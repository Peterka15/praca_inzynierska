import Model from '@/Model/Model';
import ApiUrls from '@/api/ApiUrls';
import User from '@/Model/User';

export default class File extends Model {
  endpoint = ApiUrls.files;

  /** @var {number} */
  uuid;
  /** @var {User} */
  user;
  /** @var {string} */
  url;
  /** @var {string} */
  name;
  /** @var {string} */
  mime_type;
  /** @var {Date} */
  created_at;
  /** @var {Date} */
  updated_at;

  constructor (uuid, name, mime_type) {
    super();

    this.uuid = uuid;
    this.name = name;
    this.mime_type = mime_type;
  }

  /** @return File */
  hydrate (data) {
    this.id = data.id;
    this.uuid = data.uuid;
    this.url = data.url;
    this.user = (new User()).hydrate(data.user);
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
        user_id: this.user.id,
        name: this.name,
        mime_type: this.mime_type
      }
    );
  }
}
