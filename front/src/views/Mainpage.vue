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
        <b-col cols="2" class="panel">
          <h1 class="logo">
            <a href="#">OSP LATARNIA <span>GNIEZNO <b-img
                src="http://localhost:8000/logo.png" fluid
                alt="Fluid image"></b-img></span></a>

          </h1>
          <div class="nav-wrap">
            <nav class="main-nav" role="navigation">
              <ul class="unstyled list-hover-slide">
                <li>
                  <router-link to="/login">Logowanie</router-link>
                </li>
                <li>
                  <router-link to="/article/1">Artykuł 1</router-link>
                </li>
                <li>
                  <router-link to="/article/2">Artykuł 2</router-link>
                </li>
                <li>
                  <router-link to="/article/3">Artykuł 3</router-link>
                </li>
                <li><a href="#">Wyszukaj</a></li>
                <li><a href="http://localhost:8080/addarticle">Dodaj artykuł</a></li>
                <li><a href="http://localhost:8080/materials">Materiały szkoleniowe</a></li>
                <li><a href="#">Tagi</a></li>
                <li><a href="#">Wyloguj</a></li>
              </ul>
            </nav>
          </div>
        </b-col>
        <b-col cols="10" class="right_column">
          <div>
            <feed v-for="article in articles" :key="article.id" :article="article"></feed>
          </div>
        </b-col>
      </b-row>
    </b-container>

<!--TODO: DODAC WYŚWIETLANIE OBRAZKÓW DO ARTYKUŁÓW  -->
<!--TODO  DODAĆ PRAWIDŁOWE TAGI W ARTYKUŁACH-->
  </div>

</template>

<style>
</style>

<script>
import './../style/style.css';
// import Bridge from "@/api/Bridge";
// import ApiUrls from "@/api/ApiUrls";
import Navbar from '/src/components/Navbar.vue';
import Feed from '/src/components/Feed.vue';
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
  },


  mounted() {
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

