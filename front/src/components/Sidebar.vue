<template>
  <VerticalStack wideGaps>
    <div class="d-flex flex-column align-items-center">
      <div class="card-logo-bg" style="background-image: url('/media/logo.webp')"></div>

      <h1 class="logo mt-4 p-0">
        <router-link to="/" class="m-0 p-0">
          <span v-if="!auth.loggedIn">POWIATOWY SYSTEM OSP</span>
          <span v-else>{{ auth.user.unit.name }}</span>
        </router-link>
      </h1>
    </div>

    <b-card title="Szukaj">
      <b-form-group label-for="input-search" label="Wyszukaj artykułów lub tagów">
        <b-form-input
            id="input-search"
            v-model="inputValue"
            type="text"
            placeholder="Akcja gaśnicza"
        ></b-form-input>
      </b-form-group>
    </b-card>

    <AdminOnly>
      <b-card title="Administracja">
        <VerticalStack>
          <p class="m-0">Tu znajdziesz listę skrótów do funkcji administracyjnych.</p>
          <b-button variant="secondary" class="w-100" :to="getPath(Path.addArticle)">
            Dodaj nowy artykuł
          </b-button>
          <b-button variant="secondary" class="w-100" :to="getPath(Path.users)">
            Dodaj użytkownika
          </b-button>
        </VerticalStack>
      </b-card>
    </AdminOnly>
  </VerticalStack>
</template>

<script>
import auth from '@/Model/AuthInstance';
import VerticalStack from '@/components/ui/VerticalStack.vue';
import AdminOnly from '@/components/guards/AdminOnly';
import Path, {getPath} from '@/enum/Path';

export default {
  name: 'Sidebar',
  methods: {getPath},
  components: {AdminOnly, VerticalStack},

  model: {
    prop: 'modelValue',
    event: 'update:modelValue'
  },

  data() {
    return {
      auth
    }
  },

  props: {
    modelValue: String
  },

  computed: {
    Path() {
      return Path
    },
    inputValue: {
      get() {
        return this.modelValue
      },
      set(value) {
        this.$emit('update:modelValue', value)
      }
    }
  }
}
</script>
