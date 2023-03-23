<template>
  <div class="main_page_article parent">
    <b-img v-if="this.article.images[0]" :src="this.article.images[0].url" fluid></b-img>

    <div class="text">

      <!-- TODO: ZRÓB MNIE ANIMACJA PO NAJECHANIU MYSZKA -->
      <h3 @click="goToArticle()">{{ this.article.title }}</h3>
      <p v-html="this.article.content"></p>

      <p>
        <button class="blue" v-for="tag in this.article.tags" :key="tag.id">{{ tag.name }}</button>
      </p>

      <!-- TODO: REMOVE -->
      <div>
        <a href="url" style="color: red">Edytuj</a>
      </div>
    </div>
  </div>
</template>

<script>

import router from "@/router";

export default {
  name: 'Feed',
  props: ['article'],

  methods: {
    goToArticle() {
      router.push({name: 'article', params: { articleId: this.article.id }});
    }
  }
}

</script>
