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
                    <img src="assets/images/empty-pp.png" width="120" height="120" class="rounded-circle border" alt="Profile picture">
                    <h1 class="pt-3">Full name</h1>
                    <p class="text-muted">
                        <i class="text-warning fa-solid fa-star"></i><span class="ms-1">0.0</span>
                    </p>
                    <p><i class="fa-solid fa-briefcase"></i><span class="ms-1">Profession</span></p>
                    <p><i class="fa-solid fa-location-dot"></i><span class="ms-1">Location</span></p>
                    <a href="#" class="btn btn-primary me-2"><i class="fa-solid fa-pen"></i><span class="ms-1">Edit Profile</span></a>
                    
                </div>

                <div class="col-md-9 container">
                    <a href="edit-portfolio.php" class="btn btn-outline-secondary mb-3"><i class="fa-solid fa-plus"></i><span class="ms-1">Add Portfolio</span></a>
                </div>
            </div>
        </section>
                       

        <section class="container my-4">
            <h3>What people say about me:</h3>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">"When you get reviews, you can display them here!"</p>
                            <p class="fw-bold mb-0">Dev #1</p>
                            <small class="text-muted">Profolio Team.</small>
                            
                        </div>
                    </div>
                </div> 
            </div>
        </section>


    </main>

    <?php
    //include footern
    require_once 'assets/includes/footer.php';
    ?>