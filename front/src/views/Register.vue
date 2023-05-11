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
            <b-button variant="primary" @click="addUser()">Zarejestruj się</b-button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="isSuccess">sukcess, możesz się zalogować</div>
    <div v-if="isError">wystąpił błąd, sprobuj ponownie</div>
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
      isError: false,
      isSuccess: false,
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

          }).catch(() => {
            this.isSuccess = false;
            this.isError = true;
      })
    }
  }
}

</script>