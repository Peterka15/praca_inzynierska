import Model from "@/Model/Model";
import ApiUrls from "@/api/ApiUrls";

export default class Article extends Model {
  endpoint = ApiUrls.articles;

  /** @var {string} */
  author;
  /** @var {string} */
  title;
  /** @var {string} */
  content;

  images;
  /** @var {string} */
  comments;
  /** @var {string} */
  tags;
  /** @var {string} */
  created_at;
  /** @var {string} */
  updated_at;

  constructor(title = '', author = '', content = '') {
    super();

    this.title = title;
    this.author = author;
    this.content = content;
  }

  /** @return Article */
  hydrate(data) {
    this.id = data.id ?? 0;
    this.title = data.title;
    this.author = data.author;
    this.content = data.content;
    this.created_at = data.created_at;
    this.updated_at = data.updated_at;
    this.comments = data.comments;
    this.images = data.images;
    this.tags = data.tags;

    return this;
  }

  /** @return {{author: string, title: string, content: string}} */
  dehydrate() {
    return (
      {
        title: this.title,
        author: this.author,
        content: this.content,
      }
    );
  }
}