import DataContainer from '@/Data/DataContainer';

export default class DataStorage {
  /** @type {DataContainer<Article>} */
  articles;

  /** @type {DataContainer<Comment>} */
  comments;

  /** @type {DataContainer<User>} */
  users;

  /** @type {DataContainer<Tag>} */
  tags;

  /** @type {DataContainer<Management>} */
  managements;

  /** @type {DataContainer<Unit>} */
  units;

  /** @type {?number} */
  loggedAsId = null;

  /** @type {Boolean} */
  ready = false;

  constructor () {
    this.articles = new DataContainer(DataContainer.TYPE_ARTICLE);
    this.comments = new DataContainer(DataContainer.TYPE_COMMENT);
    this.users = new DataContainer(DataContainer.TYPE_USER);
    this.tags = new DataContainer(DataContainer.TYPE_TAG);
    this.managements = new DataContainer(DataContainer.TYPE_MANAGEMENT);
    this.units = new DataContainer(DataContainer.TYPE_UNIT);
  }

  loadBasicData () {
    return Promise.all([this.articles.load(), this.tags.load(), this.units.load()])
      .then(() => {
        this.onDataAvailable();
      });
  }

  onDataAvailable () {
    this.ready = this.isReady();

    if (this.ready) {
      console.log('[Data Storage] Ready.');
    }
  }

  /**
   * @param {Object} object
   */
  add (object) {
    if (!object instanceof Object) {
      throw new Error('Object must be an instance of Object.');
    }

    const containerType = DataContainer.getContainerTypes()[object.constructor.name];

    if (containerType === undefined) {
      throw new Error('Object must be an instance of one of DataContainer.TYPE_XXX classes.');
    }

    const containerName = `${containerType}s`;

    if (!this.hasOwnProperty(containerName)) {
      throw new Error('No DataContainer for given containerType.');
    }

    if (this[containerName].data.indexOf((item) => item.id === object.id)) {
      console.warn(`[Data Storage] Object ${containerType}:${object.id} already exists.`);
      return;
    }

    this[containerName].data.push(object);

    console.log(`[Data Storage] Added object of ${containerType} type.`);
  }

  /**
   * @param {Object[]} objects
   */
  set (objects) {
    if (!Array.isArray(objects) || objects.some(obj => !(obj instanceof Object))) {
      throw new Error('Input must be an array of objects.');
    }

    const containerType = DataContainer.getContainerTypes()[objects[0].constructor.name];

    if (containerType === undefined) {
      throw new Error('Objects must be instances of one of DataContainer.TYPE_XXX classes.');
    }

    const containerName = `${containerType}s`;

    if (!this.hasOwnProperty(containerName)) {
      throw new Error('No DataContainer for given containerType.');
    }

    this[containerName].data = objects;
    this[containerName].ready = true;

    console.log(`[Data Storage] Loaded ${objects.length} objects of ${containerType} type.`);
  }

  /**
   * @return {boolean}
   */
  isReady () {
    return this.articles.ready;
  }

  /**
   * @return {?Article[]}
   */
  getArticles () {
    return this.articles.data;
  }

  /**
   * @param {number} id
   * @return {?Article}
   */
  getArticle (id) {
    return this.articles.data.find(article => article.id === id);
  }

  /**
   * @param article
   */
  removeArticle (article) {
    this.articles.data.splice(this.articles.data.indexOf(article), 1);
  }

  /**
   * @param {Article} article
   */
  addArticle (article) {
    this.articles.data.push(article);
  }

  /**
   * @param {Comment} comment
   */
  addComment (comment) {
    this.comments.data.push(comment);
  }

  /**
   * @return {?Comment[]}
   */
  getComments () {
    return this.comments.data;
  }

  /**
   * @param {User} user
   */
  addUser (user) {
    this.users.data.push(user);
  }

  /**
   * @return {?User}
   */
  getLoggedUser () {
    return this.users.data.find(user => user.id === this.loggedAsId);
  }
}
