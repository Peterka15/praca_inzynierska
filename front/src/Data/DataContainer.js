import readonly from '@/utils/readonly';
import Article from '@/Model/Article';
import Tag from '@/Model/Tag';
import User from '@/Model/User';
import Comment from '@/Model/Comment';
import Management from '@/Model/Management';
import Unit from '@/Model/Unit';

/**
 * @template T
 */
export default class DataContainer {
  @readonly
  static TYPE_ARTICLE = 'article';
  @readonly
  static TYPE_USER = 'user';
  @readonly
  static TYPE_COMMENT = 'comment';
  @readonly
  static TYPE_TAG = 'tag';
  @readonly
  static TYPE_MANAGEMENT = 'management';
  @readonly
  static TYPE_UNIT = 'unit';

  /** @type {?string} */
  type = null;
  /** @type {Map<number, T>} */
  data = new Map();
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

  /**
   * @returns {Promise<Map<number, T>>}
   */
  load () {
    if(this.ready) {
      return Promise.resolve(this.data).then();
    }

    console.info(`[Data Container] Load triggered for ${this.type} type.`);
    return this.classObj.get().then(arrayOfItems => {
      this.data = new Map(arrayOfItems.map(item => [item.id, item]));
      this.ready = true;
      console.info(`[Data Container] Loaded ${arrayOfItems.length} objects of ${this.type} type.`);

      return this.data;
    });
  }

  static getContainerTypes() {
    return {
      Article: DataContainer.TYPE_ARTICLE,
      Comment: DataContainer.TYPE_COMMENT,
      User: DataContainer.TYPE_USER,
      Tag: DataContainer.TYPE_TAG,
      Management: DataContainer.TYPE_MANAGEMENT,
      Unit: DataContainer.TYPE_UNIT
    };
  }

  /**
   * @param {string }type
   * @return {Article|Tag|User|Comment|Management}
   * @throws Error
   */
  static #getClass (type) {
    const typesMap = {
      [DataContainer.TYPE_ARTICLE]: Article,
      [DataContainer.TYPE_TAG]: Tag,
      [DataContainer.TYPE_USER]: User,
      [DataContainer.TYPE_COMMENT]: Comment,
      [DataContainer.TYPE_MANAGEMENT]: Management,
      [DataContainer.TYPE_UNIT]: Unit
    };

    if (!(type in typesMap)) {
      throw Error(`[DataContainer] Class ${type} don't exists.`);
    }

    return typesMap[type];
  }

  /**
   * @param id
   * @returns {T|null}
   */
  getById(id) {
    return this.data.get(id) || null;
  }
  
  /**
   * @return {T[]}
   */
  getDataAsArray() {
    return Array.from(this.data.values());
  }
}
