<?php

$servername = "localhost";
$username = "quotout";
$password = "qu0t_";
$dbname = "citation";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Passwort aus dem POST-Request abrufen
$rawPassword = $_POST['password']; 

// Passwort hashen
$hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);

// Gehashtes Passwort in die Datenbank einfügen
$insertSql = $conn->prepare("INSERT INTO password (password) VALUES (?)");
$insertSql->bind_param("s", $hashedPassword);

if($insertSql->execute()) {
    echo "1"; // Erfolg
    header('Location: registrieren.php');
} else {
    echo "Fehler: " . $conn->error;
}

$insertSql->close();
$conn->close();

?>
