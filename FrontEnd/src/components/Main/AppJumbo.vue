<script>
import { defineComponent } from 'vue'
import { Carousel, Navigation, Slide, Pagination } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'

export default defineComponent({
  name: 'ExamplePagination',
  components: {
    Pagination,
    Carousel,
    Slide,
    Navigation,
  },
  data() {
    return {
      settings: {
        itemsToShow: 1,
        snapAlign: 'center',
      },
      breakpoints: {
        700: {
          itemsToShow: 3.5,
          snapAlign: 'center',
        },
        1024: {
          itemsToShow: 5,
          snapAlign: 'start',
        },
      },
      images: [
        {
          photo: '../src/assets/images/Immagine_1.jpeg',
          text: 'Ottimizza la tua tecnologia con la nostra assistenza esperta: soluzioni rapide e personalizzate per garantire il funzionamento impeccabile del tuo software',
        },
        {
          photo: '../src/assets/images/Immagine_2.webp',
          text: 'Affida la manutenzione del tuo software ai nostri esperti e goditi tranquillità e prestazioni superiori, ogni giorno',
        },
      ],
    }
  },
})
</script>

<template>
  <Carousel :itemsToShow="itemsToShow" :wrapAround="true" :transition="500" :autoplay="3000">
    <Slide v-for="(image, index) in images" :key="index">
      <div class="slide-content">
        <img :src="image.photo" />
        <div class="overlay">
          <h1 class="text-marketing ms-5 me-5">{{ image.text }}</h1>
        </div>
      </div>
    </Slide>
    <Navigation />
    <Pagination />
  </Carousel>
</template>




<style lang="scss">

.carousel img {
  width: 100%;
  height: 500px;
  object-fit: cover;
}

.slide-content {
  position: relative;
  width: 100%;
  height: 100%;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  padding: 10px;
}

.text-marketing {
  font-size: 50px;
  text-align: start;
}

</style>
