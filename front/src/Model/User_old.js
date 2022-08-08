import Bridge from '@/api/Bridge';
import ApiUrls from '@/api/ApiUrls';


// noinspection JSUnusedGlobalSymbols,DuplicatedCode
export default class User_old {
  /** @var {number} */
  id;
  /** @var {string} */
  name;
  /** @var {string} */
  email;
  /** @var {string} */
  password;
  /** @var {string} */
  created_at;
  /** @var {string} */
  updated_at;

  ready = false;

  /**
   * Create new object
   * @param {string} name
   * @param {string} email
   * @param {string} password
   * @return User_old
   */
  static create (name, email, password) {
    return (new User_old()).populate(null, name, email, password);
  }

  /**
   * Populate object with data
   * @param {?number} id
   * @param {string} name
   * @param {string} email
   * @param {string} password
   * @param {?string} created_at
   * @param {?string} updated_at
   * @return User_old
   */
  populate (id, name, email, password, created_at = null, updated_at = null) {
    this.id = id;
    this.name = name;
    this.email = email;
    this.password = password;
    this.created_at = created_at;
    this.updated_at = updated_at;

    this.ready = true;
    return this;
  }

  /**
   * Get all categories from DB
   * This is async task, data won't be available immediately
   * @param {function} callback
   * @return User_old[]
   */
  static getAll (callback = null) {
    let users = [];

    Bridge.get(function (responseData) {
      responseData.forEach(data => {
        users.push(
          (new User_old()).populate(
            data.id,
            data.name,
            data.email,
            data.password,
            data.created_at,
            data.updated_at
          )
        );
      });

      if (callback) {
        callback(responseData.length);
      }
    }, ApiUrls.users);

    return users;
  }

  /**
   * Get one category from DB by id
   * This is async task, data won't be available immediately
   * @param {number} id
   * @param {?function} callback
   * @return User_old
   */
  static getById (id, callback = null) {
    let user = new User_old();

    Bridge.get(function (responseData) {
      user.populate(
        responseData.id,
        responseData.name,
        responseData.email,
        responseData.password,
        responseData.created_at,
        responseData.updated_at
      );
    }, ApiUrls.users, id);

    if (callback) {
      callback();
    }

    return user;
  }

  /**
   * Save object to DB
   */
  save () {
    let data = {
      'name': this.name,
      'email': this.email,
      'password': this.password,
    };

    if (this.id == null) {
      Bridge.post(null, ApiUrls.users, data);
    } else {
      Bridge.put(null, ApiUrls.users, this.id, data);
    }
  }

  /**
   * Delete object from DB if no any foreign-key dependencies
   * Does not delete this instance
   */
  delete () {
    Bridge.delete(null, ApiUrls.users, this.id);
  }
}
