<?php
//start session to check login status
session_start();

//include database connection
require_once 'db.php';
//showing errors
require_once 'assets/includes/display_errors.php';
//include header 
require_once 'assets/includes/header.php';
?>

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
//include footer
require_once 'assets/includes/footer.php';
?>