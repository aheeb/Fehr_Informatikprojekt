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
     // SQL-Abfrage ausführen
     $sql = "SELECT * FROM citation ORDER BY RAND() LIMIT 1"; // Zufälliges Zitat auswählen
     $result = mysqli_query($conn, $sql);
 
     // Ergebnis überprüfen
     if (mysqli_num_rows($result) > 0) {
         // Zitat auslesen und als JSON-Objekt zurückgeben
         $row = mysqli_fetch_assoc($result);
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
