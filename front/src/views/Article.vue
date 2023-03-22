<script>
import './../style/style.css';
import Article from "@/Model/Article";
import CommentComponent from "@/components/CommentComponent";
import Navbar from "@/components/Navbar";
import dataStorage from "@/Data/DataStorageInstance";

export default {
  name: 'Article',

  components: {
    // eslint-disable-next-line vue/no-unused-components
    CommentComponent,
    Navbar
  },

  data() {
    return {
      isLoaded: false,
      isError: false,
      article: null
    }
  },

  created() {
    const articleId = parseInt(this.$route.params.articleId);

    dataStorage.getArticle(1)

    Article.get(articleId)
        .then(article => {
          console.log("DONE. ", article)
          this.isLoaded = true;
          this.isError = false;
          this.article = article;
        })
        .catch(() => {
          console.log("ERROR. ")
          this.isLoaded = true;
          this.isError = true
        });
  }
}
</script>

<template>
  <div>
    <Navbar></Navbar>

    <b-container>
      <b-row class="background">
        <b-col cols="2" class="panel">
          <h1 class="logo">
            <a href="http://localhost:8080/">OSP LATARNIA <span>GNIEZNO <b-img
                src="http://localhost:8000/logo.png" fluid
                alt="Fluid image"></b-img></span></a>

          </h1>
          <div class="nav-wrap">
            <nav class="main-nav" role="navigation">
              <ul class="unstyled list-hover-slide">
                <li><a href="#">Wyszukaj</a></li>
                <li><a href="#">Zaloguj/Wyloguj</a></li>
                <li><a href="#">Dodaj artykuł</a></li>
                <li><a href="#">Materiały szkoleniowe</a></li>
                <li><a href="#">Tagi</a></li>

              </ul>
            </nav>
          </div>
        </b-col>
        <b-col cols="10" class="right_column">
          <div style="height: 200px"/>

          <div class="article_box shadow">
            <div v-if="!this.isLoaded">Loading...</div>
            <div v-else-if="this.isError">ERROR!</div>
            <div v-else>
              <b-img v-if="this.article.images[0]" :src="this.article.images[0].url" fluid></b-img>
              <div>
                <h3 class="title">{{ this.article.title }}</h3>
              </div>
              <div v-html="this.article.content"></div>
              <div class="article_tagposition">
                <p><button class="blue" v-for="tag in this.article.tags" :key="tag.id">{{ tag.name }}</button></p>
              </div>
            </div>
          </div>

          <div class="add_comment_box shadow">
            <div>
              <h4>Weź udział w dyskusji i dodając komentarz: </h4>
            </div>
            <div class="name_form">
              <input class="name_formp" type="text" id="fname" name="fname" placeholder="Imię i Nazwisko"><br>
            </div>
            <div class="name_form">
              <textarea name="comments" id="comments" class="comment_box" placeholder="Pole na komentarz"></textarea>
              <div style="padding: 8px">
                <b-button variant="primary">Dodaj</b-button>
              </div>
            </div>
          </div>

          <div class="comments_box shadow">
            <div v-if="!this.isLoaded">Loading...</div>
            <div v-else-if="this.isError">ERROR!</div>
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
