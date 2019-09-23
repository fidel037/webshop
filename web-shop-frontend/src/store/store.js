import Vue from 'vue'
import Vuex from 'vuex'
import user from './user'
Vue.use(Vuex)

const store  = new Vuex.Store({
    modules: {user_store: user}
})
export default store