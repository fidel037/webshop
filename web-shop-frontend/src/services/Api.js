import axios from "axios"
import store from './../store/store'
const ApiService = {
    _200interceptor: null,
    _401interceptor: null,
    _403interceptor: null,
    _404interceptor: null,
    rootUrl: 'http://localhost:8800/api',
    init(baseURL) {
        this.mountInterceptors()
        this.setHeader()
        axios.defaults.baseURL = baseURL;
    },

    setHeader() {
        if (store.getters.getToken != null) {
            axios.defaults.headers.common["Authorization"] = 'Bearer '+store.getters.getToken.access_token
        }
        axios.defaults.headers.common["Access-Control-Allow-Origin"] = 'http://0.0.0.0:8800'

    },
    get(url) {
        this.init()
        url = this.rootUrl + url
        return axios.get(url)
    },
    post(url, data) {
        this.init()
        url = this.rootUrl + url
        return axios.post(url, data)
    },
    patch(url, data) {
        this.init()
        url = this.rootUrl + url
        return axios.patch(url, data)
    },
    delete(url, data) {
        this.init()
        url = this.rootUrl + url
        return axios.delete(url, data)
    },
    mountInterceptors() {
        axios.interceptors.response.use(
            (response) => {
                store.dispatch("setSuccess",response.data.message)
                return response
            },
            (error) => {
                if (error.response !== undefined) {
                    store.dispatch("setError", error.response.data.message)
                }
                return new Promise(() => {});
            }
        )
    },
}
export default ApiService