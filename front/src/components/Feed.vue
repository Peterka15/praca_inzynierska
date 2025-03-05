<template>
  <div>
    <b-img v-if="this.article.images[0]" :src="this.article.images[0].url" fluid></b-img>

    <div>
      <h3 @click="goToArticle()" >{{ this.article.title }}</h3>
      <p v-html="this.article.content"></p>
      <p>
        <button v-for="tag in this.article.tags" :key="tag.id">{{ tag.name }}</button>
      </p>
    </div>
  </div>
</template>

<script>

import router from '@/router';

export default {
  name: 'Feed',
  props: ['article'],
  methods: {
    goToArticle () {
      router.push({
        name: 'article',
        params: { articleId: this.article.id }
      });
    }
  }
};


</script>
