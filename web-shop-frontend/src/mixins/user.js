import ApiService from "../services/Api"

const userMixin = {
    computed: {
        isError: {
            get() {
                return this.$store.getters.getError
            }
        },
        isSuccess: {
            get() {
                return this.$store.getters.getSuccess
            }
        }
    },
    methods: {
        getIsLoggedIn: function () {
            return this.$store.getters.getIsLoggedIn
        },
        login: async function (params) {
            return ApiService.post('/login',params).then((response) => {
                this.$store.dispatch('setToken', response.data)
                this.$store.dispatch('setIsLoggedIn', true)
                this.getUser()
                return response.data
            })
        },
        register: async function (params) {
            return ApiService.post('/register',params).then((response) => {
                return response.data
            })
        },
        logout: function () {
            this.$store.dispatch('logout')
            this.$router.push('/login')
        },
        getItems: async function(url, params) {
            if (!url) {
                url = '/items'
            } else {
                url = url.substring(url.indexOf('/items'))
            }
            return ApiService.post(url,params).then((response) => {
                return response.data
            })
        },
        getUser: async function() {
            return ApiService.get('/user').then((response) => {
                this.$store.commit('setUserData', response.data)
                return this.$store.getters.getUserData
            })
        },
        addToBasket: function (item) {
            ApiService.post('/basket',{item_id: item.id})
            this.$store.dispatch('setSuccess', 'Item '+item.name+' added to cart')
            this.$store.dispatch('setCart', item)
        },
        getCartInfo: function() {
            return this.$store.getters.getCart
        },
        payOrder: async function () {
            await ApiService.post('/pay')
        },
        removeItem: async function (item) {
            this.$store.dispatch('setSuccess', 'Item '+item.name+' removed from cart')
            return await ApiService.delete('/basket/'+item.id)
        },
        getBasket: async function() {
            return ApiService.get('/basket').then((response) => {
                this.$store.dispatch('setCartFresh')
                for (let index = 0; index < response.data.length; index++) {
                    const element = response.data[index];
                    this.$store.dispatch('setCart', element)
                }
                return response.data
            })
        },
        getOrders: async function() {
            return ApiService.post('/orders').then((response) => {
                return response.data
            })
        },
        getError: function () {
            return this.$store.getters.getError
        },
    }
  }
export default userMixin