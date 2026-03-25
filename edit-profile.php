<?php
require_once 'assets/includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: auth.php');
    exit();
}

$userId = (int) $_SESSION['user_id'];
$errors = [];
$success = false;
$defaultProfileImage = 'assets/images/profile-pic.jpg';
$currentProfileImage = $defaultProfileImage;
$defaultFeaturedImage = 'assets/images/profile-pic.jpg';
$currentFeaturedImage = $defaultFeaturedImage;

// Load current user data.
$select = $dbh->prepare('SELECT user_id, firstname, lastname, email FROM users WHERE user_id = :user_id');
$select->bindValue(':user_id', $userId, PDO::PARAM_INT);
$select->execute();
$user = $select->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header('Location: logout.php');
    exit();
}

// Load latest uploaded profile image for preview.
$photoSelect = $dbh->prepare("SELECT original FROM photos WHERE user_id = :user_id AND original LIKE 'assets/images/uploads/profiles/%' ORDER BY regdate DESC, id DESC LIMIT 1");
$photoSelect->bindValue(':user_id', $userId, PDO::PARAM_INT);
$photoSelect->execute();
$photoRow = $photoSelect->fetch(PDO::FETCH_ASSOC);
if ($photoRow && !empty($photoRow['original'])) {
    $currentProfileImage = $photoRow['original'];
}

// Load latest uploaded featured card image for preview.
$featuredSelect = $dbh->prepare("SELECT original FROM photos WHERE user_id = :user_id AND original LIKE 'assets/images/uploads/featured/%' ORDER BY regdate DESC, id DESC LIMIT 1");
$featuredSelect->bindValue(':user_id', $userId, PDO::PARAM_INT);
$featuredSelect->execute();
$featuredRow = $featuredSelect->fetch(PDO::FETCH_ASSOC);
if ($featuredRow && !empty($featuredRow['original'])) {
    $currentFeaturedImage = $featuredRow['original'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_account'])) {
        $deletePassword = trim($_POST['delete_password'] ?? '');

        if ($deletePassword === '') {
            $errors[] = 'Enter your password to delete your account.';
        } else {
            // Delete only if password matches current user.
            $delete = $dbh->prepare('DELETE FROM users WHERE user_id = :user_id AND password = :password');
            $delete->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $delete->bindValue(':password', $deletePassword);
            $delete->execute();

            if ($delete->rowCount() === 1) {
                session_unset();
                session_destroy();
                header('Location: index.php?action=account_deleted');
                exit();
            }

            $errors[] = 'Password is incorrect. Account was not deleted.';
        }
    } else {
        $firstName = trim($_POST['first_name'] ?? '');
        $lastName = trim($_POST['last_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $currentPassword = trim($_POST['current_password'] ?? '');
        $newPassword = trim($_POST['new_password'] ?? '');
        $confirmNewPassword = trim($_POST['confirm_new_password'] ?? '');
        $uploadedProfilePath = null;
        $uploadedFeaturedPath = null;

        if ($firstName === '' || $lastName === '' || $email === '') {
            $errors[] = 'All fields are required.';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address.';
        }

        $uploadImage = function (string $inputName, string $folderName, string $label) use ($userId, &$errors): ?string {
            if (!isset($_FILES[$inputName]) || (int) $_FILES[$inputName]['error'] === UPLOAD_ERR_NO_FILE) {
                return null;
            }

            $uploadError = (int) $_FILES[$inputName]['error'];
            if ($uploadError !== UPLOAD_ERR_OK) {
                $serverUploadLimit = ini_get('upload_max_filesize');

                if ($uploadError === UPLOAD_ERR_INI_SIZE || $uploadError === UPLOAD_ERR_FORM_SIZE) {
                    $errors[] = $label . ' is too large. Max upload size is ' . $serverUploadLimit . '.';
                } else {
                    $errors[] = $label . ' upload failed.';
                }
                return null;
            }

            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];
            $detectedMimeType = mime_content_type($_FILES[$inputName]['tmp_name']);

            if (!in_array($detectedMimeType, $allowedMimeTypes, true)) {
                $errors[] = $label . ' must be JPG, PNG or WEBP.';
                return null;
            }

            if ((int) $_FILES[$inputName]['size'] > 5 * 1024 * 1024) {
                $errors[] = $label . ' must be 5MB or smaller.';
                return null;
            }

            $extensionMap = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp',
            ];

            $uploadDirectory = __DIR__ . '/assets/images/uploads/' . $folderName;
            if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0755, true) && !is_dir($uploadDirectory)) {
                $errors[] = 'Could not create upload directory for ' . strtolower($label) . '.';
                return null;
            }

            try {
                $randomSuffix = bin2hex(random_bytes(8));
            } catch (Exception $e) {
                $errors[] = 'Could not generate a secure filename for ' . strtolower($label) . '.';
                return null;
            }

            $uniqueFileName = 'user_' . $userId . '_' . $randomSuffix . '.' . $extensionMap[$detectedMimeType];
            $destinationPath = $uploadDirectory . '/' . $uniqueFileName;
            if (!move_uploaded_file($_FILES[$inputName]['tmp_name'], $destinationPath)) {
                $errors[] = 'Could not save ' . strtolower($label) . '.';
                return null;
            }

            return 'assets/images/uploads/' . $folderName . '/' . $uniqueFileName;
        };

        // Separate upload handlers so profile image and featured card image can be managed independently.
        $uploadedProfilePath = $uploadImage('profile_image', 'profiles', 'Profile image');
        $uploadedFeaturedPath = $uploadImage('featured_card_image', 'featured', 'Featured card image');

        // Password change is optional, but if one field is used then all are required.
        $wantsPasswordChange = $currentPassword !== '' || $newPassword !== '' || $confirmNewPassword !== '';
        if ($wantsPasswordChange) {
            if ($currentPassword === '' || $newPassword === '' || $confirmNewPassword === '') {
                $errors[] = 'Fill in all password fields to change your password.';
            }

            if ($newPassword !== '' && strlen($newPassword) < 6) {
                $errors[] = 'The new password must be at least 6 characters long.';
            }

            if ($newPassword !== $confirmNewPassword) {
                $errors[] = 'The new passwords do not match.';
            }
        }

        if (empty($errors)) {
            // Prevent duplicate email on another account.
            $emailCheck = $dbh->prepare('SELECT user_id FROM users WHERE email = :email AND user_id <> :user_id');
            $emailCheck->bindValue(':email', $email);
            $emailCheck->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $emailCheck->execute();

            if ($emailCheck->fetch()) {
                $errors[] = 'This email address is already used by another account.';
            } else {
                if ($wantsPasswordChange) {
                    // Verify current password before saving a new one.
                    $passwordCheck = $dbh->prepare('SELECT user_id FROM users WHERE user_id = :user_id AND password = :password');
                    $passwordCheck->bindValue(':user_id', $userId, PDO::PARAM_INT);
                    $passwordCheck->bindValue(':password', $currentPassword);
                    $passwordCheck->execute();

                    if (!$passwordCheck->fetch()) {
                        $errors[] = 'Current password is incorrect.';
                    }
                }
            }

            if (empty($errors)) {
                $updateSql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email';
                if ($wantsPasswordChange) {
                    $updateSql .= ', password = :password';
                }
                $updateSql .= ' WHERE user_id = :user_id';

                $update = $dbh->prepare($updateSql);
                $update->bindValue(':firstname', $firstName);
                $update->bindValue(':lastname', $lastName);
                $update->bindValue(':email', $email);
                if ($wantsPasswordChange) {
                    $update->bindValue(':password', $newPassword);
                }
                $update->bindValue(':user_id', $userId, PDO::PARAM_INT);
                $update->execute();

                if ($uploadedProfilePath !== null) {
                    $insertPhoto = $dbh->prepare(
                        'INSERT INTO photos (user_id, original, thumb, regdate) VALUES (:user_id, :original, :thumb, NOW())'
                    );
                    $insertPhoto->bindValue(':user_id', $userId, PDO::PARAM_INT);
                    $insertPhoto->bindValue(':original', $uploadedProfilePath);
                    $insertPhoto->bindValue(':thumb', $uploadedProfilePath);
                    $insertPhoto->execute();
                    $currentProfileImage = $uploadedProfilePath;
                }

                if ($uploadedFeaturedPath !== null) {
                    $insertFeaturedPhoto = $dbh->prepare(
                        'INSERT INTO photos (user_id, original, thumb, regdate) VALUES (:user_id, :original, :thumb, NOW())'
                    );
                    $insertFeaturedPhoto->bindValue(':user_id', $userId, PDO::PARAM_INT);
                    $insertFeaturedPhoto->bindValue(':original', $uploadedFeaturedPath);
                    $insertFeaturedPhoto->bindValue(':thumb', $uploadedFeaturedPath);
                    $insertFeaturedPhoto->execute();
                    $currentFeaturedImage = $uploadedFeaturedPath;
                }

                $success = true;

                // Refresh shown values after update.
                $user['firstname'] = $firstName;
                $user['lastname'] = $lastName;
                $user['email'] = $email;
            }
        }
    }
}
?>

<?php require_once 'assets/includes/header.php'; ?>

<style>
    .edit-profile-page {
        font-family: Helvetica, sans-serif;
    }

    .edit-profile-card {
        max-width: 620px;
        margin: 2rem auto 5rem;
        border: 1px solid #ddd;
        border-radius: 12px;
        background: #fff;
        padding: 2rem;
    }

    .edit-profile-page .form-label {
        font-weight: 600;
    }
</style>

<main class="edit-profile-page">
    <section class="container">
        <div class="edit-profile-card">
            <h1 class="h3 mb-3">Edit Profile</h1>
            <p class="text-muted mb-4">Update your account details.</p>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach ($errors as $error): ?>
                        <div><?= htmlspecialchars($error); ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success" role="alert">
                    Profile updated successfully.
                </div>
            <?php endif; ?>

            <form method="post" action="edit-profile.php" enctype="multipart/form-data">
                <div class="mb-3 text-center">
                    <img src="<?= htmlspecialchars($currentProfileImage); ?>" alt="Current profile image" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                </div>

                <div class="mb-3">
                    <label for="profile_image" class="form-label">Profile image (JPG, PNG, WEBP)</label>
                    <input id="profile_image" name="profile_image" type="file" class="form-control" accept="image/jpeg,image/png,image/webp">
                </div>

                <div class="mb-3 text-center">
                    <img src="<?= htmlspecialchars($currentFeaturedImage); ?>" alt="Current featured card image" class="rounded-3" style="width: 160px; height: 110px; object-fit: cover;">
                </div>

                <div class="mb-3">
                    <label for="featured_card_image" class="form-label">Featured card image (JPG, PNG, WEBP)</label>
                    <input id="featured_card_image" name="featured_card_image" type="file" class="form-control" accept="image/jpeg,image/png,image/webp">
                </div>

                <div class="mb-3">
                    <label for="first_name" class="form-label">First name</label>
                    <input id="first_name" name="first_name" type="text" class="form-control" value="<?= htmlspecialchars($user['firstname']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Last name</label>
                    <input id="last_name" name="last_name" type="text" class="form-control" value="<?= htmlspecialchars($user['lastname']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input id="email" name="email" type="email" class="form-control" value="<?= htmlspecialchars($user['email']); ?>" required>
                </div>

                <hr class="my-4">
                <h2 class="h5 mb-3">Change Password</h2>
                <p class="text-muted">Leave these fields empty if you do not want to change your password.</p>

                <div class="mb-3">
                    <label for="current_password" class="form-label">Current password</label>
                    <input id="current_password" name="current_password" type="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">New password</label>
                    <input id="new_password" name="new_password" type="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="confirm_new_password" class="form-label">Confirm new password</label>
                    <input id="confirm_new_password" name="confirm_new_password" type="password" class="form-control">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="profile.php" class="btn btn-secondary">Back</a>
                </div>
            </form>

            <hr class="my-4">
            <h2 class="h5 mb-3 text-danger">Delete Account</h2>
            <p class="text-muted">This action cannot be undone.</p>

            <form method="post" action="edit-profile.php" onsubmit="return confirm('Are you sure you want to permanently delete your account?');">
                <div class="mb-3">
                    <label for="delete_password" class="form-label">Confirm with your password</label>
                    <input id="delete_password" name="delete_password" type="password" class="form-control" required>
                </div>
                <button type="submit" name="delete_account" value="1" class="btn btn-danger">Delete my account</button>
            </form>
        </div>
    </section>
</main>

<?php require_once 'assets/includes/footer.php'; ?>