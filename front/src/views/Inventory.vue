<template>
  <div>
    <navbar>
    </navbar>

    <div class="m_boxcenter m_boxcenterp shadow">
      <h3 class="m_boxfont">Wyposażenie jednostki</h3>
    </div>

    <div class="center_box center_boxp shadow">
      <div class="addbutton addbuttonp" >
        <b-button variant="primary" v-b-modal.my-modal >Dodaj nowy sprzęt +</b-button>
        <b-form-input
            v-model="searchQuery"
            placeholder="Wyszukaj sprzęt..."
            class="mb-3"
            style="margin: 10px"
        ></b-form-input>
        <b-modal id="my-modal">
          <h3>
            <div>
              <h3 >Dodaj sprzęt</h3>
              <div class="logininput">
                <b-form inline> Czy sprzęt jest dostępny?
                  <b-form-checkbox v-model="isInStock">
                     Dostępny
                  </b-form-checkbox>
                </b-form>
              </div>
              <div class="logininput">
                <b-form inline> Podaj nazwę sprzętu
                  <label class="sr-only">Nazwa sprzętu</label>
                  <b-form-input
                      id="inline-form-input-name"
                      v-model="name"
                      placeholder="Nazwa sprzętu"
                  ></b-form-input>
                </b-form>
              </div>
              <div class="logininput"> Podaj ilość
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
                <b-form inline> Wybierz kategorię
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
                <b-form inline> Przypisz jednostkę
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
        <b-table
            style="margin: -209px; position: absolute;top: 39%;left: 17%;width: 98%; --bs-table-hover-color: yellow;background: rgba(161, 32, 58, 0.6);"
            striped hover
            :items="filteredEquipment"
            :fields="fields"
            @sort-changed="onSortChange"
        >
          <template #cell(edit)="row">
            <b-button @click="editUser(row.item)">Edytuj</b-button>
          </template>

          <template #cell(isInStock)="row">
      <span :style="row.item.isInStock === 'nie' ? { color: 'red' } : {}">
        {{ row.item.isInStock }}
      </span>
          </template>
        </b-table>
      </div>

      <!-- Przycisk generujący PDF -->
      <div class="export-button">
        <b-button variant="success" @click="generatePDF">Generuj PDF</b-button>
      </div>
    </div>
  </div>
</template>

<script>
import pdfMake from 'pdfmake/build/pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
import Navbar from "@/components/Navbar.vue";

pdfMake.vfs = pdfFonts.pdfMake.vfs;

export default {
  name: 'Mainpage',
  data() {
    return {

      name: '',
      selectedUnit: null,
      selectedCategory: null,
      isInStock: false,
      searchQuery: '',
      units: [
        { value: 'Pszów', text: 'Pszów' },
        { value: 'Krzyżkowice', text: 'Krzyżkowice' },
        { value: 'Zawada', text: 'Zawada' },
        { value: 'Rogów', text: 'Rogów' }
      ],
      category: [
        { value: 'Pojazd', text: 'Pojazd' },
        { value: 'Sprzęt osobisty', text: 'Sprzęt osobisty' },
        { value: 'Sprzęt medyczny', text: 'Sprzęt medyczny' },
        { value: 'Sprzęt wysokościowy', text: 'Sprzęt wysokościowy' },
        { value: 'Sprzęt burzący', text: 'Sprzęt burzący' },
        { value: 'Sprzęt gaśniczy', text: 'Sprzęt burzący' }
      ],
      equipment: [
        {
          isInStock: 'tak',
          name: 'Wąż strażacki W-52',
          amount: 10,
          unit: 'Pszów',
          category: 'Sprzęt gaśniczy'
        },
        {
          isInStock: 'tak',
          name: 'Łom "Huligan"',
          amount: 5,
          unit: 'Krzyżkowice',
          category: 'Sprzęt medyczny'
        },
        {
          isInStock: 'nie',
          name: 'Hełm Bojowy',
          amount: 8,
          unit: 'Zawada',
          category: 'Sprzęt osobisty'
        },
        {
          isInStock: 'tak',
          name: 'Prądownica',
          amount: 3,
          unit: 'Rogów',
          category: 'Sprzęt gaśniczy'
        },
        {
          isInStock: 'tak',
          name: 'Torba PSP-R1',
          amount: 2,
          unit: 'Pszów',
          category: 'Sprzęt medyczny'
        }
      ],
      fields: [
        { key: 'isInStock', label: 'Dostępny', sortable: true },
        { key: 'name', label: 'Nazwa sprzętu', sortable: true },
        { key: 'amount', label: 'Ilość', sortable: true },
        { key: 'unit', label: 'Jednostka', sortable: true },
        { key: 'category', label: 'Kategoria', sortable: true },
        { key: 'edit', label: '', sortable: false }
      ]

    };
  },
  components: {
    Navbar
  },
  computed: {
    filteredEquipment() {
      return this.equipment.filter(item => {
        const query = this.searchQuery.toLowerCase();
        return (
            item.isInStock.toLowerCase().includes(query) ||
            item.name.toLowerCase().includes(query) ||
            item.unit.toLowerCase().includes(query) ||
            item.category.toLowerCase().includes(query)
        );
      });
    }
  },
  methods: {
    generatePDF() {
      const docDefinition = {
        content: [
          { text: 'Lista Wyposażenia', style: 'header' },
          {
            table: {
              headerRows: 1,
              widths: ['*', '*', '*', '*', '*'],
              body: [
                ['Na stanie', 'Nazwa sprzętu', 'Ilość', 'Jednostka', 'Kategoria'],
                ...this.equipment.map(item => [
                  item.isInStock ? 'Tak' : 'Nie',
                  item.name,
                  item.amount,
                  item.unit,
                  item.category
                ])
              ]
            }
          }
        ],
        styles: {
          header: {
            fontSize: 18,
            bold: true,
            margin: [0, 0, 0, 10]
          },
          tableHeader: {
            bold: true,
            fontSize: 13,
            color: 'black'
          }
        }
      };

      pdfMake.createPdf(docDefinition).download('equipment.pdf');
    },
    addItem() {
      // Funkcja dodawania sprzętu
    },
    editUser() {
      // Funkcja edytowania użytkownika
    },
    onSortChange() {
      // Funkcja obsługi sortowania tabeli
    }
  }
};
</script>

<style>
/* Dodaj odpowiednie style */
.export-button {
  margin-top: 20px;
  text-align: right;
  padding-right: 15px;
}


</style>
