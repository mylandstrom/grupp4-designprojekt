<?php
//start session to check login status
session_start();

//include database connection
require_once 'db.php';
//showing errors
require_once 'assets/includes/display_errors.php';
//include header 
require_once 'assets/includes/header.php';

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="utf-8">
    <title>Portfolio</title>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--Font Awesome CSS-->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!--Custom styles-->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <header class="p-1 border-bottom">
        <div class="container">
            <nav class="navbar navbar-expand-md">
                <a href="index.php" class="navbar-brand">
                    <i class="fa-solid fa-briefcase"></i>
                    <span class="ms-0">Profolio</span>
                </a>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                </ul>
                <form class="d-flex">
                    <input type="search" class="form-control mx-2" placeholder="Search for...">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
               
                    <?php if ($isLoggedIn): ?>
                    <!-- Logged-in view: Profile settings dropdown -->
                    <div class="dropdown ms-2">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile Settings
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="profile.php">View Profile</a></li>
                            <li><a class="dropdown-item" href="edit-profile.php">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="account-settings.php">Account Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                 <?php else: ?>
                    <!-- Guest view: Log in -->
                    <a href="login.php" class="btn btn-outline-primary ms-2">Log in</a>
                <?php endif; ?>

            </nav>
        </div>
    </header>

    <main>

        <div class="container">
            <a href="profile.php" class="btn btn-secondary mt-3">Back to profile</a>
            <div class="d-flex justify-content-between">
                <h1 class="mt-4">Package Design for Manta Coffee Company</h1>
                <button class="btn btn-primary"><i class="fa-solid fa-thumbs-up"></i><span class="ms-1">Like</span></button>
            </div>
            <p class="text-muted">By Vincent Miller</p>
            <img src="assets/images/pic9.jpg" alt="Abstract illustration.">
            <p class="text-center mb-3">Text about the project.</p>

            <img src="assets/images/pic9.jpg" alt="Abstract illustration.">
            <p class="text-center mb-3">Text about the project.</p>

        </div>
    </main>

    <?php
    //include footern
    require_once 'assets/includes/footer.php';
    ?>
    <footer class="bg-dark text-white py-4">
        <section class="row container mx-auto">
            <div class="col-md-12 d-flex justify-content-between">
                <a href="index.php"> <img src="assets/images/profile-pic.jpg" alt="Profolio logo" class="mb-3" width="100" height="100"></a>
                <ul class="list-unstyled">
                    <p>For designers</p>
                    <li><a href="#" class="text-white">How it works</a></li>
                    <li><a href="#" class="text-white">Pricing</a></li>
                    <li><a href="#" class="text-white">Resources</a></li>
                </ul>
                <ul class="list-unstyled">
                    <p>For employers</p>
                    <li><a href="#" class="text-white">How it works</a></li>
                    <li><a href="#" class="text-white">Pricing</a></li>
                    <li><a href="#" class="text-white">Resources</a></li>
                </ul>
            </div>
        </section>
        <div class="container d-flex justify-content-between border-top">
            <p class="pt-3">&copy; 2026 Profolio. All rights reserved.</p>
            <div class="pt-3">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            </div>
        </div>
    </footer>
</body>