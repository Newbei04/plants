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
    <script type="text/javascript" src="https://rawcdn.githack.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/instascan@1.0.0/instascan.min.js"></script> -->

    <title>Our Farm Republic</title>
</head>


<body>
    <style>
        #qrScanner {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        /* Add this CSS for mobile responsiveness */
        @media only screen and (max-width: 768px) {

            /* Adjust styles for smaller screens */
            #qrScanner {
                padding: 20px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
            }

            #scanner {
                width: 100%;
                max-width: 100%;
                height: auto;
            }

            .section__title-center {
                font-size: 1.5rem;
            }
        }
    </style>
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
                        <a href="library.php" class="nav__link">Library</a>
                    </li>

                    <li class="nav__item">
                        <a href="categories.php" class="nav__link">Category</a>
                    </li>
                    <li class="nav__item">
                        <a href="camera.php" class="nav__link active-link">Camera</a>
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



    <body>
        <!-- Add this section for the QR code scanner -->
        <section class="section container" id="qrScanner">
            <h2 class="section__title-center">QR Code Scanner</h2>

            <select id="camera-select" style="margin-bottom: 20px; padding: 10px; border-radius: 5px;"></select>

            <video id="scanner"></video>
        </section>
    </body>


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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Performance Fix for Chrome Canvas warning
        (function() {
            const nativeGetContext = HTMLCanvasElement.prototype.getContext;
            HTMLCanvasElement.prototype.getContext = function(type, attributes) {
                if (type === '2d') {
                    attributes = {
                        ...attributes,
                        willReadFrequently: true
                    };
                }
                return nativeGetContext.call(this, type, attributes);
            };
        })();

        let scannerElement = document.getElementById('scanner');
        let cameraSelect = document.getElementById('camera-select');

        let scanner = new Instascan.Scanner({
            video: scannerElement,
            mirror: true
        });

        // 2. Scan Logic
        scanner.addListener('scan', function(content) {
            if (content.includes('herbal')) {
                window.location.href = 'herbal_details.php?id=' + content;
            } else {
                window.location.href = 'herbalandnotherbal_details.php?id=' + content;
            }
        });

        // 3. Robust Camera Control
        let availableCameras = [];
        let isTransitioning = false; // Prevents FsmError

        async function startCamera(cam) {
            if (isTransitioning) return;
            isTransitioning = true;

            try {
                await scanner.start(cam);
                console.log("Camera started successfully");
            } catch (e) {
                if (e.name === 'NotReadableError') {
                    alert("Camera busy. Please switch to the USB WebCam and ensure OBS is not hijacking the feed.");
                } else {
                    console.warn("Scanner start issue:", e.message);
                }
            } finally {
                isTransitioning = false;
            }
        }

        // Initialize Cameras
        Instascan.Camera.getCameras().then(function(cameras) {
            availableCameras = cameras;
            if (cameras.length > 0) {
                cameraSelect.innerHTML = '';
                cameras.forEach((camera, index) => {
                    let option = document.createElement('option');
                    option.value = index;
                    option.text = camera.name || `Camera ${index + 1}`;
                    cameraSelect.appendChild(option);
                });

                // Start default
                startCamera(cameras[0]);

                // 4. Fixed Switching Logic to avoid FsmError
                cameraSelect.addEventListener('change', async function() {
                    const selectedIndex = this.value;

                    try {
                        // Stop current session first
                        await scanner.stop();
                    } catch (fsmError) {
                        // If it's already stopped or transitioning, we ignore the error and move on
                        console.log("Cleanup: Scanner was not in a stoppable state, proceeding anyway.");
                    }

                    // Hard-clear the video element to release hardware
                    if (scannerElement.srcObject) {
                        scannerElement.srcObject.getTracks().forEach(track => track.stop());
                        scannerElement.srcObject = null;
                    }

                    // Small delay to allow hardware to breathe
                    setTimeout(() => {
                        startCamera(availableCameras[selectedIndex]);
                    }, 300);
                });

            } else {
                cameraSelect.innerHTML = '<option>No cameras detected</option>';
            }
        }).catch(e => console.error(e));
    });
</script>

</html>