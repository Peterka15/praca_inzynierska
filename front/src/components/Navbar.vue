<template>
  <div>
    <div class="fixed-top" style="height: 4em">
      <b-navbar type="dark" style="background-color: #003a57" class="justify-content-between h-100">
        <b-navbar-nav class="font-weight-bold">
          <b-nav-item :to="getPath(Path.home)">Strona Główna</b-nav-item>

          <b-nav-item :to="getPath(Path.management)">
            Zarząd OSP
          </b-nav-item>

          <Guard loggedIn>
            <b-nav-item :to="getPath(Path.materials)">Materiały szkoleniowe</b-nav-item>
            <b-nav-item :to="getPath(Path.inventory)">Lista sprzętu</b-nav-item>
          </Guard>

          <Guard admin>
            <b-nav-item :to="getPath(Path.users)">Lista użytkowników</b-nav-item>
            <b-nav-item :to="getPath(Path.addArticle)">Nowy artykuł</b-nav-item>
          </Guard>
        </b-navbar-nav>

        <b-navbar-nav class="ml-auto">
          <Guard notLoggedIn>
            <b-nav-item :to="getPath(Path.login)">Zaloguj</b-nav-item>
          </Guard>
          <Guard loggedIn>
            <b-nav-item @click="logOut()">Wyloguj</b-nav-item>
            <b-nav-item>{{ auth?.user?.name ?? '' }}</b-nav-item>
          </Guard>
        </b-navbar-nav>
      </b-navbar>
    </div>
    <div style="height: 4em"></div>
  </div>
</template>

<script>
import auth from '@/Model/AuthInstance';
import dataStorage from '@/Data/DataStorageInstance';
import Path, { getPath } from '@/enum/Path';
import Guard from '@/components/guards/Guard';

export default {
  name: 'Navbar',
  components: {
    Guard
  },
  data () {
    return {
      updateTick: 0,

      auth,
      dataStorage
    };
  },

  mounted () {
    auth.restoreSession(() => this.forceUpdate());
  },

  computed: {
    Path () {
      return Path;
    }
  },

  methods: {
    getPath,

    logOut () {
      auth.logout();
      this.$router.push({ path: getPath(Path.home) });
      this.forceUpdate();
    },

    forceUpdate () {
      this.updateTick++;
    }
  }
};
</script>
