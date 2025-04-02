<template>
  <b-container class="my-4">
    <b-row>
      <b-col>
        <Sidebar></Sidebar>
      </b-col>
      <b-col cols="9">
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

            <AdminOnly>
              <HorizontalStack>
                <b-button :to="getPath(Path.addArticle, this.article.id)" variant="secondary">
                  Edytuj artykuł
                </b-button>
              </HorizontalStack>
            </AdminOnly>
          </b-card>

          <b-card
              title="Wasze komentarze"
          >
            <b-list-group class="border border-secondary">
              <div v-for="comment in this.article.comments" :key="comment.id" class="border-secondary border-top p-4">
                <HorizontalStack class="align-items-center" start>
                  <b-avatar variant="primary" :text="comment.author.slice(0, 2)" class="mb-2"></b-avatar>
                  <div>
                    <h5 class="m-0">{{ comment.author }}</h5>
                    <p class="m-0 text-secondary">{{
                        new Date(comment.created_at).toLocaleString('pl-PL',
                            {hour: '2-digit', minute: '2-digit', day: '2-digit', month: '2-digit', year: 'numeric'})
                      }}</p>
                  </div>
                </HorizontalStack>
                <p class="mb-0 mt-3">{{ comment.content }}</p>
              </div>
            </b-list-group>
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
                      v-model="content"
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
                      v-model="author"
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

import CommentComponent from '@/components/CommentComponent';
import Navbar from '@/components/Navbar';
import Sidebar from '/src/components/Sidebar.vue';
import dataStorage from '@/Data/DataStorageInstance';

import Comment from '@/Model/Comment';
import Article from '@/Model/Article';
import HorizontalStack from '@/components/ui/HorizontalStack.vue';
import AdminOnly from '@/components/guards/AdminOnly';
import Path, {getPath} from '@/enum/Path';
import VerticalStack from '@/components/ui/VerticalStack.vue';

export default {
  name: 'Article',
  computed: {
    Path() {
      return Path
    }
  },

  components: {
    VerticalStack,
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
    getPath,
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
