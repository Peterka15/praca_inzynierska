<template>
  <div v-if="loggedIn">
    <navbar/>
    <div class="m_boxcenter m_boxcenterp shadow">
      <h3 class="m_boxfont">NOWY ARTYKUŁ</h3>
    </div>
    <div class="workspace">
      <b-container>
        <b-row>
          <b-col cols="6">
            <div style="background: white">
              <vue-editor v-model="content"/>
            </div>
          </b-col>
          <b-col cols="6">
            <div class="name_form">
              <input class="name_formp" type="text" id="fname" name="fname" placeholder="Nazwa artykułu"
                     v-model="title"><br>
            </div>
            <div class="name_form">
              <input class="tags" type="text" placeholder="Tagi (oddziel przecinkami)" v-model="raw_tags"><br>
            </div>
            <div class="addphotos">
              <b-button variant="primary" v-b-modal.photo-modal>Dodaj zdjęcia +</b-button>
              <b-alert v-if="validationError" variant="danger" show dismissible @dismissed="validationError = null">
                {{ validationError }}
              </b-alert>
              <b-modal id="photo-modal">
                <h3>
                  Wybierz zdjęcia do dodania
                </h3>
                <b-form-file v-model="photos" class="mt-3" plain></b-form-file>
              </b-modal>
            </div>
            <div class="add_article_button">
              <b-button variant="primary" style="margin-bottom: 10px" @click="saveArticle()">Dodaj Artykuł</b-button>
              <b-button style="background: red">Usuń artykuł</b-button>
            </div>

          </b-col>
        </b-row>
      </b-container>
    </div>
  </div>
  <h1 v-else style="background-color: white; color: black;">Dostęp nielegalny</h1>
</template>

<script>
import './../style/style.css';
import {VueEditor} from "vue2-editor";
import Navbar from '/src/components/Navbar.vue';
import Article from "@/Model/Article";
import Tag from "@/Model/Tag";
import Bridge from "@/api/Bridge";
import dataStorage from "@/Data/DataStorageInstance";
import auth from "@/Model/AuthInstance";

export default {
  name: 'Mainpage',
  components: {VueEditor, Navbar},

  data() {
    return {
      title: '',
      content: '',
      raw_tags: "",
      validationError: null,
    }
  },

  methods: {
    saveArticle: function () {
      if (!this.title.trim() || !this.content.trim() || !this.raw_tags.trim()) {
        this.validationError = 'Wypełnij wszystkie pola przed dodaniem artykułu.';
        return;
      }

      if (!this.isValidTagsFormat(this.raw_tags)) {
        this.validationError = 'Tagi muszą być oddzielone przecinkami.';
        return;
      }

      const tags = this.raw_tags.split(',').map(tagText => new Tag(tagText.trim()));
      const article = new Article(this.title, this.content, tags);

      Bridge.setBearerToken('34|f0zn0BWpVKZimKURjquUbvWgeVhGTAH41RnGjEG3');

      article.save().then((article) => {
        console.log('Udało się!');
        dataStorage.addArticle(article);
        this.validationError = null;
      }).catch(() => {
        this.validationError = 'Wystąpił błąd podczas dodawania artykułu. Spróbuj ponownie później.';
      });
    },

    isValidTagsFormat(tags) {
      const tagsArray = tags.split(',');
      return tagsArray.length > 1;
    },
  },
  computed: {
    loggedIn: function () {
      return auth.loggedIn
    },
  },
}
</script>