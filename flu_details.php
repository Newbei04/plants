<?php
include(__DIR__ . '/constant/connect.php');
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "herbalinformation";

// $conn = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// if (isset($_GET['id'])) {
//     $category_id = $_GET['id'];

//     $sqlCategoryDetail = "SELECT `id`, `scientific_name`, `herbal_plant` FROM `flucategories` WHERE id = $category_id";
//     $resultCategoryDetail = $con->query($sqlCategoryDetail);

//     if ($resultCategoryDetail) {
//         $categoryDetail = $resultCategoryDetail->fetch_assoc();
//     } else {
//         echo "Error: " . $con->error;
//     }
// } else {
//     echo "Category ID not provided.";
//     exit();
// }

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    $sqlCategoryDetail = "SELECT `id`, `scientific_name`, `herbal_plant` FROM `flucategories` WHERE id = $category_id";
    $resultCategoryDetail = $con->query($sqlCategoryDetail);

    if ($resultCategoryDetail) {
        $categoryDetail = $resultCategoryDetail->fetch_assoc();

        // Explode the comma-separated herbal plants into an array
        $plants = explode(',', $categoryDetail['herbal_plant']);

        // Trim each plant name and wrap in quotes for SQL IN clause
        $plantsEscaped = array_map(function ($plant) use ($con) {
            return "'" . $con->real_escape_string(trim($plant)) . "'";
        }, $plants);

        $plantsIn = implode(',', $plantsEscaped); // e.g. 'Plant A','Plant B'

        // Fetch only matched herbal plants
        $sqlHerbal = "SELECT id, scientific_name, image FROM herbal_details WHERE scientific_name IN ($plantsIn) AND value='0'";
        $resultHerbal = $con->query($sqlHerbal);
    } else {
        echo "Error: " . $con->error;
    }
} else {
    echo "Category ID not provided.";
    exit();
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="shortcut icon" href="assets2/img/logo1.png" type="image/x-icon" />

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />

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

            .md .product-info p {
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
                        <a href="library.php" class="nav__link">Library</a>
                    </li>

                    <li class="nav__item">
                        <a href="categories.php" class="nav__link  active-link">Category</a>
                    </li>
                    <li class="nav__item">
                        <a href="camera.php" class="nav__link">Camera</a>
                    </li>
                    <li class="nav__item">
                        <a href="howtouse.php" class="nav__link">How to Use</a>
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

        <!-- Right side -->
        <div class="product-info">
            <h3 style="font-size: 14px;">
                <?php echo htmlspecialchars($categoryDetail['scientific_name']); ?>
            </h3>
            <br>
            <div>
                <p>Herbal Plants:</p>
                <div class="product__container grid" id="productContainer">
                    <?php
                    if ($resultHerbal && $resultHerbal->num_rows > 0) {
                        while ($row = $resultHerbal->fetch_assoc()) {
                    ?>
                            <article class="product__card herbal">
                                <img src="uploads/<?php echo $row['image']; ?>" width="100" alt="" class="product__img" />
                                <h3 class="product__title">
                                    <?php echo htmlspecialchars($row['scientific_name']); ?>
                                </h3>
                                <a href="herbal_details.php?id=<?php echo $row['id']; ?>" class="button--flex product__button">
                                    <i class="ri-eye-line"></i>
                                </a>
                            </article>
                    <?php
                        }
                    } else {
                        echo "<p>No matching herbal plants found.</p>";
                    }
                    ?>
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