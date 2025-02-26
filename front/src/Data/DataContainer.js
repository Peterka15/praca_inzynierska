import readonly from '@/utils/readonly';
import Article from '@/Model/Article';
import Tag from '@/Model/Tag';
import User from '@/Model/User';
import Comment from '@/Model/Comment';

export default class DataContainer {
  @readonly
  static TYPE_ARTICLE = 'article';
  @readonly
  static TYPE_USER = 'user';
  @readonly
  static TYPE_COMMENT = 'comment';
  @readonly
  static TYPE_TAG = 'tag';

  /** @type {?string} */
  type = null;
  /** @type {*[]} */
  data = [];
  /** @type {boolean} */
  ready = false;
  /** @type {Object} */
  classObj = null;

  constructor (type) {
    try {
      this.type = type;
      this.classObj = DataContainer.#getClass(type);
    } catch (error) {
      console.warn(error.message);
    }
  }

  load () {
    console.info(`[Data Container] Load triggered for ${this.type} type.`);
    return this.classObj.getAll().then(obj => {
      this.data = obj;
      this.ready = true;
      console.info(`[Data Container] Loaded ${obj.length} objects of ${this.type} type.`);

      return this.data;
    });
  }

  onLoad (callback, dataAmount) {
    if (this.data.length === dataAmount) {
      this.ready = true;
      console.info(`[Data Container] Loaded ${dataAmount} objects of ${this.type} type.`);

      if (callback) {
        callback();
      }
    }
  }

  /**
   * @param {string }type
   * @return {Article}
   * @throws Error
   */
  static #getClass (type) {
    switch (type) {
      case DataContainer.TYPE_ARTICLE:
        return Article;
      case DataContainer.TYPE_TAG:
        return Tag;
      case DataContainer.TYPE_USER:
        return User;
      case DataContainer.TYPE_COMMENT:
        return Comment;
      default:
        throw Error(`[DataContainer] Class ${type} don't exists.`);
    }
  }
}
