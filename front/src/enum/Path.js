export default {
  home: '/',
  login: '/login',
  register: '/register',
  setPassword_Token: '/set-password/:token',

  article: '/article',
  article_Id: '/article/:articleId',
  addArticle: '/addarticle',
  addArticle_Id: '/addarticle/:id?',

  files: '/files',
  management: '/management',
  inventory: '/inventory',
  users: '/users'
};

export function getPath (...path) {
  return path.join('/');
}
