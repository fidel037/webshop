<template>
  <div id="app" class="container">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <ul class="navbar-nav">
                <li class="nav-item" v-if="!this.getIsLoggedIn()"><router-link class="nav-link" to="/login">Login</router-link></li>
                <li class="nav-item" v-if="!this.getIsLoggedIn()"><router-link class="nav-link" to="/register">Register</router-link></li>
                <li class="nav-item" v-if="this.getIsLoggedIn()"><router-link class="nav-link" to="/">Pocetna</router-link></li>
                <li class="nav-item" v-if="this.getIsLoggedIn()"><router-link class="nav-link" to="/cart">Korpa({{getCartInfo().noItems}} - {{getCartInfo().total.toFixed(2)}})</router-link></li>
                <li class="nav-item" v-if="this.getIsLoggedIn()"><router-link class="nav-link" to="/orders">Narudzbine</router-link></li>
                <li class="nav-item" v-if="this.getIsLoggedIn()"><router-link class="nav-link" to="/password">Password</router-link></li>
                <li class="nav-item" v-if="this.getIsLoggedIn()"><a class="nav-link" v-on:click="logout()">Logout</a></li>
            </ul>
        </nav>
        <div class="alert alert-danger" role="alert" v-if="isError">
            {{isError}}
        </div>
        <div class="alert alert-success" role="alert" v-if="isSuccess">
            {{isSuccess}}
        </div>
    <router-view></router-view>
  </div>
</template>

<script>
import userMixin from './mixins/user'

export default {
  name: 'app',
  mixins:[userMixin]
}
</script>