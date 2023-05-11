<?php

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
    // Zufälliges Zitat auswählen
    $sql = "SELECT * FROM citation ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($conn, $sql);

    // Ergebnis überprüfen
    if (mysqli_num_rows($result) > 0) {
        // Zitat auslesen
        $row = mysqli_fetch_assoc($result);
        
        // Anzahl der Anzeigen erhöhen
        $quoteId = $row['ID'];
        $updateSql = "UPDATE citation SET views = views + 1 WHERE ID = $quoteId";
        mysqli_query($conn, $updateSql);

        // Zitat als JSON-Objekt zurückgeben
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        // Bei Fehler -1 zurückgeben
        echo -1;
    }
}

// Verbindung schließen
mysqli_close($conn);
?>
