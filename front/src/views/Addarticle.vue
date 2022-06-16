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

    <div class="m_boxcenter m_boxcenterp shadow">
      <h3 class="m_boxfont">Nowy artykuł</h3>
    </div>
    <div class="workspace workspacep">
      <b-container>
        <b-row>
          <b-col cols="6">
            <div style="background: white">
              <vue-editor v-model="content"/>
            </div>
          </b-col>
          <b-col cols="6">
            <div class="name_form">
              <input class="name_formp" type="text" id="fname" name="fname" placeholder="Nazwa artykułu"><br>
            </div>
            <div class="addphotos">
              <b-button variant="primary" v-b-modal.photo-modal>Dodaj zdjęcia +</b-button>
              <b-modal id="photo-modal">
                <h3>
                  Wybierz zdjęcia do dodania
                </h3>
                <b-form-file v-model="file2" class="mt-3" plain></b-form-file>
              </b-modal>
            </div>
            <div class="addphotos">
              <b-button variant="primary" v-b-modal.tag-modal>Dodaj tagi +</b-button>
              <b-modal id="tag-modal">
                <h3>
                  Wybierz tagi, maksymalnie 3
                </h3>
                  <b-form-select v-model="selected" :options="options"></b-form-select>
                  <b-form-select v-model="selected2" :options="options"></b-form-select>
                  <b-form-select v-model="selected3" :options="options"></b-form-select>
                  <div class="mt-3">Wybrano: <strong>{{ selected}} {{selected2}} {{selected3}}</strong></div>
              </b-modal>
            </div>

            <div class="add_article_button">
              <b-button style="background: #A1203A">Dodaj Artykuł</b-button>
            </div>


          </b-col>
        </b-row>
      </b-container>

    </div>


  </div>
</template>

<script>
import './../style/style.css';
import {VueEditor} from "vue2-editor";

export default {
  name: 'Mainpage',
  components: {VueEditor},

  data() {
      return {
        selected: null,
        selected2: null,
        selected3: null,
        options: [
          { value: null, text: 'Wybierz tag' },
          { value: 'a', text: 'Pożar' },
          { value: 'b', text: 'Wypadek' },
          { value: 'c', text: 'Zabezpieczenie' },
        ],
        options2: [
          { value: null, text: 'Wybierz tag' },
          { value: 'a', text: 'Pożar' },
          { value: 'b', text: 'Wypadek' },
          { value: 'c', text: 'Zabezpieczenie' },
        ],
        options3: [
          { value: null, text: 'Wybierz tag' },
          { value: 'a', text: 'Pożar' },
          { value: 'b', text: 'Wypadek' },
          { value: 'c', text: 'Zabezpieczenie' },
        ]
      }
    }




}
</script>