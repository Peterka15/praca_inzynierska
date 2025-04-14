<template>
  <Guard admin moderator user commandant display-error>
    <b-container class="mt-4">
      <b-row>
        <b-col>
          <div class="card-banner-bg" style="background-image: url('/media/training.webp')">
            <span>Materiały szkoleniowe</span>
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
                    placeholder="Instrukcja"
                />
              </b-form-group>

              <b-form-group label-for="filter-user" label="Właściciel">
                <b-form-select
                    id="filter-user"
                    v-model="selectedUser"
                    :options="selectUsers"
                    placeholder="Wybierz właściciela"
                />
              </b-form-group>
            </b-card>

            <Guard admin moderator>
              <b-card title="Edycja">
                <b-button variant="primary" v-b-modal.addFileModal class="w-100">
                  <b-icon-plus class="mr-1" scale="1.3"/>
                  Dodaj plik
                </b-button>
              </b-card>
            </Guard>
          </VerticalStack>
        </b-col>
        <b-col cols="12" lg="9" class="mt-4 mt-lg-0">
          <b-card
              title="Lista materiałów szkoleniowych"
              class="print-only"
          >
            <b-table
                :items="filteredEntries"
                :fields="tableFields"
                class="mt-4"
            >
              <template #cell(edit)="row">
                <HorizontalStack>
                  <b-button
                      @click="downloadFile(row.item)"
                      variant="primary">
                    <b-icon-download/>
                  </b-button>
                  <Guard admin moderator>
                    <b-button
                        @click="removeFile(row.item)"
                        variant='danger'>
                      <b-icon-trash-fill/>
                    </b-button>
                  </Guard>
                </HorizontalStack>
              </template>
            </b-table>

            <b-alert show v-if="confirmationMessage" variant="success" class="mt-3 text-center">
              {{ confirmationMessage }}
            </b-alert>
          </b-card>
        </b-col>
      </b-row>

      <Guard admin moderator>
        <b-modal
            id="addFileModal"
            title="Dodaj plik"
            @ok="saveNewFileEntry"
            @close="clearFileEntryPopup"
            @cancel="clearFileEntryPopup"
            @hide="clearFileEntryPopup"
        >
          <b-alert show v-if="validationError" variant="danger" class="mt-3 text-center">
            {{ validationError }}
          </b-alert>

          <b-form-group
              label="Nazwa pliku"
              label-for="input-add-file-name"
              description="Nazwa dla Twojego pliku"
          >
            <b-form-input
                id="input-add-file-name"
                v-model="addFileName"
                type="text"
                placeholder="Instrukcja obsługi prądownicy W-52"
                required
            ></b-form-input>
          </b-form-group>

          <b-form-group
              label="Plik"
              label-for="input-add-file"
              description="Wybierz plik do dodania"
          >
            <b-form-file
                id="input-add-file"
                v-model="addFile"
                placeholder="Wybierz plik"
                required
            />
          </b-form-group>

          <template #modal-footer>
            <b-button variant="secondary" @click="$bvModal.hide('addFileModal')">
              <b-icon-x class="mr-1" scale="1.3" shift-v="-2"/>
              Anuluj
            </b-button>
            <b-button variant="primary" @click="saveNewFileEntry">
              <b-icon-check2 class="mr-1" scale="1" shift-v="-2"/>
              Zapisz
            </b-button>
          </template>
        </b-modal>
      </Guard>
    </b-container>
  </Guard>
</template>

<script>
import dataStorage from '@/Data/DataStorageInstance';
import VerticalStack from '@/components/ui/VerticalStack.vue';
import HorizontalStack from '@/components/ui/HorizontalStack.vue';
import Guard from '@/components/guards/Guard';
import authInstance from '@/Model/AuthInstance';
import Bridge from '@/api/Bridge';
import File from '@/Model/File';

export default {
  name: 'Files',
  components: {
    Guard,
    HorizontalStack,
    VerticalStack
  },

  data () {
    return {
      updateTick: 0,

      searchQuery: '',
      selectedUser: authInstance?.user?.id ?? null,
      selectedCategory: null,

      addFileName: '',
      addFile: null,

      validationError: null,
      confirmationMessage: null
    };
  },

  created () {
    Promise.all([
      dataStorage.files.load()
    ]).then(() => {
      this.isReady = true;
      this.forceUpdate();
    });
  },

  methods: {
    saveNewFileEntry () {
      if(this.addFileName.length < 3) {
        this.validationError = 'Nazwa pliku jest za krotka.';
        return;
      }

      const formData = new FormData();
      formData.append('name', this.addFileName);
      formData.append('file', this.addFile);

      Bridge.uploadFile('files', formData)
          .then((response) => {
            this.confirmationMessage = 'Plik został przesłany.';
            dataStorage.files.data.set(response.data.id, (new File()).hydrate(response.data));

            this.$bvModal.hide('addFileModal');

            this.clearFileEntryPopup();
            this.forceUpdate();
          })
          .catch((error) => {
            this.validationError = 'Wystąpił błąd podczas dodawania pliku. ' + error;
            throw error;
          });
    },

    removeFile (entry) {
      if (!window.confirm('Czy na pewno chcesz usunąć ten plik?')) {
        return;
      }

      const file = dataStorage.files.getById(entry.id);
      if (!file) {
        return;
      }

      // Removing file is available only via UUID
      file.id = file.uuid;
      file.delete().then(() => {
        dataStorage.files.deleteById(entry.id);
        this.confirmationMessage = 'Usunięto wpis.';
        this.forceUpdate();
      }).catch((error) => {
        this.validationError = 'Wystąpił błąd podczas usuwania wpisu. ' + error.body.message;
      });
    },

    downloadFile (entry) {
      window.open(entry.url, '_blank');
    },

    clearFileEntryPopup () {
      this.addFileName = '';
    },

    forceUpdate () {
      this.updateTick++;
    }
  },

  computed: {
    tableFields () {
      return [
        {
          key: 'name',
          label: 'Nazwa',
          sortable: true
        },
        {
          key: 'type',
          label: 'Typ',
          sortable: true
        },
        {
          key: 'user',
          label: 'Właściciel',
          sortable: true
        },
        {
          key: 'createdAt',
          label: 'Data utworzenia',
          sortable: true
        },
        {
          key: 'edit',
          label: 'Akcje',
          sortable: false,
          class: 'text-right'
        }
      ];
    },

    filteredEntries: function () {
      void this.updateTick;

      const query = this.searchQuery.toLowerCase();

      return dataStorage.files
          .getDataAsArray()
          .filter(item =>
              this.selectedUser === null
              || item.user.id === this.selectedUser
          )
          .filter(item => item.name.toLowerCase().includes(query))
          .map(item =>
              ({
                id: item.id,
                name: item.name,
                user: item.user.name,
                url: item.url,
                type: item.extension,
                createdAt: new Date(item.created_at).toLocaleString(
                    'pl-PL',
                    {
                      hour: '2-digit',
                      minute: '2-digit',
                      day: '2-digit',
                      month: '2-digit',
                      year: 'numeric'
                    }
                )
              })
          );
    },

    selectUsers () {
      void this.updateTick;

      return [
        ...dataStorage.files
            .getDataAsArray()
            .map(file => ({
              value: file.user.id,
              text: file.user.name
            }))
            .reduce((carry, currentValue) => {
              if (carry.findIndex(item => item.value === currentValue.value) === -1) {
                carry.push(currentValue);
              }

              return carry;
            }, []),
        {
          value: null,
          text: 'Brak'
        }
      ];
    }
  }
};
</script>
