<template>

<!--TODO:Wykonać listę wyposażenia-->
  <!--TODO:Raporty wyposażenia -->
  <div>
    <navbar>
    </navbar>

    <div class="m_boxcenter m_boxcenterp shadow">
      <h3 class="m_boxfont">Wyposażenie jednostki</h3>
    </div>

    <div class="center_box center_boxp shadow">
      <div class="addbutton addbuttonp">
        <b-button variant="primary" v-b-modal.my-modal>Dodaj nowy sprzęt +</b-button>
        <b-modal id="my-modal">
          <h3>
            <div>
              <h3 >Dodaj sprzęt</h3>
              <div class="logininput">
                <b-form inline>
                  <b-form-checkbox v-model="isInStock">
                    Na stanie
                  </b-form-checkbox>
                </b-form>
              </div>
              <div class="logininput">
                <b-form inline>
                  <b-form-checkbox v-model="isActive">
                    Czy działa
                  </b-form-checkbox>
                </b-form>
              </div>
              <div class="logininput">
                <b-form inline>
                  <label class="sr-only">Nazwa sprzętu</label>
                  <b-form-input
                      id="inline-form-input-name"
                      v-model="name"
                      placeholder="Nazwa sprzętu"
                  ></b-form-input>
                </b-form>
              </div>
              <div class="logininput">
                <b-form inline>
                  <label class="sr-only">Ilość</label>
                  <b-form-input
                      id="inline-form-input-name"
                      v-model="amount"
                      placeholder="ilość"
                  ></b-form-input>
                </b-form>
              </div>
              <div class="logininput">
                <b-form inline>
                  <label for="unit" class="sr-only">Kategoria przedmiotu</label>
                  <b-form-select
                      id="unit"
                      v-model="selectedCategory"
                      :options="category"
                      placeholder="Wybór kategorii"
                  ></b-form-select>
                </b-form>
              </div>
              <div class="logininput">
                <b-form inline>
                  <label for="unit" class="sr-only">Jednostka OSP</label>
                  <b-form-select
                      id="unit"
                      v-model="selectedUnit"
                      :options="units"
                      placeholder="Wybór jednostki"
                  ></b-form-select>
                </b-form>
              </div>
              <div class="logininput">
                <b-button v-b-modal.modal-1 @click="addItem()">Dodaj</b-button>
              </div>
            </div>
          </h3>
        </b-modal>
      </div>

      <div class="line"><h2 style="color: white;">Lista sprzętu</h2></div>

      <div>
      <b-table  style="margin: -209px; position: absolute;top: 39%;left: 17%;width: 98%; --bs-table-hover-color: yellow;background: rgba(161, 32, 58, 0.6);" striped hover :items="equipment" :fields="fields" @sort-changed="onSortChange ">
        <template #cell(edit)="row">
          <b-button @click="editUser(row.item)">Edytuj</b-button>
        </template>
      </b-table>
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
      name: '',
      selectedUnit: null,
      selectedCategory: null,
      isActive: false,
      isInStock: false,
      isCommander: false,
      canEditEquipment: false,
      canEditMembers: false,
      isModerator: false,
      units: [
        { value: null, text: 'Proszę przypisać jednostkę' },
        { value: 'Pszów', text: 'Pszów' },
        { value: 'Krzyżkowice', text: 'Krzyżkowice' },
        { value: 'Zawada', text: 'Zawada' },
        { value: 'Rogów', text: 'Rogów' }
      ],
      category: [
        { value: null, text: 'Proszę przypisać kategorię' },
        { value: 'Pojazd', text: 'Pojazd' },
        { value: 'Sprzęt osobisty', text: 'Sprzęt osobisty' },
        { value: 'Sprzęt medyczny', text: 'Sprzęt medyczny' },
        { value: 'Sprzęt wysokościowy', text: 'Sprzęt wysokościowy' },
        { value: 'Sprzęt burzący', text: 'Sprzęt burzący' },
        { value: 'Sprzęt gaśniczy', text: 'Sprzęt burzący' }
      ],
      error: null,
      equipment: [
        {
          isActive: true,
          isInStock: true,
          name: 'Wąż strażacki W-52',
          amount: 10,
          unit: 'Pszów',
          category: 'Sprzęt gaśniczy'
        },
        {
          isActive: true,
          isInStock: true,
          name: 'Łom "Huligan"',
          amount: 5,
          unit: 'Krzyżkowice',
          category: 'Sprzęt medyczny'
        },
        {
          isActive: false,
          isInStock: true,
          name: 'Hełm Bojowy',
          amount: 8,
          unit: 'Zawada',
          category: 'Sprzęt osobisty'
        },
        {
          isActive: true,
          isInStock: true,
          name: 'Prądownica',
          amount: 3,
          unit: 'Rogów',
          category: 'Sprzęt gaśniczy'
        },
        {
          isActive: true,
          isInStock: true,
          name: 'Torba PSP-R1',
          amount: 2,
          unit: 'Pszów',
          category: 'Sprzęt medyczny'
        }
      ],

      fields: [
      { key: 'isActive', label: 'Aktywny', sortable: true },
        { key: 'isInStock', label: 'Aktywny', sortable: true },
      { key: 'name', label: 'Nazwa sprzętu', sortable: true },
      { key: 'amount', label: 'Ilość', sortable: true },
      { key: 'unit', label: 'Jednostka', sortable: true },
      { key: 'category', label: 'Kategoria', sortable: true },
      { key: 'edit', label: 'Edytuj', sortable: false }
      ]
    };
  },

  components: {
    Navbar
  },

}

</script>