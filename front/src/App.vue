<template>
  <div id="app">
    <!--    <Main v-if="auth.loggedIn === false"/> &lt;!&ndash;//było true&ndash;&gt;-->
    <!--  <Mainpage></Mainpage>-->
    <!-- <Loginscreen></Loginscreen>-->
<!--    <Teachingmaterials></Teachingmaterials>-->
    <Article></Article>
  </div>
</template>

<script>

import authInstance from '@/Model/AuthInstance';
// import Mainpage from '@/views/Mainpage';
// import Loginscreen from "@/views/Loginscreen";
// import Teachingmaterials from "@/views/Teachingmaterials";
import Article from "@/views/Article";

export default {
  name: 'App',
  components: {
    Article,
    // Mainpage,
    // Loginscreen,
    // Teachingmaterials,

  },

  data() {
    return {
      auth: authInstance
    };
  },
};
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  margin-top: 56px;
  color: #2c3e50;
}
</style>