<template>
  <div>
    <div class="fixed-top">
      <b-navbar type="dark" variant="dark">
        <b-navbar-nav>
          <b-nav-item href="#">Strona Główna</b-nav-item>

          <!-- Navbar dropdowns -->
          <b-nav-item-dropdown text="Kategorie Artykułów" right>
            <b-dropdown-item href="#">Pożar</b-dropdown-item>
            <b-dropdown-item href="#">Wypadek</b-dropdown-item>
            <b-dropdown-item href="#">Jubileusz</b-dropdown-item>
            <b-dropdown-item href="#">Zabezpieczenie</b-dropdown-item>
          </b-nav-item-dropdown>

          <b-nav-item-dropdown text="Użytkownik" right>
            <b-dropdown-item
                href="https://useme.com/static/images/avatar/empty-neutral.svg?1626173373"></b-dropdown-item>
          </b-nav-item-dropdown>

          <b-nav-item href="#">Nowy artykuł</b-nav-item>
          <b-nav-item href="#">Materiały szkoleniowe</b-nav-item>
        </b-navbar-nav>
      </b-navbar>
    </div>

  <div class="center centerp shadow">
    <div>
      <h3 class="left_column">OSP LATARNIA GNIEZNO</h3>
    </div>
    <div>
      <div class="logininput">
      <b-form inline>
        <label class="sr-only" >E-mail</label>
        <b-form-input
            id="inline-form-input-name"
            class="mb-2 mr-sm-2 mb-sm-0"
            placeholder="E-mail"
        ></b-form-input>
      </b-form>
      </div>
      <div class="logininput">
      <b-form inline>
        <label class="sr-only" >Hasło</label>
        <b-input-group class="mb-2 mr-sm-2 mb-sm-0">
          <b-form-input id="inline-form-input-username" placeholder="Hasło"></b-form-input>
        </b-input-group>
      </b-form>
        <div class="logininput">
        <b-button variant="primary">Zaloguj</b-button>
        </div>
      </div>
    </div>

  </div>
  </div>
</template>

<style>
</style>

<script>
import './../style/style.css';

export default {
  name: 'Mainpage',
}

</script>