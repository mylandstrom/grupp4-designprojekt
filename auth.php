<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <title>Profolio</title>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--Font Awesome CSS-->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!--Custom styles-->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <form action="auth.php" method="post" class="login>
        <fieldset>
            <legend>Ange inloggningsuppgifter</legend>
            <ol>
                <div>
                    <label for=" email">E-post</label>
        <input name="email" type="text">
        </div>
        <div>
            <label for="password">Lösenord</label>
            <input name="password" type="password">
            //password för att man inte ska kunna se lösenordet när man skriver ut det.
        </div>
        </ol>
        </fieldset>
        <input type="submit" name="submit" value="Logga in"
    </form>
</body>

</html>