require('./bootstrap');

import Vue from 'vue/dist/vue'
import router from './router'
import store from './store'

 import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);
window.Vue = require('vue');

import common from './common'
Vue.mixin(common)


Vue.component('mainapp', require('./component/mainapp.vue').default);

const app =new Vue({
el:"#app",
router,
store,

});