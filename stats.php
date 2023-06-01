<?php
session_start();

$servername = "localhost";
$username = "quotout";
$password = "qu0t_";
$dbname = "citation";

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);
$collection = new mysqli($servername, $username, $password, $dbname);

// Überprüfen, ob die Verbindung erfolgreich hergestellt wurde
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// SQL-Abfrage ausführen
$sql = "SELECT * FROM citation"; 
$result = $conn->query($sql);

// Ergebnisse ausgeben
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["quote"] . "</td>";
        echo "<td>" . $row["author_vorname"] . $row["author_nachname"] . "</td>";
        echo "<td>" . $row["views"] . "</td>"; 
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Keine Daten gefunden</td></tr>";
}

// Verbindung schließen
$conn->close();
?>