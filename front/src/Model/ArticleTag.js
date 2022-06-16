export default class ArticleTag {
  id;
  tag_id;
  article_id;

  /**
   * Create new object
   * @param {number} tag_id
   * @param {number} article_id
   *
   * @return ArticleTag
   */
  static create(tag_id, article_id) {
    return (new Image()).populate(null, tag_id, article_id);
  }

  /**
   * Populate object with data
   * @param {?number} id
   * @param {number} tag_id
   * @param {number} article_id
   *
   * @return ArticleTag
   */

  populate(id, tag_id, article_id) {
    this.id = id;
    this.tag_id = tag_id;
    this.article_id = article_id;


  }
}