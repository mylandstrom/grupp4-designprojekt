<!--kontrollerar om användaren är inloggad, annars skickas den tillbaka till index.php s. 87-->
<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header('Location: index.php');
}
?>