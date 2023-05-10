<template>
  <b-col cols="2" class="panel">
    <h1 class="logo">
      <router-link to="/"> OSP LATARNIA <span>GNIEZNO <b-img
          src="http://localhost:8000/logo.png" fluid
          alt="Fluid image"></b-img></span></router-link>
    </h1>
    <div class="nav-wrap">
      <nav class="main-nav" role="navigation">
        <ul class="unstyled list-hover-slide">
          <li>
            <router-link to="/login">Logowanie</router-link>
          </li>
          <!--      <li>-->
          <!--        <router-link to="/article/1">Artykuł 1</router-link>-->
          <!--      </li>-->
          <!--      <li>-->
          <!--        <router-link to="/article/2">Artykuł 2</router-link>-->
          <!--      </li>-->
          <!--      <li>-->
          <!--        <router-link to="/article/3">Artykuł 3</router-link>-->
          <!--      </li>-->
          <li>
            <a href="#">Wyszukaj</a>
          </li>
          <li>
            <router-link to="/addarticle">Dodaj artykuł</router-link>
          </li>
          <li>
            <router-link to="/materials">Materiały szkoleniowe</router-link>
          </li>
          <li><a href="#">Tagi</a></li>
          <li><a href="#">Wyloguj</a></li>
        </ul>
      </nav>
    </div>
  </b-col>
</template>

<script>
export default {
  name: 'PanelBar'
}
</script>
