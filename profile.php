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
    <title>Profile</title>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--Font Awesome CSS-->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!--Custom styles-->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <header class="p-1">
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
                <div class="dropdown">
  
                    <?php if ($isLoggedIn): ?>
                    <!-- Logged-in view: Profile settings dropdown -->
                    <div class="dropdown ms-2">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="assets/images/profile-pic.jpg" alt="Profile picture" width="20" height="20" class="rounded-circle mb-auto">
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
    <li><a class="dropdown-item" href="#">Edit</a></li>
    <li><a class="dropdown-item" href="#">Account Settings</a></li>
  </ul>
</div>
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
        <div class="container-fluid p-0">
            <img src="assets/images/header.jpg" alt="Abstract illustration." class="img-fluid w-100" style="height: 300px; object-fit: cover;">
        </div>



        <section class="container my-4">
            <div class="row">
                <div class="col-md-3">
                    <img src="assets/images/profile-pic.jpg" width="120" height="120" class="rounded-circle" alt="Profile picture">
                    <h1 class="pt-3">Vincent Miller</h1>
                    <p class="text-muted">
                        <i class="text-warning fa-solid fa-star"></i><span class="ms-1">4.8</span>
                    </p>
                    <p><i class="fa-solid fa-pen"></i><span class="ms-1">Illustrator & Graphic Designer</span></p>
                    <p><i class="fa-solid fa-location-dot"></i><span class="ms-1">Brooklyn, New York</span></p>

                    
                        <?php if ($isLoggedIn): ?>
                        <!-- Logged-in view: Show edit button -->
                        <button class="btn btn-secondary mt-3">Edit Profile</button>
                    <?php else: ?>
                        <!-- Guest view: Follow -->
                        <div class="mt-3" role="alert">
                            <a href="#" class="btn btn-primary me-2"><i class="fa-solid fa-user-plus"></i><span class="ms-1">Follow</span></a>
                            <a href="#" class="btn btn-primary"><i class="fa-solid fa-envelope"></i><span class="ms-1">Contact</span></a>
                        </div>
                    <?php endif; ?>
                    
                    
                </div>

                <div class="col-md-9 container">
                    <div class="row row-cols-3 g-3">
                        <div class="col">
                            <a href="#" class="card-link">
                                <div class="card">
                                    <img src="assets/images/pic1.jpg" width="350" height="150" class="card-img-top border-bottom" alt="Illustration 1">
                                    <div class="card-body">
                                        <h2 class="card-title">Illustration 1</h2>
                                        <p class="card-text">Description of the first illustration.</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col">
                            <a href="#" class="card-link">
                                <div class="card">
                                    <img src="assets/images/pic2.jpg" width="350" height="150" class="card-img-top border-bottom" alt="Illustration 1">
                                    <div class="card-body">
                                        <h2 class="card-title">Illustration 1</h2>
                                        <p class="card-text">Description of the first illustration.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#" class="card-link">
                                <div class="card">
                                    <img src="assets/images/pic3.jpg" width="350" height="150" class="card-img-top border-bottom" alt="Illustration 1">
                                    <div class="card-body">
                                        <h2 class="card-title">Illustration 1</h2>
                                        <p class="card-text">Description of the first illustration.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#" class="card-link">
                                <div class="card">
                                    <img src="assets/images/pic4.jpg" width="350" height="150" class="card-img-top border-bottom" alt="Illustration 1">
                                    <div class="card-body">
                                        <h2 class="card-title">Illustration 1</h2>
                                        <p class="card-text">Description of the first illustration.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#" class="card-link">
                                <div class="card">
                                    <img src="assets/images/pic5.jpg" width="350" height="150" class="card-img-top border-bottom" alt="Illustration 1">
                                    <div class="card-body">
                                        <h2 class="card-title">Illustration 1</h2>
                                        <p class="card-text">Description of the first illustration.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#" class="card-link">
                                <div class="card">
                                    <img src="assets/images/pic6.jpg" width="350" height="150" class="card-img-top border-bottom" alt="Illustration 1">
                                    <div class="card-body">
                                        <h2 class="card-title">Illustration 1</h2>
                                        <p class="card-text">Description of the first illustration.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#" class="card-link">
                                <div class="card">
                                    <img src="assets/images/pic7.jpg" width="350" height="150" class="card-img-top border-bottom" alt="Illustration 1">
                                    <div class="card-body">
                                        <h2 class="card-title">Illustration 1</h2>
                                        <p class="card-text">Description of the first illustration.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="#" class="card-link">
                                <div class="card">
                                    <img src="assets/images/pic8.jpg" width="350" height="150" class="card-img-top border-bottom" alt="Illustration 1">
                                    <div class="card-body">
                                        <h2 class="card-title">Illustration 1</h2>
                                        <p class="card-text">Description of the first illustration.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="portfolio.php" class="card-link">
                                <div class="card">
                                    <img src="assets/images/pic9.jpg" width="350" height="150" class="card-img-top border-bottom" alt="Illustration 1">
                                    <div class="card-body">
                                        <h2 class="card-title">Illustration 1</h2>
                                        <p class="card-text">Description of the first illustration.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-primary">Load More</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="container my-4">
            <h3>What people say about me:</h3>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-warning mb-2">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="card-text">"An amazing illustrator! His work is always creative and inspiring."</p>
                            <p class="fw-bold mb-0">Emily Rosch</p>
                            <small class="text-muted">Bing Design Studio</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-warning mb-2">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="card-text">"Incredible work! Vincent delivers beyond expectations every time."</p>
                            <p class="fw-bold mb-0">Randy Pollard</p>
                            <small class="text-muted">Schematics Bureau</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-warning mb-2">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="card-text">"Never have I seen such exceptional talent! Will hire Vincent again!"</p>
                            <p class="fw-bold mb-0">Frank Rodriguez</p>
                            <small class="text-muted">Creative Minds Ltd.</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-warning mb-2">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="card-text">"Cannot recommend highly enough! Unmatched attention to detail."</p>
                            <p class="fw-bold mb-0">Stella Burke</p>
                            <small class="text-muted">Hirsch Design Co.</small>
                        </div>
                    </div>
                </div>
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

</html>