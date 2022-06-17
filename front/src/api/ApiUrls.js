export default {
  categories: 'http://localhost:8080/api/categories',
  items: 'http://localhost:8081/api/items',
  sources: 'http://localhost:8081/api/sources',
  users: 'http://localhost:8081/api/users',
  mainList: 'http://localhost:8080/api/mainList',
  loginn: 'http://localhost:8080/api/loginn',
  auth: {
    base: 'http://localhost:8080/api/auth',
    register: '/register',
    login: '/login',
    logout: '/logout',
    refresh: '/refresh'
  }
};
