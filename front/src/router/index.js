import Vue from 'vue'
import VueRouter from 'vue-router'
import Loginscreen from "@/views/Loginscreen";
import Mainpage from "@/views/Mainpage";
import Article from "@/views/Article";
import Teachingmaterials from "@/views/Teachingmaterials";
import Addarticle from "@/views/AddArticle.vue";

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
    path: '/addarticle',
    name: 'addarticle',
    component: Addarticle
  },
  {
    path: '/materials',
    name: 'materials',
    component: Teachingmaterials
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
