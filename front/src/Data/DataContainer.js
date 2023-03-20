import readonly from '@/utils/readonly';
import Article from "@/Model/Article";

export default class DataContainer {
  @readonly
  static TYPE_ARTICLE = 'article';


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
    return this.classObj.getAll().then(obj => {
      this.data = obj;
      this.ready = true;
      console.log(`Loaded ${obj.length} objects of ${this.type} type.`);

      return this.data;
    });
  }

  onLoad (callback, dataAmount) {
    if (this.data.length === dataAmount) {
      this.ready = true;
      console.log(`Loaded ${dataAmount} objects of ${this.type} type.`);

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
      default:
        throw Error(`Class ${type} don't exists.`);
    }
  }
}
