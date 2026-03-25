<?php
// Include header
require_once 'assets/includes/header.php';
// Include database connection
require_once 'assets/config/db.php';
// Show errors
require_once 'assets/includes/display_errors.php';
?>

<main>
    <!-- HERO SECTION -->
    <section class="hero text-center py-5" style="background-color: #dcd1db; font-family: Helvetica, sans-serif;">
        <div class="container py-5">
            <h1 class="display-5 mb-3 fw-bold text-dark">
                Need a creative professional?
            </h1>
            <p class="lead mt-3 mx-auto" style="max-width: 550px;">
                Browse thousands of proffessional portfolios, hire directly, or add job listing to easily find a match for your project!
            </p>

            <!-- BUTTONS -->
            <a href="#" class="btn btn- btn-lg mt-4 mx-2 rounded-4" style="width: 200px; background-color: #7e1f86; color: white;">Find designers <i class="fa-solid fa-angle-right"></i></a>
            <a href="#" class="btn btn- btn-lg mt-4 mx-2 rounded-4" style="width: 200px; background-color: #3b3b58; color: white;">list a job <i class="fa-solid fa-angle-right"></i></a>
        </div>
    </section>

    <!-- FEATURED PORTFOLIO CARDS - ROW 1 -->
    <section class="features py-4 pb-1">
        <div class="container text-center">
            <h3 class="mb-3 text-secondary-emphasis">Featured portfolios</h3>

            <!-- position-relative allows absolute positioning for arrow buttons -->
            <div class="position-relative">
                <!-- LEFT ARROW BUTTON -->
                <button class="position-absolute top-50 translate-middle-y border-0"
                    style="left: -50px; z-index: 10; background: none; cursor: pointer;"
                    onclick="document.getElementById('cardsContainer').scrollLeft -= 370">
                    <!-- On click: scroll 370px to the left -->
                    <i class="fa-solid fa-chevron-left fa-2x"></i>
                    <!-- left: -50px moves the button 50px outside to the left -->
                    <!-- top-50 translate-middle-y centers the button vertically -->
                </button>

                <!-- SCROLL CONTAINER - portfolio cards row 1 -->
                <div id="cardsContainer" class="d-flex overflow-auto pb-3" style="scroll-behavior: smooth; gap: 30px; scrollbar-width: none;">
                    <!-- pb-3 adds space under the cards -->
                    <!-- gap: 20px sets spacing between each card -->
                    <!-- scrollbar-width: none hides the scrollbar in Firefox -->

                    <!-- PORTFOLIO CARD 1 -->
                    <div class="flex-shrink-0" style="width: 350px;">
                        <div class="feature-card border rounded-4 p-3 shadow" style="height: 350px;">
                            <!-- Clickable image linking to the user's profile -->
                            <a href="profile.php" class="text-decoration-none">
                                <img src="assets/Images/portfolio.exempel1.jpg" class="rounded-3 mb-3" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer;" alt="Portfolio 1">
                            </a>
                            <!-- TITLE AND PROFILE ICON -->
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Portfolio Title</h5>
                                <!-- Link to the profile -->
                                <a href="profile.php" class="text-dark">
                                    <!-- fa-2x makes the icon twice as large -->
                                    <i class="fa-regular fa-circle-user fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- PORTFOLIO CARD 2 -->
                    <div class="flex-shrink-0" style="width: 350px;">
                        <div class="feature-card border rounded-4 p-3 shadow" style="height: 350px;">
                            <!-- Clickable image linking to the user's profile -->
                            <a href="profile.php" class="text-decoration-none">
                                <img src="assets/Images/portfolio.exempel2.png" class="rounded-3 mb-3" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer;" alt="Portfolio 1">
                            </a>
                            <!-- TITLE AND PROFILE ICON -->
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Portfolio Title</h5>
                                <!-- Link to the profile -->
                                <a href="profile.php" class="text-dark">
                                    <!-- fa-2x makes the icon twice as large -->
                                    <i class="fa-regular fa-circle-user fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- PORTFOLIO CARD 3 -->
                    <div class="flex-shrink-0" style="width: 350px;">
                        <div class="feature-card border rounded-4 p-3 shadow" style="height: 350px;">
                            <!-- Clickable image linking to the user's profile -->
                            <a href="profile.php" class="text-decoration-none">
                                <img src="assets/Images/portfolio.exempel3.png" class="rounded-3 mb-3" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer;" alt="Portfolio 1">
                            </a>
                            <!-- TITLE AND PROFILE ICON -->
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Portfolio Title</h5>
                                <!-- Link to the profile -->
                                <a href="profile.php" class="text-dark">
                                    <!-- fa-2x makes the icon twice as large -->
                                    <i class="fa-regular fa-circle-user fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- PORTFOLIO CARD 4 -->
                    <div class="flex-shrink-0" style="width: 350px;">
                        <div class="feature-card border rounded-4 p-3 shadow" style="height: 350px;">
                            <!-- Clickable image linking to the user's profile -->
                            <a href="profile.php" class="text-decoration-none">
                                <img src="assets/Images/portfolio.exempel2.png" class="rounded-3 mb-3" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer;" alt="Portfolio 1">
                            </a>
                            <!-- TITLE AND PROFILE ICON -->
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Portfolio Title</h5>
                                <!-- Link to the profile -->
                                <a href="profile.php" class="text-dark">
                                    <!-- fa-2x makes the icon twice as large -->
                                    <i class="fa-regular fa-circle-user fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT ARROW BUTTON -->
                    <button class="position-absolute top-50 translate-middle-y border-0"
                        style="right: -50px; z-index: 10; background: none; cursor: pointer;"
                        onclick="document.getElementById('cardsContainer').scrollLeft += 370">
                        <!-- On click: scroll 370px to the right -->
                        <!-- 370px = card width (350px) + spacing (20px) -->
                        <!-- right: -50px moves the button 50px outside to the right -->
                        <i class="fa-solid fa-chevron-right fa-2x"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURED PORTFOLIO CARDS - ROW 2 -->
    <section class="features py-1">
        <div class="container text-center">
            <h3 class="mb-3 text-secondary-emphasis">Newcomers</h3>

            <!-- position-relative allows absolute positioning for arrow buttons -->
            <div class="position-relative">
                <!-- LEFT ARROW BUTTON -->
                <button class="position-absolute top-50 translate-middle-y border-0"
                    style="left: -50px; z-index: 10; background: none; cursor: pointer;"
                    onclick="document.getElementById('cardsContainer2').scrollLeft -= 370">
                    <!-- On click: scroll 370px to the left -->
                    <i class="fa-solid fa-chevron-left fa-2x"></i>
                    <!-- left: -50px moves the button 50px outside to the left -->
                    <!-- top-50 translate-middle-y centers the button vertically -->
                </button>

                <!-- SCROLL CONTAINER - portfolio cards row 2 -->
                <div id="cardsContainer2" class="d-flex overflow-auto pb-1" style="scroll-behavior: smooth; gap: 30px; scrollbar-width: none;">
                    <!-- pb-3 adds space under the cards -->
                    <!-- gap: 20px sets spacing between each card -->
                    <!-- scrollbar-width: none hides the scrollbar in Firefox -->

                    <!-- PORTFOLIO CARD 1 -->
                    <div class="flex-shrink-0" style="width: 350px;">
                        <div class="feature-card border rounded-4 p-3 shadow" style="height: 350px;">
                            <!-- Clickable image linking to the user's profile -->
                            <a href="profile.php" class="text-decoration-none">
                                <img src="assets/Images/portfolio.exempel3.png" class="rounded-3 mb-3" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer;" alt="Portfolio 1">
                            </a>
                            <!-- TITLE AND PROFILE ICON -->
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Portfolio Title</h5>
                                <!-- Link to the profile -->
                                <a href="profile.php" class="text-dark">
                                    <!-- fa-2x makes the icon twice as large -->
                                    <i class="fa-regular fa-circle-user fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- PORTFOLIO CARD 2 -->
                    <div class="flex-shrink-0" style="width: 350px;">
                        <div class="feature-card border rounded-4 p-3 shadow" style="height: 350px;">
                            <!-- Clickable image linking to the user's profile -->
                            <a href="profile.php" class="text-decoration-none">
                                <img src="assets/Images/portfolio.exempel2.png" class="rounded-3 mb-3" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer;" alt="Portfolio 1">
                            </a>
                            <!-- TITLE AND PROFILE ICON -->
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Portfolio Title</h5>
                                <!-- Link to the profile -->
                                <a href="profile.php" class="text-dark">
                                    <!-- fa-2x makes the icon twice as large -->
                                    <i class="fa-regular fa-circle-user fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- PORTFOLIO CARD 3 -->
                    <div class="flex-shrink-0" style="width: 350px;">
                        <div class="feature-card border rounded-4 p-3 shadow" style="height: 350px;">
                            <!-- Clickable image linking to the user's profile -->
                            <a href="profile.php" class="text-decoration-none">
                                <img src="assets/Images/portfolio.exempel1.jpg" class="rounded-3 mb-3" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer;" alt="Portfolio 1">
                            </a>
                            <!-- TITLE AND PROFILE ICON -->
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Portfolio Title</h5>
                                <!-- Link to the profile -->
                                <a href="profile.php" class="text-dark">
                                    <!-- fa-2x makes the icon twice as large -->
                                    <i class="fa-regular fa-circle-user fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- PORTFOLIO CARD 4 -->
                    <div class="flex-shrink-0" style="width: 350px;">
                        <div class="feature-card border rounded-4 p-3 shadow" style="height: 350px;">
                            <!-- Clickable image linking to the user's profile -->
                            <a href="profile.php" class="text-decoration-none">
                                <img src="assets/Images/portfolio.exempel2.png" class="rounded-3 mb-3" style="width: 100%; height: 250px; object-fit: cover; cursor: pointer;" alt="Portfolio 1">
                            </a>
                            <!-- TITLE AND PROFILE ICON -->
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Portfolio Title</h5>
                                <!-- Link to the profile -->
                                <a href="profile.php" class="text-dark">
                                    <!-- fa-2x makes the icon twice as large -->
                                    <i class="fa-regular fa-circle-user fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT ARROW BUTTON -->
                    <button class="position-absolute top-50 translate-middle-y border-0"
                        style="right: -50px; z-index: 10; background: none; cursor: pointer;"
                        onclick="document.getElementById('cardsContainer2').scrollLeft += 370">
                        <!-- On click: scroll 370px to the right -->
                        <!-- 370px = card width (350px) + spacing (20px) -->
                        <!-- right: -50px moves the button 50px outside to the right -->
                        <i class="fa-solid fa-chevron-right fa-2x"></i>
                    </button>
                </div>

                <!-- CSS TO HIDE THE SCROLLBAR IN CHROME/SAFARI/EDGE -->
                <!-- ::-webkit-scrollbar targets scrollbars in WebKit-based browsers -->
                <!-- display: none hides the scrollbar completely -->
                <style>
                    #cardsContainer::-webkit-scrollbar,
                    #cardsContainer2::-webkit-scrollbar {
                        display: none;
                    }
                </style>

                <!-- Read more button -->
                <a href="#" class="btn btn-dark btn-lg text-light mt-3 mb-5 mx-4 rounded-3">
                    More... <i class="fa-solid fa-angle-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="py-5" style="background-color: #dcd1db;">
        <div class="container">
            <h3 class="text-center mb-5 text-dark">Why choose Profolio?</h3>
            <div class="row g-5">
                <div class="col-md-4">
                    <div class="card border-0 shadow bg-body-tertiary rounded">
                        <div class="card-body p-3">
                            <div class="text-warning">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text mt-1 px-3">
                            "Creative and supportive, and I feel truly valued as an artist on their platform."
                        </p>
                        <p class="fw-bold mb-0 px-3">- Sofia Andersson</p>
                        <small class="text-muted px-3 mb-2">Artist, Freelance Illustrator</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow bg-body-tertiary rounded">
                        <div class="card-body p-3">
                            <div class="text-warning">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text mt-1 px-3">
                            "Professional and reliable, and we are very satisfied with their services."
                        </p>
                        <p class="fw-bold mb-0 px-3">- Johan Lindström</p>
                        <small class="text-muted px-3 mb-2">Client, Studio Form AB</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow bg-body-tertiary rounded">
                        <div class="card-body p-3">
                            <div class="text-warning">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                        </div>
                        <p class="card-text mt-1 px-3">
                            "Helpful and responsive, and we are extremely happy with their support."
                        </p>
                        <p class="fw-bold mb-0 px-3">- Anna Berg</p>
                        <small class="text-muted px-3 mb-2">Client, Nordic Design AB</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BOTTOM HERO SECTION -->
    <section class="hero text-center py-4" style="font-family: Helvetica, sans-serif;">
        <div class="container py-5">
            <h2 class="mb-3 fw-bold text-dark">
                Start networking today!
            </h2>
            <p class="lead mt-3 mx-auto" style="max-width: 550px;">
                Connect with talented designers, discover new opportunities, and bring your creative projects to life with Profolio.
            </p>

            <!-- BUTTONS -->
            <a href="#" class="btn btn-sm mt-4 mx-2 rounded-4 text-center" style="width: 180px; height: 45px; background-color: #7e1f86; color: white; line-height: 45px; padding: 0;">Join as a designer <i class="fa-solid fa-angle-right"></i></a>
            <a href="#" class="btn btn-sm mt-4 mx-2 rounded-4 text-center" style="width: 180px; height: 45px; background-color: #3b3b58; color: white; line-height: 45px; padding: 0;">list a job <i class="fa-solid fa-angle-right"></i></a>
        </div>
    </section>
</main>

<?php require_once 'assets/includes/footer.php'; ?>