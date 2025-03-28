import Model from '@/Model/Model';
import UserRole from '@/enum/UserRole';
import ApiUrls from '@/api/ApiUrls';

export default class Role extends Model {
  endpoint = ApiUrls.roles;
  
  /** @var {string} */
  name;

  constructor (name = '') {
    super();

    this.name = name;
  }

  /**
   * @param {{id: number, name: string}} data
   * @return Role
   */
  hydrate (data) {
    this.id = data.id;
    this.name = data.name;

    return this;
  }

  /**
   * @return {{name: string}}
   */
  dehydrate () {
    return {
      name: this.name
    };
  }

  /**
   * @return {boolean}
   */
  isAdmin () {
    return this.id === UserRole.ADMIN;
  }

  /**
   * @return {boolean}
   */
  isModerator () {
    return this.id === UserRole.MODERATOR;
  }

  /**
   * @return {boolean}
   */
  isUser () {
    return this.id === UserRole.USER;
  }

  /**
   * @return {boolean}
   */
  isCommandant () {
    return this.id === UserRole.COMMANDANT;
  }

  /**
   * @return {boolean}
   */
  isPublic () {
    return this.id === UserRole.PUBLIC;
  }

  /**
   * @return {boolean}
   */
  isDisabled () {
    return this.id === UserRole.DISABLED;
  }
}
