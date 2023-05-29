<template>
  <div>
    <navbar>
    </navbar>
    <b-container>
      <b-row class="background">
        <Sidebar @submitSearch="handleSubmitSearch"></Sidebar>
        <b-col cols="9" class="right_column">
          <div>
            <feed v-for="article in filteredArticles" :key="article.id" :article="article"></feed>
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
import Sidebar from '/src/components/Sidebar.vue';
import dataStorageInstance from "@/Data/DataStorageInstance";


export default {
  name: 'Mainpage',


  data() {
    return {
      /** @var {DataStorage} dataStorage */
      dataStorage: dataStorageInstance,
      isLoggedIn: false,
      isReady: false,
      searchPhrase: '',
      searchTag: "",
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
    Sidebar
  },


  mounted() {
    if (this.dataStorage.isReady()) {
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
        return [];
      }

      return this.dataStorage.getArticles();
    },
    filteredArticles() {
      const searchTermLower = this.searchPhrase.toLowerCase();

      return this.articles.filter(article => {
        const articleTitleLower = article.title.toLowerCase();
        return this.searchPhrase === '' || articleTitleLower.includes(searchTermLower);
      }).filter(article => {
        return this.searchTag === '' || article.tags.filter(tag => tag.name === this.searchTag).length > 0
      })
    },


  },

  methods: {
    isDateStorageReady: function () {
      return this.dataStorage && this.dataStorage.isReady();
    },

    handleSubmitSearch(searchPhrase) {
      this.searchPhrase = searchPhrase;
    },
  }
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

