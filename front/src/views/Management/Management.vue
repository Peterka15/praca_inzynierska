<template>
  <b-container class="mt-4">
    <b-row>
      <b-col cols="12" lg="3">
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
              <b-button variant="primary" v-b-modal.addEditManagementModal class="w-100">
                Dodaj członka zarządu
              </b-button>
            </b-card>
          </AdminOnly>
        </VerticalStack>
      </b-col>
      <b-col cols="12" lg="9" class="mt-4 mt-lg-0">
        <b-card
            title="Lista członków zarządu"
        >
          <b-table
              :items="filteredEntries"
              :fields="tableFields"
              class="mt-4"
          >
            <template #cell(edit)="row">
              <HorizontalStack>
                <b-button @click="openManagementEntryEditModal(row.item)" variant="primary">Edytuj</b-button>
                <b-button @click="removeManagementEntry(row.item)" variant="danger">Usuń</b-button>
              </HorizontalStack>
            </template>
          </b-table>

          <b-alert show v-if="validationError" variant="danger" class="mt-3 text-center">
            {{ validationError }}
          </b-alert>
          <b-alert show v-if="confirmationMessage" variant="success" class="mt-3 text-center">
            {{ confirmationMessage }}
          </b-alert>
        </b-card>
      </b-col>
    </b-row>

    <AdminOnly>
      <b-modal
          id="addEditManagementModal"
          :title="this.addManagementId ? 'Edytuj członka zarządu' : 'Dodaj członka zarządu'"
          :ok-title="this.addManagementId ? 'Zapisz' : 'Dodaj'"
          cancel-title="Anuluj"
          @ok="saveManagementEntry"
          @close="clearManagementEntryPopup"
          @cancel="clearManagementEntryPopup"
          @hide="clearManagementEntryPopup"
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
              v-model="addManagementUnitId"
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
import HorizontalStack from '@/components/ui/HorizontalStack.vue';
import auth from '@/Model/AuthInstance';

export default {
  name: 'Management',
  components: {HorizontalStack, AdminOnly, VerticalStack},

  data() {
    return {
      updateTick: 0,

      searchQuery: '',
      selectedUnit: null,
      selectedManagementFunction: null,

      addManagementId: null,
      addManagementName: '',
      addManagementFunction: '',
      addManagementUnitId: null,

      validationError: null,
      confirmationMessage: null,
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
          dataStorage.units.getById(this.addManagementUnitId)
      );

      if (this.addManagementId) {
        managementEntry.id = this.addManagementId;
      }

      managementEntry.save().then((savedEntry) => {
        dataStorage.managements.data.set(savedEntry.id, savedEntry);
        this.confirmationMessage = 'Zapisano.';

        this.clearManagementEntryPopup();
        this.forceUpdate();
      }).catch((error) => {
        this.validationError = 'Wystąpił błąd podczas dodawania wpisu. ' + error.body.message;
      });
    },

    removeManagementEntry(entry) {
      if (!window.confirm('Czy na pewno chcesz usunąć ten wpis?')) {
        return;
      }

      const model = dataStorage.managements.getById(entry.id);
      if (!model) {
        return;
      }

      model.delete().then(() => {
        dataStorage.managements.data.delete(entry.id);
        this.confirmationMessage = 'Usunięto wpis.';
        this.forceUpdate();
      }).catch((error) => {
        this.validationError = 'Wystąpił błąd podczas usuwania wpisu. ' + error.body.message;
      });
    },

    openManagementEntryEditModal(entry) {
      const managementEntity = dataStorage.managements.getById(entry.id);

      this.addManagementId = managementEntity.id;
      this.addManagementName = managementEntity.name;
      this.addManagementFunction = managementEntity.function;
      this.addManagementUnitId = managementEntity.unit.id;

      this.$nextTick(() => {
        this.$bvModal.show('addEditManagementModal');
      });
    },

    clearManagementEntryPopup() {
      this.addManagementId = null;
      this.addManagementName = '';
      this.addManagementFunction = '';
      this.addManagementUnitId = null;
    },

    forceUpdate() {
      this.updateTick++;
    }
  },

  computed: {
    tableFields() {
      const fields = [
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
        }
      ];

      if (auth?.user?.role?.isAdmin()) {
        fields.push({
          key: 'edit',
          label: 'Akcje',
          sortable: false,
          class: 'text-right'
        });
      }

      return fields;
    },

    filteredEntries() {
      void this.updateTick;

      const query = this.searchQuery.toLowerCase();

      return dataStorage.managements
          .getDataAsArray()
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
                id: managementEntry.id,
                name: managementEntry.name,
                position: managementEntry.function,
                unit: managementEntry.unit.name
              })
          );
    },

    selectUnits() {
      void this.updateTick;

      return [
        ...dataStorage.units
            .getDataAsArray()
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
      void this.updateTick;

      return [
        ...dataStorage.managements
            .getDataAsArray()
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
