<template>
  <b-col cols="3" class="panel">
    <h1 class="logo">
      <router-link to="/"> OSP LATARNIA <span>GNIEZNO <b-img
          src="http://localhost:8000/logo.png" fluid
          alt="Fluid image"></b-img></span></router-link>
    </h1>
    <div class="nav-wrap">
      <nav class="main-nav" role="navigation">
        <ul class="unstyled list-hover-slide">
          <li>
            <a @click="showSearchForm = true" style="color: #DFDBD9">Wyszukaj</a>
            <div v-if="showSearchForm">
              <form @submit.prevent="submitSearch">
                <a> <input type="text" v-model="searchPhrase" placeholder="Nazwa artykułu..."></a>
                <b-button type="submit" style="margin: 7px">Szukaj</b-button>
              </form>
            </div>
          </li>
          <li>
            <router-link to="/addarticle">Dodaj artykuł</router-link>
          </li>
          <li>
            <router-link to="/materials">Materiały szkoleniowe</router-link>
          </li>
          <li>
            <a href="#">Tagi</a>
<!--            TODO: Dodać obsługę tagów-->
          </li>
        </ul>
      </nav>
    </div>
  </b-col>
</template>

<script>
export default {
  name: 'Sidebar',

  data(){
    return{
      showSearchForm: false,
      searchPhrase: ''
    }
  },
  // TODO: Dodać wyszukiwanie nazw
  methods: {
    submitSearch() {
      this.$emit("submitSearch", this.searchPhrase);
      console.log('Wyszukiwanie:', this.searchPhrase);

      // this.searchQuery = '';
      // this.showSearchForm = false;
    },
  }
}
</script>
