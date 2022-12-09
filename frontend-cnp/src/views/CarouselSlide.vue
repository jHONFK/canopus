<template>
<div>
    <div class="slider" ref="slider">
        <div class="slider__controls">
            <a @click="moveSlider(n)" href="#/carousels" v-for="n in slides.length" :key="n" class="slider__controls__link">{{ n }}</a>
        </div>
        <div v-for="(slide, index) in slides" :key="index" :style="`background-image:url(${slide.image_path})`" class="slider__content">
            <p style="font-size: 30px; padding-top:30%;font-weight: bold;">{{slide.title}}</p>
            <p style="font-size: 20px;font-weight: bold;">{{slide.description}}</p>
        <!-- {{ slide.description }} -->
        </div>
    </div>
</div>
  
</template>

<script>
export default {
  name: "CarouselSlide",
  mounted() {
    this.slider = this.$refs.slider;
    this.height = this.slider.offsetHeight;
  },
  props: {
    slides: {
      type: Array,
      required: true,
    }
  },
  data() {
    return {
      slider: null,
      height: null,
    };
  },
  methods: {
    moveSlider(n) {
      //n = n === 1 ? 0 : n;
      n = n-1;
      this.slider.scrollTo({
        top: this.height * n,
        behavior: 'smooth'
      })
    }
  }
};
</script>

<style>
.slider {
  position: relative;
  height: 50vh;
  width:60%;
  margin:auto;
  overflow: scroll;
  background-color: #ccc;
  scroll-snap-type: y mandatory;
  overflow-x: hidden;
  overflow-y: hidden;
}
.slider__controls {
  position: fixed;
  right: 9.5rem;
  top: -91px;
  width: 3rem;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}
.slider__controls__link {
  width: 3rem;
  height: 3rem;
  background-color: rgb(76 76 76 / 80%);
  color: white !important;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  text-decoration: none;
  font-weight: bold;
  margin: 1rem 0;
}
.slider__content {
  height: 500px;
  /* padding-top:60%; */
  background-position: center;
  background-size: contain;
  background-repeat: no-repeat;
  scroll-snap-align: center;
  color: white;
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
  font-size: calc(3rem + 4vmin);
}

@media screen and (max-width: 1040px) {
    .slider__controls{
        right:5.5rem;
    }
}

@media screen and (max-height: 894px){
    .slider__controls{
        top:-48px;
    }
}

@media screen and (max-height: 760px){
    .slider__controls{
        top:-38px;
    }
}
</style>