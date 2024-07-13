<template>

<!--TODO:Wykonać panel administracyjny -->
  <div>
    <navbar>
    </navbar>

    <div class="m_boxcenter m_boxcenterp shadow">
      <h3 class="m_boxfont">Panel Administracyjny</h3>
    </div>

    <div class="center_box center_boxp shadow">
      <div class="addbutton addbuttonp">
        <b-button variant="primary" v-b-modal.my-modal>Dodaj nowego użytkownika +</b-button>
        <b-modal id="my-modal">
          <h3>
            <div>
              <h3 >Dodawanie użytkownika</h3>
              <div class="logininput">
                <b-form inline>
                  <b-form-checkbox v-model="isActive">
                    Aktywny
                  </b-form-checkbox>
                </b-form>
              </div>
              <div class="logininput">
                <b-form inline>
                  <label class="sr-only">Imię</label>
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
                      id="inline-form-input-name"
                      v-model="email"
                      placeholder="E-mail"
                  ></b-form-input>
                </b-form>
              </div>
              <div class="logininput">
                <b-form inline>
                  <label class="sr-only">Hasło</label>
                  <b-input-group>
                    <b-form-input id="inline-form-input-username" v-model="password"
                                  placeholder="Hasło" type="password"></b-form-input>
                  </b-input-group>
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
                <b-form inline>
                  <b-form-checkbox
                      v-model="isCommander">
                    Uprawnienia komendanta powiatowego
                  </b-form-checkbox>
                </b-form>
              </div>
              <div class="logininput">
                <b-form inline>
                  <b-form-checkbox
                      v-model="canEditEquipment">
                    Zarządzanie sprzętem w jednostce
                  </b-form-checkbox>
                </b-form>
              </div>
              <div class="logininput">
                <b-form inline>
                  <b-form-checkbox
                      v-model="canEditMembers">
                    Edycja członków zarządu
                  </b-form-checkbox>
                </b-form>
              </div>
              <div class="logininput">
                <b-form inline>
                  <b-form-checkbox v-model="isModerator">
                    Moderator jednostki OSP
                  </b-form-checkbox>
                </b-form>
              </div>
              <div class="logininput">
                <b-button v-b-modal.modal-1 @click="addUser()">Dodaj</b-button>
              </div>
              <b-alert v-if="registrationError" variant="danger" show>{{ registrationError }}</b-alert>
            </div>
          </h3>
        </b-modal>
      </div>

      <div class="line"><h2 style="color: white;">Lista wszystkich użytkowników</h2></div>

      <div>
      <b-table  style="margin: -209px; position: absolute;top: 39%;left: 17%;width: 98%; --bs-table-hover-color: yellow;background: rgba(161, 32, 58, 0.6);" striped hover :items="users" :fields="fields" @sort-changed="onSortChange ">
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
import auth from "@/Model/AuthInstance";


export default {
  name: 'Mainpage',
  data() {
    return {
      name: '',
      email: '',
      password: '',
      selectedUnit: null,
      isActive: false,
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
      registrationError: null,
      error: null,
      users: [
        {
          name: 'Jan Kowalski',
          email: 'jan.kowalski@example.com',
          unit: 'Pszów',
          isActive: true,
          isCommander: true,
          canEditEquipment: false,
          canEditMembers: true,
          isModerator: false
        },
        {
          name: 'Anna Nowak',
          email: 'anna.nowak@example.com',
          unit: 'Krzyżkowice',
          isActive: true,
          isCommander: false,
          canEditEquipment: true,
          canEditMembers: false,
          isModerator: true
        },
        {
          name: 'Piotr Wiśniewski',
          email: 'piotr.wisniewski@example.com',
          unit: 'Zawada',
          isActive: true,
          isCommander: false,
          canEditEquipment: true,
          canEditMembers: true,
          isModerator: false
        },
        {
          name: 'Katarzyna Wójcik',
          email: 'katarzyna.wojcik@example.com',
          unit: 'Rogów',
          isActive: true,
          isCommander: true,
          canEditEquipment: true,
          canEditMembers: false,
          isModerator: true
        },
        {
          name: 'Michał Lewandowski',
          email: 'michal.lewandowski@example.com',
          unit: 'Pszów',
          isActive: true,
          isCommander: false,
          canEditEquipment: false,
          canEditMembers: true,
          isModerator: true
        },
      ],
      fields: [
        { key: 'isActive', label: 'Aktywny', sortable: true },
        { key: 'name', label: 'Imię', sortable: true },
        { key: 'email', label: 'E-mail', sortable: true },
        { key: 'unit', label: 'Jednostka', sortable: true },
        { key: 'isCommander', label: 'Komendant/Kwatermistrz Powiatowy', sortable: true },
        { key: 'canEditEquipment', label: 'Edycja Sprzętu', sortable: true },
        { key: 'canEditMembers', label: 'Edycja Członków', sortable: true },
        { key: 'isModerator', label: 'Moderator OSP', sortable: true },
        { key: 'edit', label: 'Edytuj', sortable: false }
      ]
    };
  },

  components: {
    Navbar
  },

  methods: {
    addUser: function () {
      auth.register(this.email, this.password, this.name)
          .then(() => {
            this.$router.push({path: '/login'});
          })
      this.registrationError = null; // Zresetuj błąd przed próbą rejestracji
      // Sprawdź warunki przed rejestracją

      if (this.name.trim() === "") {
        this.registrationError = 'Pole "Imię" nie może być puste.';
        return;
      }
      if (this.password.length < 8) {
        this.registrationError = 'Hasło musi mieć minimum 8 znaków.';
        return;
      }
      // TODO wyciągniecie z api informacji o tym czy jest już w bazie podany użytkownik:
      auth.checkUserExistence(this.email)
          .then((response) => {
            if (response.data.exists) {
              this.registrationError = 'Użytkownik o podanym adresie e-mail już istnieje.';
            } else {
              // Sprawdź, czy input to adres email
              if (!this.isValidEmail(this.email)) {
                this.registrationError = 'Podany adres e-mail jest nieprawidłowy.';
              } else {
                // Wykonaj rejestrację
                auth.register(this.email, this.password, this.name)
                    .then(() => {
                      this.$router.push({path: '/login'});
                    })
                    .catch(() => {
                      // Obsługa błędów rejestracji
                      this.registrationError = 'Wystąpił błąd podczas rejestracji. Spróbuj ponownie później.';
                    });
              }
            }
          })
          .catch(() => {
            this.registrationError = 'Wystąpił błąd podczas sprawdzania dostępności użytkownika.';
          });
    },
    isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    },
  },


}

</script>