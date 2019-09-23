<template>
    <div class="row">
        <div class="col-6 mt-3">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Email</span>
                </div>
                <input type="email" v-model="email" class="form-control">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Password</span>
                </div>
                <input type="password" v-model="password" class="form-control">
            </div>
            <button v-on:click="loginAction()" class="btn btn-success">Login</button>
        </div>
    </div>
</template>

<script>
import userMixin from '../mixins/user';
export default {
    name: 'login',
    data() {
        return {
            email: null,
            password: null
        }
    },
    mixins: [userMixin],
    methods: {
        loginAction(){
            this.login(this.$data).then(() => {
                this.$router.push('/')
            })
        }
    }
}
</script>