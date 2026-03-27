<?php
require_once 'assets/includes/header.php';

// Control designer_id
if (!isset($_GET['designer_id'])) {
    die("Ingen designer vald.");
}

$designer_id = (int)$_GET['designer_id'];

// Get designer-information
$stmt = $dbh->prepare("SELECT name, profile_image FROM designers WHERE id = ?");
$stmt->execute([$designer_id]);
$designer = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$designer) {
    die("Designer finns inte.");
}

// Handle form submission
$messageSent = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    // Save to database
    $stmt = $dbh->prepare("INSERT INTO messages (designer_id, sender_name, sender_email, message) VALUES (?, ?, ?, ?)");
    $stmt->execute([$designer_id, $name, $email, $message]);

    $messageSent = true;
}
?>

<!-- Contact designer and profile image -->
<div class="contact-wrapper">
    <div class="container mt-5 contact-page">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="m-0">Contact <?= htmlspecialchars($designer['name']); ?></h2>

            <?php if (!empty($designer['profile_image'])): ?>
                <img src="<?= htmlspecialchars($designer['profile_image']); ?>"
                    alt="<?= htmlspecialchars($designer['name']); ?> profilbild"
                    class="img-fluid rounded-circle"
                    style="width:60px; height:60px; object-fit:cover;">
            <?php endif; ?>
        </div>

        <!-- Message sent confirmation -->
        <?php if ($messageSent): ?>
            <div class="alert alert-success">Meddelandet skickades!</div>
            <a href="browse.php" class="btn btn-secondary">Tillbaka till Designers</a>
        <?php else: ?>
            <form method="POST">

                <!-- Contact form -->
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
                <a href="browse.php" class="btn btn-secondary">Cancel</a>
            </form>
        <?php endif; ?>
    </div>
</div>

<!-- Footer -->
<?php require_once 'assets/includes/footer.php'; ?>