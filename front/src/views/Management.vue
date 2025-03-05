<template>
  <div>
    <b-button
        v-if="auth.loggedIn && auth.user.role.isAdmin()"
        variant="primary"
    >
      Dodaj członka zarządu +
    </b-button>

    <b-modal id="my-modal">
      <div>
        <h3>Dodaj członka zarządu</h3>
        <div class="logininput">
          <b-form inline> Podaj imię i nazwisko
            <label class="sr-only">Imię i nazwisko</label>
            <b-form-input
                id="inline-form-input-name"
                v-model="name"
                placeholder="Imię i nazwisko"
            ></b-form-input>
          </b-form>
        </div>
        <div class="logininput"> Przypisz funkcję
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
        <div class="logininput"> Wybierz jednostkę
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
    </b-modal>

    <b-card
        class="m-4"
        header-tag="header"
    >
      <template #header>
        <h3 class="mb-0 text-left">Lista członków zarządu</h3>
      </template>
      <b-container>
        <b-row>
          <b-col>
            <b-form-group label-for="filer-search" label="Wyszukaj członka zarządu">
              <b-form-input id="filer-search" v-model="searchQuery" placeholder="Wyszukaj członka zarządu..."/>
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="filer-position" label="Jednostka">
              <b-form-select id="filter-unit" v-model="selectedUnit" :options="units" placeholder="Wybierz jednostkę"/>
            </b-form-group>
          </b-col>
        </b-row>
      </b-container>

      <b-card-body>
        <b-table
            :items="filteredUsers"
            :fields="fields"
        >
          <template #cell(edit)="row">
            <b-button @click="editUser(row.item)">Edytuj</b-button>
          </template>
        </b-table>
      </b-card-body>
    </b-card>
  </div>
</template>

<script>
import Navbar from '@/components/Navbar.vue';
import dataStorage from '@/Data/DataStorageInstance';
import auth from '@/Model/AuthInstance';

export default {
  name: 'Mainpage',
  data () {
    return {
      auth,
      isReady: false,
      searchQuery: '',
      name: '',
      email: '',
      selectedUnit: null,
      selectedPosition: null,
      position: [
        {
          value: 'Prezes',
          text: 'Prezes'
        },
        {
          value: 'Wiceprezes',
          text: 'Wiceprezes'
        },
        {
          value: 'Naczelnik',
          text: 'Naczelnik'
        },
        {
          value: 'Sekretarz',
          text: 'Sekretarz'
        },
        {
          value: 'Skarbnik',
          text: 'Skarbnik'
        },
        {
          value: 'Gospodarz',
          text: 'Gospodarz'
        },
        {
          value: 'Członek zarządu',
          text: 'Członek zarządu'
        },
        {
          value: 'Zastępca naczelnika',
          text: 'Zastępca naczelnika'
        }
      ],
      fields: [
        {
          key: 'name',
          label: 'Imię i nazwisko',
          sortable: true
        },
        {
          key: 'position',
          label: 'Pełniona funkcja',
          sortable: true
        },
        {
          key: 'unit',
          label: 'Jednostka',
          sortable: true
        },
        {
          key: 'edit',
          label: 'Akcje',
          sortable: false
        }
      ]
    };
  },

  created () {
    Promise.all([
      dataStorage.managements.load(),
      dataStorage.units.load()
    ]).then(() => {
      this.isReady = true;
    });
  },

  computed: {
    filteredUsers () {
      const query = this.searchQuery.toLowerCase();

      return dataStorage.managements.data.filter(managementEntry => (
                  managementEntry.name.toLowerCase().includes(query) ||
                  managementEntry.function.toLowerCase().includes(query) ||
                  managementEntry.unit.name.toLowerCase().includes(query)
              )
          )
          .filter(managementEntry => this.selectedUnit === null || managementEntry.unit.id === this.selectedUnit)
          .map(managementEntry => ({
                name: managementEntry.name,
                position: managementEntry.function,
                unit: managementEntry.unit.name
              })
          );
    },

    units () {
      return [
        ...dataStorage.units.data,
        {
          id: null,
          name: 'Brak'
        }
      ].map(unit => ({
        value: unit.id,
        text: unit.name
      }));
    }
  },

  components: {
    Navbar
  },

  methods: {
    auth () {
      return auth;
    },
    addItem () {
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
    editUser (item) {
      // Funkcja edytowania użytkownika
      console.log(item);
    }
  }
};
</script>
