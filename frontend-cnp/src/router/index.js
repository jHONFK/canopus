import Vue from 'vue'
import VueRouter from 'vue-router'
// import HomeView from '../views/HomeView.vue'
import Home from '../views/landingpage/Home.vue'
// import Guard from '@/service/middleware'


Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/admin-dashboard',
    name: 'admin-dashboard',
    component: () => import(/* webpackChunkName: "carousels" */ '../views/AdminDashboard.vue'),


  },
  {
    path: '/carousels',
    name: 'carousels',
    component: () => import(/* webpackChunkName: "carousels" */ '../views/CarouselView.vue'),
  },
  {
    
    path: '/register',
    name: 'register',
    component: () => import(/* webpackChunkName: "register" */ '../views/RegisterView.vue'),


  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = new VueRouter({
  routes
})

export default router
