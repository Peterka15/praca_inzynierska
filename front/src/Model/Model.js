import ApiUrls from '@/api/ApiUrls';
import Bridge, { BridgeRequestMethod } from '@/api/Bridge';

export default class Model {
  endpoint = ApiUrls.articles;
  id = 0;

  static fromData (data) {
    return (new this()).hydrate(data);
  }

  refresh () {
    return Bridge.getData(this.endpoint, this.id)
      .then((response) => {
        if (response.message !== undefined) {
          throw new Error(`GET failed with message ${response.message}`);
        }

        this.hydrate(response.data);

        /** @var Model this */
        return this;
      });
  }

  static get (id = null, args = null) {
    const model = new this();

    return Bridge.getData(model.endpoint, id, args)
      .then((response) => {
        if (response.message !== undefined) {
          throw new Error(`GET failed with message ${response.message}`);
        }

        if(Array.isArray(response.data)) {
          return response.data.map((data) => (new this()).hydrate(data));
        }

        return model.hydrate(response.data);
      });
  }

  post () {
    if (this.id !== 0) {
      throw new Error('Can\'t POST already created object.');
    }

    return Bridge.postData(this.endpoint, this.dehydrate(BridgeRequestMethod.POST))
      .then((response) => {
        if (response.message !== undefined) {
          throw new Error(`POST failed with message ${response.message}`);
        }

        this.hydrate(response.data);

        /** @var Model this */
        return this;
      });
  }

  put () {
    if (this.id === 0) {
      throw new Error('Can\'t PUT non-existing object.');
    }

    return Bridge.putData(this.endpoint, this.id, this.dehydrate(BridgeRequestMethod.PUT))
      .then((response) => {
        if (response.message !== undefined) {
          throw new Error(`PUT failed with message ${response.message}`);
        }

        this.hydrate(response.data);

        /** @var Model this */
        return this;
      });
  }

  save () {
    return (this.id === 0) ? this.post() : this.put();
  }

  delete () {
    if (this.id === 0) {
      throw new Error('Can\'t DELETE non-existing object.');
    }

    return Bridge.deleteData(this.endpoint, this.id)
      .then((response) => {
        if (response?.data) {
          throw new Error(`DELETE failed with message ${response.message}`);
        }

        /** @var Model this */
        return this;
      });
  }

  /** @return Object */
  // eslint-disable-next-line no-unused-vars
  hydrate (data) {
    throw new Error('CANNOT USE HYDRATE');
  }

  /** @return Object */
  // eslint-disable-next-line no-unused-vars
  dehydrate (method) {
    throw new Error('CANNOT USE DEHYDRATE');
  }
}
