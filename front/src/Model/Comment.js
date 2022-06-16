export default class Comment {
  id;
  article_id;
  author;
  content;
  created_at;
  updated_at;

/**
 * Create new object
 * @param {number} article_id
 * @param {string} author
 * @param {string} content
 * @return Comment
 */
static create (article_id, author, content){
  return (new Comment()).populate(null, article_id, author, content);
}

/**
 * Populate object with data
 * @param {?number} id
 * @param {number}  article_id
 * @param {string} author
 * @param {string} content
 * @param {?string} created_at
 * @param {?string} updated_at
 * @return Comment
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
}