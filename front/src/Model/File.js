import Model from '@/Model/Model';
import ApiUrls from '@/api/ApiUrls';

export default class File extends Model {
  endpoint = ApiUrls.articles;

  /** @var {number} */
  uuid;
  /** @var {number} */
  user_id;
  /** @var {string} */
  name;
  /** @var {string} */
  mime_type;
  /** @var {Date} */
  created_at;
  /** @var {Date} */
  updated_at;

  constructor (uuid = '', user_id = '', name = '', mime_type = '') {
    super();

    this.uuid = uuid;
    this.user_id = user_id;
    this.name = name;
    this.mime_type = mime_type;
  }

  /** @return File */
  hydrate (data) {
    this.id = data.id;
    this.uuid = data.uuid;
    this.user_id = data.user_id;
    this.name = data.name;
    this.mime_type = data.mime_type;
    this.created_at = new Date(Date.parse(data.created_at));
    this.updated_at = new Date(Date.parse(data.updated_at));

    return this;
  }

  /** @return {{author: string, title: string, content: string}} */
  dehydrate () {
    return (
      {
        uuid: this.uuid,
        user_id: this.user_id,
        name: this.name,
        mime_type: this.mime_type
      }
    );
  }
}
