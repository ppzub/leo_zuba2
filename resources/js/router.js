import VueRouter from 'vue-router'

// Pages
import Home from './pages/Home'
import Register from './pages/Register'
import Login from './pages/Login'
import Dashboard from './pages/Dashboard'

import PostCreate from './posts/Create'
import PostEdit from './posts/Edit'
import PostShow from './posts/Show'

// Routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/posts/:id',
    name: 'postshow',
    component: PostShow,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      auth: false
    }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false
    }
  },

  // USER ROUTES
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: {
      auth: true
    }
  },
  {
    path: '/create/post',
    name: 'postcreate',
    component: PostCreate,
    meta: {
      auth: true
    }
  },
  {
    path: '/posts/edit/:id',
    name: 'postedit',
    component: PostEdit,
    meta: {
      auth: true
    }
  },
]

const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})

export default router
