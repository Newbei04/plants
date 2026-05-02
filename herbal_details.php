<?php
include(__DIR__ .'/constant/connect.php');
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "herbalinformation";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $herbal_id = $_GET['id'];

    // Fetch details from the herbal_details table for the specific herbal
    $sqlHerbalDetail = "SELECT * FROM herbal_details WHERE id = $herbal_id";
    $resultHerbalDetail = $con->query($sqlHerbalDetail);

    if ($resultHerbalDetail) {
        $herbalDetail = $resultHerbalDetail->fetch_assoc();
    } else {
        echo "Error: " . $con->error;
    }
} else {
    echo "Herbal ID not provided.";
    exit();
}

// Close the database connection
$con->close();
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

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 30px;
        }

        header {
            margin-bottom: 20px;
        }

        .product-container {
            display: flex;
            justify-content: start;
            align-items: start;
            gap: 40px;
        }

        /* .img-card{
    width: 40%;
} */

        .img-card img {
            width: 100%;
            flex-shrink: 0;
            border-radius: 4px;
            height: 500px;
            object-fit: cover;
        }

        .small-Card {
            display: flex;
            justify-content: start;
            align-items: center;
            margin-top: 15px;
            gap: 12px;
        }

        .small-Card img {
            width: 104px;
            height: 104px;
            border-radius: 4px;
            cursor: pointer;
        }

        .small-Card img:active {
            border: 1px solid #17696a;
        }

        .sm-card {
            border: 2px solid darkred;
        }

        .product-info {
            width: 60%;
        }

        .product-info h3 {
            font-size: 32px;
            font-family: Lato;
            font-weight: 600;
            line-height: 130%;
        }

        .product-info h5 {
            font-size: 24px;
            font-family: Lato;
            font-weight: 500;
            line-height: 130%;
            color: #ff4242;
            margin: 6px 0;
        }

        .product-info del {
            color: #a9a9a9;
        }

        .product-info p {
            color: #424551;
            margin: 15px 0;
            width: 70%;
        }

        .sizes p {
            font-size: 18px;
            color: black;
        }

        .size-option {
            width: 200px;
            height: 30px;
            margin-bottom: 15px;
            padding: 5px;
        }

        .quantity input {
            width: 51px;
            height: 33px;
            margin-bottom: 15px;
            padding: 6px;
        }

        button {
            background: #17696a;
            border-radius: 4px;
            padding: 10px 37px;
            border: none;
            color: white;
            font-weight: 600;
        }

        button:hover {
            background: #ff4242;
            transition: ease-in 0.4s;
        }

        .delivery {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 70%;
            color: #787a80;
            font-size: 12px;
            font-family: Lato;
            line-height: 150%;
            letter-spacing: 1px;
        }

        hr {
            color: #787a80;
            width: 58%;
            opacity: 0.67;
        }

        .pagination {
            color: #787a80;
            margin: 15px 0;
            cursor: pointer;
        }

        @media screen and (max-width: 576px) {
            .product-container {
                flex-direction: column;
            }

            .small-Card img {
                width: 80px;
            }

            .product-info {
                width: 100%;
            }

            echo "# product-details-page-html-css-js">>README.md .product-info p {
                width: 100%;
            }

            .delivery {
                width: 100%;
            }

            hr {
                width: 100%;
            }
        }
    </style>
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
                        <a href="index.php" class="nav__link ">Home</a>
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
                        <a href="about.php" class="nav__link ">About Us</a>
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


    <br><br>
    <br><br>
    <br><br>
    <section class="product-container">

        <!-- left side -->
        <div class="img-card">
            <img src="uploads/<?php echo $herbalDetail['image']; ?>" alt="Herbal Image" />
            <!-- small img -->
        </div>
        <!-- Right side -->
        <div class="product-info">

            <h3>

                <?php echo $herbalDetail['scientific_name']; ?>

            </h3>
            <br>
            <div>
                <p>Meaning:</p>
                <p>
                    <?php echo $herbalDetail['meaning']; ?>
                </p>
                <br>
                <p>Can Use To:</p>
                <p>
                    <?php echo $herbalDetail['can_use_to'] ?>
                </p>
                <br>
                <p>How to Use:</p>
                <p>
                    <?php echo $herbalDetail['how_to_use'] ?>
                </p>
                <br>
                <p>Trivia:</p>
                <p>
                    <?php echo $herbalDetail['trivia'] ?>
                </p>
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