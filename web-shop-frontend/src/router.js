import VueRouter from 'vue-router'
import HelloWorld from './components/HelloWorld'
import Login from './components/Login'
import Register from './components/Register'
import ItemList from './components/ItemList'
import Basket from './components/Basket'
import Orders from './components/Orders'
import Password from './components/Password'
import store from './store/store'
const routes = [
    {
        path: '/foo',
        component: HelloWorld,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        component: Login,
        meta: {
            requiresAuth: false
        }
    },
    {
        path: '/register',
        component: Register,
        meta: {
            requiresAuth: false,
        }
    },
    {
        path: '/',
        component: ItemList,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/cart',
        component: Basket,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/orders',
        component: Orders,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/password',
        component: Password,
        meta: {
            requiresAuth: true,
        }
    },
]
const router = new VueRouter({
    routes
})
router.beforeEach((to, from, next) => {
    if (from.path !== '/password') {
        store.dispatch('setSuccess', false)
    }
    store.dispatch('setError', false)

    if (to.matched.some(record => record.meta.requiresAuth)) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.
      if (!store.getters.getIsLoggedIn) {
        next({
          path: '/login',
          query: { redirect: to.fullPath }
        })
      } else {
        next()
      }
    } else {
      next() // make sure to always call next()!
    }
  })
export default router