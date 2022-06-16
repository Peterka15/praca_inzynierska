export default class Tag {
  id;
  name;
  articles;
  articles_count;

  /**
   * Create new object
   * @param {string} name
   * @param {string} articles
   * @param {number} articles_count
   * @return Tag
   */
  static create(name, articles, articles_count) {
    return (new Tag()).populate(null, name, articles, articles_count);
  }

  populate(id, name, articles, articles_count) {
    this.id = id;
    this.name = name;
    this.articles = articles;
    this.articles_count = articles_count;

    return this;
  }
}