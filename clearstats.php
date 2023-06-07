<?php
$servername = "localhost";
$username = "quotout";
$password = "qu0t_";
$dbname = "citation";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE citation SET views = 0";
if (mysqli_query($conn, $sql)) {
    // Hier keine Ausgabe machen, da dies die Verwendung von header() unten stört
} else {
    echo "Fehler beim Zurücksetzen der Views: " . mysqli_error($conn);
    exit();  // Beenden Sie das Skript, wenn ein Fehler auftritt, um die Weiterleitung unten zu verhindern
}

$conn->close();

// Weiterleitung zur stats.html-Seite
header("Location: stats.php");
exit();  // Beenden Sie das Skript nach der Weiterleitung, um sicherzustellen, dass kein weiterer Code ausgeführt wird
?>
