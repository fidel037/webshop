const user_store = {
    state: {
        isLoggedIn: false,
        token: null,
        userData: null,
        error: false,
        success: false,
        cart: {
            total: 0.00,
            noItems: 0
        }
    },
    mutations: {
        setIsLoggedIn (state, value) {
            state.isLoggedIn = value
        },
        setToken (state, value) {
            state.token = value
        },
        setUserData(state, value) {
            state.userData = value
        },
        setError (state, value) {
            state.error = value
        },
        setSuccess (state, value) {
            if (value != '') {
                state.success = value
            }
            if (value === false) {
                state.success = false
            }
        },
        setCart (state, item) {
            state.cart.total += parseFloat(item.price)
            state.cart.noItems++
        },
        setCartFresh (state) {
            state.cart.total = 0
            state.cart.noItems = 0
        },
    },
    actions: {
        setIsLoggedIn({commit}, value) {
            commit('setIsLoggedIn', value)
        },
        setToken({commit}, value) {
            commit('setToken', value)
        },
        setUserData({commit}, value) {
            commit('setUserData', value)
        },
        setError({commit}, value) {
            commit('setError', value)
        },
        setSuccess({commit}, value) {
            commit('setSuccess', value)
        },
        setCart({commit}, value) {
            commit('setCart', value)
        },
        setCartFresh({commit}) {
            commit('setCartFresh')
        },
        logout({commit}) {
            commit('setIsLoggedIn', false)
            commit('setToken', null)
        }
    },
    getters: {
        getIsLoggedIn: state => {
            return state.isLoggedIn
        },
        getToken: state => {
            return state.token
        },
        getUserData: state => {
            return state.userData
        },
        getError: state => {
            return state.error
        },
        getSuccess: state => {
            return state.success
        },
        getCart: state => {
            return state.cart
        },

    }
  }
export default user_store