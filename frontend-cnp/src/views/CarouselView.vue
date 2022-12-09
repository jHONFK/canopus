<template>
  <div>
    <Home>
            <h1>Nossos imóveis</h1>
            <CarouselSlide :slides="carousels" />
            
    </Home>
  </div>
</template>

<script>
import Home from './landingpage/Home.vue'
import CarouselSlide from './CarouselSlide.vue'
export default {
    components:{
        Home,
        CarouselSlide
    },
    data(){
        return{
            carousels: [],
            backendImagePath: 'http://localhost:8000/images/'
        }
    },
    methods:{
        getCarousels(){
            let self=this;
            this.axios.get('http://localhost:8000/api/carousels')
            .then(function (response) {
                console.log(response);
                self.carousels = response.data;
                self.assignCorrectImagePath();
            })
        },
        assignCorrectImagePath(){
            this.carousels.forEach(carousel => {
                carousel.image_path = this.backendImagePath + carousel.image_path;
            });
        }
    },
    mounted(){
        this.getCarousels();
    }
}
</script>

<style>
    
</style>