import Vue from 'vue'
import App from './App.vue'
import Vue2Editor from "vue2-editor";

import {BootstrapVue, BootstrapVueIcons} from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)
Vue.use(Vue2Editor)


Vue.config.productionTip = false

new Vue({
  render: h => h(App),
}).$mount('#app')
