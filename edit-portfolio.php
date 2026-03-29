<?php
    // Connecting to database
    require_once 'assets/config/db.php';
    // Starts session for user handling
    session_start();

    // Check portfolio group in the URL
    if (!isset($_GET['group'])) {
        echo "No portfolio selected";
        exit();
    }

    $groupId = $_GET['group'];

    // Gathering all data connected to specific portfolio group
    $stmt = $dbh->prepare(
        'SELECT 
            portfolio_id, 
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

    // Stopping if no portfolios exist
    if (!$portfolios) {
        echo "Portfolio not found";
        exit();
    }

    // Using the first item for shared data
    $first = $portfolios[0] ?? null;

    // Stopping if no first item exists
    if (!$first) {
        echo "Portfolio not found";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Deletion of singular portfolio item
    if (isset($_POST['delete_item'])) {
        $deleteId = $_POST['delete_item'];
        $stmt = $dbh->prepare(
            "DELETE FROM portfolios
             WHERE portfolio_id = :id");
        $stmt->execute([':id' => $deleteId]);

        // To stay on edit page after deleting single item
        header("Location:edit-portfolio.php?group=" . urlencode($groupId));
        exit();
        }

        // Deletion of whole portfolio
        if (isset($_POST['delete_group'])) {
            $stmt = $dbh->prepare(
                "DELETE FROM portfolios 
                 WHERE portfolio_group = :group");
            $stmt->execute([':group' => $groupId]);

            //Redirect to profile overview upon deleting entire portfolio
            header("Location:profile.php");
            exit();
        }

        // To update the data that's only used once on the page
        $title = $_POST['title'] ?? '';
        $company = $_POST['company_name'] ?? '';

        $stmt = $dbh->prepare(
            "UPDATE portfolios 
             SET title = :title, company_name = :company 
             WHERE portfolio_group = :group");
        $stmt->execute([
            ':title'    => $title, 
            ':company'  => $company, 
            ':group'    => $groupId]);

        // Arrays from the "add portfolio" form = already existing data (can be multiple fields)
        $ids            = $_POST['id'] ?? [];
        $titles         = $_POST['piece_title'] ?? [];
        $descriptions   = $_POST['description_text'] ?? [];

        // Updates the existing data
        foreach ($ids as $index => $id) {

            $pieceTitle  = $titles[$index] ?? '';
            $description = $descriptions[$index] ?? '';

            $update = $dbh->prepare(
                "UPDATE portfolios
                 SET piece_title = :piece_title, description_text = :description
                 WHERE portfolio_id = :id
            ");

            $update->execute([
                ':piece_title'  => $pieceTitle,
                ':description'  => $description,
                ':id'           => $id
            ]);
        }

    // For handling new files added in the "edit mode" through cloned forms
    $fileIndex = 0;

    for ($i = count($ids); $i < count($titles); $i++) {

        $pieceTitle  = $titles[$i] ?? '';
        $description = $descriptions[$i] ?? '';

        // Skipping empties
        if (empty($pieceTitle) && empty($_FILES['photo']['name'][$fileIndex])) {
            continue;
        }

        $imagePath = null;

        // Handling of file uploads
        if (!empty($_FILES['photo']['name'][$fileIndex])) {
            $filename = time() . '_' . $_FILES['photo']['name'][$fileIndex];
            $target = 'assets/images/uploads/portfolios/' . $filename;
            move_uploaded_file($_FILES['photo']['tmp_name'][$fileIndex], $target);
            $imagePath = $target;

            // Moves to the next uploaded file
            $fileIndex++;
        }

        // Insertion of new portfolio items
        $insert = $dbh->prepare(
            "INSERT INTO portfolios 
            (user_id, title, company_name, piece_title, description_text, portfolio_image, portfolio_group)
             VALUES 
            (:user_id, :title, :company, :piece_title, :description, :image, :group)
        ");

        $insert->execute([
            ':user_id'      => $_SESSION['user_id'],
            ':title'        => $title,
            ':company'      => $company,
            ':piece_title'  => $pieceTitle,
            ':description'  => $description,
            ':image'        => $imagePath,
            ':group'        => $groupId
        ]);
    }

        // Redirects to portfolio overview upon save
        header("Location: portfolio.php?group=" . urlencode($groupId));
        exit();
    }

// Including the header
require_once 'assets/includes/header.php';
?>

<main class="container">
    <!-- To easily controll CSS for edit-portfolio.php -->
    <section class="edit-portfolio-page">
            
        <!-- Button for easy access back to portfolio overview -->
        <a href="portfolio.php?group=<?= urlencode($groupId); ?>"
            class="btn btn-secondary mt-3">
            <i class="fa-solid fa-arrow-left"></i>Back to portfolio
        </a>

        <!-- Form to edit the data that has already been put in -->
        <form method="post" enctype="multipart/form-data">
            <h1 class="mt-4">
                <input type="text" 
                           name="title" 
                           class="form-control my-2" 
                           value="<?= htmlspecialchars($first['title'] ?? ''); ?>" 
                           placeholder="Project Title">
            </h1>
            <p class="text-muted">
                <input type="text" 
                           name="company_name" 
                           class="form-control mb-2" 
                           value="<?= htmlspecialchars($first['company_name'] ?? ''); ?>" 
                           placeholder="Company">
            </p>
            
            <!-- Shows excisting items -->
            <?php foreach ($portfolios as $portfolio): ?>

            <div class="card mb-4 p-3">
                    
                <img src="<?= htmlspecialchars($portfolio['portfolio_image'] ?? 'assets/images/default-portfolio.jpg'); ?>"
                    class="card-image-top" alt="">

                    <div class="card-body">

                        <!-- Button to delete single item -->
                        <button type="submit" 
                                name="delete_item" 
                                value="<?= $portfolio['portfolio_id']; ?>" 
                                class="btn btn-danger btn-sm mb-2 float-end"
                                onClick="return confirm('Are you sure you want to delete this item?')">
                            <i class="fa-solid fa-trash"></i>Delete this item
                        </button>

                        <!-- Hidden ID for updating an existing item -->
                        <input type="hidden"
                               name="id[]" 
                               value="<?= $portfolio['portfolio_id']; ?>">
                    
                        <input type="text" 
                               name="piece_title[]" 
                               class="form-control mb-2" 
                               value="<?= htmlspecialchars($portfolio['piece_title'] ?? ''); ?>" 
                               placeholder="Title of piece">

                        <textarea name="description_text[]" 
                                  class="form-control mb-2" 
                                  placeholder="Description"><?= htmlspecialchars($portfolio['description_text'] ?? ''); ?></textarea>

                        <p class="card-text">
                            <small class="text-body-secondary float-end">
                                <?=  htmlspecialchars($portfolio['created'] ?? ''); ?>
                            </small>
                        </p>

                    </div>

            </div>

            <?php endforeach; ?>

                <!-- To be able to add more items to an existing portfolio -->
                <div id="portfolioContainer">

                    <div class="portfolio-item">

                        <label for="customFile" 
                               class="w-100 border bg-light rounded p-5 text-center d-block">
                            <i class="fa-solid fa-cloud-arrow-up fa-5x text-secondary mb-3"></i>

                            <h5>Choose a file to upload</h5>
                            <p class="text-muted small mb-3">JPG, PNG, GIF</p>

                            <input type="file" 
                                   id="customFile" 
                                   name="photo[]" 
                                   class="form-control w-50 mx-auto">
                        </label>
            
                        <input type="text" 
                               name="piece_title[]" 
                               class="form-control my-2" 
                               placeholder="Title of piece">

                        <textarea name="description_text[]" 
                                  class="form-control mb-2" 
                                  placeholder="Description"></textarea>
                    </div>

                </div>

                <!-- Button to create a clone of an empty form to add new items -->
                <button type="button" onclick="addForm()" 
                        class="btn btn-primary my-3 me-2" 
                        name="upload">
                    <i class="fa-solid fa-plus"></i>
                        <span class="ms-1">Add another file</span>
                </button>

                <!-- Button to save new changes -->
                <button type="submit" 
                        class="btn btn-secondary my-3" 
                        name="upload">
                    <i class="fa-solid fa-floppy-disk"></i>
                        <span class="ms-1">Save changes</span>
                </button>

                <!-- Button to delete entire portfolio -->
                <button type="submit" 
                        class="btn btn-danger my-3 float-end" 
                        name="delete_group" 
                        onClick="return confirm('Are you sure you want to delete this portfolio?')">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                        <span class="ms-1">Delete portfolio</span>
                </button>

        </form>
        
        <!-- Creator copyright -->
        <p>&copy; All rights reserved.</p>
                
    </section>
        
</main>

<script>

// Java Script for cloning upload fields
    function addForm() {
        const container = document.getElementById('portfolioContainer');
        
        const firstItem = container.querySelector('.portfolio-item');
        const newItem   = firstItem.cloneNode(true);

        newItem.querySelectorAll('input, textarea').forEach(el => {
            if (el.type !== 'file') {
                el.value = '';
}
        });
        container.appendChild(newItem);
    }

</script>

<?php
// Including the footer
require_once 'assets/includes/footer.php';
?>