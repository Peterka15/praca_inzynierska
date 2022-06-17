<template>
  <div>
    <div class="fixed-top">
      <b-navbar type="dark" variant="dark">
        <b-navbar-nav>
          <b-nav-item href="#">Strona Główna</b-nav-item>

          <!-- Navbar dropdowns -->
          <b-nav-item-dropdown text="Kategorie Artykułów" right>
            <b-dropdown-item href="#">Pożar</b-dropdown-item>
            <b-dropdown-item href="#">Wypadek</b-dropdown-item>
            <b-dropdown-item href="#">Jubileusz</b-dropdown-item>
            <b-dropdown-item href="#">Zabezpieczenie</b-dropdown-item>
          </b-nav-item-dropdown>

          <b-nav-item-dropdown text="Użytkownik" right>
            <b-dropdown-item
                href="https://useme.com/static/images/avatar/empty-neutral.svg?1626173373"></b-dropdown-item>
          </b-nav-item-dropdown>

          <b-nav-item href="#">Nowy artykuł</b-nav-item>
          <b-nav-item href="#">Materiały szkoleniowe</b-nav-item>
        </b-navbar-nav>
      </b-navbar>
    </div>

    <div>
      <div>
        <b-carousel
            id="carousel-1"
            v-model="slide"
            :interval="10000"
            controls
            indicators
            background="#ababab"
            img-width="800"
            img-height="100"
            style="text-shadow: 1px 1px 2px #333;"
            @sliding-start="onSlideStart"
            @sliding-end="onSlideEnd"
        >

          <b-carousel-slide
              caption="Kosmos"
              text="A gdzie to jest?"
              img-src="https://i.picsum.photos/id/223/1920/300.jpg?hmac=WHk_C8Q9apgeqRz-NbmdP9pFqArBQKgpmOjQB8dpoB0"
          ></b-carousel-slide>

          <b-carousel-slide
              caption="Diuna część 2"
              text="nie no nie czytałem"
              img-src="https://i.picsum.photos/id/185/1920/300.jpg?hmac=xQ87hpfVXHZ21qFNIak9k9R4W2L2adbOlxMHxcomqAQ"
          ></b-carousel-slide>

          <b-carousel-slide
              caption="Bardzo wysoko"
              text="Bardzo"
              img-src="https://i.picsum.photos/id/779/1920/300.jpg?hmac=tYHyZfumksUfZTt6_GcB15lsM-O--jclzafxEFme6fU"
          ></b-carousel-slide>

          <b-carousel-slide
              caption="Jeszcze wyżej"
              text="Serio"
              img-src="https://i.picsum.photos/id/961/1920/300.jpg?hmac=k2LeFHUn9sWF-ld554GK_5eWtDxi8JAILduwEQDlaQI"
          ></b-carousel-slide>
        </b-carousel>

      </div>
    </div>


    <b-container>
      <b-row class="background">
        <b-col cols="2" class="panel">
          <h1 class="logo">
            <a href="#">OSP LATARNIA <span>GNIEZNO <b-img
                src="https://i.picsum.photos/id/517/70/50.jpg?hmac=TlaHUUrNdx_l1_ussq_mE2F90F-Alr7pKaHCoPjdBmg" fluid
                alt="Fluid image"></b-img></span></a>

          </h1>
          <div class="nav-wrap">
            <nav class="main-nav" role="navigation">
              <ul class="unstyled list-hover-slide">
                <li><a href="#">Wyszukaj</a></li>
                <li><a href="#">Zaloguj/Wyloguj</a></li>
                <li><a href="#">Dodaj artykuł</a></li>
                <li><a href="#">Materiały szkoleniowe</a></li>
                <li><a href="#">Tagi</a></li>

              </ul>
            </nav>
          </div>
        </b-col>
        <b-col cols="10" class="right_column">
          <div>

            <div class="list_object parent">
              <b-img src="
https://picsum.photos/1024/400/?image=41"
                     fluid alt="Responsive image"></b-img>

              <div class="text">
                <h3>Headline</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent euismod ultrices ante, ac laoreet
                  nulla vestibulum adipiscing. Nam quis justo in augue auctor imperdiet.</p>
                <p><span class="blue">New!</span> <span class="green">More Later!</span></p>
                <div>
                  <a href="url" style="color: red">Edytuj</a>
                </div>
              </div>

            </div>

            <div class="list_object parent">
              <b-img src="https://i.picsum.photos/id/975/1024/400.jpg?hmac=p2IJL0qLWGZqU1vquXLS_77nLmRvZtWxVgDfzlG_S74"
                     fluid alt="Responsive image"></b-img>
              <div class="text">
                <h3>Headline</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent euismod ultrices ante, ac laoreet
                  nulla vestibulum adipiscing. Nam quis justo in augue auctor imperdiet.</p>
                <p><span class="blue">New!</span> <span class="green">More Later!</span></p>
                <a href="url" style="color: red">Edytuj</a>
              </div>
            </div>

            <div class="list_object parent">
              <b-img src="https://i.picsum.photos/id/557/1024/400.jpg?hmac=m4kQHMbdidA5_sDQiWpQtJ8gfuSpdlP_x_2H9rss8KQ"
                     fluid alt="Responsive image"></b-img>
              <div class="text">
                <h3>Headline</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent euismod ultrices ante, ac laoreet
                  nulla vestibulum adipiscing. Nam quis justo in augue auctor imperdiet.</p>
                <p><span class="blue">New!</span> <span class="green">More Later!</span></p>
                <a href="url" style="color: red">Edytuj</a>
              </div>
            </div>

            <div class="list_object parent">
              <b-img src="https://i.picsum.photos/id/557/1024/400.jpg?hmac=m4kQHMbdidA5_sDQiWpQtJ8gfuSpdlP_x_2H9rss8KQ"
                     fluid alt="Responsive image"></b-img>
              <div class="text">
                <h3>Headline</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent euismod ultrices ante, ac laoreet
                  nulla vestibulum adipiscing. Nam quis justo in augue auctor imperdiet.</p>
                <p><span class="blue">New!</span> <span class="green">More Later!</span></p>
                <a href="url" style="color: red">Edytuj</a>
              </div>
            </div>


          </div>
        </b-col>
      </b-row>
    </b-container>


  </div>

</template>

<style>
</style>

<script>
import './../style/style.css';

export default {
  name: 'Mainpage',
}

</script>

