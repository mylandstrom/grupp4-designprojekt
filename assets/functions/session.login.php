<?php
//  initerar sessionshantering s. 82-85 i Kurslitteratur
if (isset($_POST['login'])) {
    $errors  =  array();
    if (
        empty($_POST['email']) || 
        empty($_POST['password'])
    ) {
   header('Location: ../../index.php?action=empty');
exit();
}

// Trims e-mail and password
$email = trim($_POST['email']);
$password = trim($_POST['password']);

$sql = '
SELECT *
FROM users
WHERE email = :email
AND password = :password
';
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':password', $password);
$stmt->execute();
// Counts rows returned from database
$count = $stmt->rowCount();
// Checks whether user exists
if ($count > 0) {
// Saves results to variable
$row = $stmt->fetch();
// Creates session variable with user id
$_SESSION['user_id'] = $row['user_id'];
// Redirects user to success page
header('Location: ../../index.php');
exit();
} else {
// Redirect user to error page
header('Location: ../../index.php?action=error');
exit();
}
}
?>
<?php
// Checks if an action is set
if (isset($_GET['action'])) {
// Checks which action is set
switch ($_GET['action']) {
case 'empty':
echo '
<div class="alert alert-warning">
You have not entered password or email!
</div>
';
break;
case 'error':
echo '
<div class="alert alert-danger">
The password or email submitted is incorrect!
</div>
';
break;
}
}
?>