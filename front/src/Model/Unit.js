import Model from '@/Model/Model';

export default class Unit extends Model {
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
