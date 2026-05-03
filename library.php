<?php
include('./constant/connect.php');

// Fetch distinct scientific_name (disease/category) from flucategories
$sqlCategories = "SELECT DISTINCT `scientific_name` FROM `flucategories` WHERE 1 ORDER BY `scientific_name` ASC";
$resultCategories = $con->query($sqlCategories);
$categories = [];
while ($cat = $resultCategories->fetch_assoc()) {
    $categories[] = trim($cat['scientific_name']);
}

// Build a map: scientific_name of plant => array of disease categories it belongs to
// e.g. "Aloe vera" => ["Common Flu (Influenza)", "Fever"]
$sqlMap = "SELECT `scientific_name`, `herbal_plant` FROM `flucategories`";
$resultMap = $con->query($sqlMap);
$plantCategoryMap = []; // plant name (lowercase) => [category1, category2, ...]
while ($row = $resultMap->fetch_assoc()) {
    $disease = trim($row['scientific_name']);
    $plants  = explode(',', $row['herbal_plant']);
    foreach ($plants as $plant) {
        $plantKey = strtolower(trim($plant));
        if (!isset($plantCategoryMap[$plantKey])) {
            $plantCategoryMap[$plantKey] = [];
        }
        $plantCategoryMap[$plantKey][] = strtolower($disease);
    }
}

// Fetch herbal details
$sqlHerbal = "SELECT id, scientific_name, image FROM herbal_details WHERE value='0'";
$resultHerbal = $con->query($sqlHerbal);

// Fetch not-herbal details
$sqlNotHerbal = "SELECT id, scientific_name, image FROM not_herbal_details WHERE value='0'";
$resultNotHerbal = $con->query($sqlNotHerbal);
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
        .filter-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .filter-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-color, #555);
            text-transform: uppercase;
            letter-spacing: 0.05rem;
            margin-right: 0.4rem;
        }

        .filter-group {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.6rem;
        }

        .filter-btn {
            padding: 0.45rem 1.1rem;
            border: 2px solid var(--first-color, #4CAF50);
            background-color: transparent;
            color: var(--first-color, #4CAF50);
            border-radius: 2rem;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background-color: var(--first-color, #4CAF50);
            color: #fff;
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

    <!--==================== PRODUCTS ====================-->
    <section class="product section container" id="products">
        <h2 class="section__title-center">Herbal and Not Herbal</h2>

        <!-- Search -->
        <div class="search-container">
            <div class="search-wrapper">
                <input type="text" id="searchInput" placeholder="Search" oninput="filterProducts()">
                <button onclick="filterProducts()">Search</button>
            </div>
        </div>

        <!-- Filters -->
        <div class="filter-section">

            <!-- Row 1: Type Filter -->
            <div class="filter-group" id="typeFilterGroup">
                <span class="filter-label">Type:</span>
                <button class="filter-btn active" onclick="setFilter('type', 'all', this)">All</button>
                <button class="filter-btn" onclick="setFilter('type', 'herbal', this)">Herbal</button>
                <button class="filter-btn" onclick="setFilter('type', 'not-herbal', this)">Not Herbal</button>
            </div>

            <!-- Row 2: Category Filter (scientific_name = disease from flucategories) -->
            <div class="filter-group" id="categoryFilterGroup">
                <span class="filter-label">Category:</span>
                <button class="filter-btn active" onclick="setFilter('category', 'all', this)">All</button>
                <?php foreach ($categories as $cat): ?>
                    <button class="filter-btn" onclick="setFilter('category', '<?php echo htmlspecialchars(strtolower($cat)); ?>', this)">
                        <?php echo htmlspecialchars($cat); ?>
                    </button>
                <?php endforeach; ?>
            </div>

        </div>

        <!-- Product Grid -->
        <div class="product__container grid" id="productContainer">
            <?php
            if ($resultHerbal && $resultNotHerbal) {
                while ($row = $resultHerbal->fetch_assoc()) {
                    $name    = htmlspecialchars($row['scientific_name']);
                    $nameKey = strtolower(trim($row['scientific_name']));
                    $plantCategories = isset($plantCategoryMap[$nameKey])
                        ? json_encode($plantCategoryMap[$nameKey])
                        : '[]';
            ?>
                    <article class="product__card"
                        data-type="herbal"
                        data-name="<?php echo strtolower($name); ?>"
                        data-categories='<?php echo $plantCategories; ?>'>
                        <a href="herbal_details.php?id=<?php echo $row['id']; ?>">
                            <img src="uploads/<?php echo $row['image']; ?>" width="100" alt="" class="product__img" />
                            <h3 class="product__title"><?php echo $name; ?></h3>
                        </a>
                    </article>
                <?php
                }

                while ($row = $resultNotHerbal->fetch_assoc()) {
                    $name    = htmlspecialchars($row['scientific_name']);
                    $nameKey = strtolower(trim($row['scientific_name']));
                    $plantCategories = isset($plantCategoryMap[$nameKey])
                        ? json_encode($plantCategoryMap[$nameKey])
                        : '[]';
                ?>
                    <article class="product__card"
                        data-type="not-herbal"
                        data-name="<?php echo strtolower($name); ?>"
                        data-categories='<?php echo $plantCategories; ?>'>
                        <a href="notherbal_details.php?id=<?php echo $row['id']; ?>">
                            <img src="uploads/<?php echo $row['image']; ?>" alt="" class="product__img" />
                            <h3 class="product__title"><?php echo $name; ?></h3>
                        </a>
                    </article>
            <?php
                }
            } else {
                echo "Error: " . $con->error;
            }
            ?>
        </div>

        <p id="searchNotFound" style="text-align: center; display: none;">No results found.</p>
    </section>

    <script>
        const activeFilters = {
            type: 'all',
            category: 'all'
        };

        function setFilter(group, value, btn) {
            activeFilters[group] = value;

            btn.closest('.filter-group').querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            filterProducts();
        }

        function filterProducts() {
            const searchValue = document.getElementById('searchInput').value.toUpperCase();
            const cards = document.querySelectorAll('#productContainer .product__card');
            let found = false;

            cards.forEach(card => {
                const cardType = card.getAttribute('data-type');
                const titleText = card.querySelector('.product__title').innerText.toUpperCase();
                // data-categories is a JSON array of disease names (lowercase) this plant belongs to
                const cardCategories = JSON.parse(card.getAttribute('data-categories') || '[]');

                const matchesSearch = titleText.includes(searchValue);
                const matchesType = activeFilters.type === 'all' || cardType === activeFilters.type;
                // Check if the selected disease category is in the plant's categories array
                const matchesCategory = activeFilters.category === 'all' || cardCategories.includes(activeFilters.category);

                if (matchesSearch && matchesType && matchesCategory) {
                    card.style.display = '';
                    found = true;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('searchNotFound').style.display = found ? 'none' : 'block';
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
                    There are no incurable diseases only the lack of will. There are no worthless herbs only the lack of knowledge
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