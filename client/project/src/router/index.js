import Vue from 'vue'
import Router from 'vue-router'
import home from '@/components/Home'
import showCars from '@/components/showCars'
import singleCar from '@/components/singleCar'
import buyCar from '@/components/buyCar'
import search from '@/components/search'
import secure from '@/components/secure'
import notFound from '../views/notFound'
import store from '../store/store.js'

Vue.use(Router)

let router =  new Router({
  mode: 'history',
  base: '/rest/client/',
  routes: [
    {
      path: '/',
      name: 'home',
      component: home
    },
      {
          path: '/secure',
          name: 'secure',
          component: secure,
          meta: {
              requiresAuth: true
          }
      },
      {
          path: '/search',
          name: 'search',
          component: search
      },
      {
          path: '/buy/:id',
          name: 'buyCar',
          component: buyCar,
          meta: {
              requiresAuth: true
          }
      },
      {
          path: '/show',
          name: 'showCars',
          component: showCars
      },
      {
          path: '/search',
          name: 'search',
          component: search
      },
      {
          path: '/car/:id',
          name: 'singleCar',
          component: singleCar
      },
      {
          path: '/404',
          name: '404',
          component: notFound
      },
      {
          path: '*',
          redirect: '/404'
      },
  ]
})
// if (localStorage.getItem('token')) {
router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next()
            return
        }
        next('/')
    } else {
        next()
    }
})

export default router
