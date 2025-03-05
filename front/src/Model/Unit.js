import Model from '@/Model/Model';
import ApiUrls from '@/api/ApiUrls';

export default class Unit extends Model {
  endpoint = ApiUrls.units;

  /** @var {string} */
  name;

  constructor (name = '') {
    super();

    this.name = name;
  }

  /**
   * @param {{id: number, name: string}} data
   * @return Unit
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
