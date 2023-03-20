import Model from './Model';
import ApiUrls from "@/api/ApiUrls";
import Bridge, {BridgeRequestMethod} from "@/api/Bridge";

export default class User extends Model {
  endpoint = ApiUrls.users;

  /** @var {string} */
  name;
  /** @var {string} */
  email;
  /** @var {string} */
  password = '';
  /** @var {string} */
  created_at = '';
  /** @var {string} */
  updated_at = '';

  constructor(name = '', email = '') {
    super();

    this.name = name;
    this.email = email;
  }

  /** @return User */
  hydrate(data) {
    this.id = data.id;
    this.name = data.name;
    this.email = data.email;
    this.password = data.password;
    this.created_at = data.created_at;
    this.updated_at = data.updated_at;

    return this;
  }

  dehydrate(method) {
    return (
      (method === BridgeRequestMethod.POST)
        ? {
          name: this.name,
          email: this.email,
          password: this.password
        } : {
          name: this.name,
          email: this.email,
        }
    );
  }

  /** @return {Promise<User>} */
  static fetchCurrentUser() {
    return Bridge.getData(ApiUrls.profile).then((user) => (new User()).hydrate(user));
  }
}