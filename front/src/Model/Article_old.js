import Bridge from "@/api/Bridge";
import ApiUrls from "@/api/ApiUrls";

export default class Article_old {
  /** @var {number} */
  id;
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

  /**
   * Create new object
   * @param {string} author
   * @param {string} title
   * @param {string} content
   * @param {string} comments
   * @param {string} images
   * @param {string} tags
   *
   * @return Article_old
   */
  static create(author, title, content, comments,images, tags) {
    return (new Article_old()).populate(null, author, title, content, comments, images, tags);
  }


  /**
   * Populate object with data
   * @param {?number} id
   * @param {string} author
   * @param {string} title
   * @param {string} content
   * @param {string} comments
   * @param {string} images
   * @param {string} tags
   *
   * @return Article_old
   */

  populate(id, title,author, content, created_at = null, updated_at = null, comments, images, tags) {
    this.id = id;
    this.title = title;
    this.author = author;
    this.content = content;
    this.created_at = created_at;
    this.updated_at = updated_at;
    this.comments = comments;
    this.images = images;
    this.tags = tags;

    return this;


  }
  /**
   * Get all categories from DB
   * This is async task, data won't be available immediately
   * @param {function} callback
   * @return User[]
   */
  static getAll (callback = null) {
    let articles = [];

    Bridge.get(function (responseData) {
      responseData.forEach(data => {
        articles.push(
          (new Article_old()).populate(
            data.id,
            data.title,
            data.author,
            data.content,
            data.created_at,
            data.updated_at,
            data.comments,
            data.images,
            data.tags

          )
        );
      });

      if (callback) {
        callback(responseData.length);
      }
    }, ApiUrls.articles);

    return articles;
  }

  /**
   * Get one category from DB by id
   * This is async task, data won't be available immediately
   * @param {number} id
   * @param {?function} callback
   * @return Article_old
   */
  static getById (id, callback = null) {
    let article = new Article_old();

    Bridge.get(function (responseData) {
      article.populate(
        responseData.id,
        responseData.title,
        responseData.author,
        responseData.content,
        responseData.created_at,
        responseData.updated_at,
        responseData.comments,
        responseData.images,
        responseData.tags

      );
    }, ApiUrls.users, id);

    if (callback) {
      callback();
    }

    return article;
  }

  /**
   * Save object to DB
   */
  save () {
    let data = {
      'title': this.title,
      'author': this.author,
      'content': this.content,
    };

    if (this.id == null) {
      Bridge.post(null, ApiUrls.articles, data);
    } else {
      Bridge.put(null, ApiUrls.articles, this.id, data);
    }
  }

  /**
   * Delete object from DB if no any foreign-key dependencies
   * Does not delete this instance
   */
  delete () {
    Bridge.delete(null, ApiUrls.users, this.id);
  }
}