import Model from "@/Model/Model";
import ApiUrls from "@/api/ApiUrls";

export default class Tag extends Model {
  endpoint = ApiUrls.articles;

  /** @var {string} */
  name;

  constructor(name = '') {
    super();

    this.title = name;
  }

  /** @return Article */
  hydrate(data) {
    this.id = data.id ;
    this.name = data.name;

    return this;
  }

  /** @return {{author: string, title: string, content: string}} */
  dehydrate() {
    return (
      {
        name: this.name,
      }
    );
  }
}