<template>
  <AdminOnly>
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

              <b-form-group label-for="input-management-function" label="Filtruj role">
                <b-form-select
                    id="filter-management-function"
                    v-model="selectedRole"
                    :options="selectRoles"
                    placeholder="Wybierz funkcje"
                />
              </b-form-group>
            </b-card>

            <AdminOnly>
              <b-card title="Edycja">
                <b-button variant="primary" v-b-modal.addEditUserModal class="w-100">
                  Dodaj użytkownika
                </b-button>
              </b-card>
            </AdminOnly>
          </VerticalStack>
        </b-col>
        <b-col cols="9">
          <b-card
              title="Lista użytkowników"
          >
            <b-table
                :items="filteredEntries"
                :fields="tableFields"
                class="mt-4"
            >
              <template #cell(edit)="row">
                <HorizontalStack>
                  <b-button @click="openUserEditModal(row.item)" variant="primary">Edytuj</b-button>
                  <b-button @click="removeUser(row.item)" variant="danger">Usuń</b-button>
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

      <b-modal
          id="addEditUserModal"
          :title="this.addUserId ? 'Edytuj użytkownika' : 'Dodaj użytkownika'"
          :ok-title="this.addUserId ? 'Zapisz' : 'Dodaj'"
          cancel-title="Anuluj"
          @ok="saveNewUserEntry"
          @close="clearUserEntryPopup"
          @cancel="clearUserEntryPopup"
          @hide="clearUserEntryPopup"
      >
        <b-form-group
            label="Nazwa"
            label-for="input-add-user-name"
            description="Podaj nazwę użytkownika"
        >
          <b-form-input
              id="input-add-user-name"
              v-model="addUserName"
              type="text"
              placeholder="Krzysztof Kowalski"
              required
          ></b-form-input>
        </b-form-group>

        <b-form-group
            label="E-mail"
            label-for="input-add-user-email"
            description="Podaj adres e-mail użytkownika"
        >
          <b-form-input
              id="input-add-user-email"
              v-model="addUserEmail"
              type="email"
              placeholder="krzysztof.kowalski@o2.pl"
              required
          ></b-form-input>
        </b-form-group>

        <b-form-group
            label="Rola"
            label-for="input-add-user-role"
            description="Poziom uprawnień w systemie"
        >
          <b-form-select
              id="input-add-user-role"
              v-model="addUserRoleId"
              :options="selectRoles"
              placeholder="Komendant"
              required
          />
        </b-form-group>

        <b-form-group
            label="Jednostka OSP"
            label-for="input-add-management-unit"
            description="Przynależność do jednostki OSP"
        >
          <b-form-select
              id="input-add-management-unit"
              v-model="addUserUnitId"
              :options="selectUnits"
              placeholder="OSP PSZÓW"
              required
          />
        </b-form-group>
      </b-modal>

      <b-modal
          id="userAddedModal"
          title="Link do aktywacji konta użytkownika"
          ok-title="Zamknij"
          cancel-title="Anuluj"
          cancel-disabled
      >
        <p>Poniżej podany został jednorazowy link do aktywacji konta. Przekaż go w bezpieczny sposób do użytkownika.</p>

        <b-form-group
            label="Adres email użytkownika"
            label-for="input-password-set-email"
            description="Adres email użytkownika."
        >
          <b-form-input
              id="input-password-set-email"
              v-model="addUserPasswordSetEmail"
              readonly
              type="text"
          ></b-form-input>
        </b-form-group>
        
        <b-form-group
            label="Link do aktywacji konta"
            label-for="input-password-set-url"
            description="Jednorazowy link do aktywacji konta w systemie."
        >
          <b-form-input
              id="input-password-set-url"
              v-model="addUserPasswordSetUrl"
              readonly
              type="text"
          ></b-form-input>
        </b-form-group>
        
        <b-alert show variant="warning" class="mt-3 text-center">
          Skopiuj ten link przed zamknięciem okna. Jego ponowne wyświetlenie jest niemożliwe!
        </b-alert>
      </b-modal>
    </b-container>
  </AdminOnly>
</template>

<script>
import dataStorage from '@/Data/DataStorageInstance';
import VerticalStack from '@/components/ui/VerticalStack.vue';
import AdminOnly from '@/components/guards/AdminOnly.js';
import HorizontalStack from '@/components/ui/HorizontalStack.vue';
import UserRole from '@/enum/UserRole';
import User from '@/Model/User';

export default {
  name: 'Users',
  components: {HorizontalStack, AdminOnly, VerticalStack},

  data() {
    return {
      updateTick: 0,

      searchQuery: '',
      selectedUnit: null,
      selectedRole: null,

      addUserId: null,
      addUserName: '',
      addUserEmail: '',
      addUserRoleId: null,
      addUserUnitId: null,
      addUserPasswordSetUrl: null,
      addUserPasswordSetEmail: null,
      
      validationError: null,
      confirmationMessage: null,

      tableFields: [
        {
          key: 'name',
          label: 'Nazwa',
          sortable: true
        },
        {
          key: 'email',
          label: 'E-mail',
          sortable: true
        },
        {
          key: 'unit',
          label: 'Jednostka',
          sortable: true
        },
        {
          key: 'role',
          label: 'Rola',
          sortable: true
        },
        {
          key: 'edit',
          label: 'Akcje',
          sortable: false,
          class: 'text-right'
        }
      ],
    }
  },

  created() {
    Promise.all([
      dataStorage.users.load(),
      dataStorage.units.load(),
      dataStorage.roles.load()
    ]).then(() => {
      this.isReady = true;
    });
  },

  methods: {
    saveNewUserEntry() {
      const user = new User(
          this.addUserName,
          this.addUserEmail,
      );
      
      user.role = dataStorage.roles.getById(this.addUserRoleId);
      user.unit = dataStorage.units.getById(this.addUserUnitId);

      if (this.addUserId) {
        user.id = this.addUserId;
      }

      user.save().then((savedEntry) => {
        dataStorage.users.data.set(savedEntry.id, savedEntry);

        const user = dataStorage.users.getById(savedEntry.id);
        this.addUserPasswordSetUrl = user.password_change_url;
        this.addUserPasswordSetEmail = user.email;
        
        this.$nextTick(() => {
          this.$bvModal.show('userAddedModal');
        });
        
        this.clearUserEntryPopup();
        this.forceUpdate();
      }).catch((error) => {
        this.validationError = 'Wystąpił błąd podczas dodawania wpisu. ' + error.body.message;
      });
    },

    removeUser(entry) {
      if (!window.confirm('Czy na pewno chcesz usunąć ten wpis?')) {
        return;
      }

      const user = dataStorage.users.getById(entry.id);
      if (!user) {
        return;
      }

      user.delete().then(() => {
        dataStorage.users.data.delete(entry.id);
        this.confirmationMessage = 'Usunięto wpis.';
        this.forceUpdate();
      }).catch((error) => {
        this.validationError = 'Wystąpił błąd podczas usuwania wpisu. ' + error.body.message;
      });
    },

    openUserEditModal(entry) {
      const user = dataStorage.users.getById(entry.id);

      this.addUserId = user.id;
      this.addUserName = user.name;
      this.addUserEmail = user.email;
      this.addUserUnitId = user.unit.id;
      this.addUserRoleId = user.role.id;

      this.$nextTick(() => {
        this.$bvModal.show('addEditUserModal');
      });
    },

    clearUserEntryPopup() {
      this.addUserId = null;
      this.addUserName = '';
      this.addUserEmail = '';
      this.addUserUnitId = null;
      this.addUserRoleId = null;
    },

    forceUpdate() {
      this.updateTick++;
    }
  },

  computed: {
    filteredEntries: function () {
      void this.updateTick;

      const query = this.searchQuery.toLowerCase();

      return dataStorage.users
          .getDataAsArray()
          .filter(user =>
              user.role.id === UserRole.ADMIN
              || user.role.id === UserRole.USER
              || user.role.id === UserRole.COMMANDANT
              || user.role.id === UserRole.MODERATOR
          )
          .filter(user =>
              this.selectedUnit === null
              || user.unit.id === this.selectedUnit
          )
          .filter(user =>
              this.selectedRole === null
              || user.role.id === this.selectedRole
          )
          .filter(user =>
              user.name.toLowerCase().includes(query)
              || user.email.toLowerCase().includes(query)
              || user.unit.name.toLowerCase().includes(query)
              || user.role.name.toLowerCase().includes(query)
          )
          .map(user =>
              ({
                id: user.id,
                name: user.name,
                email: user.email,
                unit: user.unit.name,
                role: user.role.name
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

    selectRoles() {
      void this.updateTick;

      return [
        ...dataStorage.roles
            .getDataAsArray()
            .filter(role =>
                role.id === UserRole.ADMIN
                || role.id === UserRole.USER
                || role.id === UserRole.COMMANDANT
                || role.id === UserRole.MODERATOR
            )
            .map(role => ({
              value: role.id,
              text: role.name
            })),
        {
          value: null,
          text: 'Brak'
        }
      ];
    }
  },
};
</script>
