<?php
require_once 'assets/includes/header.php';
?>

<main class="container">
    <h1 class="mt-4">Portfolio Management</h1>
    <p>Here you can create, edit and delete your selected portfolio. You can add photos, change the title and description.</p>
<form action="profile.php" method="post" enctype="multipart/form-data">
            <label for="customFile" class="w-100 border bg-light rounded p-5 text-center d-block">
                <i class="fa-solid fa-cloud-arrow-up fa-5x text-secondary mb-3"></i>
                <h5>Choose a file to upload</h5>
                <p class="text-muted small mb-3">JPG, PNG, GIF</p>
                <input type="file" id="customFile" name="photo" class="form-control w-50 mx-auto">
            </label>
            <button type="submit" class="btn btn-success my-4" name="upload">Upload</button>
        </form>

        
        <button class="btn btn-primary mb-1"><i class="fa-solid fa-pen"></i><span class="ms-1">Edit text</span></button>
        <button class="btn btn-primary mb-1"><i class="fa-solid fa-trash"></i></button>
        <div class="card mb-4">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
  </div>
</div>
        
        <button class="btn btn-primary mb-4"><i class="fa-solid fa-floppy-disk"></i><span class="ms-1">Save Changes</span></button>
        <button class="btn btn-danger mb-4"><i class="fa-solid fa-triangle-exclamation"></i><span class="ms-1">Delete Portfolio</span></button>
</main>

<?php
require_once 'assets/includes/footer.php';
?>