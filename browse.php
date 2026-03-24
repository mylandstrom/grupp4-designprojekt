<?php
// browse.php - Page to browse designer portfolios
require_once 'assets/includes/header.php';
require_once 'db.php';

// Get all designers
$stmt = $dbh->prepare("SELECT * FROM designers");
$stmt->execute();
$designers = $stmt->fetchAll();

// Get projects for each designer
foreach ($designers as $index => $designer) {
    $stmt2 = $dbh->prepare("SELECT image FROM projects WHERE designer_id = ?");
    $stmt2->execute([$designer['id']]);
    $designers[$index]['projects'] = $stmt2->fetchAll(PDO::FETCH_COLUMN);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Portfolios</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Protect browse page -->
    <div class="browse-page">

        <div class="container mt-5">
            <h2 class="mb-4">Browse portfolios</h2>

            <!-- Search and filter -->
            <div class="d-flex mb-4">
                <input class="form-control flex-grow-1 me-3" type="search" placeholder="Search designers">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                        <li><a class="dropdown-item" href="#">Graphic Designers</a></li>
                        <li><a class="dropdown-item" href="#">UI/UX Designers</a></li>
                        <li><a class="dropdown-item" href="#">Illustrators</a></li>
                        <li><a class="dropdown-item" href="#">All</a></li>
                    </ul>
                </div>
            </div>

            <!-- Loop designers -->
            <?php foreach ($designers as $designer): ?>
                <div class="card mb-5 p-3">
                    <div class="d-flex align-items-center mb-4">
                        <img src="<?= $designer['profile_image']; ?>" class="rounded-circle me-3" style="width:60px; height:60px; object-fit:cover;">
                        <div>
                            <h5 class="mb-0"><?= $designer['name']; ?></h5>
                            <small class="text-muted"><?= $designer['role']; ?></small>
                        </div>

                        <!-- Contact Button -->
                        <button class="btn btn-dark btn-sm ms-auto">
                            <a href="contact.php?designer_id=<?= $designer['id']; ?>" style="color:white; text-decoration:none;">Contact</a>
                        </button>
                    </div>

                    <!-- Pictures -->
                    <div class="row g-2">
                        <?php if (!empty($designer['projects'])): ?>
                            <?php foreach ($designer['projects'] as $img): ?>
                                <div class="col-3">
                                    <img src="<?= $img; ?>" class="img-fluid project-img" alt="Project image"
                                        data-bs-toggle="modal"
                                        data-bs-target="#imageModal"
                                        data-img="<?= $img; ?>">
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-3">
                                <img src="assets/images/placeholder.png" class="img-fluid project-img" alt="No project"
                                    data-bs-toggle="modal"
                                    data-bs-target="#imageModal"
                                    data-img="assets/images/placeholder.png">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <!-- Modal for image preview -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <img id="modalImage" src="" class="img-fluid" alt="Project large">
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');

        modal.addEventListener('show.bs.modal', event => {
            const img = event.relatedTarget.getAttribute('data-img');
            modalImage.src = img;
        });
    </script>

    <!-- Footer -->
    <?php require_once 'assets/includes/footer.php'; ?>

</body>

</html>