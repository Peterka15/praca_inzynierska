export default class User {
  id;
  name;
  email;
  password;
  created_at
  updated_at;

  /**
   * Create new object
   * @param {string} name
   * @param {string} email
   * @param {string} password
   * @return User
   */

  static create (name, email,password ){
    return (new User()).populate(null, name, email, password);
  }
  /**
   * Populate object with data
   * @param {?number} id
   * @param {string} name
   * @param {string} email
   * @param {string} password
   * @param {?string} created_at
   * @param {?string} updated_at
   * @return User
   */
  populate (id, name, email, password,created_at, updated_at = null) {
    this.id = id;
    this.name = name;
    this.email = email;
    this.password = password;
    this.created_at = created_at;
    this.updated_at = updated_at;
  }
}