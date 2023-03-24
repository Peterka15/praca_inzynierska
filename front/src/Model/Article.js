import Model from "@/Model/Model";
import ApiUrls from "@/api/ApiUrls";
import User from "@/Model/User";
import Tag from "@/Model/Tag";
import Image from "@/Model/Image";
import Comment from "@/Model/Comment";

export default class Article extends Model {
  endpoint = ApiUrls.articles;

  /** @var {User} */
  author;
  /** @var {string} */
  title;
  /** @var {string} */
  content;

  /** @var {Image[]} */
  images;
  /** @var {Comment[]} */
  comments;
  /** @var {Tag[]} */
  tags;
  /** @var {string} */
  created_at;
  /** @var {string} */
  updated_at;

  /**
   *
   * @param {string} title
   * @param {string} content
   * @param {Tag[]} tags
   */
  constructor(title = '', content = '', tags = []) {
    super();

    this.title = title;
    this.content = content;
    this.tags = tags;
  }

  /** @return Article */
  hydrate(data) {
    this.id = data.id ?? 0;
    this.title = data.title;
    this.author = (new User()).hydrate(data.author);
    this.content = data.content;
    this.created_at = data.created_at;
    this.updated_at = data.updated_at;
    this.comments = data.comments.map(commentData => (new Comment()).hydrate(commentData));
    this.images = data.images.map(imageData => (new Image()).hydrate(imageData));
    this.tags = data.tags.map(tagData => (new Tag()).hydrate(tagData));

    return this;
  }

  /** @return {{title: string, content: string, tags: string}} */
  dehydrate() {
    return (
      {
        title: this.title,
        content: this.content,
        tags: this.tags.map(tag => tag.name).join(',')
      }
    );
  }
}