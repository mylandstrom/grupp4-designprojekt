<?php
// =============================================================================
// DATABASANSLUTNING MED PDO
// =============================================================================
// Den här filen skapar en anslutning till MySQL-databasen.
// Inkludera denna fil i dina andra PHP-filer med: require_once 'db.php';
// Sedan kan du använda variabeln $dbh för att köra databasfrågor.
// =============================================================================

// -----------------------------------------------------------------------------
// DATABASINSTÄLLNINGAR
// -----------------------------------------------------------------------------
// Dessa värden matchar inställningarna i docker-compose.yml
// Konstanter kan inte ändras efter att de definierats (säkrare)
// -----------------------------------------------------------------------------
define('DB_HOST', 'mysql');        // Servernamn
define('DB_NAME', 'mydb');         // Databasnamn
define('DB_USER', 'root');         // Användarnamn
define('DB_PASS', 'root');         // Lösenord

// -----------------------------------------------------------------------------
// SKAPA DATABASANSLUTNING
// -----------------------------------------------------------------------------
try {
    // Anslutningssträng (DSN = Data Source Name)
    // utf8mb4 ger stöd för svenska tecken (åäö) och emojis
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

    // PDO-inställningar
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,                            // Visa fel som undantag
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,                       // Hämta som array med kolumnnamn
        PDO::ATTR_EMULATE_PREPARES => false,                                    // Skydda mot SQL-injection
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = 'Europe/Stockholm'",   // Svensk tidszon
    ];

    // Skapa anslutningen
    $dbh = new PDO($dsn, DB_USER, DB_PASS, $options);

    // Visa meddelande om anslutningen lyckades
    echo 'Anslutningen till databasen lyckades!';
} catch (PDOException $e) {
    // Visa felmeddelande om något gick fel
    die("Kunde inte ansluta till databasen.");
}
