import 'es6-promise/auto'
import axios from 'axios'
import './bootstrap'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import wysiwyg from "vue-wysiwyg";
import Index from './Index'
import Pagination from './components/Pagination'
import auth from './auth'
import router from './router'
import store from './store'

require('axios-debug')(axios)
// Set Vue globally
window.Vue = Vue

// Set Vue router
Vue.router = router
Vue.use(VueRouter)

// Set Vue authentication

Vue.use(VueAxios, axios)

axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`

Vue.use(VueAuth, auth)
Vue.use(wysiwyg, {hideModules: { "image": true }});
// Load Index
Vue.component('index', Index)
Vue.component('pagination', Pagination)

const app = new Vue({
  el: '#app',
  router,
  store
});
