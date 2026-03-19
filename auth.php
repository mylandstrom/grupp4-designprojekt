<!-- funktion av att kunna logga in-->
<?php
session_start();
//include database connection
require_once 'db.php';
//showing errors
require_once 'assets/includes/display_errors.php';
//include header 
require_once 'assets/includes/header.php';
//login data to database
require_once 'assets/functions/session.login.php';
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

    <main>
        <!-- Hero section -->
        <section class="hero">
            <div class="container"> 
                <h1 class="display-4">Welcome to Profolio</h1>
                <p class="lead">Your personal portfolio management tool for networking amongst creative designers!</p>
            </div>
        </section>  
        <!-- s. 80, inloggningsformulär i "Webbutveckling med PHP och MySQL-->
        <section>
            <div class="login">
                <form action="index.php"  method="post">
                    <fieldset>
                        <legend>Sign in to Profolio<legend>
                        
                                    <div>
                    <label for="email">E-post</label>
                    <input name="email" type="text">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input name="password" type="password">
                    <!--password för att man inte ska kunna se lösenordet när man skriver ut det-->
                </div>
        </fieldset>
        <input type="submit" name="submit" value="Sign in">
    </form>
    <?php
    require_once 'assets/functions/session.login.php';
    require_once 'assets/includes/footer.php';
    ?>
</body>
</html>

