<template>
  <div>
    <b-container>
      <b-row class="background">
        <Sidebar @submitSearch="handleSubmitSearch" @submitSearchTag="handleSubmitSearchTag"></Sidebar>
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
import Navbar from '/src/components/Navbar.vue';
import Feed from '/src/components/Feed.vue';
import Sidebar from '/src/components/Sidebar.vue';
import dataStorageInstance from "@/Data/DataStorageInstance";


export default {
  name: 'Mainpage',

  data() {
    return {
      dataStorage: dataStorageInstance,
      isLoggedIn: false,
      isReady: false,
      searchPhrase: '',
      searchTag: '',
    };
  },

  watch: {
    isLoggedIn(newValue) {
      console.log("LOGGED", newValue);
    },
  },

  components: {
    Navbar,
    Feed,
    Sidebar,
  },

  mounted() {
    if (this.dataStorage.isReady()) {
      this.isReady = true;
      return;
    }

    this.dataStorage.loadBasicData().then(() => {
      this.isReady = true;
    });
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

      const uniqueArticles = [];
      const seenIds = new Set();

      this.articles.forEach((article) => {
        const articleTitleLower = article.title.toLowerCase();
        const isTitleMatch = this.searchPhrase === '' || articleTitleLower.includes(searchTermLower);
        const isTagMatch = this.searchTag === '' || article.tags.filter((tag) => tag.name === this.searchTag).length > 0;

        if (isTitleMatch && isTagMatch && !seenIds.has(article.id)) {
          uniqueArticles.push(article);
          seenIds.add(article.id);
        }
      });

      return uniqueArticles;
    },
  },

  methods: {
    isDateStorageReady: function () {
      return this.dataStorage && this.dataStorage.isReady();
    },

    handleSubmitSearch(searchPhrase) {
      this.searchPhrase = searchPhrase;
    },
    handleSubmitSearchTag(searchTag) {
      this.searchTag = searchTag;
    },
  },
};
</script>
