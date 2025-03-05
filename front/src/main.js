import Vue from 'vue'
import App from './App.vue'
import Vue2Editor from "vue2-editor";
import VueRouter from "vue-router";

import {BootstrapVue, BootstrapVueIcons} from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import '@/styles/style.scss';

import router from './router'

Vue.use(BootstrapVue, {
  BButton: { variant: 'dark' },
  BCard: { bgVariant: 'dark' }
})
console.log(BootstrapVue.setDefaults);


Vue.use(BootstrapVueIcons)
Vue.use(Vue2Editor)
Vue.use(VueRouter)

Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
