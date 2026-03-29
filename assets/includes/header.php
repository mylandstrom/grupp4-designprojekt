<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure redirects in included pages still work, even if HTML has already started.
if (!headers_sent()) {
    ob_start();
}

// Make header independent of include order (e.g. pages that include header before db.php).
if (!isset($dbh)) {
    require_once __DIR__ . '/../config/db.php';
}
?>

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
                <img src="assets/images/logo.white.png" alt="Logo" width="130" height="130">
                <span class="navbar-brand-text" style="font-size: 28px; font-weight: semi-bold; font-family: Helvetica, sans-serif; letter-spacing: 0px; margin-left: -30px; color: white;">
                    Profolio
                </span>
            </a>

            <!-- Navbar links -->
            <?php
            // Highlight the current page in the navbar
            $current_page = basename($_SERVER['PHP_SELF']);
            $is_logged_in = isset($_SESSION['user_id']);
            $profile_link = isset($_SESSION['user_id']) ? 'profile.php?user_id=' . (int) $_SESSION['user_id'] : 'auth.php';
            $auth_link = $is_logged_in ? 'logout.php' : 'auth.php';
            $auth_label = $is_logged_in ? 'Log out' : 'Log in';
            $header_profile_image = null;

            if ($is_logged_in && isset($dbh)) {
                try {
                    $photoStmt = $dbh->prepare("SELECT original FROM photos WHERE user_id = :user_id AND original LIKE 'assets/images/uploads/profiles/%' ORDER BY regdate DESC, id DESC LIMIT 1");
                    $photoStmt->bindValue(':user_id', (int) $_SESSION['user_id'], PDO::PARAM_INT);
                    $photoStmt->execute();
                    $photo = $photoStmt->fetch(PDO::FETCH_ASSOC);

                    if ($photo && !empty($photo['original'])) {
                        $header_profile_image = $photo['original'];
                    }
                } catch (Exception $e) {
                    $header_profile_image = null;
                }
            }
            ?>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-2">
                    <a href="browse.php" class="nav-link <?php echo ($current_page == 'browse.php') ? 'active text-white' : ''; ?>"
                        style="<?php echo ($current_page == 'browse.php') ? 'font-weight: bold;' : 'color: rgba(255, 255, 255, 0.75);'; ?>">
                        Portfolios
                    </a>
                </li>
                </li>
                <li class="nav-item mx-2">
                    <a href="#site-footer" class="nav-link"
                        style="color: rgba(255, 255, 255, 0.75);">
                        About us
                    </a>
                </li>
            </ul>

            <form class="d-flex ms-4 mb-0">
                <!-- Search input and search button -->
                <input type="search" class="form-control me-1 form-control-sm" placeholder="Search...">
                <button type="submit" class="btn btn-sm text-warning"><i class="fa-solid fa-magnifying-glass fa-lg"></i></button>
            </form>

            <div class="d-flex align-items-center ms-4">
                <a href="<?= htmlspecialchars($auth_link); ?>" class="nav-link me-3 <?php echo ($current_page == 'auth.php' || $current_page == 'logout.php') ? 'active text-white' : ''; ?>"
                    style="<?php echo ($current_page == 'auth.php' || $current_page == 'logout.php') ? 'font-weight: bold;' : 'color: rgba(255, 255, 255, 0.75);'; ?>">
                    <?= htmlspecialchars($auth_label); ?>
                </a>

                <!-- Profile button -->
                <a href="<?= htmlspecialchars($profile_link); ?>" class="btn btn-sm">
                    <?php if ($header_profile_image !== null): ?>
                        <img src="<?= htmlspecialchars($header_profile_image); ?>" alt="Profile" class="rounded-circle" style="width: 44px; height: 44px; object-fit: cover;">
                    <?php else: ?>
                        <i class="fa-regular fa-circle-user display-6 text-white-50"></i>
                    <?php endif; ?>
                </a>
            </div>

        </div>
    </nav>

</header>