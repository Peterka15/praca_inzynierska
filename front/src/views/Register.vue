<template>
  <div>
    <navbar/>
    <div class="m_boxcenter m_boxcenterp shadow">
      <h3 class="m_boxfont">REJESTRACJA</h3>
    </div>
    <div class="center centerp shadow">
      <div>
        <h3 class="left_column">OSP LATARNIA GNIEZNO</h3>
      </div>
      <div>
        <div class="logininput">
          <b-form inline>
            <label class="sr-only">Imię</label>
            <b-form-input
                id="inline-form-input-name"
                v-model="name"
                class="mb-2 mr-sm-2 mb-sm-0"
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
                class="mb-2 mr-sm-2 mb-sm-0"
                placeholder="E-mail"
            ></b-form-input>
          </b-form>
        </div>
        <div class="logininput">
          <b-form inline>
            <label class="sr-only">Hasło</label>
            <b-input-group class="mb-2 mr-sm-2 mb-sm-0">
              <b-form-input id="inline-form-input-username" v-model="password"
                            placeholder="Hasło" type="password"></b-form-input>
            </b-input-group>
          </b-form>
          <div class="logininput">
            <b-button v-b-modal.modal-1 @click="addUser()">Zarejestruj się</b-button>
          </div>
        </div>
        <b-alert v-if="registrationError" variant="danger" show>{{ registrationError }}</b-alert>
      </div>
    </div>

  </div>
</template>

<style>
</style>

<script>
import './../style/style.css';

import Navbar from "@/components/Navbar";
import auth from "@/Model/AuthInstance";


export default {
  name: 'Mainpage',

  data() {
    return {
      email: '',
      password: '',
      name: "",
      registrationError: null,
      error: null,
    }
  },
  components: {
    Navbar,
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