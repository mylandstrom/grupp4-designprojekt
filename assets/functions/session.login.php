<?php
//  initerar sessionshantering s. 82-85 i Kurslitteratur
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['submit'])) {
    $errors  =  array();
    if (
        empty($_POST['username']) ||
        empty($_POST['password'])
    ) {
        $errors[]  =   'Fill in the fields for username and password.';
    }
    $username   =   'admin';
    $password   =   'test';
    if (
        $_POST['username'] !=  $username   ||
        $_POST['password']  !=  $password
    ) {
        $errors[]   =   'Wrong username or password.';
    }
    if (count($errors) == 0) {
        $_SESSION['userid'] = 1;
        header('Location: protected.php');
    }
}
