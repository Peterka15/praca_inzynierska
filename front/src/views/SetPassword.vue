<template>
  <div>
    <navbar/>
    <div class="m_boxcenter m_boxcenterp shadow">
      <h3 class="m_boxfont">USTAW HASŁO</h3>
    </div>
    <div class="center centerp shadow">
      <div>
        <h3 class="left_column">POWIATOWY SYSTEM OSP</h3>
      </div>
      <div>
        <div class="logininput">
          <b-form inline>
            <label class="sr-only">Hasło</label>
            <b-input-group class="mb-2 mr-sm-2 mb-sm-0">
              <b-form-input id="inline-form-input-password" v-model="password"
                            placeholder="Hasło" type="password"></b-form-input>
            </b-input-group>
          </b-form>
        </div>
        <div class="logininput">
          <b-form inline>
            <label class="sr-only">Potwierdź hasło</label>
            <b-input-group class="mb-2 mr-sm-2 mb-sm-0">
              <b-form-input id="inline-form-input-confirm-password" v-model="confirmPassword"
                            placeholder="Powtórz Hasło" type="password"></b-form-input>
            </b-input-group>
          </b-form>
        </div>
        <div class="logininput">
          <b-button v-b-modal.modal-1 @click="addUser()">Zapisz nowe hasło</b-button>
        </div>
        <b-alert v-if="registrationError" variant="danger" show>{{ registrationError }}</b-alert>
      </div>
    </div>
  </div>
</template>

<script>
import './../style/style.css';

import Navbar from "@/components/Navbar";
import auth from "@/Model/AuthInstance";

export default {
  name: 'Mainpage',

  data() {
    return {
      password: '',
      confirmPassword: '',
      registrationError: null,
    }
  },
  components: {
    Navbar,
  },

  methods: {
    addUser: function () {
      this.registrationError = null; // Resetuje błąd przed próbą rejestracji

      // Sprawdź, czy hasła są zgodne
      if (this.password !== this.confirmPassword) {
        this.registrationError = 'Hasła nie są zgodne.';
        return;
      }

      // Sprawdź, czy hasło ma minimum 8 znaków
      if (this.password.length < 8) {
        this.registrationError = 'Hasło musi mieć minimum 8 znaków.';
        return;
      }

      // Próba rejestracji użytkownika
      auth.register(this.password)
          .then(() => {
            this.$router.push({path: '/login'});
          })
          .catch(() => {
            this.registrationError = 'Wystąpił błąd podczas rejestracji. Spróbuj ponownie później.';
          });
    },
  }
}
</script>
