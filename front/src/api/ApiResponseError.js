export default class ApiResponseError extends Error {
  response;
  body;

  constructor (response, body) {
    super(`${response.status}: Request failed with ${response.statusText}`);
    this.response = response;
    this.body = body;
  }
}
