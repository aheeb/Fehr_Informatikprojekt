<?php

$servername = "localhost";
$username = "quotout";
$password = "qu0t_";
$dbname = "citation";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$rawPassword = $_POST['password']; 

$sql = "SELECT password FROM admin_password WHERE id = 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $hashedPassword = $row['password'];
    
    if (password_verify($rawPassword, $hashedPassword)) {
        session_start();
        $_SESSION['isAdmin'] = true; 
        // Anstelle von echo "1"; können Sie die Benutzer direkt umleiten
        header("Location: registrieren.php");
        exit;
    } else {
        echo "Falsches Passwort";
    }
} else {
    echo "Kein Admin-Passwort gefunden";
}

$conn->close();

?>
