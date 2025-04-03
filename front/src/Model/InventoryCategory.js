import Model from '@/Model/Model';
import ApiUrls from '@/api/ApiUrls';

export default class InventoryCategory extends Model {
  endpoint = ApiUrls.inventoryCategory;

  /** @var {string} */
  name;
  

  constructor (name = '') {
    super();

    this.name = name;
  }

  /**
   * @param {{id: number, name: string}} data
   * @return InventoryCategory
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
}
