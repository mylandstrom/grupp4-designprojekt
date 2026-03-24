<?php
// Start session and include shared dependencies.
session_start();
require_once 'db.php';
require_once 'assets/includes/display_errors.php';
require_once 'assets/includes/header.php';

// Used to show validation and success messages in the UI.
$errors = [];
$success = false;

// Handle registration form submit.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Read and normalize user input.
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    if ($first_name === '' || $last_name === '' || $email === '' || $password === '' || $confirm_password === '') {
        $errors[] = 'Please fill in all fields.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }

    // Continue only if all validation checks passed.
    if (empty($errors)) {
        // Prevent duplicate accounts by email.
        $check = $dbh->prepare('SELECT user_id FROM users WHERE email = :email');
        $check->bindValue(':email', $email);
        $check->execute();

        if ($check->fetch()) {
            $errors[] = 'An account with this email already exists.';
        } else {
            // Note: Login flow currently checks plain text password in this project.
            // Save new user using actual users table columns.
            $insert = $dbh->prepare(
                'INSERT INTO users (firstname, lastname, email, password, regdate) VALUES (:firstname, :lastname, :email, :password, NOW())'
            );
            $insert->bindValue(':firstname', $first_name);
            $insert->bindValue(':lastname', $last_name);
            $insert->bindValue(':email', $email);
            $insert->bindValue(':password', $password);
            $insert->execute();
            $success = true;
        }
    }
}
?>

<style>
    /* Page-scoped styles: affects only register page content. */
    .register-page {
        font-family: Helvetica, sans-serif;
    }

    /* Top hero area. */
    .register-page .register-hero {
        padding: 2rem;
        background-color: #f8f9fa;
        text-align: center;
    }

    /* Inner wrapper for hero text width. */
    .register-page .register-hero-inner {
        max-width: 900px;
        margin: 0 auto;
    }

    /* Main form wrapper. */
    .register-page .register-form {
        max-width: 400px;
        margin: 0 auto;
        padding: 2rem;
        padding-bottom: 5rem;
    }

    /* Visual card around the inputs. */
    .register-page fieldset {
        border: 1px solid #ddd;
        padding: 3rem;
        border-radius: 10px;
        background-color: #fff;
    }

    /* Input group spacing and alignment. */
    .register-page .form-group {
        padding: 1rem;
        text-align: left;
    }

    /* Make all inputs fill available width. */
    .register-page .form-group input {
        width: 100%;
    }

    /* Register button style. */
    .register-page .btn-register {
        background-color: #7e1f86;
        color: white;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        margin-top: 1rem;
        width: 100px;
        height: 40px;
    }

    /* Hover style for register button. */
    .register-page .btn-register:hover {
        color: #5a1460;
        background-color: white;
        transition-duration: 300ms;
    }
</style>

<main class="register-page">
    <!-- Hero section -->
    <section class="register-hero">
        <div class="register-hero-inner">
            <h1 class="display-4">Welcome to Profolio</h1>
            <p class="lead">Your personal portfolio management tool for networking amongst creative designers!</p>
        </div>
    </section>

    <!-- Registration form section -->
    <section>
        <div class="register-form">
            <!-- Error messages -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach ($errors as $error): ?>
                        <div><?= htmlspecialchars($error); ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Success message -->
            <?php if ($success): ?>
                <div class="alert alert-success" role="alert">
                    Registration successful. Redirecting to login... <a href="auth.php">Log in here</a>.
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = 'auth.php';
                    }, 2000);
                </script>
            <?php endif; ?>

            <!-- Registration form -->
            <form action="register.php" method="post">
                <fieldset>
                    <legend class="form-label">Register to <img src="assets/images/logo.gray.png" alt="Logo" width="80"> Today!</legend>
                    <!-- First name field -->
                    <div class="form-group">
                        <label for="register-first-name">First name</label>
                        <input id="register-first-name" name="first_name" type="text" value="<?= htmlspecialchars($_POST['first_name'] ?? ''); ?>" required>
                    </div>
                    <!-- Last name field -->
                    <div class="form-group">
                        <label for="register-last-name">Last name</label>
                        <input id="register-last-name" name="last_name" type="text" value="<?= htmlspecialchars($_POST['last_name'] ?? ''); ?>" required>
                    </div>
                    <!-- Email field -->
                    <div class="form-group">
                        <label for="register-email">E-mail</label>
                        <br>
                        <input id="register-email" name="email" type="email" value="<?= htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                    </div>
                    <!-- Password fields -->
                    <div class="form-group">
                        <label for="register-password">Password</label>
                        <input id="register-password" name="password" type="password" required>
                    </div>
                    <div class="form-group">
                        <label for="register-confirm-password">Confirm password</label>
                        <input id="register-confirm-password" name="confirm_password" type="password" required>
                    </div>
                    <p>Already have an account? <a href="auth.php">Sign in here!</a></p>
                    <input class="btn-register" type="submit" name="register" value="Register">
                </fieldset>
            </form>
        </div>
    </section>
</main>

<?php require_once 'assets/includes/footer.php'; ?>