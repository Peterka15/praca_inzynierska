import Bridge from '@/api/Bridge';
import ApiUrls from '@/api/ApiUrls';

export default class File_old {
  /** @var {number} */
  id;
  /** @var {number} */
  uuid;
  /** @var {number} */
  user_id;
  /** @var {string} */
  name;
  /** @var {string} */
  mime_type;
  /** @var {string} */
  created_at;
  /** @var {string} */
  updated_at;



  /**
   * Create new object
   * @param {string} uuid
   * @param {number} user_id;
   * @param {string} name;
   *
   * @return File_old
   */
  static create(uuid, user_id, name,mime_type) {
    return (new File_old()).populate(null, uuid, user_id, name, mime_type);
  }

  /**
   * Populate object with data
   * @param {?number} id
   * @param {string} uuid
   * @param {number} user_id;
   * @param {string} name;
   * @param {string} mime_type;
   * @param {?string} created_at;
   * @param {?string} updated_at;

   *
   * @return File_old
   */

  populate(id, uuid, user_id, name,created_at,updated_at, mime_type) {
    this.id = id;
    this.uuid = uuid;
    this.user_id = user_id;
    this.name = name;
    this.mime_type = mime_type;
    this.created_at = created_at;
    this.updated_at = updated_at;

    return this;


  }

  /**
   * Get all categories from DB
   * This is async task, data won't be available immediately
   * @param {function} callback
   * @return File_old[]
   */
  static getAll (callback = null) {
    let files = [];

    Bridge.get(function (responseData) {
      responseData.forEach(data => {
        files.push(
          (new File_old()).populate(
            data.id,
            data.uuid,
            data.user_id,
            data.name,
            data.mime_type,
            data.created_at,
            data.updated_at
          )
        );
      });

      if (callback) {
        callback(responseData.length);
      }
    }, ApiUrls.files);

    return files;
  }

  /**
   * Get one category from DB by id
   * This is async task, data won't be available immediately
   * @param {number} id
   * @param {?function} callback
   * @return File_old
   */
  static getById (id, callback = null) {
    let file = new File_old();

    Bridge.get(function (responseData) {
      file.populate(
        responseData.id,
        responseData.uuid,
        responseData.user_id,
        responseData.name,
        responseData.mime_type,
        responseData.created_at,
        responseData.updated_at
      );
    }, ApiUrls.files, id);

    if (callback) {
      callback();
    }

    return file;
  }

  /**
   * Save object to DB
   */
  save () {
    let data = {
      'name': this.name,
    };

    if (this.id == null) {
      Bridge.post(null, ApiUrls.files, data);
    } else {
      Bridge.put(null, ApiUrls.files, this.id, data);
    }
  }

  /**
   * Delete object from DB if no any foreign-key dependencies
   * Does not delete this instance
   */
  delete () {
    Bridge.delete(null, ApiUrls.files, this.id);
  }



}