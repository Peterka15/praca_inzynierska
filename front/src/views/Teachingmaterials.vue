<template>
<!--TODO:Research zrobić dodawanie materiałów-->
  <div>
    <navbar>
    </navbar>

    <div class="m_boxcenter m_boxcenterp shadow">
      <h3 class="m_boxfont">MATERIAŁY SZKOLENIOWE</h3>
    </div>

    <div class="center_box center_boxp shadow">
      <div class="addbutton addbuttonp">
        <b-button variant="primary" v-b-modal.my-modal>Dodaj nowy plik +</b-button>
        <b-modal id="my-modal">
          <h3>
            Dodaj nowy plik
          </h3>
          <b-form-file v-model="file2" class="mt-3" plain></b-form-file>
        </b-modal>
      </div>

      <div class="line"></div>

      <div class="table tablep">
        <b-table danger :items="items" :fields="fields" :tbody-tr-class="rowClass"></b-table>
      </div>
    </div>
  </div>


</template>

<style>
</style>

<script>
import './../style/style.css';
import Navbar from '/src/components/Navbar.vue';

export default {
  name: 'Mainpage',
  data() {
    return {
      file1: null,
      file2: null,
      fields: ['nazwa_pliku', 'data_dodania'],
      items: [
        {data_dodania: '19.05.2020', nazwa_pliku: 'Wytyczne dotyczące covid',},
        {data_dodania: '3.06.2021', nazwa_pliku: 'Pożary mieszkań',},
        {data_dodania: '7.02.2022', nazwa_pliku: 'Pytania KPP 2022',}
      ]
    }
  },

  components: {
    Navbar
  }
}

</script>