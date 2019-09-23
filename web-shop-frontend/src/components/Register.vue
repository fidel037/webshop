<template>
    <div class="row">
        <div class="col-6 mt-3">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Name</span>
                </div>
                <input type="text" name="name" v-model="name">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Email</span>
                </div>
                <input type="email" v-model="email">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Password</span>
                </div>
                <input type="password" v-model="password" class="form-control">
            </div>
            <button v-on:click="registerAction()" class="btn btn-success">Register</button>
        </div>
    </div>
</template>

<script>
import userMixin from '../mixins/user';
export default {
    name: 'register',
    data() {
        return {
            email: null,
            password: null,
            name: null
        }
    },
    mixins: [userMixin],
    methods: {
        registerAction(){
            this.register(this.$data).then(() => {
                this.$router.push('/')
            })
        }
    }
}
</script>