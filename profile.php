<?php
    require_once 'assets/config/db.php';
    session_start();

    // Use ?user_id=... when viewing someone else's profile, otherwise show logged-in user profile.
    $requestedUserId = isset($_GET['user_id']) ? (int) $_GET['user_id'] : 0;
    $loggedInUserId  = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : 0;
    $profileUserId   = $requestedUserId > 0 ? $requestedUserId : $loggedInUserId;

        if ($profileUserId <= 0) {
            header('Location: auth.php');
            exit();
        }

    $stmt = $dbh->prepare(
        'SELECT 
            user_id, 
            firstname, 
            lastname, 
            email, 
            regdate, 
            based, 
            profession 
         FROM users 
         WHERE user_id = :user_id');

    $stmt->bindValue(':user_id', $profileUserId, PDO::PARAM_INT);
    $stmt->execute();
    $profileUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$profileUser) {
            header('Location: index.php');
            exit();
        }

    $headerImage = 'assets/images/default-header.jpg';
    $photoStmt = $dbh->prepare(
        "SELECT original 
         FROM photos 
         WHERE user_id = :user_id 
         AND original 
         LIKE 'assets/images/uploads/headers/%' 
         ORDER BY regdate 
         DESC, id 
         DESC LIMIT 1");

    $photoStmt->bindValue(':user_id', $profileUserId, PDO::PARAM_INT);
    $photoStmt->execute();
    $photo = $photoStmt->fetch(PDO::FETCH_ASSOC);

        if ($photo && !empty($photo['original'])) {
            $headerImage = $photo['original'];
        }

    $profileImage = 'assets/images/default-pp.png';
    $photoStmt = $dbh->prepare(
        "SELECT original 
         FROM photos 
         WHERE user_id = :user_id 
         AND original 
         LIKE 'assets/images/uploads/profiles/%' 
         ORDER BY regdate 
         DESC, id 
         DESC LIMIT 1");

    $photoStmt->bindValue(':user_id', $profileUserId, PDO::PARAM_INT);
    $photoStmt->execute();
    $photo = $photoStmt->fetch(PDO::FETCH_ASSOC);

        if ($photo && !empty($photo['original'])) {
            $profileImage = $photo['original'];
        }

    $isOwnProfile = $loggedInUserId > 0 && $loggedInUserId === (int) $profileUser['user_id'];
    $profileName  = trim(($profileUser['firstname'] ?? '') . ' ' . ($profileUser['lastname'] ?? ''));

        if ($profileName === '') {
            $profileName = 'User #' . (int) $profileUser['user_id'];
        }

    $stmt = $dbh->prepare(
        "SELECT MIN(portfolio_id) as portfolio_id
         FROM portfolios
         WHERE user_id = :user_id
         GROUP BY portfolio_group
         ORDER BY portfolio_id DESC");

    $stmt->bindValue(':user_id', $profileUserId, PDO::PARAM_INT);
    $stmt->execute();
    $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $portfolios = [];

    foreach ($groups as $group) {
        $stmt = $dbh->prepare(
            "SELECT * FROM portfolios 
             WHERE portfolio_id = :id");

        $stmt->execute([':id' => $group['portfolio_id']]);
        $portfolios[] = $stmt->fetch(PDO::FETCH_ASSOC);
    }


    $memberSince = '';
        if (!empty($profileUser['regdate'])) {
            try {
                $memberSince = (new DateTime($profileUser['regdate']))->format('Y-m-d');
            }
            catch (Exception $e) {
                $memberSince = '';
            }
        }

//Includes the header and its functions
require_once 'assets/includes/header.php'
?>

<!-- To easily controll profile page CSS -->
<main class="profile-page">
    <!-- Header image -->
    <img src="<?= htmlspecialchars($headerImage); ?>"
         alt="."
         class="w-100" 
         style= "height: 250px; object-fit: cover;">
              
    <section class="container my-4">
        <div class="row">
            <!-- Section to the left: creator info --> 
            <div class="col-md-3">

                <!-- Rounded profile picture -->
                <img src="<?= htmlspecialchars($profileImage); ?>"
                     width="120" height="120"
                     class="rounded-circle" 
                     alt="Profile picture" 
                     style="object-fit: cover;">

                <h1 class="pt-3"><?= htmlspecialchars($profileName); ?></h1>
                <!-- Overall ratings: only for aesthetics -->
                <p class="text-muted">
                    <i class="text-warning fa-solid fa-star"></i>
                    <span class="ms-1">0</span>
                </p>
                <p>
                    <i class="fa-solid fa-briefcase"></i>
                    <span class="ms-1"><?= htmlspecialchars($profileUser['profession'] ?? 'Profession'); ?></span>
                </p>
                <p>
                    <i class="fa-solid fa-location-dot"></i>
                    <span class="ms-1"><?= htmlspecialchars($profileUser['based'] ?? 'Location'); ?></span>
                </p>
                <p>
                    <i class="fa-solid fa-envelope"></i>
                    <span class="ms-1"><?= htmlspecialchars($profileUser['email']); ?></span>
                </p>

                <!-- Member since, if available -->
                <?php if ($memberSince !== ''): ?>
                    <p>
                        <i class="fa-regular fa-calendar"></i>
                        <span class="ms-1">Member since <?= htmlspecialchars($memberSince); ?></span>
                    </p>
                <?php endif; ?>

                <!-- If logged in, edit profile button is seen -->
                <?php if ($isOwnProfile): ?>
                    <a href="edit-profile.php" 
                       class="btn btn-primary mt-3 me-2">
                        <i class="fa-solid fa-pen"></i>
                        <span class="ms-1">Edit Profile</span>
                    </a>

                    <a href="add-portfolio.php"
                       class="btn btn-secondary mt-3">
                        <i class="fa-solid fa-plus"></i>
                        <span class="ms-1">Add portfolio</span>
                    </a>
                <?php else: ?>

                    <!-- If guest, follow and contact button are seen -->
                    <div class="mt-3" 
                         role="alert">

                        <a href="#" 
                           class="btn btn-primary me-2">
                           <i class="fa-solid fa-user-plus"></i>
                           <span class="ms-1">Follow</span>
                        </a>

                        <a href="mailto:<?= htmlspecialchars($profileUser['email']); ?>"
                           class="btn btn-secondary">
                           <i class="fa-solid fa-envelope"></i>
                           <span class="ms-1">Contact</span>
                        </a>
                    
                    </div>
                <?php endif; ?>

            </div>

            <!-- Portfolio grid -->
            <div class="col-md-9 container">
                <div class="row row-cols-3 g-3">

                <!-- If there are portfolios available -->
                <?php if (!empty($portfolios)): ?>
                <!-- Shows all available portfolios as clickable cards with thumbnails -->
                <?php foreach ($portfolios as $portfolio): ?>

                    <div class="col">
                        <a href="portfolio.php?group=<?= $portfolio['portfolio_group']; ?>" 
                           class="card-link text-decoration-none text-dark">

                            <div class="card h-100">
                                <img src="<?= htmlspecialchars($portfolio['portfolio_image'] ?? 'assets/images/default-portfolio.jpg'); ?>"
                                    class="card-img-top"
                                    style="height: 150px; object-fit:cover;">

                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?= htmlspecialchars($portfolio['title'] ?? 'Untitled'); ?>
                                    </h5>
                                    <p class="text-muted small">
                                        <?= htmlspecialchars($portfolio['company_name'] ?? ''); ?>
                                    </p>
                                    <p class="card-text">
                                        <?= htmlspecialchars(mb_strimwidth($portfolio['description_text'] ?? '', 0, 80, '...')); ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php endforeach; ?>
                    <?php else: ?>

                    <!-- If there are no added portfolios yet -->
                    <div class="col-md-9 container mt-4">
                        <h2>There are no portfolios here yet...</h2>
                    </div>
                        
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials: none available, logged in view -->
    <?php if ($isOwnProfile): ?>
    <section class="container my-4">

        <h3>What people say about me:</h3>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-warning mb-2">
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>

                        <p class="card-text">"When you get reviews, the latest ones show up here. Stars and all!"</p>
                        <p class="fw-bold mb-0">Devs</p>
                        <small class="text-muted">Profolio Team</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials: none available, guest view -->
    <?php else: ?>
        <section class="container my-4">
            
            <h3>What people say about this creative professional:</h3>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-warning mb-2">
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>

                            <p class="card-text">"No reviews yet"</p>
                            <p class="fw-bold mb-0">Devs</p>
                            <small class="text-muted">Profolio Team</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php endif; ?>

</main>

<?php
//Includes the footer
require_once 'assets/includes/footer.php';
?>