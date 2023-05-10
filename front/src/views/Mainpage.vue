<template>
  <div>
    <navbar>
    </navbar>
    <!--    <div>-->
    <!--      <div>-->
    <!--        <b-carousel-->
    <!--            id="carousel-1"-->
    <!--            v-model="slide"-->
    <!--            :interval="10000"-->
    <!--            controls-->
    <!--            indicators-->
    <!--            background="#ababab"-->
    <!--            img-width="800"-->
    <!--            img-height="100"-->
    <!--            style="text-shadow: 1px 1px 2px #333;"-->
    <!--            @sliding-start="onSlideStart"-->
    <!--            @sliding-end="onSlideEnd"-->
    <!--        >-->

    <!--          <b-carousel-slide-->
    <!--              caption="Kosmos"-->
    <!--              text="A gdzie to jest?"-->
    <!--              img-src="http://localhost:8000/carusel1.jpg"-->
    <!--          ></b-carousel-slide>-->

    <!--          <b-carousel-slide-->
    <!--              caption="Diuna część 2"-->
    <!--              text="nie no nie czytałem"-->
    <!--              img-src="http://localhost:8000/carusel2.jpg"-->
    <!--          ></b-carousel-slide>-->

    <!--          <b-carousel-slide-->
    <!--              caption="Bardzo wysoko"-->
    <!--              text="Bardzo"-->
    <!--              img-src="http://localhost:8000/carusel3.png"-->
    <!--          ></b-carousel-slide>-->

    <!--          <b-carousel-slide-->
    <!--              caption="Jeszcze wyżej"-->
    <!--              text="Serio"-->
    <!--              img-src="http://localhost:8000/carusel4.jpg"-->
    <!--          ></b-carousel-slide>-->
    <!--        </b-carousel>-->

    <!--      </div>-->
    <!--    </div>-->


    <b-container>
      <b-row class="background">
        <PanelBar></PanelBar>
        <b-col cols="10" class="right_column">
          <div>
            <feed v-for="article in articles" :key="article.id" :article="article"></feed>
          </div>
        </b-col>
      </b-row>
    </b-container>
  </div>

</template>

<style>
</style>

<script>
import './../style/style.css';
import Navbar from '/src/components/Navbar.vue';
import Feed from '/src/components/Feed.vue';
import PanelBar from '/src/components/Sidelbar.vue';
import dataStorageInstance from "@/Data/DataStorageInstance";


export default {
  name: 'Mainpage',

  data() {
    return {
      /** @var {DataStorage} dataStorage */
      dataStorage: dataStorageInstance,
      isLoggedIn: false,
      isReady: false,
    }
  },

  watch: {
    isLoggedIn(newValue) {
      console.log("LOGGED", newValue)
    }
  },

  components: {
    Navbar,
    Feed,
    PanelBar
  },


  mounted() {
    if(this.dataStorage.isReady()) {
      this.isReady = true;
      return;
    }

    this.dataStorage.loadData().then(() => {
      console.log('[DATA_STORAGE]', this.dataStorage);
      this.isReady = true;
    })
  },

  computed: {
    articles: function () {
      if (!this.isReady) {
        return null;
      }

      return this.dataStorage.getArticles();
    },
  },

  // methods: {
  //   isDateStorageReady: function () {
  //     return this.dataStorage && this.dataStorage.isReady();
  //   },
  // }
};

// console.log(Auth.getCurrentUser());
//
// if (Auth.loggedIn) {
//   console.log("YES");
// } else {
//   console.log("NOT YET");
// }
//
// Auth.login('sam@osp', 'strazaksam').then(() => {
//   console.log(Auth.getCurrentUser());
// });

// const newArticle = new Article('Pieniądze za siano: Wielka gra', 'Stara Baba', 'Stahu chyba nie ucieknie!');
// newArticle.post();
//
// Article.get(1).then((article) => {
//   console.log(article);
// });

</script>

