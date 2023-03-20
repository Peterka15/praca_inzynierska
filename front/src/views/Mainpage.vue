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
                <li><router-link to="/login">Logowanie</router-link></li>
                <li><router-link to="/article/1">Artykuł 1</router-link></li>
                <li><router-link to="/article/2">Artykuł 2</router-link></li>
                <li><router-link to="/article/3">Artykuł 3</router-link></li>
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
<!--TODO: PRZEROBIĆ RENDEROWANIE ARTYKUŁU NA STRONIE GŁÓWNEJ NA KOMPONENT-->
            <div class="list_object parent" v-for="article in articles" :key="article.id">

              <b-img src="http://localhost:8000/1.jpg" fluid alt="Responsive image"></b-img>
              <!--TODO: ZA POMOCĄ POSTMANA DODAĆ OBRAZKI DO BAZY-->

              <div class="text">

                <h3>{{article.title}} </h3>
                <!--TODO: ZROBIĆ LINK DO ARTYKULU-->

                <p v-html="article.content"></p>

                <p><span class="blue" v-for="tag in article.tags" :key="tag.id">{{ tag.name }}</span> </p>
                <!--TODO: DODAĆ MARINESY DO TAGÓW I JEDEN KOLOR NP KLASĄ TAG-->

                <div>
                  <a href="url" style="color: red">Edytuj</a>
                </div>
              </div>

            </div>

<!--            <div class="list_object parent">-->
<!--              <b-img src="http://localhost:8000/2.jpg"-->
<!--                     fluid alt="Responsive image"></b-img>-->
<!--              <div class="text">-->
<!--                <h3>Headline</h3>-->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent euismod ultrices ante, ac laoreet-->
<!--                  nulla vestibulum adipiscing. Nam quis justo in augue auctor imperdiet.</p>-->
<!--                <p><span class="blue">New!</span> <span class="green">More Later!</span></p>-->
<!--                <a href="url" style="color: red">Edytuj</a>-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="list_object parent">-->
<!--              <b-img src="http://localhost:8000/3.jpg"-->
<!--                     fluid alt="Responsive image"></b-img>-->
<!--              <div class="text">-->
<!--                <h3>Headline</h3>-->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent euismod ultrices ante, ac laoreet-->
<!--                  nulla vestibulum adipiscing. Nam quis justo in augue auctor imperdiet.</p>-->
<!--                <p><span class="blue">New!</span> <span class="green">More Later!</span></p>-->
<!--                <a href="url" style="color: red">Edytuj</a>-->
<!--              </div>-->
<!--            </div>-->

<!--            <div class="list_object parent">-->
<!--              <b-img src="http://localhost:8000/4.jpg"-->
<!--                     fluid alt="Responsive image"></b-img>-->
<!--              <div class="text">-->
<!--                <h3>Headline</h3>-->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent euismod ultrices ante, ac laoreet-->
<!--                  nulla vestibulum adipiscing. Nam quis justo in augue auctor imperdiet.</p>-->
<!--                <p><span class="blue">New!</span> <span class="green">More Later!</span></p>-->
<!--                <a href="url" style="color: red">Edytuj</a>-->
<!--              </div>-->
<!--            </div>-->


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
// import Bridge from "@/api/Bridge";
// import ApiUrls from "@/api/ApiUrls";
import Navbar from '/src/components/Navbar.vue';
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
  },


  mounted() {
    this.dataStorage.loadData().then(()=>{
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

