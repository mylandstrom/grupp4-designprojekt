<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="utf-8">
    <title>Profolio</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- Custom styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Remove blue focus color from the search field */
        .form-control:focus {
            border-color: #2a0d2f;
            box-shadow: 0 0 0 0.2rem rgba(57, 32, 61, 0.25);
        }
    </style>
</head>

<header>

    <nav class="navbar navbar-expand-md navbar-light border-bottom" style="background-color: #7a5980; overflow: hidden; height: 80px;">
        <!-- Navbar logo and brand name -->
        <div class="container align-items-center h-100">
            <a href="index.php" class="navbar-brand me-5" style="display: flex; align-items: center;">
                <img src="assets/Images/logo.white.png" alt="Logo" width="130" height="130">
                <span class="navbar-brand-text" style="font-size: 28px; font-weight: semi-bold; font-family: Helvetica, sans-serif; letter-spacing: 0px; margin-left: -30px; color: white;">
                    Profolio
                </span>
            </a>

            <!-- Navbar links -->
            <?php
            // Highlight the current page in the navbar
            $current_page = basename($_SERVER['PHP_SELF']);
            ?>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-2">
                    <a href="index.php" class="nav-link <?php echo ($current_page == 'index.php') ? 'active text-white' : ''; ?>"
                        style="<?php echo ($current_page == 'index.php') ? 'font-weight: bold;' : 'color: rgba(255, 255, 255, 0.75);'; ?>">
                        Portfolios
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a href="job-listing.php" class="nav-link <?php echo ($current_page == 'job-listing.php') ? 'active text-white' : ''; ?>"
                        style="<?php echo ($current_page == 'job-listing.php') ? 'font-weight: bold;' : 'color: rgba(255, 255, 255, 0.75);'; ?>">
                        Job listing
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a href="about.php" class="nav-link <?php echo ($current_page == 'about.php') ? 'active text-white' : ''; ?>"
                        style="<?php echo ($current_page == 'about.php') ? 'font-weight: bold;' : 'color: rgba(255, 255, 255, 0.75);'; ?>">
                        Log in
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a href="aboutus.php" class="nav-link <?php echo ($current_page == 'aboutus.php') ? 'active text-white' : ''; ?>"
                        style="<?php echo ($current_page == 'aboutus.php') ? 'font-weight: bold;' : 'color: rgba(255, 255, 255, 0.75);'; ?>">
                        About us
                    </a>
                </li>
            </ul>

            <form class="d-flex ms-4 mb-0">
                <!-- Search input and search button -->
                <input type="search" class="form-control me-1 form-control-sm" placeholder="Search...">
                <button type="submit" class="btn btn-sm text-warning"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button>
            </form>

            <!-- Profile button -->
            <a href="profile.php" class="btn btn-sm ms-5">
                <i class="fa-regular fa-circle-user display-6 text-white-50"></i>
            </a>

        </div>
    </nav>

</header>