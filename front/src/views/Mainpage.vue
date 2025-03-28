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
      isReady: false,
      searchPhrase: '',
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
    filteredArticles() {
      const articles = this.dataStorage.articles
          .getDataAsArray()
          .sort((a, b) => b.created_at >= a.created_at);
      
      if (this.searchPhrase === '') {
        return articles;
      }

      const searchTermLower = this.searchPhrase.toLowerCase();

      return articles.filter((article) => {
        const isTitleMatch = article.title.toLowerCase().includes(searchTermLower);
        const isTagMatch = article.tags.filter((tag) => tag.name.toLowerCase().includes(searchTermLower)).length > 0;

        return isTitleMatch || isTagMatch;
      });
    },
  }
};
</script>
