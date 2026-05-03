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

  <style>
    /* ===== HOW TO USE PAGE STYLES ===== */
    .howtouse {
      padding: 6rem 0 2rem;
    }

    .howtouse__title {
      font-size: 2rem;
      color: var(--title-color);
      text-align: center;
      margin-bottom: 0.5rem;
    }

    .howtouse__subtitle {
      text-align: center;
      color: var(--text-color);
      margin-bottom: 3rem;
    }

    /* Each "Way" block */
    .howtouse__way {
      margin-bottom: 3rem;
    }

    .howtouse__way + .howtouse__way {
      padding-top: 2.5rem;
      border-top: 1px solid rgba(128, 128, 128, 0.15);
    }

    .howtouse__way-header {
      margin-bottom: 1.5rem;
    }

    .howtouse__way-badge {
      display: inline-block;
      background-color: var(--first-color);
      color: #fff;
      font-size: 0.75rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      padding: 0.25rem 0.9rem;
      border-radius: 2rem;
      margin-bottom: 0.6rem;
    }

    .howtouse__way-title {
      font-size: 1.25rem;
      color: var(--title-color);
      font-weight: 700;
      margin-bottom: 0.35rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .howtouse__way-title i {
      color: var(--first-color);
    }

    .howtouse__way-desc {
      color: var(--text-color);
      font-size: 0.93rem;
    }

    /* Steps grid */
    .howtouse__steps {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 1.25rem;
    }

    .howtouse__card {
      background-color: var(--container-color);
      border-radius: 1rem;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .howtouse__card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    /* Placeholder image area */
    .howtouse__card-img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      display: block;
      background-color: rgba(128, 128, 128, 0.08);
    }

    /* Styled placeholder when no real image yet */
    .howtouse__card-img-placeholder {
      width: 100%;
      height: 160px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background-color: rgba(128, 128, 128, 0.07);
      gap: 0.4rem;
      border-bottom: 1px solid rgba(128, 128, 128, 0.1);
    }

    .howtouse__card-img-placeholder i {
      font-size: 2.5rem;
      color: var(--first-color);
      opacity: 0.5;
    }

    .howtouse__card-img-placeholder span {
      font-size: 0.75rem;
      color: var(--text-color);
      opacity: 0.5;
    }

    /* Card body */
    .howtouse__card-body {
      padding: 1.25rem 1rem 1.5rem;
    }

    .howtouse__step-number {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background-color: var(--first-color);
      color: #fff;
      font-size: 1rem;
      font-weight: 700;
      margin-bottom: 0.6rem;
    }

    .howtouse__card-title {
      font-size: 1rem;
      color: var(--title-color);
      font-weight: 600;
      margin-bottom: 0.4rem;
    }

    .howtouse__card-desc {
      font-size: 0.88rem;
      color: var(--text-color);
      line-height: 1.6;
    }

    /* Replace image hint */
    .howtouse__img-hint {
      display: block;
      font-size: 0.72rem;
      color: var(--text-color);
      opacity: 0.45;
      margin-top: 0.5rem;
      font-style: italic;
    }
  </style>

  <title>How to Use – Our Farm Republic</title>
</head>

<body>
  <!--==================== HEADER ====================-->
  <header class="header" id="header">
    <nav class="nav container">
      <a href="index.php" class="nav__logo">
        <img src="assets2/img/logo1.png" alt="" style="width: 60px" /> Our Farm
        Republic
      </a>

      <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
          <li class="nav__item">
            <a href="index.php" class="nav__link">Home</a>
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
            <a href="howtouse.php" class="nav__link active-link">How to Use</a>
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
        <i class="ri-moon-line change-theme" id="theme-button"></i>
        <div class="nav__toggle" id="nav-toggle">
          <i class="ri-menu-line"></i>
        </div>
      </div>
    </nav>
  </header>

  <main class="main">

    <section class="howtouse section" id="howtouse">
      <div class="container">

        <h1 class="howtouse__title">How to Use Our Farm Republic</h1>
        <p class="howtouse__subtitle">There are three ways to explore and find plants on our platform.</p>

        <div class="howtouse__way">
          <div class="howtouse__way-header">
            <span class="howtouse__way-badge">Way 1</span>
            <h2 class="howtouse__way-title">
              <i class="ri-book-2-line"></i> Browse the Library
            </h2>
            <p class="howtouse__way-desc">
              Explore all available plants and view their full details directly from the library.
            </p>
          </div>
          <div class="howtouse__steps">

            <div class="howtouse__card">
              <div class="howtouse__card-body">
                <span class="howtouse__step-number">1</span>
                <h3 class="howtouse__card-title">Go to Library</h3>
                <p class="howtouse__card-desc">
                  Click on <strong>Library</strong> in the navigation bar to open the full list of plants.
                </p>
              </div>
            </div>

            <div class="howtouse__card">
              <div class="howtouse__card-body">
                <span class="howtouse__step-number">2</span>
                <h3 class="howtouse__card-title">Select a Plant</h3>
                <p class="howtouse__card-desc">
                  Browse through the list and click on any plant that interests you.
                </p>
              </div>
            </div>

            <div class="howtouse__card">
              <div class="howtouse__card-body">
                <span class="howtouse__step-number">3</span>
                <h3 class="howtouse__card-title">View Plant Info</h3>
                <p class="howtouse__card-desc">
                  Read the plant's full profile — its name, description, medicinal uses, and more.
                </p>
              </div>
            </div>

          </div>
        </div>

        <!-- ===== WAY 2: QR CODE ===== -->
        <div class="howtouse__way">
          <div class="howtouse__way-header">
            <span class="howtouse__way-badge">Way 2</span>
            <h2 class="howtouse__way-title">
              <i class="ri-qr-code-line"></i> Scan a QR Code
            </h2>
            <p class="howtouse__way-desc">
              Each plant has its own QR code. Scan it to jump straight to that specific plant's page instantly.
            </p>
          </div>
          <div class="howtouse__steps">

            <div class="howtouse__card">
              <div class="howtouse__card-body">
                <span class="howtouse__step-number">1</span>
                <h3 class="howtouse__card-title">Open the Camera</h3>
                <p class="howtouse__card-desc">
                  Go to the <strong>Camera</strong> page or use your phone's built-in camera app.
                </p>
              </div>
            </div>

            <div class="howtouse__card">
              <div class="howtouse__card-body">
                <span class="howtouse__step-number">2</span>
                <h3 class="howtouse__card-title">Scan the QR Code</h3>
                <p class="howtouse__card-desc">
                  Point your camera at the QR code on the plant's label or display tag and hold steady.
                </p>
              </div>
            </div>

            <div class="howtouse__card">
              <div class="howtouse__card-body">
                <span class="howtouse__step-number">3</span>
                <h3 class="howtouse__card-title">View the Plant</h3>
                <p class="howtouse__card-desc">
                  You will be taken directly to that plant's page — no searching needed!
                </p>
              </div>
            </div>

          </div>
        </div>

        <div class="howtouse__way">
          <div class="howtouse__way-header">
            <span class="howtouse__way-badge">Way 3</span>
            <h2 class="howtouse__way-title">
              <i class="ri-list-check-2"></i> Browse by Category
            </h2>
            <p class="howtouse__way-desc">
              Looking for plants that treat a specific condition? Use Categories to filter by ailment and find the right plant faster.
            </p>
          </div>
          <div class="howtouse__steps">

            <div class="howtouse__card">
              <div class="howtouse__card-body">
                <span class="howtouse__step-number">1</span>
                <h3 class="howtouse__card-title">Go to Category</h3>
                <p class="howtouse__card-desc">
                  Click on <strong>Category</strong> in the navigation bar to see all available ailment categories.
                </p>
              </div>
            </div>

            <div class="howtouse__card">
              <div class="howtouse__card-body">
                <span class="howtouse__step-number">2</span>
                <h3 class="howtouse__card-title">Choose a Condition</h3>
                <p class="howtouse__card-desc">
                  Select a condition — for example, <strong>Flu</strong> — to filter and show only plants effective for that ailment.
                </p>
              </div>
            </div>

            <div class="howtouse__card">
              <div class="howtouse__card-body">
                <span class="howtouse__step-number">3</span>
                <h3 class="howtouse__card-title">View Effective Plants</h3>
                <p class="howtouse__card-desc">
                  Browse the filtered results and click any plant to learn how it helps treat your chosen condition.
                </p>
              </div>
            </div>

          </div>
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