<template>
  <b-container class="mt-4">
    <b-row>
      <b-col>
        <Sidebar></Sidebar>
      </b-col>
      <b-col cols="9">
        <div v-if="!this.article">
          <b-spinner label="Spinning"></b-spinner>
        </div>
        <b-card
            v-else
            :title="this.article.title"
            :img-src="this.article.images[0] ? this.article.images[0].url : '/media/cover.webp'"
            img-top
            tag="article"
        >
          <b-card-text>
            <HorizontalStack start>
              <b-button
                  to="#"
                  variant="secondary"
                  v-for="tag in this.article.tags" :key="tag.id"
                  style="font-size: 0.7em"
                  class="p-1"
              >
                {{ tag.name }}
              </b-button>
            </HorizontalStack>
          </b-card-text>

          <b-card-text v-html="this.article.content"></b-card-text>

          <AdminOnly>
            <HorizontalStack>
              <b-button :to="{ path: '/addarticle/' + this.article.id }" variant="secondary">
                Edytuj artykuł
              </b-button>
            </HorizontalStack>
          </AdminOnly>
        </b-card>

        <div class="add_comment_box shadow">
          <div>
            <h4>Weź udział w dyskusji dodając komentarz: </h4>
          </div>
          <div class="name_form">
            <input class="name_formp" type="text" id="fname" name="fname" placeholder="Imię i Nazwisko"
                   v-model="author"><br>
          </div>
          <div class="name_form">
              <textarea name="comments" id="comments" class="comment_box" placeholder="Pole na komentarz"
                        v-model="content"></textarea>
            <div style="padding: 8px">
              <!--                ZAPISZ KOMENTARZ-->
              <b-button variant="primary" @click="saveComment()">Dodaj</b-button>
            </div>
          </div>
        </div>
        <div class="comments_box shadow">
          <div v-if="!this.article">
            <b-spinner label="Spinning"></b-spinner>
          </div>
          <div v-else>
            <CommentComponent
                v-for="comment in this.article.comments"
                :key="comment.id"
                :comment="comment"
            />
          </div>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>

import CommentComponent from '@/components/CommentComponent';
import Navbar from '@/components/Navbar';
import Sidebar from '/src/components/Sidebar.vue';
import dataStorage from '@/Data/DataStorageInstance';

import Comment from '@/Model/Comment';
import Article from '@/Model/Article';
import HorizontalStack from '@/components/ui/HorizontalStack.vue';
import AdminOnly from '@/components/guards/AdminOnly';

export default {
  name: 'Article',

  components: {
    AdminOnly,
    HorizontalStack,
    CommentComponent,
    Navbar,
    Sidebar,
  },

  data() {
    return {
      article: null,
      author: '',
      content: ''
    };
  },

  created() {
    const articleId = parseInt(this.$route.params.articleId);
    this.article = dataStorage.articles.data.get(articleId);

    if (!this.article) {
      Article.get(articleId).then((article) => {
        dataStorage.add(article);
        this.article = article;
      });
    }
  },

  methods: {
    saveComment: function () {

      const articleId = parseInt(this.$route.params.articleId);
      const comment = new Comment(articleId, this.author, this.content);

      comment.save().then((comment) => {
        this.article.comments.push(comment);
      });
    }
  }
}
</script>
