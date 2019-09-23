import axios from "axios"
import store from './../store/store'
const ApiService = {
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
        axios.defaults.headers.common["Access-Control-Allow-Origin"] = 'http://localhost:8800'

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
    delete(url, data) {
        this.init()
        url = this.rootUrl + url
        return axios.delete(url, data)
    },
    mountInterceptors() {
        axios.interceptors.response.use(
            (response) => {
                return response
            },
            async (error) => {
                store.dispatch("setError", error.response.data.message)
            }
        )
    },
}
export default ApiService