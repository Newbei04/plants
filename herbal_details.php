<?php
include(__DIR__ . '/constant/connect.php');

if (isset($_GET['id'])) {
    $herbal_id = (int)$_GET['id'];

    $stmt = $con->prepare("SELECT * FROM herbal_details WHERE id = ?");
    $stmt->bind_param("i", $herbal_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $herbalDetail = $result->fetch_assoc();

    if (!$herbalDetail) {
        echo "Herbal not found.";
        exit();
    }

    // Decode JSON pairs; fallback for legacy comma-separated data
    $pairs = json_decode($herbalDetail['can_use_to'], true);
    if (!is_array($pairs)) {
        $pairs = array_map(fn($u) => [
            'category'   => trim($u),
            'can_use_to' => $herbalDetail['how_to_use'] ?? ''
        ], explode(',', $herbalDetail['can_use_to']));
    }

    $con->close();
} else {
    echo "Herbal ID not provided.";
    exit();
}
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

        .img-card img {
            width: 100%;
            flex-shrink: 0;
            border-radius: 4px;
            height: 500px;
            object-fit: cover;
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

        .product-info p {
            color: #424551;
            margin: 15px 0;
        }

        .info-label {
            font-size: 15px;
            font-weight: 700;
            color: #17696a;
            margin-bottom: 4px;
            margin-top: 16px;
        }

        /* ── Category dropdown ── */
        .category-select-wrapper {
            margin-top: 8px;
        }

        .category-select-wrapper select {
            width: 100%;
            max-width: 360px;
            padding: 10px 14px;
            border: 2px solid #17696a;
            border-radius: 8px;
            font-size: 15px;
            color: #2d2d2d;
            background: #fff;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%2317696a' d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            transition: border-color 0.2s;
        }

        .category-select-wrapper select:focus {
            outline: none;
            border-color: #0f4a4b;
        }

        /* ── How-to-use result box ── */
        #howto-display {
            display: none;
            margin-top: 14px;
            padding: 16px 20px;
            background: #f0faf9;
            border-left: 4px solid #17696a;
            border-radius: 0 8px 8px 0;
            color: #2d2d2d;
            font-size: 15px;
            line-height: 1.7;
            max-width: 520px;
            animation: fadeIn 0.25s ease;
        }

        #howto-display .howto-category-title {
            font-weight: 700;
            color: #17696a;
            margin-bottom: 8px;
            font-size: 15px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── Trivia ── */
        .trivia-box {
            margin-top: 8px;
            padding: 14px 18px;
            background: #fffbf0;
            border-left: 4px solid #e5a800;
            border-radius: 0 8px 8px 0;
            color: #424551;
            font-size: 15px;
            line-height: 1.7;
            max-width: 520px;
        }

        hr {
            color: #787a80;
            width: 58%;
            opacity: 0.67;
            margin: 20px 0;
        }

        @media screen and (max-width: 576px) {
            .product-container {
                flex-direction: column;
            }

            .product-info {
                width: 100%;
            }

            hr {
                width: 100%;
            }

            .category-select-wrapper select {
                max-width: 100%;
            }

            #howto-display {
                max-width: 100%;
            }

            .trivia-box {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav__logo">
                <img src="assets2/img/logo1.png" alt="" style="width: 60px" /> Our Farm Republic
            </a>
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item"><a href="index.php" class="nav__link">Home</a></li>
                    <li class="nav__item"><a href="library.php" class="nav__link active-link">Library</a></li>
                    <li class="nav__item"><a href="categories.php" class="nav__link">Category</a></li>
                    <li class="nav__item"><a href="camera.php" class="nav__link">Camera</a></li>
                    <li class="nav__item"><a href="about.php" class="nav__link">About Us</a></li>
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

    <br><br><br><br><br><br>

    <section class="product-container">

        <!-- Left: Image -->
        <div class="img-card">
            <img src="uploads/<?php echo htmlspecialchars($herbalDetail['image']); ?>"
                alt="<?php echo htmlspecialchars($herbalDetail['scientific_name']); ?>" />
        </div>

        <!-- Right: Info -->
        <div class="product-info">

            <h3><?php echo htmlspecialchars($herbalDetail['scientific_name']); ?></h3>

            <p class="info-label">Meaning</p>
            <p><?php echo htmlspecialchars($herbalDetail['meaning']); ?></p>

            <hr>

            <!-- Category dropdown -->
            <p class="info-label">Select a Category to see how to use</p>
            <div class="category-select-wrapper">
                <select id="category-select" onchange="showHowTo(this.value)">
                    <option value="">-- Choose a category --</option>
                    <?php foreach ($pairs as $index => $pair): ?>
                        <?php if (!empty($pair['category'])): ?>
                            <option value="<?php echo $index; ?>">
                                <?php echo htmlspecialchars($pair['category']); ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- How-to-use result (shown after selection) -->
            <div id="howto-display">
                <div class="howto-category-title" id="howto-title"></div>
                <div id="howto-text"></div>
            </div>

            <hr>
            <p class="info-label">How to Use</p>
            <div class="trivia-box">
                <?php echo nl2br(htmlspecialchars($herbalDetail['how_to_use'])); ?>
            </div>

            <hr>

            <p class="info-label">Trivia</p>
            <div class="trivia-box">
                <?php echo nl2br(htmlspecialchars($herbalDetail['trivia'])); ?>
            </div>

        </div>
    </section>

    <!-- Pairs data passed to JS -->
    <script>
        const pairs = <?php echo json_encode($pairs, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

        function showHowTo(index) {
            const display = document.getElementById('howto-display');
            const titleEl = document.getElementById('howto-title');
            const textEl = document.getElementById('howto-text');

            if (index === '' || !pairs[index]) {
                display.style.display = 'none';
                return;
            }

            const pair = pairs[index];

            titleEl.textContent = pair.category;
            // Replace newlines with <br> for display
            textEl.innerHTML = pair.can_use_to ?
                pair.can_use_to.replace(/\n/g, '<br>') :
                '<em style="color:#999;">No instructions available.</em>';

            display.style.display = 'block';
        }
    </script>

    <!--==================== FOOTER ====================-->
    <footer class="footer section">
        <div class="footer__container container grid">
            <div class="footer__content">
                <a href="#" class="footer__logo">
                    <img src="assets2/img/logo1.png" alt="" style="width: 60px" /> Our Farm Republic
                </a>
                <h3 class="footer__title">
                    There are no incurable diseases only the lack of will.
                    There are no worthless herbs only the lack of knowledge
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

    <a href="#" class="scrollup" id="scroll-up">
        <i class="ri-arrow-up-fill scrollup__icon"></i>
    </a>

    <script src="assets2/js/scrollreveal.min.js"></script>
    <script src="assets2/js/main.js"></script>
</body>

</html>