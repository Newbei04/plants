<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!--=============== FAVICON ===============-->
  <link rel="shortcut icon" href="assets2/img/logo1.png" type="image/x-icon" />

  <!--=============== REMIX ICONS ===============-->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />

  <!--=============== CSS ===============-->
  <link rel="stylesheet" href="assets2/css/styles.css" />

  <title>Our Farm Republic</title>
</head>

<body>
  <!--==================== HEADER ====================-->
  <header class="header" id="header">
    <nav class="nav container">
      <a href="#" class="nav__logo">
        <img src="assets2/img/logo1.png" alt="" style="width: 60px" /> Our Farm
        Republic
      </a>

      <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
          <li class="nav__item">
            <a href="index.php" class="nav__link active-link">Home</a>
          </li>
          <li class="nav__item">
            <a href="library.php" class="nav__link">Library</a>
          </li>

          <li class="nav__item">
            <a href="categories.php" class="nav__link">Category</a>
          </li>
          <li class="nav__item">
            <a href="camera.php" class="nav__link">Camera</a>
          </li>
          <li class="nav__item">
            <a href="about.php" class="nav__link">About Us</a>
          </li>
        </ul>

        <div class="nav__close" id="nav-close">
          <i class="ri-close-line"></i>
        </div>
      </div>

      <div class="nav__btns">
        <!-- Theme change button -->
        <i class="ri-moon-line change-theme" id="theme-button"></i>

        <div class="nav__toggle" id="nav-toggle">
          <i class="ri-menu-line"></i>
        </div>
      </div>
    </nav>
  </header>

  <main class="main">
    <!--==================== HOME ====================-->
    <section class="home" id="home">
      <div class="home__container container grid">
        <img src="assets2/img/home.png" alt="" class="home__img" />

        <div class="home__data">
          <h1 class="home__title">
            Plants will make <br />
            your life better
          </h1>
          <p class="home__description">
            There are no incurable diseases only the lack of will. There are
            no worthless herbs only the lack of knowledge
          </p>

        </div>

        <div class="home__social">
          <div class="home__social-links"></div>
        </div>
      </div>
    </section>





    <!--==================== FOOTER ====================-->
    <footer class="footer section">
      <div class="footer__container container grid">
        <div class="footer__content">
          <a href="#" class="footer__logo">
            <img src="assets2/img/logo1.png" alt="" style="width: 60px" /> Our
            Farm Republic
          </a>

          <h3 class="footer__title">
            There are no incurable diseases only the lack of will. There are no
            worthless herbs only the lack of knowledge
          </h3>
        </div>

        <div class="footer__content">
          <h3 class="footer__title">Our Address</h3>

          <ul class="footer__data">
            <li class="footer__information">Sitio Mangga,</li>
            <li class="footer__information">Torre 2nd and Pogon</li>
            <li class="footer__information">Lomboy Mangatarem</li>
          </ul>
        </div>

        <div class="footer__content">
          <h3 class="footer__title">Contact Us</h3>

          <ul class="footer__data">
            <li class="footer__information">+999 888 777</li>
          </ul>
        </div>

        <div class="footer__content">
          <h3 class="footer__title">Company</h3>

          <div class="footer__cards">
            <li class="footer__information">OUR FARM REPUBLIC</li>
          </div>
        </div>
      </div>
    </footer>

    <!--=============== SCROLL UP ===============-->
    <a href="#" class="scrollup" id="scroll-up">
      <i class="ri-arrow-up-fill scrollup__icon"></i>
    </a>

    <!--=============== SCROLL REVEAL ===============-->
    <script src="assets2/js/scrollreveal.min.js"></script>

    <!--=============== MAIN JS ===============-->
    <script src="assets2/js/main.js"></script>
</body>

</html>