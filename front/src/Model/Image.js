export default class Image {
 id;
 uuid;
 article_id;
 created_at;
 updated_at;
 extension;
 mime_type;

 /**
  * Create new object
  * @param {string} uuid
  * @param {number} article_id
  * @param {string} extension
  * @param {string} mime_type
  *
  * @return Image
  */
 static create(uuid, article_id, extension, mime_type) {
  return (new Image()).populate(null, uuid, article_id, extension, mime_type);
 }

 /**
  * Populate object with data
  * @param {string} uuid
  * @param {number} article_id
  * @param {?string} created_at
  * @param {?string} updated_at
  * @param {string} extension
  * @param {string} mime_type

  *
  * @return Image
  */

 populate(id, uuid, article_id, created_at, updated_at, extension, mime_type) {
  this.id = id;
  this.uuid = uuid
  this.article_id = article_id;
  this.created_at = created_at;
  this.updated_at = updated_at;
  this.extension = extension;
  this.mime_type = mime_type;

  return this;


 }


}
