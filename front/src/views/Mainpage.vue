<template>
  <div>
    <navbar>
    </navbar>
    <b-container>
      <b-row class="background">
        <PanelBar></PanelBar>
        <b-col cols="9" class="right_column">
          <div>
            <feed v-for="article in articles" :key="article.id" :article="article"></feed>
          </div>
        </b-col>
      </b-row>
    </b-container>
  </div>
<!--TODO: Dodać paginację-->
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
  searchPhrase: '',

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
    // filteredArticles() {
    //   let articles = this.dataStorage.articles;
    //   if(this.searchPhrase !== '') {
    //     articles = articles.includes(article => article.title.includes(this.searchPhrase));
    //   }
    //   return articles;
    // }

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

