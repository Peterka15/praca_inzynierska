import ApiResponseError from "@/api/ApiResponseError";
import {baseApiUrl} from "@/api/ApiUrls";

export const BridgeRequestMethod = {
  GET: 'get',
  POST: 'post',
  PUT: 'put',
  DELETE: 'delete'
}

export default class Bridge {
  static authorizationToken = '';

  static getHeaders() {
    return {
      Accept: 'application/json',
      'Content-type': 'application/json',
      Authorization: this.authorizationToken
    };
  }

  static makeRequest(
    method,
    url,
    headers,
    body = null
  ) {
    const params = {
      method,
      headers,
      body: null,
      // credentials: 'include'
    };

    if (body !== null) {
      params.body = JSON.stringify(body);
    }

    const request = new Request(url, params);

    console.info('[Bridge] Fetching', url);

    return fetch(request)
      .then((response) => this.handleErrors(response))
      .then((response) => response.text())
      .then((responseString) => (responseString ? JSON.parse(responseString) : {}))
      .then((responseObject) => {
        console.info('[Bridge] Success', url, responseObject);

        return responseObject;
      });
  }

  static getData(
    endpoint,
    id = null,
    args = null
  ) {
    let url = this.getUrl(endpoint);

    if (id !== null) {
      url += `/${id}`;
    }

    if (args) {
      const argsAsString =
        args.map(([key, value]) => `${key}=${value}`)
          .join('&');

      url += `?${argsAsString}`;
    }

    return this.makeRequest(BridgeRequestMethod.GET, url, this.getHeaders(), null);
  }

  static postData(
    endpoint,
    data
  ) {
    const url = this.getUrl(endpoint);

    return this.makeRequest(BridgeRequestMethod.POST, url, this.getHeaders(), data);
  }

  static putData(
    endpoint,
    id,
    data
  ) {
    let url = this.getUrl(endpoint);
    url += `/${id}`;

    return this.makeRequest(BridgeRequestMethod.PUT, url, this.getHeaders(), data);
  }

  static deleteData(
    endpoint,
    id
  ) {
    let url = this.getUrl(endpoint);
    url += `/${id}`;

    return this.makeRequest(BridgeRequestMethod.DELETE, url, this.getHeaders(), null);
  }

  static uploadFile(endpoint, formData) {
    const url = this.getUrl(endpoint);

    // DO NOT set Content-Type — browser handles boundary for FormData
    const headers = {
      Authorization: this.authorizationToken
    };

    return fetch(url, {
      method: 'POST',
      headers,
      body: formData
    })
      .then((response) => this.handleErrors(response))
      .then((res) => res.json());
  }

  static async downloadFile(endpoint) {
    const url = this.getUrl(endpoint);
    const headers = {
      Authorization: this.authorizationToken,
      Accept: 'application/pdf'
    };

    const response = await fetch(url, { method: 'GET', headers });

    if (!response.ok) {
      throw new ApiResponseError(response, await response.json());
    }

    const blob = await response.blob();
    const objectUrl = window.URL.createObjectURL(blob);
    window.open(objectUrl, '_blank');
  }

  static setBearerToken(authorizationToken = '') {
    this.authorizationToken = `Bearer ${authorizationToken}`;
  }

  static getUrl(endpoint) {
    return `${baseApiUrl}/${endpoint}`;
  }

  static async handleErrors(response) {
    if (!response.ok) {
      throw new ApiResponseError(response, await response.json());
    }

    return response;
  }
}
