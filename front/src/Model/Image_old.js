import Bridge from '@/api/Bridge';
import ApiUrls from '@/api/ApiUrls';

export default class Image_old {
 /** @var {number}*/
 id;
 /** @var {string} */
 uuid;
 /** @var {number}*/
 article_id;
 /** @var {string} */
 created_at;
 /** @var {string} */
 updated_at;

 /**
  * Create new object
  * @param {string} uuid
  * @param {number} article_id
  *
  * @return Image_old
  */
 static create(uuid, article_id) {
  return (new Image_old()).populate(null, uuid, article_id);
 }

 /**
  * Populate object with data
  * @param {string} uuid
  * @param {number} article_id
  * @param {?string} created_at
  * @param {?string} updated_at
  *
  * @return Image_old
  */

 populate(id, uuid, article_id, created_at, updated_at) {
  this.id = id;
  this.uuid = uuid
  this.article_id = article_id;
  this.created_at = created_at;
  this.updated_at = updated_at;
  return this;


 }
 /**
  * Get all categories from DB
  * This is async task, data won't be available immediately
  * @param {function} callback
  * @return Image_old[]
  */
 static getAll (callback = null) {
  let images = [];

  Bridge.get(function (responseData) {
   responseData.forEach(data => {
    images.push(
      (new Image_old()).populate(
        data.id,
        data.uuid,
        data.article_id,
        data.created_at,
        data.updated_at
      )
    );
   });

   if (callback) {
    callback(responseData.length);
   }
  }, ApiUrls.images);

  return images;
 }

 /**
  * Get one category from DB by id
  * This is async task, data won't be available immediately
  * @param {number} id
  * @param {?function} callback
  * @return Image_old
  */
 static getById (id, callback = null) {
  let image = new Image_old();

  Bridge.get(function (responseData) {
   image.populate(
     responseData.id,
     responseData.uuid,
     responseData.article_id,
     responseData.created_at,
     responseData.updated_at
   );
  }, ApiUrls.images, id);

  if (callback) {
   callback();
  }

  return image;
 }

 /**
  * Save object to DB
  */
 save () {
  let data = {

  };

  if (this.id == null) {
   Bridge.post(null, ApiUrls.images, data);
  } else {
   Bridge.put(null, ApiUrls.images, this.id, data);
  }
 }

 /**
  * Delete object from DB if no any foreign-key dependencies
  * Does not delete this instance
  */
 delete () {
  Bridge.delete(null, ApiUrls.images, this.id);
 }
}
