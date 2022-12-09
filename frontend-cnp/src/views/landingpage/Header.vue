<template>
  <header>
    <div class="menu">
        <div class="menu-logo">
            <a href="#">Imobiliária</a>
        </div>
        <nav>
            <ul>
                <li><router-link to="/">Início</router-link></li>
                <!-- <li id="helloMessage">Olá fulano</li> -->
                <li v-if="!userLogged"><router-link to="/register">Cadastrar/Login</router-link></li>
                <li v-else @click="logout">Deslogar</li>
                <li v-if="userAuth"><router-link to="/admin-dashboard">Editar carrosséis</router-link></li>
                <li v-if="userLogged"><router-link to="/carousels">Visualizar imoveis</router-link></li>
            </ul>
        </nav>
    </div>
    
  </header>
</template>

<script>
import Cookie from 'js-cookie';
export default {
    computed:{
        userLogged(){
            const token = Cookie.get('token');
            if(token){
                return true;
            }
            else{
                return false;
            }
        },
        userAuth(){
            if(this.userLogged){
                if(Cookie.get('userAuth') == 'true'){
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
    },
    methods:{
        logout(){
            Cookie.remove('token');
            Cookie.remove('userAuth');
            window.location.href = '/#/';
            window.location.reload();
        }
    }
    
}
</script>

<style>
#helloMessage{
    justify-self: flex-end;
}
header{
    background-color:black;
}
.menu {
	max-width: 960px;
	margin: 0 auto;
	padding: 15px 0;
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	align-items: center;
}
.menu-logo a {
	font-size: 2.25em;
	font-weight: bold;
	margin: 0 10px;
}


ul{
    /* width:100% */
    /* display:flex; justify-content: space-between; */
	list-style: none;

}

nav ul{
    display: flex;
	flex-wrap: wrap;
}
nav a{
    display:block;
    padding:10px;
}
li{
    /* justify-content: space-between; */
    margin:0px;
    padding:0px;
    align-self: center;
    color:white;
}

li:hover{
    cursor:pointer;
}

.menu a{
    color:white !important;
    text-decoration: none !important;
}


</style>