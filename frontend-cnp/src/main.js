import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueCookies from 'vue-cookies'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// import { FormFilePlugin } from 'bootstrap-vue'
Vue.config.productionTip = false

// Vue.use(FormFilePlugin)

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

// import './views/landingpage/Container.vue'

// import 'vee-validate'

Vue.use(VueAxios, axios);
Vue.use(VueCookies);
// Vue.prototype.$axios = axios

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
