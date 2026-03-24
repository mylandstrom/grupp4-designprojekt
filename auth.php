<?php
// funktion av att kunna logga in
session_start();
//include database connection
require_once 'db.php';
//showing errors
require_once 'assets/includes/display_errors.php';
//login data to database
require_once 'assets/functions/session.login.php';
//include header 
require_once 'assets/includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profolio - Login</title>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--Font Awesome CSS-->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!--Custom styles-->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <style>
        /* Keep hero text centered like the register page without affecting other pages. (antog att den skulle vara centrerad:)*/
        .login-page .login-hero {
            text-align: center;
        }

        .login-page .login-hero-inner {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>

    <main class="login-page">
        <!-- Hero section -->
        <section class="hero login-hero">
            <div class="login-hero-inner">
                <h1 class="display-4">Welcome to Profolio</h1>
                <p class="lead">Your personal portfolio management tool for networking amongst creative designers!</p>
            </div>
        </section>
        <!-- s. 80, inloggningsformulär i "Webbutveckling med PHP och MySQL-->
        <section>
            <div class="login-form">
                <form action="auth.php" method="post">
                    <fieldset>
                        <legend class="form-label">Sign in to <img src="assets/Images/logo.gray.png" alt="Logo" width="80px"> Today!</legend>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <br>
                            <!-- Required email input to prevent empty submit -->
                            <input id="email" name="email" type="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <!-- Required password input to prevent empty submit -->
                            <input id="password" name="password" type="password" required>
                            <!--password för att man inte ska kunna se lösenordet när man skriver ut det-->
                        </div>
                        <p>Don't have an account? <a href="register.php">Register here!</a></p>
                        <input class="btn-signin" type="submit" name="login" value="Sign in">
                    </fieldset>

            </div>
            </form>

            <?php
            require_once 'assets/includes/footer.php';
            ?>
</body>

</html>