<template>
  <div
      class="w-100 d-flex align-items-center justify-content-center"
      style="height: 100vh; position: fixed; top: 0; left: 0;"
  >
    <b-card
        title="Zmiana hasła"
        sub-title="Wpisz nowe hasło dla Twojego konta"
        style="width: 600px; height: fit-content"
    >
      <b-alert show v-if="setPasswordError" variant="danger" class="mt-3 text-center">{{ setPasswordError }}</b-alert>
      <b-form @submit.prevent="setPassword">
        <b-form-group
            label="Hasło"
            label-for="input-form-input-password"
            description="Wpisz nowe hasło dla Twojego konta."
            class="mt-4"
        >
          <b-form-input
              id="inline-form-input-password"
              v-model="password"
              type="password"
              placeholder="Nowe hasło"
              required
          ></b-form-input>
        </b-form-group>

        <b-form-group
            label="Hasło:"
            label-for="inline-form-input-password-repeat"
            description="Wprowadź ponownie Twoje hasło."
        >
          <b-form-input
              id="inline-form-input-password-repeat"
              v-model="confirmPassword"
              type="password"
              placeholder="Powtórz nowe hasło"
              required
          ></b-form-input>
        </b-form-group>
        <HorizontalStack class="mt-4">
          <b-button variant="secondary" type="button" @click="$router.push({path: getPath(Path.home)})">
            <b-icon-x class="mr-1" scale="1.3" shift-v="-2"/>
            Wróć do strony głównej
          </b-button>
          <b-button variant="primary" type="submit">
            <b-icon-check2 class="mr-1" scale="1" shift-v="-2"/>
            Potwierdź zmianę hasła
          </b-button>
        </HorizontalStack>
      </b-form>
      <template #footer>
        <b-card-text class="text-center">
          Link aktywacyjny nie działa? Skontaktuj się z administratorem portalu.
        </b-card-text>
      </template>
    </b-card>

    <b-modal
        id="passwordSetModal"
        title="Hasło zostało ustawione"
        ok-title="Przejdź do logowania"
        cancel-title="Wróć do strony głównej"
        @ok="$router.push({path: getPath(Path.login)})"
        @cancel="$router.push({path: getPath(Path.home)})"
    >
      <b-alert show variant="success" class="mt-3 text-center">
        Hasło zostało ustawione poprawnie. Możesz teraz zalogować się na swoje konto.
      </b-alert>
    </b-modal>
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
import auth from '@/Model/AuthInstance';
import Path, { getPath } from '@/enum/Path';
import HorizontalStack from '@/components/ui/HorizontalStack.vue';

export default {
  name: 'SetPassword',
  computed: {
    Path () {
      return Path;
    }
  },

  data () {
    return {
      password: '',
      confirmPassword: '',
      setPasswordError: null
    };
  },

  components: {
    HorizontalStack,
    Navbar
  },

  methods: {
    getPath,
    setPassword: function () {
      this.setPasswordError = null;

      if (this.password !== this.confirmPassword) {
        this.setPasswordError = 'Hasła muszą być takie same.';
        return;
      }

      if (this.password.length < 8) {
        this.setPasswordError = 'Hasło musi mieć conajmniej 8 znaków.';
        return;
      }

      const token = this.$route.params.token;
      auth.setPassword(token, this.password)
          .then(() => {
            this.$bvModal.show('passwordSetModal');
          })
          .catch((error) => {
            this.setPasswordError =
                'Wystąpił błąd podczas ustawiania hasła: ' + error.body.message.error?.password?.[0];
          });
    }
  }
};
</script>
