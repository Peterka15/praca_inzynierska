<template>
  <div class="d-flex flex-column align-items-center">
    <div class="card-logo-bg" style="background-image: url('/media/logo.webp')"></div>

    <h1 class="logo mt-4 p-0">
      <router-link to="/" class="m-0 p-0">
        <span v-if="!auth.loggedIn">POWIATOWY SYSTEM OSP</span>
        <span v-else>{{ auth.user.unit.name }}</span>
      </router-link>
    </h1>
  </div>
</template>
<script>
import auth from '@/Model/AuthInstance';

export default {
  name: 'OspLogo',

  data() {
    return {
      auth
    }
  },
};
</script>
