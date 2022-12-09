<template>
    <div>
        <Header></Header>
            <slot></slot>
        <Footer></Footer>  
    </div>
</template>

<script>
import Header from './Header.vue'
import Footer from './Footer.vue'
// import Cookie from 'js-cookie';
export default {
   components: {
      Header,
      Footer
   },
   mounted(){
        // const token = Cookie.get('token');
        // console.log(token);
   }

}
</script>

<style>

</style>