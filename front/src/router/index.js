import Vue from 'vue'
import VueRouter from 'vue-router'
import Loginscreen from "@/views/Loginscreen";
import Mainpage from "@/views/Mainpage";
import Article from "@/views/Article";
import TeachingMaterials from "@/views/TeachingMaterials.vue";
import Addarticle from "@/views/AddArticle.vue";
import Register from "@/views/Register";
import Inventory from "@/views/Inventory.vue";
import Management from "@/views/Management/Management.vue";
import SetPassword from "@/views/SetPassword.vue";
import Users from '@/views/Users/Users.vue';
import Path from '@/enum/Path';

Vue.use(VueRouter)

const routes = [
  {
    path: Path.home,
    name: 'home',
    component: Mainpage
  },
  {
    path: Path.login,
    name: 'login',
    component: Loginscreen
  },
  {
    path: Path.article_Id,
    name: 'article',
    component: Article
  },
  {
    path: Path.addArticle_Id,
    name: 'addarticle',
    component: Addarticle
  },
  {
    path: Path.materials,
    name: 'materials',
    component: TeachingMaterials
  },
  {
    path: Path.register,
    name: 'register',
    component: Register
  },
  {
    path: Path.setPassword_Token,
    name: 'set-password',
    component: SetPassword
  },
  {
    path: Path.inventory,
    name: 'inventory',
    component: Inventory
  },
  {
    path: Path.management,
    name: 'management',
    component: Management
  },
  {
    path: Path.users,
    name: 'users',
    component: Users
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
