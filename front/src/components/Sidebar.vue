<template>
  <div>
    <h1 class="logo">
      <router-link to="/">
        <span v-if="!auth.loggedIn">POWIATOWY SYSTEM OSP</span>
        <span v-else>{{ auth.user.unit.name }}</span>
      </router-link>
    </h1>

    <b-card title="Szukaj..." sub-title="Wyszukaj artykuły lub tagi">
      <b-form-input
          v-model="inputValue"
          type="text"
          placeholder="Akcja gaśnicza"
      ></b-form-input>
    </b-card>
  </div>
</template>

<script>
import auth from '@/Model/AuthInstance';
import dataStorage from '@/Data/DataStorageInstance';

export default {
  name: 'Sidebar',

  model: {
    prop: 'modelValue',
    event: 'update:modelValue'
  },
  
  data() {
    return {
      tags: dataStorage.tags.data,
      auth
    }
  },

  props: {
    modelValue: String
  },

  computed: {
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
