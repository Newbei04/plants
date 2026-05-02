<?php
include('../constant/connect.php');
// Assuming you have a database connection
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "herbalinformation";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// Fetch data from both herbal_details and not_herbal_details tables
$sqlHerbal = "SELECT id, scientific_name, image FROM herbal_details";
$resultHerbal = $con->query($sqlHerbal);

$sqlNotHerbal = "SELECT id, scientific_name, image FROM not_herbal_details";
$resultNotHerbal = $con->query($sqlNotHerbal);
?>
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
                        <a href="index.php" class="nav__link">Home</a>
                    </li>
                    <li class="nav__item">
                        <a href="library.php" class="nav__link active-link">Library</a>
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



    <!--==================== PRODUCTS ====================-->
    <section class="product section container" id="products">
        <h2 class="section__title-center">
            Herbal and Not Herbal
        </h2>

        <div class="search-container">
            <div class="search-wrapper">
                <input type="text" id="searchInput" placeholder="Search ">
                <button onclick="searchProducts()">Search</button>
            </div>
        </div>

        <div class="product__container grid" id="productContainer">
            <?php
            // Check if the queries were successful
            if ($resultHerbal && $resultNotHerbal) {
                while ($row = $resultHerbal->fetch_assoc()) {
                    ?>
                    <article class="product__card herbal">
                        <img src="uploads/<?php echo $row['image']; ?>" width="100" alt="" class="product__img" />
                        <h3 class="product__title">
                            <?php echo $row['scientific_name']; ?>
                        </h3>
                        <a href="herbal_details.php?id=<?php echo $row['id']; ?>" class="button--flex product__button">
                            <i class="ri-eye-line"></i>
                        </a>
                    </article>
                    <?php
                }

                while ($row = $resultNotHerbal->fetch_assoc()) {
                    ?>
                    <article class="product__card not-herbal">
                        <img src="uploads/<?php echo $row['image']; ?>" alt="" class="product__img" />
                        <h3 class="product__title">
                            <?php echo $row['scientific_name']; ?>
                        </h3>
                        <a href="notherbal_details.php?id=<?php echo $row['id']; ?>" class="button--flex product__button">
                            <i class="ri-eye-line"></i>
                        </a>
                    </article>
                    <?php
                }
            } else {
                echo "Error: " . $con->error;
            }
            ?>
        </div>

        <!-- Search not found message -->
        <p id="searchNotFound" style="text-align: center; display: none;">No results found.</p>
    </section>

    <script>
        function searchProducts() {
            var input, filter, cards, cardContainer, title, i, found;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            cardContainer = document.getElementById("productContainer");
            cards = cardContainer.getElementsByClassName("product__card");
            found = false;

            for (i = 0; i < cards.length; i++) {
                title = cards[i].querySelector(".product__title");
                var category = cards[i].classList.contains("herbal") ? "herbal" : "not-herbal";
                if (title.innerText.toUpperCase().indexOf(filter) > -1 && (category === "herbal" || category === "not-herbal")) {
                    cards[i].style.display = "";
                    found = true;
                } else {
                    cards[i].style.display = "none";
                }
            }

            // Display search not found message
            var searchNotFound = document.getElementById("searchNotFound");
            if (!found) {
                searchNotFound.style.display = "block";
            } else {
                searchNotFound.style.display = "none";
            }
        }
    </script>

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