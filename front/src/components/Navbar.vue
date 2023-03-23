<template>
<div class="fixed-top">
<b-navbar type="dark" variant="dark">
  <b-navbar-nav>
    <b-nav-item :to="{ path: '/'}">Strona Główna</b-nav-item>

    <!-- Navbar dropdowns -->
    <b-nav-item-dropdown text="Kategorie Artykułów" right>
      <b-dropdown-item href="#">Pożar</b-dropdown-item>
      <b-dropdown-item href="#">Wypadek</b-dropdown-item>
      <b-dropdown-item href="#">Jubileusz</b-dropdown-item>
      <b-dropdown-item href="#">Zabezpieczenie</b-dropdown-item>
    </b-nav-item-dropdown>

    <!-- TODO: ZRÓB MNIE Z TEGO ROUTING JAK W LINII 5 -->
    <b-nav-item href="http://localhost:8080/addarticle">Nowy artykuł</b-nav-item>
    <b-nav-item href="http://localhost:8080/materials">Materiały szkoleniowe</b-nav-item>
  </b-navbar-nav>
</b-navbar>
</div>
</template>

<script>
export default {
  name: 'Navbar'
}
</script>
