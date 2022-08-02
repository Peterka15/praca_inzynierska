export default class ApiResponseError extends Error {
  response;

  constructor (response) {
    super(`${response.status}: Request failed with ${response.statusText}`);
    this.response = response;
  }
}
