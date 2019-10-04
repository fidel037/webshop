<template>
    <div class="row mt-3">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Stara lozinka</span>
            </div>
            <input type="password" v-model="oldP" class="form-control">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Nova lozinka</span>
            </div>
            <input type="password" v-model="newP" class="form-control">
        </div>
        <button v-on:click="changePassword()" class="btn btn-success">Promeni</button>
    </div>
</template>
<script>
import userMixin from '../mixins/user';
import ApiService from '../services/Api';
export default {
    name: 'login',
    data() {
        return {
            oldP: null,
            newP: null
        }
    },
    mixins: [userMixin],
    methods: {
        changePassword(){
            ApiService.patch('/password', this.$data).then(() => {
                this.$router.push('/')
            })
        }
    }
}
</script>
