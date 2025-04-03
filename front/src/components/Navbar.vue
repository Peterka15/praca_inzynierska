<template>
  <div>
    <div class="fixed-top" style="height: 4em">
      <b-navbar type="dark" style="background-color: #003a57" class="justify-content-between h-100">
        <b-navbar-nav class="font-weight-bold">
          <b-nav-item :to="getPath(Path.home)">Strona Główna</b-nav-item>

          <b-nav-item :to="getPath(Path.management)">
            Zarząd OSP
          </b-nav-item>

          <LoggedInOnly>
            <b-nav-item :to="getPath(Path.materials)">Materiały szkoleniowe</b-nav-item>
            <b-nav-item :to="getPath(Path.inventory)">Lista sprzętu</b-nav-item>
          </LoggedInOnly>

          <AdminOnly>
            <b-nav-item :to="getPath(Path.users)">Lista użytkowników</b-nav-item>
            <b-nav-item :to="getPath(Path.addArticle)">Nowy artykuł</b-nav-item>
          </AdminOnly>
        </b-navbar-nav>
        
        <b-navbar-nav class="ml-auto">
          <NotLoggedInOnly>
            <b-nav-item :to="getPath(Path.login)">Zaloguj</b-nav-item>
          </NotLoggedInOnly>
          <LoggedInOnly>
            <b-nav-item @click="logOut()">Wyloguj</b-nav-item>
            <b-nav-item>{{ auth?.user?.name ?? '' }}</b-nav-item>
          </LoggedInOnly>
        </b-navbar-nav>
      </b-navbar>
    </div>
    <div style="height: 4em"></div>
  </div>
</template>

<script>
import auth from '@/Model/AuthInstance';
import dataStorage from '@/Data/DataStorageInstance';
import LoggedInOnly from '@/components/guards/LoggedInOnly';
import AdminOnly from '@/components/guards/AdminOnly';
import NotLoggedInOnly from '@/components/guards/NotLoggedInOnly';
import Path, {getPath} from '@/enum/Path';

export default {
  name: 'Navbar',
  components: {NotLoggedInOnly, AdminOnly, LoggedInOnly},
  data() {
    return {
      updateTick: 0,

      auth,
      dataStorage
    };
  },

  mounted() {
    auth.restoreSession(() => this.forceUpdate());
  },

  computed: {
    Path() {
      return Path
    },
  },

  methods: {
    getPath,
    
    logOut() {
      auth.logout();
      this.$router.push({path: getPath(Path.home)});
      this.forceUpdate();
    },
    
    forceUpdate() {
      this.updateTick++;
    }
  },
};
</script>
