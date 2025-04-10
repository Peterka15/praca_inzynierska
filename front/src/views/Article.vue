<template>
  <b-container class="my-4">
    <b-row>
      <b-col cols="12" lg="3">
        <VerticalStack wideGaps>
          <OspLogo/>

          <Guard admin moderator>
            <b-card title="Edycja">
              <VerticalStack>
                <p class="m-0">Edycja jest dostępna dla moderatorów i administratora portalu.</p>
                <b-button variant="secondary" class="w-100" :to="getPath(Path.addArticle)">
                  Dodaj nowy artykuł
                </b-button>
                <b-button :to="getPath(Path.addArticle, this.article.id)" variant="secondary">
                  Edytuj artykuł
                </b-button>
                <b-button @click="removeArticle" variant="danger">
                  Usuń artykuł
                </b-button>
              </VerticalStack>
            </b-card>
          </Guard>
        </VerticalStack>
      </b-col>
      <b-col cols="12" lg="9" class="mt-4 mt-lg-0">
        <VerticalStack wide-gaps>
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

            <UserSignature :username="this.article.author.name" :date="this.article.created_at" variant="danger"/>
          </b-card>

          <b-card
              title="Wasze komentarze"
          >
            <b-list-group class="border border-secondary" v-if="this.article.comments.length">
              <div v-for="comment in this.article.comments" :key="comment.id" class="border-secondary border-top p-4">
                <p class="mb-3">{{ comment.content }}</p>
                <UserSignature :username="comment.author" :date="comment.created_at"/>
              </div>
            </b-list-group>
            <b-alert show v-else variant="secondary" class="mb-0 text-center">
              Jeszcze nikt nie skomentował tego artykułu.
            </b-alert>
          </b-card>

          <b-card title="Weź udział w dyskusji - dodaj komentarz!">
            <b-form @submit.prevent="saveComment">
              <VerticalStack>
                <b-form-group
                    label="Twój komentarz"
                    label-for="comment"
                    description="Co myślisz o tym artykule?"
                >
                  <b-textarea
                      id="comment"
                      class="w-100"
                      placeholder="Twój komentarz"
                      v-model="newCommentContent"
                      required
                  />
                </b-form-group>

                <b-form-group
                    label="Podpis"
                    label-for="author"
                    description="Jak mamy podpisać Twój komentarz?"
                >
                  <b-input
                      type="text"
                      id="author"
                      placeholder="Krzysztof Kowalski"
                      v-model="newCommentAuthor"
                  />
                </b-form-group>
                <b-button variant="primary" type="submit">Dodaj komentarz</b-button>
              </VerticalStack>
            </b-form>
          </b-card>
        </VerticalStack>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>

import dataStorage from '@/Data/DataStorageInstance';

import Comment from '@/Model/Comment';
import Article from '@/Model/Article';
import HorizontalStack from '@/components/ui/HorizontalStack.vue';
import Path, { getPath } from '@/enum/Path';
import VerticalStack from '@/components/ui/VerticalStack.vue';
import OspLogo from '@/components/OspLogo.vue';
import auth from '@/Model/AuthInstance';
import Guard from '@/components/guards/Guard';
import UserSignature from '@/components/ui/UserSignature.vue';

export default {
  name: 'Article',
  computed: {
    Path () {
      return Path;
    }
  },

  components: {
    UserSignature,
    Guard,
    OspLogo,
    VerticalStack,
    HorizontalStack
  },

  data () {
    return {
      /** @type {Article} */
      article: null,
      newCommentAuthor: '',
      newCommentContent: ''
    };
  },

  created () {
    const articleId = parseInt(this.$route.params.articleId);
    this.article = dataStorage.articles.getById(articleId);

    if (!this.article) {
      Article.get(articleId).then((article) => {
        dataStorage.add(article);
        this.article = article;
      });
    }
  },

  methods: {
    getPath,

    saveComment: function () {
      const articleId = parseInt(this.$route.params.articleId);
      const comment = new Comment(articleId, this.newCommentAuthor, this.newCommentContent);

      comment.save().then((comment) => {
        this.article.comments.push(comment);
      });
    },

    removeArticle: function () {
      if (!window.confirm('Czy na pewno chcesz usunąć ten artykuł?')) {
        return;
      }

      if (!(auth.user.role.isAdmin() || auth.user.role.isModerator())) {
        return;
      }

      const articleId = parseInt(this.$route.params.articleId);

      dataStorage.articles.getById(articleId)?.delete().then(() => {
        dataStorage.articles.deleteById(articleId);
        this.$router.push('/');
      });
    }
  }
};
</script>
