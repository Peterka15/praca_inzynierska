import Bridge from "@/api/Bridge";
import ApiUrls from "@/api/ApiUrls";

export default class Comment_old {
  /** @var {number} */
  id;
  /** @var {number} */
  article_id;
  /** @var {string} */
  author;
  /** @var {string} */
  content;
  /** @var {string} */
  created_at;
  /** @var {string} */
  updated_at;

/**
 * Create new object
 * @param {number} article_id
 * @param {string} author
 * @param {string} content
 * @return Comment_old
 */
static create (article_id, author, content){
  return (new Comment_old()).populate(null, article_id, author, content);
}

/**
 * Populate object with data
 * @param {?number} id
 * @param {number}  article_id
 * @param {string} author
 * @param {string} content
 * @param {?string} created_at
 * @param {?string} updated_at
 * @return Comment_old
 */

populate (id,  article_id, author, content, created_at = null, updated_at = null)
{
  this.id = id;
  this.article_id = article_id;
  this.author = author;
  this.content = content;
  this.created_at = created_at;
  this.updated_at = updated_at;

  return this;
}
  /**
   * Get all categories from DB
   * This is async task, data won't be available immediately
   * @param {function} callback
   * @return Comment_old[]
   */
  static getAll (callback = null) {
    let comments = [];

    Bridge.get(function (responseData) {
      responseData.forEach(data => {
        comments.push(
          (new Comment_old()).populate(
            data.id,
            data.article_id,
            data.author,
            data.content,
            data.created_at,
            data.updated_at
          )
        );
      });

      if (callback) {
        callback(responseData.length);
      }
    }, ApiUrls.comments);

    return comments;
  }

  /**
   * Get one category from DB by id
   * This is async task, data won't be available immediately
   * @param {number} id
   * @param {?function} callback
   * @return Comment_old
   */
  static getById (id, callback = null) {
    let comment = new Comment_old();

    Bridge.get(function (responseData) {
      comment.populate(
        responseData.id,
        responseData.article_id,
        responseData.author,
        responseData.content,
        responseData.created_at,
        responseData.updated_at
      );
    }, ApiUrls.comments, id);

    if (callback) {
      callback();
    }

    return comment;
  }

  /**
   * Save object to DB
   */
  save () {
    let data = {
      'author': this.author,
      'content': this.content,
    };

    if (this.id == null) {
      Bridge.post(null, ApiUrls.comments, data);
    } else {
      Bridge.put(null, ApiUrls.comments, this.id, data);
    }
  }

  /**
   * Delete object from DB if no any foreign-key dependencies
   * Does not delete this instance
   */
  delete () {
    Bridge.delete(null, ApiUrls.comments, this.id);
  }
}