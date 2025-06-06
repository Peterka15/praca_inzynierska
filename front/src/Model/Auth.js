import ApiUrls from '@/api/ApiUrls';
import readonly from '@/utils/readonly';
import Bridge from '@/api/Bridge';
import User from '@/Model/User';

// noinspection JSUnusedGlobalSymbols,DuplicatedCode
export default class Auth {
  @readonly
  LOCAL_STORAGE_USER_ID = 'userId';
  @readonly
  LOCAL_STORAGE_TOKEN = 'token';
  @readonly
  LOCAL_STORAGE_TOKEN_EXPIRATION_DATE = 'tokenExpirationDate';

  /** var {boolean} */
  loggedIn = false;
  /** var {boolean} */
  wasSessionRestoreAttempted = false;

  /** @var {?string} */
  token = null;
  /** @vat {?Date} */
  tokenExpirationDate = null;

  /** @var {?User} */
  user = null;

  restoreSession (callbackFn) {
    this.wasSessionRestoreAttempted = true;
    this.token = localStorage.getItem('token');

    if (!this.token) {
      this.logout();
      callbackFn(false);
      return;
    }

    this.tokenExpirationDate = Date.parse(localStorage.getItem(this.LOCAL_STORAGE_TOKEN_EXPIRATION_DATE));

    if (new Date() >= this.tokenExpirationDate) {
      this.logout();
      callbackFn(false);
      return;
    }

    Bridge.setBearerToken(this.token);

    if (this.user) {
      callbackFn(true);
      return;
    }

    User.fetchCurrentUser()
      .then((user) => {
        this.user = user;
        this.loggedIn = true;

        callbackFn(true);
      })
      .catch(() => {
        this.logout();
        callbackFn(false);
      });
  }

  /**
   * Register to api (retrieve JWT token)
   * Token is stored in localStorage
   * @param {string} email
   * @param {string} password
   * @param {string} name
   *
   * @return Promise
   */
  register (email, password, name) {
    let data = {
      email: email,
      password: password,
      name: name
    };

    return Bridge.postData(
      ApiUrls.auth.register,
      data
    );
  }

  setPassword (token, password) {
    const data = {
      password: password
    };

    return Bridge.postData(
      ApiUrls.auth.setPassword + '/' + token,
      data
    );
  }

  /**
   * Login to api (retrieve JWT token)
   * Token is stored in localStorage
   * @param {string} email
   * @param {string} password
   * @return Promise
   */
  login (email, password) {
    let data = {
      email: email,
      password: password
    };

    return Bridge.postData(
      ApiUrls.auth.login,
      data
    ).then(
      (data) => {
        let tokenExpirationDate = new Date();
        tokenExpirationDate.setTime(tokenExpirationDate.getTime() + data['data']['expires_in'] * 1000);

        localStorage.setItem(this.LOCAL_STORAGE_TOKEN, data['data']['access_token']);
        localStorage.setItem(this.LOCAL_STORAGE_TOKEN_EXPIRATION_DATE, tokenExpirationDate.toUTCString());

        this.loggedIn = true;
        this.tokenExpirationDate = tokenExpirationDate;

        Bridge.setBearerToken(data['data']['access_token']);

        this.user = (new User()).hydrate(data['data']['user']);
      }
    );
  }

  logout () {
    this.user = null;
    this.loggedIn = false;

    localStorage.removeItem(this.LOCAL_STORAGE_TOKEN);
    localStorage.removeItem(this.LOCAL_STORAGE_TOKEN_EXPIRATION_DATE);

    Bridge.setBearerToken();
  }

  /**
   * @return {?User}
   */
  getCurrentUser () {
    return this.user;
  }

  /**
   * Get JWT token as bearer string
   * Returns empty string if token not found
   * @return string
   */
  static getBearerToken () {
    let token = localStorage.getItem('token');
    return (token !== null) ? 'bearer ' + token : '';
  }
}
