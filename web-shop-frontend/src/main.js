import Vue from 'vue'
import App from './App.vue'
import store from './store/store'
import router from './router'
import userMixin from './mixins/user'
import VueRouter from 'vue-router'

Vue.config.productionTip = false
Vue.use(VueRouter)
new Vue({
  render: h => h(App),
  store: store,
  router,
  mixins:[userMixin]
}).$mount('#app')
