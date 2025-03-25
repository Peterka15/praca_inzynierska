<template>
  <b-card
      title="Dodaj artykuł"
  >
    <b-form @submit.prevent="saveArticle">
      <b-form-group
          label="Tytuł"
          label-for="input-form-input-title"
          description="Wprowadź tytuł artykułu."
          class="mt-4"
      >
        <b-form-input
            id="input-form-input-title"
            v-model="title"
            type="text"
            placeholder="Tytuł"
            required
        ></b-form-input>
      </b-form-group>

      <b-form-group
          label="Treść"
          label-for="input-form-input-tags"
          description="Wprowadź treść artykułu."
          class="mt-4"
      >
        <vue-editor v-model="content" :editor-toolbar="customToolbar" id="input-form-editor"/>
      </b-form-group>

      <b-form-group
          label="Tagi"
          label-for="input-form-input-tags"
          description="Wprowadź tagi oddzielone przecinkami."
          class="mt-4"
      >
        <b-form-input
            id="input-form-input-tags"
            v-model="raw_tags"
            type="text"
            placeholder="Pożar, Akcja, OSP, Latarnia"
            required
        ></b-form-input>
      </b-form-group>

      <b-form-group
          label="Zdjęcia"
          label-for="input-form-input-photos"
          description="Dodaj zdjęcia do artykułu."
          class="mt-4"
      >
        <b-form-file v-model="photos" class="mt-3" multiple accept="image/*"></b-form-file>

        <div class="mt-3 d-flex flex-wrap" style="gap: 1em">
          <div v-for="(img, index) in photoPreviews" :key="index">
            <img :src="img" alt="Podgląd obrazka" style="height: 100px; object-fit: cover"/>
          </div>
        </div>
      </b-form-group>

      <b-alert show v-if="validationError" variant="danger" class="mt-3 text-center">{{ validationError }}</b-alert>

      <div class="d-flex justify-content-end">
        <b-button variant="primary" type="submit" class="d-inline">Dodaj artykuł</b-button>
      </div>
    </b-form>
  </b-card>
</template>

<script>
import {VueEditor} from 'vue2-editor';
import Navbar from '/src/components/Navbar.vue';
import Article from '@/Model/Article';
import Tag from '@/Model/Tag';
import dataStorage from '@/Data/DataStorageInstance';

export default {
  name: 'Mainpage',
  components: {VueEditor, Navbar},

  data() {
    return {
      title: '',
      content: '',
      raw_tags: '',
      photos: null,
      photoPreviews: [],
      validationError: null,
      customToolbar: [
        ['bold', 'italic', 'underline', 'strike'],
        [{list: 'ordered'}, {list: 'bullet'}],
        ['code-block'],
        [{header: [1, 2, 3, 4, 5, 6]}],
        ['link']
      ]
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

      const tags = this.raw_tags
          .trim()
          .split(',')
          .filter(tagText => tagText.length)
          .map(tagText => new Tag(tagText.trim()));

      const article = new Article(this.title, this.content, tags);

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

  watch: {
    photos(newFiles) {
      this.photoPreviews = [];
      if (!newFiles) return;

      Array.from(newFiles).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => this.photoPreviews.push(e.target.result);
        reader.readAsDataURL(file);
      });
    }
  },
}
</script>
