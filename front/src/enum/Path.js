export default {
  home: '/',
  login: '/login',
  register: '/register',
  setPassword: '/set-password',

  article: '/article',
  article_Id: '/article/:articleId',
  addArticle: '/addarticle',
  addArticle_Id: '/addarticle/:id?',
  
  materials: '/materials',
  management: '/management',
  inventory: '/inventory',
  users: '/users',
};

export function getPath(...path) {
  return path.join('/');
}