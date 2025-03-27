<template>
  <b-container class="mt-4">
    <b-row>
      <b-col>
        <VerticalStack wideGaps>
          <b-card title="Szukaj">
            <b-form-group label-for="input-search" label="Szukaj po nazwie">
              <b-form-input
                  id="input-search"
                  v-model="searchQuery"
                  placeholder="Prezes"
              />
            </b-form-group>

            <b-form-group label-for="input-unit" label="Filtruj jednostki">
              <b-form-select
                  id="filter-unit"
                  v-model="selectedUnit"
                  :options="selectUnits"
                  placeholder="Wybierz jednostkę"
              />
            </b-form-group>

            <b-form-group label-for="input-management-function" label="Filtruj funkcje">
              <b-form-select
                  id="filter-management-function"
                  v-model="selectedManagementFunction"
                  :options="selectManagementFunctions"
                  placeholder="Wybierz funkcje"
              />
            </b-form-group>
          </b-card>

          <AdminOnly>
            <b-card title="Edycja">
              <b-button variant="primary" v-b-modal.my-modal class="w-100">Dodaj członka zarządu</b-button>
            </b-card>
          </AdminOnly>
        </VerticalStack>
      </b-col>
      <b-col cols="9">
        <b-card
            title="Lista członków zarządu"
        >
          <b-table
              :items="filteredEntries"
              :fields="tableFields"
              class="mt-4"
          >
            <template #cell(edit)="row">
              <b-button @click="editUser(row.item)">Edytuj</b-button>
            </template>
          </b-table>
        </b-card>
      </b-col>
    </b-row>

    <AdminOnly>
      <b-modal
          id="my-modal"
          title="Dodaj członka zarządu"
          ok-title="Dodaj"
          cancel-title="Anuluj"
          @ok="saveManagementEntry"
          visible
      >
        <b-form-group
            label="Imię i nazwisko"
            label-for="input-add-management-name"
            description="Podaj imię i nazwisko"
        >
          <b-form-input
              id="input-add-management-name"
              v-model="addManagementName"
              type="text"
              placeholder="Krzysztof Kowalski"
              required
          ></b-form-input>
        </b-form-group>

        <b-form-group
            label="Pełniona funkcja"
            label-for="input-add-management-function"
            description="Jaką rolę pełni ta osoba?"
        >
          <b-form-input
              id="input-add-management-function"
              v-model="addManagementFunction"
              type="text"
              placeholder="Kierownik"
              required
          ></b-form-input>
        </b-form-group>

        <b-form-group
            label="Jednostka OSP"
            label-for="input-add-management-unit"
            description="Przynależność do jednostki OSP"
        >
          <b-form-select
              id="input-add-management-unit"
              v-model="addManagementUnit"
              :options="selectUnits"
              placeholder="Wybierz jednostkę"
              required
          />
        </b-form-group>
      </b-modal>
    </AdminOnly>
  </b-container>
</template>

<script>
import dataStorage from '@/Data/DataStorageInstance';
import VerticalStack from '@/components/ui/VerticalStack.vue';
import AdminOnly from '@/components/guards/AdminOnly.js';
import Management from '@/Model/Management';

export default {
  name: 'Mainpage',
  components: {AdminOnly, VerticalStack},
  data() {
    return {
      searchQuery: '',
      selectedUnit: null,
      selectedManagementFunction: null,

      addManagementId: null,
      addManagementName: '',
      addManagementFunction: '',
      addManagementUnit: null,

      tableFields: [
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

  created() {
    Promise.all([
      dataStorage.managements.load(),
      dataStorage.units.load()
    ]).then(() => {
      this.isReady = true;
    });
  },

  methods: {
    saveManagementEntry() {
      const managementEntry = new Management(
          this.addManagementName,
          this.addManagementFunction,
          dataStorage.managements.data.find(e => e.id === this.addManagementUnit)
      );

      if (this.addManagementId) {
        managementEntry.id = this.addManagementId;
      }

      managementEntry.save().then((managementEntry) => {
        dataStorage.managements.data.push(managementEntry);
      }).then(() => {
        this.confirmationMessage = 'Zapisano.'
      }).catch((error) => {
        this.validationError = 'Wystąpił błąd podczas dodawania wpisu. ' + error.body.message;
      });
    }
  },

  computed: {
    filteredEntries() {
      const query = this.searchQuery.toLowerCase();

      return dataStorage.managements.data
          .filter(managementEntry =>
              this.selectedUnit === null
              || managementEntry.unit.id === this.selectedUnit
          )
          .filter(managementEntry =>
              this.selectedManagementFunction === null
              || managementEntry.function === this.selectedManagementFunction
          )
          .filter(managementEntry =>
              managementEntry.name.toLowerCase().includes(query)
              || managementEntry.function.toLowerCase().includes(query)
              || managementEntry.unit.name.toLowerCase().includes(query)
          )
          .map(managementEntry => ({
                name: managementEntry.name,
                position: managementEntry.function,
                unit: managementEntry.unit.name
              })
          );
    },

    selectUnits() {
      return [
        ...dataStorage.units.data
            .map(unit => ({
              value: unit.id,
              text: unit.name
            })),
        {
          value: null,
          text: 'Brak'
        }
      ];
    },

    selectManagementFunctions() {
      return [
        ...dataStorage.managements.data
            .map(unit => ({
              value: unit.function,
              text: unit.function
            })),
        {
          value: null,
          text: 'Brak'
        }
      ].reduce((carry, currentValue) => {
        if (carry.findIndex(item => item.value === currentValue.value) === -1) {
          carry.push(currentValue);
        }

        return carry;
      }, []);
    }
  },
};
</script>
