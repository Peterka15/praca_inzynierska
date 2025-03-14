<template>
  <div id="app">
    <Navbar/>
    <router-view/>
  </div>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
}

.card {
  border-radius: 0.75em !important;
  overflow: hidden;
}

</style>

<script>
import Navbar from '@/components/Navbar.vue';

export default {
  name: 'App',
  components: {
    Navbar
  }
};
</script>
