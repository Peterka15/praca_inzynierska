<template>
  <div>
    <navbar/>
    <div class="m_boxcenter m_boxcenterp shadow">
      <h3 class="m_boxfont">LINK AUTORYZACYJNY</h3>
    </div>
    <div class="center centerp shadow">
      <div>
        <h3 class="left_column">POWIATOWY SYSTEM OSP</h3>
      </div>
      <div style="background-color: white; padding: 10px">
        <h5 style="color: green;background-color: white;">Zarejestrowano pomyślnie!</h5>
        <p>Wyślij użytkownikowi ten link, aby ustawił hasło.</p>
        <p>
          <a :href="passwordResetLink" target="_blank" class="password-reset-link">
            link
          </a>
        </p>
        <p style="color: red;"><strong>Uwaga, zapisz ten link, jest unikatowy!</strong></p>
      </div>

      </div>
    </div>

</template>

<style>
</style>

<script>
import Navbar from "@/components/Navbar";



export default {
  name: 'Mainpage',

  data() {
    return {
    }
  },
  components: {
    Navbar,
  },

}

</script>
