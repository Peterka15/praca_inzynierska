<template>
  <div>
    <b-button variant="primary" v-b-modal.my-modal>Dodaj członka zarządu +</b-button>
    <div class="search-container">
      <b-input-group class="mb-3" style="max-width: 300px; margin-left: auto;">
        <b-form-input
            v-model="searchQuery"
            placeholder="Wyszukaj członka zarządu..."
            style="margin: 10px"
        ></b-form-input>
      </b-input-group>
    </div>

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
        title="Lista członków zarządu"
        text-variant="white"
    >
      <b-card-body>
        <b-table
            striped
            hover
            :items="filteredUsers"
            :fields="fields"
            @sort-changed="onSortChange"
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

export default {
  name: 'Mainpage',
  data () {
    return {
      searchQuery: '',
      name: '',
      email: '',
      selectedUnit: null,
      selectedPosition: null,
      units: [
        {
          value: 'Pszów',
          text: 'Pszów'
        },
        {
          value: 'Krzyżkowice',
          text: 'Krzyżkowice'
        },
        {
          value: 'Zawada',
          text: 'Zawada'
        },
        {
          value: 'Rogów',
          text: 'Rogów'
        }
      ],
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
          label: '',
          sortable: false
        }
      ]
    };
  },

  created () {
    dataStorage.managements.load();
  },

  computed: {
    filteredUsers () {
      const query = this.searchQuery.toLowerCase();

      return dataStorage.managements.data.filter(managementEntry => (
              managementEntry.name.toLowerCase().includes(query) ||
              managementEntry.function.toLowerCase().includes(query) ||
              managementEntry.unit.name.toLowerCase().includes(query)
          )
      ).map(managementEntry => ({
            name: managementEntry.name,
            position: managementEntry.function,
            unit: managementEntry.unit.name
          })
      );
    }
  },

  components: {
    Navbar
  },

  methods: {
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
    },
    onSortChange () {
      // Funkcja obsługi sortowania tabeli
    }
  }
};
</script>
