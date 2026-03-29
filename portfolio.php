<?php
// Conneting the database
require_once 'assets/config/db.php';

// Check portfolio group selected in URL
if (!isset($_GET['group'])) {
    echo "No portfolio selected";
    exit();
}

// Collecting the group ID
$groupId = $_GET['group'];

// Fetching all data from portfolios table
$stmt = $dbh->prepare(
    'SELECT 
        user_id, 
        title, 
        company_name, 
        piece_title, 
        description_text, 
        portfolio_image, 
        created 
    FROM portfolios 
    WHERE portfolio_group = :group');

$stmt->execute([':group' => $groupId]);
$portfolios = $stmt->fetchALL(PDO::FETCH_ASSOC);

// Stopping if no portfolios are found
if (!$portfolios) {
    echo "Portfolio not found";
    exit();
}

// The info only shown once per page
$first = $portfolios[0] ?? null;

if (!$first) {
    echo "Portfolio not found";
    exit();
}
// Includes the header
require_once 'assets/includes/header.php';
?>

<main class="portfolio-page">
    <div class="container">
        <!-- Button to get back to correct profile -->
        <a href="profile.php?user_id=<?= $first['user_id'] ?>" class="btn btn-secondary mt-3">Back to profile</a>
            
        <div class="row">
            <!-- Data only shown once per portfolio -->
            <h1 class="mt-4"><?= htmlspecialchars($first['title'] ?? ''); ?></h1>
            <p class="text-muted"><?= htmlspecialchars($first['company_name'] ?? ''); ?></p>
    
    <?php
    if (isset($_SESSION['user_id'])):
    ?>
        <!-- See button to edit portfolio, only if logged in -->
            <div>
                <a href="edit-portfolio.php?group=<?= urlencode($groupId); ?>"
               class="btn btn-primary mb-2 float-end">
                    <i class="fa-solid fa-pen"></i>
                    <span class="ms-1">Edit portfolio</span>
                </a>
            </div>
        </div>

    <?php endif; ?>
    
    <?php 
    // Shows all added portfolio items
    foreach ($portfolios as $portfolio): ?>

        <div class="card mb-4">
            <img src="<?= htmlspecialchars($portfolio['portfolio_image'] ?? 'assets/images/default-portfolio.jpg'); ?>"
                 class="card-img-top p-3"
                 alt="Portfolio cover image">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($portfolio['piece_title'] ?? ''); ?></h5>
                    <p class="card-text text-muted"><?= htmlspecialchars($portfolio['description_text'] ?? 'No description available.'); ?></p>
                    <p class="card-text"><small class="text-body-secondary float-end"><?= htmlspecialchars($portfolio['created'] ?? 'Unknown date'); ?></small></p>
                </div>
        </div>

    <?php endforeach; ?>

        <!-- Creator copyright -->
        <p>&copy; All rights reserved.</p>

    </div>           
</main>

<?php
// Including the footer
require_once 'assets/includes/footer.php';
?>