<template>
  <div
      class="w-100 d-flex align-items-center justify-content-center"
      style="height: 100vh; position: fixed; top: 0; left: 0;"
  >
    <b-card
        title="POWIATOWY SYSTEM OSP"
        sub-title="Zaloguj się do portalu i uzyskaj dostęp do szczegółowych danych OSP."
        style="width: 600px; height: fit-content"
    >
      <b-alert show v-if="loginError" variant="danger" class="mt-3 text-center">{{ loginError }}</b-alert>
      <b-form @submit.prevent="login">
        <b-form-group
            label="Adres email:"
            label-for="input-form-input-name"
            description="Wprowadź Twój adres email."
            class="mt-4"
        >
          <b-form-input
              id="inline-form-input-name"
              v-model="email"
              type="email"
              placeholder="Adres email"
              required
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Hasło:" label-for="inline-form-input-password" description="Wprowadź Twoje hasło.">
          <b-form-input
              id="inline-form-input-password"
              v-model="password"
              type="password"
              placeholder="Hasło"
              required
          ></b-form-input>
        </b-form-group>
        <div class="d-flex justify-content-end">
          <b-button variant="primary" type="submit" class="d-inline">Zaloguj</b-button>
        </div>
      </b-form>
      <template #footer>
        <b-card-text class="text-center">Nie posiadasz konta? Skontaktuj się z administratorem portalu.</b-card-text>
      </template>
    </b-card>
  </div>
</template>

<script>
import auth from '@/Model/AuthInstance';
import Navbar from '@/components/Navbar';

export default {
  components: {
    Navbar,
  },
  data() {
    return {
      email: '',
      password: '',
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
            console.log('CATCH!')
            console.warn(error.body)

            if (error.body) {
              this.loginError = error.body.message.error?.email?.[0] ?? error.body.message.error?.password?.[0];
            } else if (error.response && error.response.status === 401) {
              this.loginError = 'Nieprawidłowe login lub hasło. Spróbuj ponownie.';
            } else {
              this.loginError = 'Wystąpił błąd podczas logowania. Spróbuj ponownie później.';
            }
          });
    },
  },
};

</script>
