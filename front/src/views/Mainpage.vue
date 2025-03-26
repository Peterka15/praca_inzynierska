<template>
  <b-container class="mt-4">
    <b-row>
      <b-col>
        <Sidebar @submitSearch="handleSubmitSearch" @submitSearchTag="handleSubmitSearchTag"></Sidebar>
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
    handleSubmitSearch(searchPhrase) {
      this.searchPhrase = searchPhrase;
    },
    handleSubmitSearchTag(searchTag) {
      this.searchTag = searchTag;
    },
  },
};
</script>
