<template>
  <div v-if="loggedIn">
    <Navbar></Navbar>

    <b-container>
      <b-row class="background">
        <PanelBar></PanelBar>
        <b-col cols="9" class="right_column">
          <div style="height: 200px"/>

          <div class="article_box shadow">
            <div v-if="!this.isLoaded"><b-spinner label="Spinning"></b-spinner></div>
            <div v-else-if="this.isError">ERROR!</div>
            <div v-else>
              <b-img v-if="this.article && this.article.images[0]" :src="this.article.images[0].url" fluid></b-img>
              <div>
                <h3 class="title">{{ this.article.title }}</h3>
              </div>
              <div v-html="this.article.content"></div>
              <div class="article_tagposition">
                <p>
                  <button class="blue" v-for="tag in this.article.tags" :key="tag.id">{{ tag.name }}</button>
                </p>
              </div>
<!--              TODO: Przejście do ekranu edycji artykułu-->
              <b-button v-if="loggedIn" :to="{ path: '/'}">EDYTUJ WPIS</b-button>
            </div>
          </div>

          <div class="add_comment_box shadow">
            <div>
              <h4>Weź udział w dyskusji dodając komentarz: </h4>
            </div>
            <div class="name_form">
              <input class="name_formp" type="text" id="fname" name="fname" placeholder="Imię i Nazwisko" v-model="author"><br>
            </div>
            <div class="name_form">
              <textarea name="comments" id="comments" class="comment_box" placeholder="Pole na komentarz"  v-model="content" ></textarea>
              <div style="padding: 8px">
<!--                ZAPISZ KOMENTARZ-->
                <b-button variant="primary"  @click="saveComment()">Dodaj</b-button>
              </div>
            </div>
          </div>
          <div class="comments_box shadow">
            <div v-if="!this.isLoaded"><b-spinner label="Spinning"></b-spinner></div>
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

  </div>
</template>

<script>

import './../style/style.css';
import CommentComponent from '@/components/CommentComponent';
import Navbar from '@/components/Navbar';
import PanelBar from '/src/components/Sidelbar.vue';
import dataStorage from '@/Data/DataStorageInstance';

import Comment from "@/Model/Comment";
import Article from "@/Model/Article";
import auth from "@/Model/AuthInstance";


export default {
  name: 'Article',


  components: {
    // eslint-disable-next-line vue/no-unused-components
    CommentComponent,
    Navbar,
    PanelBar,
  },

  data() {
    return {
      isLoaded: false,
      article: null,
      author: "",
      content: ""
    };
  },

  computed: {
    loggedIn: function () {
      return auth.loggedIn
    },
  },

  created() {
    const articleId = parseInt(this.$route.params.articleId);
    Article.get(articleId).then((article) =>{
      dataStorage.addArticle(article);
      this.article = article;
      this.isLoaded = true;
    });
  },

  methods: {
    saveComment: function () {

      const articleId = parseInt(this.$route.params.articleId);
      const comment = new Comment(articleId, this.author, this.content);

      comment.save().then((comment) => {
        console.log('Udało się!');
        this.article.comments.push(comment);
      });
    }
  }
}
</script>