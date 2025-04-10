import Model from '@/Model/Model';
import Unit from '@/Model/Unit';

export default class Management extends Model {
  endpoint = 'management';

  /** @var {string} */
  name;

  /** @var {string} */
  function;

  /** @var {Unit} */
  unit;

  /**
   * @param {string} name
   * @param {string} func
   * @param {Unit} unit
   */
  constructor (name = '', func = '', unit = new Unit()) {
    super();
    this.name = name;
    this.function = func;
    this.unit = unit;
  }

  /**
   * @param {{id: number, name: string, function: string, unit: {id: number, name: string}}} data
   * @return {Management}
   */
  hydrate (data) {
    this.id = data.id;
    this.name = data.name;
    this.function = data.function;
    this.unit = (new Unit()).hydrate(data.unit);
    return this;
  }

  /**
   * @return {{name: string, function: string, unit: object}}
   */
  dehydrate () {
    return {
      name: this.name,
      function: this.function,
      unit_id: this.unit.id
    };
  }
}
