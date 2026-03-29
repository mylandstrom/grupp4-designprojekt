<?php
//include header 
require_once 'assets/includes/header.php';
?>



    <main>
        <div class="header-container">
            <img src="assets/images/header.jpg" alt="." class="img-fluid w-100" style="height: 300px; object-fit: cover;">
        </div>

        <section class="container my-4">
            <div class="row">
                <div class="col-md-3">
                    <img src="assets/images/profile-pic.jpg" width="120" height="120" class="rounded-circle" alt="Profile picture">
                    <h1 class="pt-3">Vincent Miller</h1>
                    <p class="text-muted">
                        <i class="text-warning fa-solid fa-star"></i><span class="ms-1">4.8</span>
                    </p>
                    <p><i class="fa-solid fa-briefcase"></i><span class="ms-1">Illustrator & Graphic Designer</span></p>
                    <p><i class="fa-solid fa-location-dot"></i><span class="ms-1">Brooklyn, New York</span></p>

                    
                        <?php
                        // Check if the user is logged in
                        if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
                            // Show edit button for logged-in users
                            echo '<div class="mt-3">
                                    <a href="#" class="btn btn-secondary"><i class="fa-solid fa-pen"></i><span class="ms-1">Edit Profile</span></a>
                                    </div>';

                        } else {
                            // Show follow and contact buttons for guests
                            echo '<div class="mt-3">
                                    <a href="#" class="btn btn-primary me-2"><i class="fa-solid fa-user-plus"></i><span class="ms-1">Follow</span></a>
                                    <a href="#" class="btn btn-primary"><i class="fa-solid fa-envelope"></i><span class="ms-1">Contact</span></a>
                                  </div>';
                        }
                        ?>
                    
                    
                </div>

                <div class="col-md-9 container">
                    <div class="row row-cols-3 g-4">
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
                            <a href="demo_portfolio.php" class="card-link">
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