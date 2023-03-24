<template>
  <!-- NAVBAR? -->
  <div>
    <div class="m_boxcenter m_boxcenterp shadow">
      <h3 class="m_boxfont">LOGOWANIE</h3>
    </div>

    <div class="center centerp shadow">
      <div>
        <h3 class="left_column">OSP LATARNIA GNIEZNO</h3>
      </div>
      <div>
        <div class="logininput">
          <b-form @submit.prevent="login">
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
        </div>
      </div>

    </div>
  </div>
</template>

<style>
</style>


<script>
import auth from "@/Model/AuthInstance";

export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    login() {
      // TODO: NAPRAWIĆ PRZEKIEROWANIE
      auth.login(this.email, this.password)
          .then(() => {
            this.$router.push({ name: 'Mainpage' });
          })
    },
  },
};

</script>
