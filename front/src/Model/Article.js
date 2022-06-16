
export default class Article {
  id;
  author_id;
  title;
  content;
  created_at;
  updated_at;
  author;
  comments;
  comments_count;
  images;
  images_count;
  tags;
  tags_count;

  /**
   * Create new object
   * @param {number} author_id
   * @param {string} title
   * @param {string} content
   * @param {string} author
   * @param {string} comments
   * @param {string} images
   * @param {string} tags
   *
   * @return Article
   */
  static create(name, email, password, role) {
    return (new Article()).populate(null, name, email, password, role);
  }


  /**
   * Populate object with data
   * @param {?number} id
   * @param {number} author_id
   * @param {string} title
   * @param {number}  article_id
   * @param {string} content
   * @param {?string} created_at
   * @param {?string} updated_at
   * @param {string} author
   * @param {string} comments
   * @param {number} comments_count
   * @param {string} images
   * @param {number} images_count
   * @param {string} tags
   * @param {number} tags_count
   *
   * @return Article
   */

  populate(id, author_id,  article_id, title, content, created_at = null, updated_at = null, author, comments, comments_count, images, images_count, tags, tags_count) {
    this.id = id;
    this.article_id = article_id;
    this.author = author;
    this.content = content;
    this.created_at = created_at;
    this.updated_at = updated_at;
    this.comments = comments;
    this.comments_count = comments_count;
    this.images = images;
    this.images_count = images_count;
    this.tags = tags;
    this.tags_count = tags_count;

    return this;


  }
}