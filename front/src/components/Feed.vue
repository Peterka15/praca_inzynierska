<template>
  <b-card
      no-body
      class="overflow-hidden"
      tag="article"
  >
    <b-row no-gutters>
      <b-col
          class="article-image"
          :style="`background-image: url(${article.images[0] ? article.images[0].url : '/media/cover.webp'}); min-height: 250px`"
      >
      </b-col>
      <b-col>
        <b-card-body :title="this.article.title" class="text-left">
          <b-card-text class="clamp-text">
            <div v-html="this.article.content"></div>
          </b-card-text>

          <b-card-text>
            <b-button
                to="#"
                variant="secondary"
                v-for="tag in this.article.tags" :key="tag.id"
                style="font-size: 0.7em"
                class="p-1 m-1"
            >
              {{ tag.name }}
            </b-button>
          </b-card-text>

          <div class="text-right">
            <b-button :to="getPath(Path.article, article.id)" variant="primary">Czytaj więcej</b-button>
          </div>
        </b-card-body>
      </b-col>
    </b-row>
  </b-card>
</template>

<style>
.article-image {
  background-position: center;
  background-size: cover;
}

.clamp-text {
  display: -webkit-box;
  line-clamp: 2;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
  height: 3em;
}
</style>

<script>

import Path, { getPath } from '@/enum/Path';

export default {
  name: 'Feed',
  methods: { getPath },
  computed: {
    Path () {
      return Path;
    }
  },
  props: ['article']
};


</script>
