import Model from "@/Model/Model";
import ApiUrls from "@/api/ApiUrls";

export default class Tag extends Model {
  endpoint = ApiUrls.articles;

  /** @var {string} */
  name;

  constructor(name = '') {
    super();

    this.name = name;
  }

  /** @return Tag */
  hydrate(data) {
    this.id = data.id;
    this.name = data.name;

    return this;
  }

  /** @return {{name: string}} */
  dehydrate() {
    return (
      {
        name: this.name,
      }
    );
  }
}