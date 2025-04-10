<template>
  <Guard admin moderator user commandant display-error>
    <b-container class="mt-4">
      <b-row>
        <b-col>
          <div class="card-banner-bg" style="background-image: url('/media/inventory.webp')">
            <span>Sprzęt</span>
          </div>
        </b-col>
      </b-row>
      <b-row class="mt-4">
        <b-col cols="12" lg="3">
          <VerticalStack wideGaps>
            <b-card title="Szukaj">
              <b-form-group label-for="input-search" label="Szukaj po nazwie">
                <b-form-input
                    id="input-search"
                    v-model="searchQuery"
                    placeholder="Wąż"
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

              <b-form-group label-for="input-category" label="Filtruj kategorię">
                <b-form-select
                    id="filter-category"
                    v-model="selectedCategory"
                    :options="selectCategories"
                    placeholder="Wybierz kategorię"
                />
              </b-form-group>
            </b-card>

            <Guard admin moderator>
              <b-card title="Edycja">
                <b-button variant="primary" v-b-modal.addEditInventoryModal class="w-100">
                  Dodaj sprzęt
                </b-button>
              </b-card>
            </Guard>

            <Guard admin moderator commandant>
              <b-card title="Raport">
                <b-button
                    variant="primary"
                    @click="printInventoryReport"
                    class="w-100"
                >
                  Wydrukuj raport sprzętu
                </b-button>
              </b-card>
            </Guard>
          </VerticalStack>
        </b-col>
        <b-col cols="12" lg="9" class="mt-4 mt-lg-0">
          <b-card
              title="Lista sprzętu"
              class="print-only"
          >
            <b-table
                :items="filteredEntries"
                :fields="tableFields"
                class="mt-4"
            >
              <template #cell(edit)="row">
                <HorizontalStack>
                  <b-button @click="openInventoryEditModal(row.item)" variant="primary">Edytuj</b-button>
                  <b-button @click="removeInventory(row.item)" variant="danger">Usuń</b-button>
                </HorizontalStack>
              </template>
              <template #cell(available)="row">
                <b-badge pill variant="success" v-if="row.item.available">TAK</b-badge>
                <b-badge pill variant="danger" v-else>NIE</b-badge>
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

      <Guard admin moderator>
        <b-modal
            id="addEditInventoryModal"
            :title="this.addInventoryId ? 'Edytuj sprzęt' : 'Dodaj sprzęt'"
            :ok-title="this.addInventoryId ? 'Zapisz' : 'Dodaj'"
            cancel-title="Anuluj"
            @ok="saveNewInventoryEntry"
            @close="clearInventoryEntryPopup"
            @cancel="clearInventoryEntryPopup"
            @hide="clearInventoryEntryPopup"
        >
          <b-form-group
              label="Kategoria"
              label-for="input-add-inventory-category"
              description="Kategoria sprzętu"
          >
            <b-form-select
                id="input-add-inventory-category"
                v-model="addInventoryCategoryId"
                :options="selectCategories"
                placeholder="Sprzęt podręczny"
                required
            />
          </b-form-group>

          <b-form-group
              label="Nazwa"
              label-for="input-add-inventory-name"
              description="Podaj nazwę sprzętu"
          >
            <b-form-input
                id="input-add-inventory-name"
                v-model="addInventoryName"
                type="text"
                placeholder="Wąż gaśniczy W-52"
                required
            ></b-form-input>
          </b-form-group>

          <b-form-group
              label="Ilość"
              label-for="input-add-inventory-amount"
              description="Podaj ilość sprzętu"
          >
            <b-form-input
                id="input-add-inventory-amount"
                v-model="addInventoryAmount"
                type="number"
                placeholder="10"
                required
            ></b-form-input>
          </b-form-group>

          <b-form-group
              label="Dostępność"
              label-for="input-add-inventory-availability"
              description="Czy sprzęt jest dostępny do wykorzystania?"
          >
            <b-form-select
                id="input-add-inventory-availability"
                v-model="addInventoryAvailability"
                :options="selectAvailability"
                placeholder="TAK"
                required
            />
          </b-form-group>

          <b-form-group
              label="Jednostka OSP"
              label-for="input-add-inventory-unit"
              description="Przynależność do jednostki OSP"
          >
            <b-form-select
                id="input-add-inventory-unit"
                v-model="addInventoryUnitId"
                :options="selectUnits"
                placeholder="OSP PSZÓW"
                required
            />
          </b-form-group>
        </b-modal>
      </Guard>
    </b-container>
  </Guard>
</template>

<script>
import dataStorage from '@/Data/DataStorageInstance';
import VerticalStack from '@/components/ui/VerticalStack.vue';
import HorizontalStack from '@/components/ui/HorizontalStack.vue';
import InventoryItem from '@/Model/InventoryItem';
import Guard from '@/components/guards/Guard';
import auth from '@/Model/AuthInstance';
import Bridge from '@/api/Bridge';

export default {
  name: 'Users',
  components: {
    Guard,
    HorizontalStack,
    VerticalStack
  },

  data () {
    return {
      updateTick: 0,

      searchQuery: '',
      selectedUnit: null,
      selectedCategory: null,

      addInventoryId: null,
      addInventoryName: '',
      addInventoryAmount: 1,
      addInventoryAvailability: true,
      addInventoryCategoryId: 1,
      addInventoryUnitId: null,

      validationError: null,
      confirmationMessage: null
    };
  },

  created () {
    Promise.all([
      dataStorage.inventoryCategories.load(),
      dataStorage.inventoryItems.load(),
      dataStorage.units.load()
    ]).then(() => {
      this.isReady = true;
      this.forceUpdate();
    });
  },

  methods: {
    async printInventoryReport() {
      Bridge.downloadFile('inventory/pdf').catch((err) => {
        console.error('Błąd podczas pobierania PDF:', err);
      });
    },

    saveNewInventoryEntry () {
      const item = new InventoryItem(
          this.addInventoryName,
          parseInt(this.addInventoryAmount),
          dataStorage.inventoryCategories.getById(this.addInventoryCategoryId),
          dataStorage.units.getById(this.addInventoryUnitId),
          this.addInventoryAvailability
      );

      if (this.addInventoryId) {
        item.id = this.addInventoryId;
      }

      item.save().then((savedEntry) => {
        dataStorage.inventoryItems.setUsingId(savedEntry);

        this.clearInventoryEntryPopup();
        this.forceUpdate();
      }).catch((error) => {
        this.validationError = 'Wystąpił błąd podczas dodawania wpisu. ' + error.body.message;
      });
    },

    removeInventory (entry) {
      if (!window.confirm('Czy na pewno chcesz usunąć ten wpis?')) {
        return;
      }

      const item = dataStorage.inventoryItems.getById(entry.id);
      if (!item) {
        return;
      }

      item.delete().then(() => {
        dataStorage.inventoryItems.deleteById(entry.id);
        this.confirmationMessage = 'Usunięto wpis.';
        this.forceUpdate();
      }).catch((error) => {
        this.validationError = 'Wystąpił błąd podczas usuwania wpisu. ' + error.body.message;
      });
    },

    openInventoryEditModal (entry) {
      const item = dataStorage.inventoryItems.getById(entry.id);

      this.addInventoryId = item.id;
      this.addInventoryName = item.name;
      this.addInventoryUnitId = item.unit.id;
      this.addInventoryCategoryId = item.category.id;
      this.addInventoryAmount = item.amount;

      this.$nextTick(() => {
        this.$bvModal.show('addEditInventoryModal');
      });
    },

    clearInventoryEntryPopup () {
      this.addInventoryId = null;
      this.addInventoryName = '';
      this.addInventoryUnitId = null;
      this.addInventoryCategoryId = 1;
      this.addInventoryAmount = 1;
    },

    forceUpdate () {
      this.updateTick++;
    }
  },

  computed: {
    tableFields () {
      let tableFields = [
        {
          key: 'name',
          label: 'Nazwa',
          sortable: true
        },
        {
          key: 'category',
          label: 'Kategoria',
          sortable: true
        },
        {
          key: 'amount',
          label: 'Ilość',
          sortable: true
        },
        {
          key: 'unit',
          label: 'Jednostka',
          sortable: true
        },
        {
          key: 'available',
          label: 'Dostępność',
          sortable: true
        }
      ];

      if (auth?.user?.role?.isAdmin() || auth?.user?.role?.isModerator()) {
        tableFields.push({
          key: 'edit',
          label: 'Akcje',
          sortable: false,
          class: 'text-right'
        });
      }

      return tableFields;
    },

    filteredEntries: function () {
      void this.updateTick;

      const query = this.searchQuery.toLowerCase();

      return dataStorage.inventoryItems
          .getDataAsArray()
          .filter(item =>
              this.selectedUnit === null
              || item.unit.id === this.selectedUnit
          )
          .filter(item =>
              this.selectedCategory === null
              || item.category.id === this.selectedCategory
          )
          .filter(item => item.name.toLowerCase().includes(query))
          .map(item =>
              ({
                id: item.id,
                name: item.name,
                category: item.category.name,
                unit: item.unit.name,
                amount: item.amount,
                available: item.available
              })
          );
    },

    selectUnits () {
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

    selectCategories () {
      void this.updateTick;

      return [
        ...dataStorage.inventoryCategories
            .getDataAsArray()
            .map(category => ({
              value: category.id,
              text: category.name
            })),
        {
          value: null,
          text: 'Brak'
        }
      ];
    },

    selectAvailability () {
      return [
        {
          value: true,
          text: 'TAK'
        },
        {
          value: false,
          text: 'NIE'
        }
      ];
    }
  }
};
</script>
