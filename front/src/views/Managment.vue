<template>
  <div>
    <navbar></navbar>

    <div class="m_boxcenter m_boxcenterp shadow">
      <h3 class="m_boxfont">Lista członków zarządu OSP</h3>
    </div>

    <div class="center_box center_boxp shadow">
      <div class="addbutton addbuttonp">
        <b-button variant="primary" v-b-modal.my-modal>Dodaj członka zarządu +</b-button>
        <b-modal id="my-modal">
          <h3>
            <div>
              <h3>Dodaj członka zarządu</h3>
              <div class="logininput">
                <b-form inline>
                  <label class="sr-only">Imię i nazwisko</label>
                  <b-form-input
                      id="inline-form-input-name"
                      v-model="name"
                      placeholder="imię"
                  ></b-form-input>
                </b-form>
              </div>
              <div class="logininput">
                <b-form inline>
                  <label class="sr-only">E-mail</label>
                  <b-form-input
                      id="inline-form-input-email"
                      v-model="email"
                      placeholder="E-mail"
                  ></b-form-input>
                </b-form>
              </div>
              <div class="logininput">
                <b-form inline>
                  <label for="position" class="sr-only">Pełniona funkcja</label>
                  <b-form-select
                      id="position"
                      v-model="selectedPosition"
                      :options="position"
                      placeholder="Proszę przypisać funkcję"
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
                      placeholder="Proszę przypisać jednostkę"
                  ></b-form-select>
                </b-form>
              </div>
              <div class="logininput">
                <b-button @click="addItem">Dodaj</b-button>
              </div>
            </div>
          </h3>
        </b-modal>
      </div>

      <div class="line"><h2 style="color: white;">Lista członków zarządu</h2></div>

      <div>
        <b-table  style="margin: -209px; position: absolute;top: 39%;left: 17%;width: 98%; --bs-table-hover-color: yellow;background: rgba(161, 32, 58, 0.6);" striped hover :items="users" :fields="fields" @sort-changed="onSortChange ">
          <template #cell(edit)="row">
            <b-button @click="editUser(row.item)">Edytuj</b-button>
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
      email: '',
      selectedUnit: null,
      selectedPosition: null,
      users: [
        {
          name: 'Adam Nowak',
          position: 'Prezes',
          email: 'adam.nowak@onet.pl',
          unit: 'Pszów',
        },
        {
          name: 'Jan Kowalski',
          position: 'Prezes',
          email: 'jan.kowalski@example.com',
          unit: 'Krzyżkowice',
        },
        {
          name: 'Piotr Wiśniewski',
          position: 'Naczelnik',
          email: 'piotr.wisniewski@example.com',
          unit: 'Pszów',
        },
        {
          name: 'Katarzyna Zielińska',
          position: 'Sekretarz',
          email: 'katarzyna.zielinska@example.com',
          unit: 'Rogów',
        },
        {
          name: 'Marek Lewandowski',
          position: 'Członek zarządu',
          email: 'marek.lewandowski@example.com',
          unit: 'Zawada',
        },
      ],
      units: [
        { value: null, text: 'Proszę przypisać jednostkę' },
        { value: 'Pszów', text: 'Pszów' },
        { value: 'Krzyżkowice', text: 'Krzyżkowice' },
        { value: 'Zawada', text: 'Zawada' },
        { value: 'Rogów', text: 'Rogów' }
      ],
      position: [
        { value: null, text: 'Proszę przypisać funkcję' },
        { value: 'Prezes', text: 'Prezes' },
        { value: 'Wiceprezes', text: 'Wiceprezes' },
        { value: 'Naczelnik', text: 'Naczelnik' },
        { value: 'Sekretarz', text: 'Sekretarz' },
        { value: 'Skarbnik', text: 'Skarbnik' },
        { value: 'Gospodarz', text: 'Gospodarz' },
        { value: 'Członek zarządu', text: 'Członek zarządu' },
        { value: 'Zastępca naczelnika', text: 'Zastępca naczelnika' }
      ],
      fields: [
        { key: 'name', label: 'Imię i nazwisko', sortable: true },
        { key: 'position', label: 'Pełniona funkcja', sortable: true },
        { key: 'unit', label: 'Jednostka', sortable: true },
        { key: 'email', label: 'E-mail', sortable: true },
        { key: 'edit', label: 'Edytuj', sortable: false }
      ]
    };
  },
  components: {
    Navbar
  },
  methods: {
    generatePDF() {
      const docDefinition = {
        content: [
          { text: 'Lista Członków Zarządu', style: 'header' },
          {
            table: {
              headerRows: 1,
              widths: ['auto', '*', '*', 'auto'],
              body: [
                [
                  { text: 'Imię i nazwisko', style: 'tableHeader' },
                  { text: 'Pełniona funkcja', style: 'tableHeader' },
                  { text: 'Jednostka', style: 'tableHeader' },
                  { text: 'E-mail', style: 'tableHeader' }
                ],
                ...this.users.map(user => [
                  user.name,
                  user.position,
                  user.unit,
                  user.email
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

      pdfMake.createPdf(docDefinition).download('zarzad_osp.pdf');
    },
    addItem() {
      if (this.name && this.email && this.selectedUnit && this.selectedPosition) {
        this.users.push({
          name: this.name,
          email: this.email,
          unit: this.selectedUnit,
          position: this.selectedPosition
        });
        this.name = '';
        this.email = '';
        this.selectedUnit = null;
        this.selectedPosition = null;
      }
    },
    editUser(item) {
      // Funkcja edytowania użytkownika
      console.log(item);
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
