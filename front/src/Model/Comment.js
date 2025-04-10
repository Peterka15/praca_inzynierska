import Model from '@/Model/Model';
import ApiUrls from '@/api/ApiUrls';

export default class Comment extends Model {
  endpoint = ApiUrls.comments;

  /** @var {number} */
  article_id;
  /** @var {string} */
  author;
  /** @var {string} */
  content;
  /** @var {string} */
  Auth_NotLoggedInOnly
  /** @var {Date} */
  updated_at;

  constructor (article_id = 0, author = '', content = '') {
    super();

    this.article_id = article_id;
    this.author = author;
    this.content = content;
  }

  /** @return Comment */
  hydrate (data) {
    this.id = data.id;
    this.article_id = data.article_id;
    this.author = data.author;
    this.content = data.content;
    this.created_at = new Date(Date.parse(data.created_at));
    this.updated_at = new Date(Date.parse(data.updated_at));

    return this;
  }

  /** @return {{article_id: number, author: string, content: string}} */
  dehydrate () {
    return (
      {
        article_id: this.article_id,
        author: this.author,
        content: this.content
      }
    );
  }
}
