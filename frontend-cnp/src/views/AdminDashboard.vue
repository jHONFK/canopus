<template>

  <div>
    
    <Home>
        <div class="defaultDiv">
            <b-button @click="$bvModal.show('insertCarouselModal')">Inserir novo carrossel</b-button>
            <b-modal size="sm" id="insertCarouselModal" ref="insertCarouselModal" @ok="insertCarousel">
                <b-form @submit="insertCarousel">
                    <h3>Inserir novo carrossel</h3>
                    <br><br>
                    <b-form-group id="input-group-1" label="Título:" label-for="input-1">
                        <b-form-input id="input-1" v-model="title" required placeholder="Título"></b-form-input>
                    </b-form-group>

                    <b-form-group id="input-group-2" label="Descrição:" label-for="input-2">
                        <b-form-input id="input-2" v-model="description" required placeholder="Descrição"></b-form-input>
                    </b-form-group>

                    <b-form-group id="input-group-3" label="Imagem:" label-for="input-3">
                        <b-form-file id="input-3" @input="insertImage" v-model="image" required placeholder="Imagem"></b-form-file>
                    </b-form-group>
                </b-form>
            </b-modal>
            <b-modal size="sm" id="editCarouselModal" ref="editCarouselModal" @ok="editInsertCarousel">
                <b-form @submit="editInsertCarousel">
                    <h3>Editar carrossel</h3>
                    <br><br>
                    <b-form-group id="input-group-1" label="Título:" label-for="input-1">
                        <b-form-input id="input-1" v-model="editTitle" required placeholder="Título"></b-form-input>
                    </b-form-group>

                    <b-form-group id="input-group-2" label="Descrição:" label-for="input-2">
                        <b-form-input id="input-2" v-model="editDescription" required placeholder="Descrição"></b-form-input>
                    </b-form-group>

                    
                    <b-form-group id="input-group-3" label="Imagem:" label-for="input-3">
                        <b-form-file id="input-3" @input="insertEditImage" v-model="editedImage" required placeholder="Imagem"></b-form-file>
                    </b-form-group>
                    
                </b-form>
            </b-modal>
        </div>
        

<br>
<br>
<br>
        
        <!-- <input type="button" value="Mostrar" @click="getCarousels"> -->
        <div class="defaultDiv">
            <h4>Filtros dos carrosséis</h4>
            <b-form-input v-model="searchCarouselTitle" placeholder="Pesquisar por título de carrosel"></b-form-input>
            <b-form-input style="margin-top:20px; margin-bottom:50px" v-model="searchCarouselDescription" placeholder="Pesquisar por descrição de carrosel"></b-form-input>
            <hr style="border:1px solid lightgray">
            <h3>Imagens dos Carrosséis</h3>
        </div>

        <div class="carouselsDiv">
            <b-card v-for="carousel in carouselsListed" :key="carousel.id" style="margin-top:20px">
                <b-card-img :src="backendImagePath+carousel.image_path" alt="Image"></b-card-img>
                <b-card-body>
                    <b-card-title>{{ carousel.title }}</b-card-title>
                    <b-card-text>{{ carousel.description }}</b-card-text>
                    <b-button variant="primary" @click="openEditModal(carousel)">
                        <b-icon icon="pencil-square"></b-icon>
                    </b-button>
                    <b-button variant="danger" @click="deleteCarousel(carousel.id)" style="margin-left:10px;">
                        <b-icon icon="trash"></b-icon>
                    </b-button>
                </b-card-body>
            </b-card>
        </div>
        
    </Home>
  </div>
<!-- <div v-else>
    <h1 style="text-align:center">Você não tem permissão para acessar essa página</h1>
</div> -->
</template>

<script>
// import { BFormFile } from 'bootstrap-vue'

// import Cookie from 'js-cookie'
import Home from './landingpage/Home.vue'
export default {
    components:{
        Home,
        // BFormFile
    },
    data(){
        return{
            search:'',
            searchCarouselTitle:'',
            searchCarouselDescription:'',
            carousels:[],
            carouselsListed:[],
            editId:0,
            editTitle:'',
            editDescription:'',
            editedImage:'',
            title:'',
            description:'',
            image:'',
            backendImagePath: 'http://localhost:8000/images/'
        }
    },
    computed:{
    },
    methods:{
        makeDeletedToast(){
            this.$bvToast.toast('Carrossel deletado!', {
                title: 'Aviso!',
                variant: 'danger',
                autoHideDelay: 5000,
            })
        },
        makeInsertedToast(){
            this.$bvToast.toast('Carrossel inserido!', {
                title: 'Aviso!',
                variant: 'success',
                autoHideDelay: 5000,
            })
        },
        deleteCarousel(id){
            let self=this;
            this.axios.post('http://localhost:8000/api/carousels-delete', {
                id: id
            })
            .then(function (response) {
                console.log(response);
                self.makeDeletedToast();
                self.getCarousels();
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        openEditModal(carousel){
            // let id = carousel.id;
            // this.carouselToEdit = this.carousels.find(carousel => carousel.id == id);
            this.editTitle = carousel.title;
            this.editDescription = carousel.description;
            // this.editedImage = carousel.image_path;
            this.editId = carousel.id;
            this.$refs.editCarouselModal.show();
        },
        editInsertCarousel(){
            let self=this;
            const form = new FormData();
            form.append('title', this.editTitle);
            form.append('description', this.editDescription);
            if(this.editedImage != null)
                form.append('image', this.editedImage);
            form.append('id', this.editId);

            this.axios.post('http://localhost:8000/api/carousels-edit', form)
            .then(function (response) {
                console.log(response);
                // alert('Carrossel inserido com sucesso!');
                self.getCarousels();
                self.makeInsertedToast();

            })
        },
        getCarousels(){
            let self = this;
            this.axios.get('http://localhost:8000/api/carousels')
            .then(function (response) {
                self.carousels = response.data;
                self.carouselsListed = response.data;
            })
        },
        insertCarousel(){
            let self=this;
            const form = new FormData();
            form.append('title', this.title);
            form.append('description', this.description);
            form.append('image', this.image);

            this.axios.post('http://localhost:8000/api/carousels', form)
            .then(function (response) {
                console.log(response);
                self.editedImage = '';
                self.editDescription = '';
                self.editTitle = '';
                // alert('Carrossel inserido com sucesso!');
                self.getCarousels();
                self.makeInsertedToast();

            })
        },
        insertImage(event){
            // this.image = event.target.files[0];
            this.image = event;
        },
        insertEditImage(event){
            this.editedImage = event;
        }
    },
    mounted(){
        this.getCarousels();
    },
    watch:{
        searchCarouselTitle(){
            this.carouselsListed = this.carousels.filter(carousel => carousel.title.includes(this.searchCarouselTitle));
        },
        searchCarouselDescription(){
            this.carouselsListed = this.carousels.filter(carousel => carousel.description.includes(this.searchCarouselDescription));
        }
    },
}

</script>

<style>
.defaultDiv{
    width:30%; margin:auto; padding:10px; text-align:left; margin-top:10px;
}

.carouselsDiv{
    width:30%; margin:auto; padding:10px; text-align:left; margin-top:10px;
    height:500px; overflow-y:scroll;
}
</style>