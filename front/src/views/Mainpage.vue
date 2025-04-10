<template>
  <b-container class="mt-4">
    <b-row>
      <b-col cols="12" lg="3">
        <VerticalStack wideGaps>
          <OspLogo/>

          <b-card title="Szukaj">
            <b-form-group label-for="input-search" label="Wyszukaj artykułów lub tagów">
              <b-form-input
                  id="input-search"
                  v-model="searchPhrase"
                  type="text"
                  placeholder="Akcja gaśnicza"
              ></b-form-input>
            </b-form-group>
          </b-card>

          <Guard admin moderator>
            <b-card title="Edycja">
              <VerticalStack>
                <p class="m-0">Edycja jest dostępna dla moderatorów i administratora portalu.</p>
                <b-button variant="secondary" class="w-100" :to="getPath(Path.addArticle)">
                  <b-icon-plus class="mr-1" scale="1.3"/> Dodaj nowy artykuł
                </b-button>
              </VerticalStack>
            </b-card>
          </Guard>

          <Guard admin>
            <b-card title="Administracja">
              <VerticalStack>
                <p class="m-0">Tu znajdziesz listę skrótów do funkcji administracyjnych.</p>
                <b-button variant="secondary" class="w-100" :to="getPath(Path.users)">
                  <b-icon-plus class="mr-1" scale="1.3"/>  Dodaj użytkownika
                </b-button>
              </VerticalStack>
            </b-card>
          </Guard>
        </VerticalStack>
      </b-col>
      <b-col cols="12" lg="9" class="mt-4_5 mt-lg-0">
        <VerticalStack>
          <Feed v-for="article in filteredArticles" :key="article.id" :article="article"></Feed>
        </VerticalStack>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import Navbar from '/src/components/Navbar.vue';
import Feed from '/src/components/Feed.vue';
import dataStorageInstance from '@/Data/DataStorageInstance';
import VerticalStack from '@/components/ui/VerticalStack.vue';
import OspLogo from '@/components/OspLogo.vue';
import Path, { getPath } from '@/enum/Path';
import Guard from '@/components/guards/Guard';

export default {
  name: 'Mainpage',
  methods: { getPath },

  data () {
    return {
      dataStorage: dataStorageInstance,
      isReady: false,
      searchPhrase: ''
    };
  },

  components: {
    Guard,
    OspLogo,
    VerticalStack,
    Navbar,
    Feed
  },

  mounted () {
    if (this.dataStorage.isReady()) {
      this.isReady = true;
      return;
    }

    this.dataStorage.loadBasicData().then(() => {
      this.isReady = true;
    });
  },

  computed: {
    Path () {
      return Path;
    },

    filteredArticles () {
      const articles = this.dataStorage.articles
          .getDataAsArray()
          .sort((a, b) => b.created_at >= a.created_at);

      if (this.searchPhrase === '') {
        return articles;
      }

      const searchTermLower = this.searchPhrase.toLowerCase();

      return articles.filter((article) => {
        const isTitleMatch = article.title.toLowerCase().includes(searchTermLower);
        const isTagMatch = article.tags.filter((tag) => tag.name.toLowerCase().includes(searchTermLower)).length > 0;

        return isTitleMatch || isTagMatch;
      });
    }
  }
};
</script>
