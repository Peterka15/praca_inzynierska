import Model from '@/Model/Model';
import ApiUrls from '@/api/ApiUrls';

export default class Image extends Model {
  endpoint = ApiUrls.articles;

  /** @var {string} */
  uuid;
  /** @var {string} */
  url;
  /** @var {number} */
  article_id;
  /** @var {string} */
  created_at;
  /** @var {string} */
  updated_at;

  constructor (uuid = '', article_id = 0) {
    super();

    this.uuid = uuid;
    this.article_id = article_id;
  }

  /** @return Image */
  hydrate (data) {
    this.id = data.id;
    this.uuid = data.uuid;
    this.url = data.url;
    this.article_id = data.article_id;
    this.created_at = data.created_at;
    this.updated_at = data.updated_at;

    return this;
  }

  /** @return {{uuid: string, article_id: number}} */
  dehydrate () {
    return (
      {
        uuid: this.uuid,
        article_id: this.article_id
      }
    );
  }
}
