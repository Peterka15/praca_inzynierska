<template>
  <b-container class="mt-4">
    <b-row>
      <b-col>
        <Sidebar v-model="searchPhrase"/>
      </b-col>
      <b-col cols="9">
        <Feed v-for="article in filteredArticles" :key="article.id" :article="article"></Feed>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import Navbar from '/src/components/Navbar.vue';
import Feed from '/src/components/Feed.vue';
import Sidebar from '/src/components/Sidebar.vue';
import dataStorageInstance from '@/Data/DataStorageInstance';

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
      if (this.searchPhrase === '') {
        return this.articles;
      }
      
      const searchTermLower = this.searchPhrase.toLowerCase();

      return this.articles.filter((article) => {
        console.log(article);
        const isTitleMatch = article.title.toLowerCase().includes(searchTermLower);
        const isTagMatch = article.tags.filter((tag) => tag.name.toLowerCase().includes(searchTermLower)).length > 0;

        return isTitleMatch || isTagMatch;
      });
    },
  }
};
</script>
