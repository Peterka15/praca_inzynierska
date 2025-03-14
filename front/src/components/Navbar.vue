<template>
  <div>
    <div class="fixed-top" style="height: 4em">
      <b-navbar type="dark" style="background-color: #003a57" class="justify-content-between h-100">
        <b-navbar-nav class="font-weight-bold">
          <b-nav-item :to="{ path: '/'}">Strona Główna</b-nav-item>

          <template v-if="dataStorage.tags.data.length <= 5 && !auth.loggedIn">
            <b-nav-item v-for="tag in dataStorage.tags.data" :key="'x' + tag.id" href="#">{{ tag.name }}</b-nav-item>
          </template>

          <b-nav-item-dropdown v-else text="Kategorie Artykułów" right>
            <b-dropdown-item v-for="tag in dataStorage.tags.data" :key="tag.id" href="#">{{
                tag.name
              }}
            </b-dropdown-item>
          </b-nav-item-dropdown>

          <b-nav-item
              v-if="auth.loggedIn && (auth.user.role.isAdmin() || auth.user.role.isModerator())"
              :to="{ path: '/addarticle'}"
          >
            Nowy artykuł
          </b-nav-item>
          <b-nav-item v-if="auth.loggedIn" :to="{ path: '/materials'}">
            Materiały szkoleniowe
          </b-nav-item>
          <b-nav-item v-if="auth.loggedIn && auth.user.role.isAdmin()" :to="{ path: '/users'}">
            Lista użytkowników
          </b-nav-item>
          <b-nav-item v-if="auth.loggedIn" :to="{ path: '/equipment'}">
            Lista sprzętu
          </b-nav-item>
          <b-nav-item :to="{ path: '/management'}">
            Zarząd
          </b-nav-item>

        </b-navbar-nav>
        <b-navbar-nav class="ml-auto">
          <b-nav-item :to="{ path: '/login'}" v-if="!username">Zaloguj</b-nav-item>
          <b-nav-item v-if="username" @click="logOut()">Wyloguj</b-nav-item>
          <b-nav-item v-if="username">{{ username }}</b-nav-item>
        </b-navbar-nav>
      </b-navbar>
    </div>
    <div style="height: 4em"></div>
  </div>
</template>

<script>
import auth from '@/Model/AuthInstance';
import dataStorage from '@/Data/DataStorageInstance';

export default {
  name: 'Navbar',
  data() {
    return {
      isSessionRestored: false,
      auth,
      dataStorage
    };
  },

  mounted() {
    auth.restoreSession(resolved => {
      if (resolved) {
        this.isSessionRestored = true;
      }
    });
  },

  computed: {
    username() {
      // This will recompute whenever isSessionRestored changes
      if (this.isSessionRestored && auth.user != null) {
        return auth.user.name;
      } else {
        return null;
      }
    }
  },

  methods: {
    logOut() {
      auth.logout();
      this.$router.push({path: '/'});
      window.location.reload();
    }
  }
};
</script>
