// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue';
import YDUI from 'vue-ydui'; /* 相当于import YDUI from 'vue-ydui/ydui.rem.js' */
import 'vue-ydui/dist/ydui.rem.css';

import $ from 'jquery';

import App from './App';
import router from './router';
import store from './store';


Vue.use(YDUI);
Vue.config.productionTip = false;


import './assets/css/style.css';
import '../static/js/ydui.flexible.js';

//https://www.npmjs.com/package/vue-awesome-swiper
import VueAwesomeSwiper from 'vue-awesome-swiper';
import 'swiper/dist/css/swiper.min.css';
Vue.use(VueAwesomeSwiper);


//调用axios的封装方法
import httpaxios from '../static/js/httpaxios.js';
Vue.prototype.http = httpaxios;


/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})
