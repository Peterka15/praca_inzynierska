import Model from '@/Model/Model';
import ApiUrls from '@/api/ApiUrls';
import Unit from '@/Model/Unit';
import InventoryCategory from '@/Model/InventoryCategory';

export default class InventoryItem extends Model {
  endpoint = ApiUrls.inventoryItem;

  /** @var {string} */
  name;

  /** @var {number} */
  amount = 0;

  /** @var {InventoryCategory} */
  category;

  /** @var {Unit} */
  unit;

  /** @var {boolean} */
  available = true;


  constructor(name = '', amount = 0, category = new InventoryCategory(), unit = new Unit(), available = true) {
    super();

    this.name = name;
    this.amount = amount;
    this.category = category;
    this.unit = unit;
    this.available = available;
  }

  /**
   * @param {{id: number, name: string, amount: number, category: {id: number, name: string}, unit: {id: number, name: string}, available: number}} data
   * @return InventoryItem
   */
  hydrate(data) {
    this.id = data.id;
    this.name = data.name;
    this.amount = data.amount;
    this.category = (new InventoryCategory()).hydrate(data.category);
    this.unit = (new Unit()).hydrate(data.unit);
    this.available = !!data.available;

    return this;
  }

  /**
   * @return {{name: string, amount: number, category_id: number, unit_id: number, available: boolean}}
   */
  dehydrate() {
    return {
      name: this.name,
      amount: this.amount,
      category_id: this.category.id,
      unit_id: this.unit.id,
      available: this.available
    };
  }
}
