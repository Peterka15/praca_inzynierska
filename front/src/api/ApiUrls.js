export default {
  categories: 'http://localhost:8081/api/categories',
  items: 'http://localhost:8081/api/items',
  sources: 'http://localhost:8081/api/sources',
  users: 'http://localhost:8081/api/users',
  auth: {
    base: 'http://localhost:8081/api/auth',
    register: '/register',
    login: '/login',
    logout: '/logout',
    refresh: '/refresh'
  }
};
