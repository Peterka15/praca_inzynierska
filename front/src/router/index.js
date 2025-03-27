import Vue from 'vue'
import VueRouter from 'vue-router'
import Loginscreen from "@/views/Loginscreen";
import Mainpage from "@/views/Mainpage";
import Article from "@/views/Article";
import TeachingMaterials from "@/views/TeachingMaterials.vue";
import Addarticle from "@/views/AddArticle.vue";
import Register from "@/views/Register";
import AdminPanel from "@/views/AdminPanel.vue";
import Inventory from "@/views/Inventory.vue";
import Management from "@/views/Management/Management.vue";
import SetPassword from "@/views/SetPassword.vue";
import AuthPassword from "@/views/AuthPassword.vue";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: Mainpage
  },
  {
    path: '/login',
    name: 'login',
    component: Loginscreen
  },
  {
    path: '/article/:articleId',
    name: 'article',
    component: Article
  },
  {
    path: '/addarticle/:id?',
    name: 'addarticle',
    component: Addarticle
  },
  {
    path: '/materials',
    name: 'materials',
    component: TeachingMaterials
  },
  {
    path: '/adminpanel',
    name: 'adminpanel',
    component: AdminPanel
  },
  {
    path: '/register',
    name: 'register',
    component: Register
  },
  {
    path: '/setpassword',
    name: 'setpassword',
    component: SetPassword
  },
  {
    path: '/authpassword',
    name: 'authpassword',
    component: AuthPassword
  },
  {
    path: '/inventory',
    name: 'inventory',
    component: Inventory
  },
  {
    path: '/management',
    name: 'management',
    component: Management
  },


]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
