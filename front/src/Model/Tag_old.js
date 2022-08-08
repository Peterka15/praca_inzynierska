import Bridge from '@/api/Bridge';
import ApiUrls from '@/api/ApiUrls';

export default class Tag_old {
  /** @var {number} */
  id;
  /** @var {string} */
  name;


  /**
   * Create new object
   * @param {string} name
   * @return Tag_old
   */
  static create(name) {
    return (new Tag_old()).populate(null, name);
  }

  populate(id, name) {
    this.id = id;
    this.name = name;

    return this;
  }

  /**
   * Get all categories from DB
   * This is async task, data won't be available immediately
   * @param {function} callback
   * @return Tag_old[]
   */
  static getAll (callback = null) {
    let tags = [];

    Bridge.get(function (responseData) {
      responseData.forEach(data => {
        tags.push(
          (new Tag_old()).populate(
            data.id,
            data.name,
          )
        );
      });

      if (callback) {
        callback(responseData.length);
      }
    }, ApiUrls.tags);

    return tags;
  }

  /**
   * Get one category from DB by id
   * This is async task, data won't be available immediately
   * @param {number} id
   * @param {?function} callback
   * @return Tag_old
   */
  static getById (id, callback = null) {
    let tag = new Tag_old();

    Bridge.get(function (responseData) {
      tag.populate(
        responseData.id,
        responseData.name,
      );
    }, ApiUrls.tags, id);

    if (callback) {
      callback();
    }

    return tag;
  }

  /**
   * Save object to DB
   */
  save () {
    let data = {
      'name': this.name
    };

    if (this.id == null) {
      Bridge.post(null, ApiUrls.tags, data);
    } else {
      Bridge.put(null, ApiUrls.tags, this.id, data);
    }
  }

  /**
   * Delete object from DB if no any foreign-key dependencies
   * Does not delete this instance
   */
  delete () {
    Bridge.delete(null, ApiUrls.tags, this.id);
  }

}