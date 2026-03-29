<?php
    // Connecting the databade
    require_once 'assets/config/db.php';
    // Starting session for user handling
    session_start();

    // For form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Creates a unique ID for the portfolio group
        $groupId        = uniqid();
        // Collects data from the form
        $title          = $_POST['title'] ?? '';
        $companyName    = $_POST['company_name'] ?? '';
        $pieceTitles    = $_POST['piece_title'] ?? [];
        $descriptions   = $_POST['description_text'] ?? [];

        // Looping cards for each "post" in the portfolio
        if (!empty($pieceTitles)) {
            for ($i = 0; $i < count($pieceTitles ?? []); $i++) {

                // Skips inputs with no photo or title
                if (empty($pieceTitles[$i]) && empty($_FILES['photo']['name'][$i])) {
                    continue;
                }

                $imagePath = null;

                // Handles photo uploads if such exists
                if (!empty($_FILES['photo']['name'][$i])) {
                    // Creates a unique filename for each photo
                    $filename = time() . '_' . $_FILES['photo']['name'][$i];
                    // Where pictures are to be saved
                    $target = 'assets/images/uploads/portfolios/' . $filename;
                    // Moves picture to the correct folder
                    move_uploaded_file($_FILES['photo']['tmp_name'][$i], $target);
                    $imagePath = $target;
                }

                // Prepares the SQL-query to insert new portfolio data into the database
                $stmt = $dbh->prepare(
                    'INSERT INTO portfolios
                    (user_id, title, company_name, piece_title, description_text, portfolio_image, portfolio_group)
                    VALUES
                    (:user_id, :title, :company_name, :piece_title, :description_text, :portfolio_image, :portfolio_group)'
                );

                // Inserts the data into the database
                $stmt->execute([
                    ':user_id'          => $_SESSION['user_id'],
                    ':title'            => $title,
                    ':company_name'     => $companyName,
                    ':piece_title'      => $pieceTitles[$i] ?? '',
                    ':description_text' => $descriptions[$i] ?? '',
                    ':portfolio_image'  => $imagePath,
                    ':portfolio_group'  => $groupId
                ]);
            }

            // Redirects from the current page/file back to the portfolio overview
            header('Location: portfolio.php?group=' . $groupId);
            exit();
        }
    }

// Adds header and its functions to this page
require_once 'assets/includes/header.php';
?>

<!-- Container to create space on the edges -->
<main class="container">

    <!-- To easily controll CSS for add-profile.php -->
    <div class="add-portfolio-page">

        <h1 class="mt-4">Portfolio Management</h1>
        <p>Here you can create, edit and delete your selected portfolio. You can add photos, change the title and description.</p>

        <!-- Form for creating a new portfolio -->
        <form method="post" enctype="multipart/form-data">

            <!-- To input project info that shows up ones on the page (not cloned by script below) -->
            <input type="text"
                name="title"
                class="form-control my-2"
                placeholder="Project Title">

            <input  type="text"
                    name="company_name"
                    class="form-control mb-2" 
                    placeholder="Company">

            <section id="portfolioContainer">

                <div class="portfolio-item">

                    <!-- For uploading images -->
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

                    <!-- Fields for more info input -->
                    <input type="text" 
                        name="piece_title[]" 
                        class="form-control my-2" 
                        placeholder="Title of piece">

                    <textarea name="description_text[]" 
                            class="form-control mb-2" 
                            placeholder="Description">
                    </textarea>

                </div>

            </section>

            <!-- Buttons to add more items to new portfolio, and upload -->
            <button type="button" 
                    onclick="addForm()" 
                    class="btn btn-primary my-3 me-2" 
                    name="upload">
                <i class="fa-solid fa-plus"></i>
                    <span class="ms-1">Add another file</span>
            </button>

            <button type="submit" 
                    class="btn btn-secondary my-3" 
                    name="upload">
                <i class="fa-solid fa-upload"></i>
                    <span class="ms-1">Upload portfolio</span>
            </button>
        
        </form>
    </div>
</main>

<script>

    // Java Script function to clone part of the form (specifically "portfolioContainer") to add more files to new portfolio
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
// Includes the footer
require_once 'assets/includes/footer.php';
?>