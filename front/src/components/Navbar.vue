<template>
<div class="fixed-top">
<b-navbar type="dark" variant="dark" class="justify-content-between">
  <b-navbar-nav>
    <b-nav-item :to="{ path: '/'}">Strona Główna</b-nav-item>

    <!-- Navbar dropdowns -->
    <b-nav-item-dropdown text="Kategorie Artykułów" right>
      <b-dropdown-item href="#">Pożar</b-dropdown-item>
      <b-dropdown-item href="#">Wypadek</b-dropdown-item>
      <b-dropdown-item href="#">Jubileusz</b-dropdown-item>
      <b-dropdown-item href="#">Zabezpieczenie</b-dropdown-item>
    </b-nav-item-dropdown>

    <b-nav-item v-if="loggedIn" :to="{ path: '/addarticle'}">Nowy artykuł</b-nav-item>
    <b-nav-item v-if="loggedIn" :to="{ path: '/materials'}">Materiały szkoleniowe</b-nav-item>

  </b-navbar-nav>
  <b-navbar-nav class="ml-auto">
    <b-nav-item :to="{ path: '/login'}" v-if="!username">Zaloguj</b-nav-item>
    <b-nav-item v-if="username" @click="logOut()">Wyloguj</b-nav-item>
    <b-nav-item v-if="username">{{username}}</b-nav-item>
  </b-navbar-nav>
</b-navbar>
</div>
</template>

<script>
import auth from "@/Model/AuthInstance";
export default {
  name: 'Navbar',
  data() {
    return {
      isSessionRestored: false,
    };
  },

  mounted() {
    auth.restoreSession(resolved => {
      console.log(resolved, auth.user);
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
    },

    loggedIn() {
      return auth.loggedIn;
    },
  },

  methods: {
    logOut() {
      auth.logout();
      this.$router.push({ path: '/' });
      window.location.reload();
    }
  }
}
</script>
