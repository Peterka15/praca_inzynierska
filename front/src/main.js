import Vue from 'vue';
import App from './App.vue';
import Vue2Editor from 'vue2-editor';
import VueRouter from 'vue-router';

import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import '@/styles/style.scss';

import router from './router';

Vue.use(BootstrapVue, {
  BContainer: {
    variant: 'dark',
    textVariant: 'light'
  },
  BButton: {
    variant: 'dark',
    textVariant: 'light'
  },
  BCard: {
    bgVariant: 'dark',
    textVariant: 'light',
    borderVariant: 'secondary',
    headerBorderVariant: 'secondary',
    footerBorderVariant: 'secondary'
  },
  BCardImageLazy: {
    bgVariant: 'dark',
    textVariant: 'light',
    borderVariant: 'secondary',
    headerBorderVariant: 'secondary',
    footerBorderVariant: 'secondary'
  },
  BModal: {
    headerBgVariant: 'dark',
    headerTextVariant: 'light',
    footerBgVariant: 'dark',
    footerTextVariant: 'light',
    bodyBgVariant: 'dark',
    bodyTextVariant: 'light',
    borderVariant: 'secondary',
    headerBorderVariant: 'secondary',
    footerBorderVariant: 'secondary'
  },
  BTable: {
    tableVariant: 'dark',
    striped: true,
    hover: true
  },
});

Vue.use(BootstrapVueIcons);
Vue.use(Vue2Editor);
Vue.use(VueRouter);

Vue.config.productionTip = false;

new Vue({
  router,
  render: h => h(App)
}).$mount('#app');
