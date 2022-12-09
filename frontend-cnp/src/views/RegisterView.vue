<template>
  <div>
    <Home>
        <div class="defaultDiv">
            <b-tabs content-class="mt-3" align="center" v-model="tabIndex">
                <b-tab title="Logar">
                    <!-- <b-form @submit="login"> -->
                        <b-form-group id="input-group-1" label="Email:" label-for="input-1">
                            <b-form-input id="input-1" v-model="email" required placeholder="Email"></b-form-input>
                        </b-form-group>
                        <b-form-group id="input-group-2" label="Senha:" label-for="input-2">
                            <b-form-input id="input-2" type="password" v-model="password" required placeholder="Senha"></b-form-input>
                        </b-form-group>
                        <b-button type="submit" @click="login" variant="primary">Logar</b-button>
                    <!-- </b-form> -->
                </b-tab>
                <b-tab title="Registrar">
                    <!-- <b-form @submit="register"> -->
                        <b-form-group id="input-group-1" label="Nome:" label-for="input-1">
                            <b-form-input id="input-1" v-model="name" required placeholder="Nome"></b-form-input>
                        </b-form-group>
                        <b-form-group id="input-group-2" label="Email:" label-for="input-2">
                            <b-form-input id="input-2" v-model="email" required placeholder="Email"></b-form-input>
                        </b-form-group>
                        <b-form-group id="input-group-3" label="Senha:" label-for="input-3">
                            <b-form-input id="input-3" type="password" v-model="password" required placeholder="Senha"></b-form-input>
                        </b-form-group>
                        <b-button type="submit" @click="register" variant="primary">Registrar</b-button>
                    <!-- </b-form> -->
                </b-tab>
            </b-tabs>
            <!-- <h1>Cadastrar ou Logar</h1>
            <input type="radio" id="login" name="login" v-model="option" checked value="login">
            <label for="login">Logar</label><br>
            <input type="radio" id="register" name="register" v-model="option" value="register">
            <label for="register">Registrar</label><br>
            <div v-if="option=='register'">
                <label for="name">Nome</label>
                <input type="text" id="name" v-model="name" name="name" placeholder="Seu nome..">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Seu email..">
                <label for="password">Senha</label>
                <input type="text" id="password" name="password" placeholder="Sua senha..">
                <input type="button" value="Cadastrar" @click="register()">
            </div>
            <div v-else>
                <label for="email">Email</label>
                <input type="text" id="email" v-model="email" name="email" placeholder="Seu email..">
                <label for="password">Senha</label>
                <input type="password" id="password" v-model="password" name="password" placeholder="Sua senha..">
                <input type="button" value="Logar" @click="login()">
            </div> -->
            
        </div>
    </Home>
  </div>
</template>

<script>
import Home from './landingpage/Home.vue'
import Cookie from 'js-cookie';
export default {
    name: 'RegisterView',
    components: {
        Home
    },
    data() {
        return {
            tabIndex: 0,
            option: 'login',
            name: '',
            email: '',
            password: ''
        }
    },
    methods: {
        register(){
            let self=this;
            this.axios.post('http://localhost:8000/api/register', {
                name: this.name,
                email: this.email,
                password: this.password,
            })
            .then(function (response) {
                self.$bvToast.toast('Usuário cadastrado com sucesso!', {
                    title: 'Sucesso',
                    variant: 'success',
                    position: 'top-right',
                    solid: true,
                    autoHideDelay: 5000
                })
                self.tabIndex = 0;
                console.log(response);
            })
        },
        login(){
            this.axios.post('http://localhost:8000/api/login', {
                email: this.email,
                password: this.password,
            })
            .then(function (response) {
                const token = response.data.token;
                Cookie.set('token', token, { expires: 300000 });
                let user_type = response.data.user_type;
                if(user_type == 1){
                    Cookie.set('userAuth', true, { expires: 300000 });
                    window.location.href = '/#/admin-dashboard';
                }
                else{
                    Cookie.set('userAuth', false, { expires: 300000 });
                    window.location.href = '/#/carousels';
                }
                // console.log(token);
            })
        }
    }
}
</script>

<style>
.defaultDiv{
    width:30%; margin:auto; padding:10px; text-align:left; margin-top:10px;
}
</style>