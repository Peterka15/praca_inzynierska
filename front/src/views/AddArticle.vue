<template>
  <AdminOnly displayError>
    <b-container class="mt-4">
      <b-card
          :title="this.id ? 'Edytuj artykuł' : 'Dodaj artykuł'"
      >
        <b-form @submit.prevent="saveArticle">
          <b-form-group
              label="Tytuł"
              label-for="input-form-input-title"
              description="Wprowadź tytuł artykułu."
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
          >
            <vue-editor v-model="content" :editor-toolbar="customToolbar" id="input-form-editor"/>
          </b-form-group>

          <b-row>
            <b-col>
              <b-form-group
                  label="Tagi"
                  label-for="input-form-input-tags"
                  description="Wprowadź tagi oddzielone przecinkami."
              >
                <b-form-input
                    id="input-form-input-tags"
                    v-model="raw_tags"
                    type="text"
                    placeholder="Pożar, Akcja, OSP, Latarnia"
                ></b-form-input>
              </b-form-group>
            </b-col>

            <b-col>
              <b-form-group
                  label="Zdjęcia"
                  label-for="input-form-input-photos"
                  description="Dodaj zdjęcia do artykułu."
              >
                <b-form-file v-model="photos" multiple accept="image/*"></b-form-file>

                <HorizontalStack>
                  <div v-for="(img, index) in photoPreviews" :key="index">
                    <img :src="img" alt="Podgląd obrazka" style="height: 100px; object-fit: cover"/>
                  </div>
                </HorizontalStack>
              </b-form-group>
            </b-col>
          </b-row>

          <b-alert show v-if="validationError" variant="danger" class="mt-3 text-center">{{ validationError }}</b-alert>
          <b-alert show v-if="confirmationMessage" variant="success" class="mt-3 text-center">
            {{ confirmationMessage }}
          </b-alert>

          <HorizontalStack>
            <b-button
                v-if="this.id"
                :to="getPath(Path.article, this.id)"
                variant="danger"
                type="submit"
                class="d-inline"
            >
              Anuluj
            </b-button>
            <b-button variant="primary" type="submit" class="d-inline">
              {{ this.id ? 'Zapisz zmiany' : 'Dodaj artykuł' }}
            </b-button>
          </HorizontalStack>
        </b-form>
      </b-card>
    </b-container>
  </AdminOnly>
</template>

<script>
import {VueEditor} from 'vue2-editor';
import Article from '@/Model/Article';
import Tag from '@/Model/Tag';
import dataStorage from '@/Data/DataStorageInstance';
import Bridge from '@/api/Bridge';
import Image from '@/Model/Image';
import HorizontalStack from '@/components/ui/HorizontalStack.vue';
import AdminOnly from '@/components/guards/AdminOnly';
import Path, {getPath} from '@/enum/Path';

export default {
  name: 'Mainpage',
  computed: {
    Path() {
      return Path
    }
  },
  components: {AdminOnly, HorizontalStack, VueEditor},

  data() {
    return {
      id: null,
      title: '',
      content: '',
      raw_tags: '',
      photos: null,
      photoPreviews: [],
      validationError: null,
      confirmationMessage: null,
      customToolbar: [
        ['bold', 'italic', 'underline', 'strike'],
        [{list: 'ordered'}, {list: 'bullet'}],
        ['code-block'],
        [{header: [1, 2, 3, 4, 5, 6]}],
        ['link']
      ]
    }
  },

  created() {
    this.id = parseInt(this.$route.params.id);

    if (!this.id) {
      return;
    }

    const article = dataStorage.articles.data.get(this.id);

    if (article) {
      this.title = article.title;
      this.content = article.content;
      this.raw_tags = article.tags.map(tag => tag.name).join(', ');
    } else {
      this.validationError = 'Nie znaleziono artykułu do edycji.';
    }
  },

  methods: {
    getPath,
    saveArticle: function () {
      if (!this.title.trim() || !this.content.trim()) {
        this.validationError = 'Wypełnij wszystkie pola przed dodaniem artykułu.';
        return;
      }

      if (!/^(([\wąćęłńóżź](,\s+)?)*)$/i.test(this.raw_tags)) {
        this.validationError = 'Tagi muszą być oddzielone przecinkami i nie mogą być puste.';
        return;
      }

      const tags = this.raw_tags
          .trim()
          .split(',')
          .filter(tagText => tagText.length)
          .map(tagText => new Tag(tagText.trim()));

      const article =
          this.id
              ? dataStorage.articles.data.get(this.id)
              : new Article();

      article.title = this.title;
      article.content = this.content;
      article.tags = tags;

      article.save().then((article) => {
        dataStorage.articles.data.set(article.id, article);
        this.validationError = null;

        if (!this.photos || !this.photos.length) {
          return article;
        }

        // Upload images simultaneously
        const uploadPromises = Array.from(this.photos).map(async (file) => {
          const formData = new FormData();
          formData.append('article_id', article.id);
          formData.append('image', file);

          let response = await Bridge.uploadFile('images', formData);
          article.images.push((new Image()).hydrate(response.data));
          return article;
        });

        return Promise.all(uploadPromises);
      }).then(() => {
        this.confirmationMessage = 'Artykuł zapisany.'
      }).catch((error) => {
        this.validationError = 'Wystąpił błąd podczas dodawania artykułu. ' + error.body.message;
      });
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
