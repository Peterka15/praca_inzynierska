<template>
  <div>
    <navbar>
    </navbar>
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
              img-src="http://localhost:8000/carusel1.jpg"
          ></b-carousel-slide>

          <b-carousel-slide
              caption="Diuna część 2"
              text="nie no nie czytałem"
              img-src="http://localhost:8000/carusel2.jpg"
          ></b-carousel-slide>

          <b-carousel-slide
              caption="Bardzo wysoko"
              text="Bardzo"
              img-src="http://localhost:8000/carusel3.png"
          ></b-carousel-slide>

          <b-carousel-slide
              caption="Jeszcze wyżej"
              text="Serio"
              img-src="http://localhost:8000/carusel4.jpg"
          ></b-carousel-slide>
        </b-carousel>

      </div>
    </div>


    <b-container>
      <b-row class="background">
        <b-col cols="2" class="panel">
          <h1 class="logo">
            <a href="#">OSP LATARNIA <span>GNIEZNO <b-img
                src="http://localhost:8000/logo.png" fluid
                alt="Fluid image"></b-img></span></a>

          </h1>
          <div class="nav-wrap">
            <nav class="main-nav" role="navigation">
              <ul class="unstyled list-hover-slide">
                <li><a href="#">Wyszukaj</a></li>
                <li><a href="http://localhost:8080/addarticle">Dodaj artykuł</a></li>
                <li><a href="http://localhost:8080/materials">Materiały szkoleniowe</a></li>
                <li><a href="#">Tagi</a></li>

              </ul>
            </nav>
          </div>
        </b-col>
        <b-col cols="10" class="right_column">
          <div>

            <div class="list_object parent">
              <b-img src="http://localhost:8000/1.jpg"
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
              <b-img src="http://localhost:8000/2.jpg"
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
              <b-img src="http://localhost:8000/3.jpg"
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
              <b-img src="http://localhost:8000/4.jpg"
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

