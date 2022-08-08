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
            <b-carousel
                id="carousel-1"
                v-model="slide"
                :interval="10000"
                controls
                indicators
                img-width="800"
                img-height="100"
                style="text-shadow: 1px 1px 2px #333;"
                @sliding-start="onSlideStart"
                @sliding-end="onSlideEnd"
            >

              <b-carousel-slide
                  img-src="https://i.picsum.photos/id/223/1920/300.jpg?hmac=WHk_C8Q9apgeqRz-NbmdP9pFqArBQKgpmOjQB8dpoB0"
              ></b-carousel-slide>

              <b-carousel-slide
                  img-src="https://i.picsum.photos/id/185/1920/300.jpg?hmac=xQ87hpfVXHZ21qFNIak9k9R4W2L2adbOlxMHxcomqAQ"
              ></b-carousel-slide>

              <b-carousel-slide
                  img-src="https://i.picsum.photos/id/779/1920/300.jpg?hmac=tYHyZfumksUfZTt6_GcB15lsM-O--jclzafxEFme6fU"
              ></b-carousel-slide>

              <b-carousel-slide
                  img-src="https://i.picsum.photos/id/961/1920/300.jpg?hmac=k2LeFHUn9sWF-ld554GK_5eWtDxi8JAILduwEQDlaQI"
              ></b-carousel-slide>
            </b-carousel>
          </div>
          <div class="article_box shadow">
            <div>
              <h3 class="title">Zawody strażackie na szczeblu powiatowym w Gnieznie</h3>
            </div>
            <div>
              <p class="article_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis at mollis dolor,
                vitae varius dolor. Vestibulum congue bibendum porta. Etiam interdum varius purus eget aliquam. Morbi
                nisi magna, tincidunt sed magna eu, ultricies vulputate lacus. Vestibulum ante ipsum primis in faucibus
                orci luctus et ultrices posuere cubilia curae; In sollicitudin euismod congue. Maecenas sit amet neque
                eu velit tempus facilisis non a arcu. Fusce ex ex, commodo nec auctor vitae, semper at tortor. Duis non
                nibh vel urna vehicula ultricies.</p>
              <p class="article_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis at mollis dolor,
                vitae varius dolor. Vestibulum congue bibendum porta. Etiam interdum varius purus eget aliquam. Morbi
                nisi magna, tincidunt sed magna eu, ultricies vulputate lacus. Vestibulum ante ipsum primis in faucibus
                orci luctus et ultrices posuere cubilia curae; In sollicitudin euismod congue. Maecenas sit amet neque
                eu velit tempus facilisis non a arcu. Fusce ex ex, commodo nec auctor vitae, semper at tortor. Duis non
                nibh vel urna vehicula ultricies.</p>
            </div>
            <div class="article_tagposition">
              <p><span class="blue">New!</span> <span class="green">More Later!</span> <span class="red">dupa</span>
                <span class="orange">janusz</span></p>
            </div>
          </div>

          <div class="add_comment_box shadow">
            <div>
              <h4>Weź udział w dyskusji i dodając komentarz: </h4>
            </div>
            <div class="name_form">
              <input class="name_formp" type="text" id="fname" name="fname" placeholder="Imię i Nazwisko"><br>
            </div>
            <div class="name_form">
<textarea name="comments" id="comments" class="comment_box" placeholder="Pole na komentarz">

</textarea>
              <div style="padding: 8px">
                <b-button variant="primary">Dodaj</b-button>
              </div>
            </div>
          </div>

          <div class="comments_box shadow">
            <div class="comment">
              <p class="commentator_name" > Jan Kowalski</p>
              <p class="comment_text"> Bardzo dobrze chłopcy, oby do przodu!</p>

            </div>

            <div class="comment">
              <p class="commentator_name" > Adolf Kittler</p>
              <p class="comment_text"> Guten Tag_old, Ja ja!</p>

            </div>

            <div class="comment">
              <p class="commentator_name" > Łysy z brazzers</p>
              <p class="comment_text"> Very nice, gniezno, good job</p>

            </div>

            <div>

            </div>

          </div>


        </b-col>
      </b-row>
    </b-container>

  </div>
</template>

<script>
import './../style/style.css';

export default {
  name: 'Mainpage',
}
</script>