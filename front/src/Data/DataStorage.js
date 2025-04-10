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

  /** @type {DataContainer<Role>} */
  roles;

  /** @type {DataContainer<InventoryCategory>} */
  inventoryCategories;

  /** @type {DataContainer<InventoryItem>} */
  inventoryItems;

  /** @type {Boolean} */
  ready = false;

  constructor () {
    this.articles = new DataContainer(DataContainer.TYPE_ARTICLE);
    this.comments = new DataContainer(DataContainer.TYPE_COMMENT);
    this.users = new DataContainer(DataContainer.TYPE_USER);
    this.tags = new DataContainer(DataContainer.TYPE_TAG);
    this.managements = new DataContainer(DataContainer.TYPE_MANAGEMENT);
    this.units = new DataContainer(DataContainer.TYPE_UNIT);
    this.roles = new DataContainer(DataContainer.TYPE_ROLE);
    this.inventoryCategories = new DataContainer(DataContainer.TYPE_INVENTORY_CATEGORY);
    this.inventoryItems = new DataContainer(DataContainer.TYPE_INVENTORY_ITEM);
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

    const container = this[containerName];
    if (container.data.has(object.id)) {
      console.warn(`[Data Storage] Object ${containerType}:${object.id} already exists.`);
      return;
    }

    container.data.set(object.id, object);

    console.log(`[Data Storage] Added object of ${containerType} type.`);
  }

  /**
   * Warning, this replaces whole DataContainer's data!
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

    this[containerName].data = new Map(objects.map(obj => [obj.id, obj]));
    this[containerName].ready = true;

    console.log(`[Data Storage] Loaded ${objects.length} objects of ${containerType} type.`);
  }

  /**
   * @return {boolean}
   */
  isReady () {
    return this.articles.ready;
  }
}
