<template>
  <div class="fixed-top">
    <b-navbar type="dark" variant="dark" class="justify-content-between">
      <b-navbar-nav>
        <b-nav-item :to="{ path: '/'}">Strona Główna</b-nav-item>

        <template v-if="tags.length <= 5">
          <b-nav-item v-for="tag in tags" :key="tag.id" href="#">{{ tag.name }}</b-nav-item>
        </template>
        <b-nav-item-dropdown v-else text="Kategorie Artykułów" right>
          <b-dropdown-item v-for="tag in tags" :key="tag.id" href="#">{{ tag.name }}</b-dropdown-item>
        </b-nav-item-dropdown>


        <b-nav-item v-if="auth.loggedIn && (auth.user.role.isAdmin() || auth.user.role.isModerator())"
                    :to="{ path: '/addarticle'}">Nowy artykuł
        </b-nav-item>
        <b-nav-item v-if="auth.loggedIn"
                    :to="{ path: '/materials'}">Materiały szkoleniowe
        </b-nav-item>

      </b-navbar-nav>
      <b-navbar-nav class="ml-auto">
        <b-nav-item :to="{ path: '/login'}" v-if="!username">Zaloguj</b-nav-item>
        <b-nav-item v-if="username" @click="logOut()">Wyloguj</b-nav-item>
        <b-nav-item v-if="username">{{ username }}</b-nav-item>
      </b-navbar-nav>
    </b-navbar>
  </div>
</template>

<script>
import auth from '@/Model/AuthInstance';
import dataStorage from '@/Data/DataStorageInstance';

export default {
  name: 'Navbar',
  data () {
    return {
      isSessionRestored: false,
      auth,
      tags: dataStorage.tags.data
    };
  },

  mounted () {
    auth.restoreSession(resolved => {
      if (resolved) {
        this.isSessionRestored = true;
      }
    });
  },

  computed: {
    username () {
      // This will recompute whenever isSessionRestored changes
      if (this.isSessionRestored && auth.user != null) {
        return auth.user.name;
      } else {
        return null;
      }
    }
  },

  methods: {
    logOut () {
      auth.logout();
      this.$router.push({ path: '/' });
      window.location.reload();
    }
  }
};
</script>
