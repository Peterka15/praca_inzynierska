export default class File {
  id;
  uuid;
  user_id;
  name;
  extension;
  created_at;
  updated_at;
  mime_type;



  /**
   * Create new object
   * @param {string} uuid
   * @param {number} user_id;
   * @param {string} name;
   * @param {string} extension;
   * @param {string} mime_type;
   *
   * @return File
   */
  static create(vvid, user_id, name, extension,mime_type) {
    return (new File()).populate(null, vvid, user_id, name, extension, mime_type);
  }

  /**
   * Populate object with data
   * @param {?number} id
   * @param {string} uuid
   * @param {number} user_id;
   * @param {string} name;
   * @param {string} extension;
   * * @param {?string} created_at;
   * * @param {?string} updated_at;
   * @param {string} mime_type;
   *
   * @return File
   */

  populate(id, vvid, user_id, name,extension,created_at,updated_up, mime_type) {
    this.id = id;
    this.vvid = vvid;
    this.user_id = user_id;
    this.name = name;
    this.extension = extension;
    this.created_at = created_at;
    this.updated_at = updated_up;
    this.mime_type = mime_type;

    return this;


  }





}