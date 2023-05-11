<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit;
}
// Verbindung zur Datenbank herstellen
$servername = "localhost"; // Servername
$username = "root"; // Benutzername
$password = ""; // Passwort (leer, wenn keine Passwort erforderlich)
$dbname = "citation"; // Datenbankname

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung hergestellt werden konnte
if (!$conn) {
    // Bei Fehler -1 zurückgeben
    echo -1;
} else {
    // Daten aus dem Formular abrufen
    $newQuote = $_POST['quote'];
    $newAuthorVorname = $_POST['author_vorname'];
    $newAuthorNachname = $_POST['author_nachname'];

    // Überprüfen, ob der Autor bereits existiert
    $checkAuthorSql = "SELECT * FROM citation WHERE author_vorname = '$newAuthorVorname' AND author_nachname = '$newAuthorNachname'";
    $checkAuthorResult = mysqli_query($conn, $checkAuthorSql);

    // Wenn der Autor bereits existiert, Fehlermeldung ausgeben
    if (mysqli_num_rows($checkAuthorResult) > 0) {
        echo "Autor bereits vorhanden. Zitat konnte nicht hinzugefügt werden.";
    } else {
        // Autor existiert nicht, daher Zitat zur Datenbank hinzufügen
        $insertSql = "INSERT INTO citation (quote, author_vorname, author_nachname) VALUES ('$newQuote', '$newAuthorVorname', '$newAuthorNachname')";
        $result = mysqli_query($conn, $insertSql);

        // Erfolg oder Fehlermeldung ausgeben
        if ($result) {
            echo "1"; // Erfolg
        } else {
            echo "Fehler beim Hinzufügen des Zitats.";
        }
    }
}

// Verbindung schließen
mysqli_close($conn);
