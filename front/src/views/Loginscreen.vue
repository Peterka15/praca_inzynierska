<template>
  <div>
  <navbar/>


    <div class="m_boxcenter m_boxcenterp shadow">
      <h3 class="m_boxfont">LOGOWANIE</h3>
    </div>

    <div class="center centerp shadow">
      <div>
        <h3 class="left_column">OSP LATARNIA GNIEZNO</h3>
      </div>
      <div>
        <div class="logininput">
          <b-form @submit.prevent="login" style="margin: 5px">
            <label class="sr-only">E-mail</label>
            <b-form-input
                id="inline-form-input-name"
                v-model="email"
                class="mb-2 mr-sm-2 mb-sm-0"
                placeholder="E-mail"

            ></b-form-input>
            <label class="sr-only">Hasło</label>
            <b-input-group class="mb-2 mr-sm-2 mb-sm-0">
              <b-form-input type="password" id="inline-form-input-username" v-model="password"
                            placeholder="Hasło"></b-form-input>
            </b-input-group>
            <b-button variant="primary" type="submit">Zaloguj</b-button>
          </b-form>
          <b-button :to="{ path: '/register'}">Rejestracja</b-button>

        </div>
        <b-alert v-if="loginError" variant="danger" show>{{ loginError }}</b-alert>
      </div>
    </div>
  </div>

</template>

<style>
</style>


<script>
import auth from "@/Model/AuthInstance";
import Navbar from "@/components/Navbar";

export default {
  components: {
    Navbar,
  },
  data() {
    return {
      email: "",
      password: "",
      loginError: null,
    };
  },


  methods: {
    login() {
      auth.login(this.email, this.password)
          .then(() => {
            this.$router.push({path: '/'});
          })
          .catch((error) => {
            // Obsługa błędu nieprawidłowego hasła
            if (error.response && error.response.status === 400) {
              this.loginError = 'Nieprawidłowe login lub hasło. Spróbuj ponownie.';
            } else {
              this.loginError = 'Wystąpił błąd podczas logowania. Spróbuj ponownie później.';
            }
          });
    },
  },
};

</script>
