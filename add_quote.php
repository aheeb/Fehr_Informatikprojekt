<?php

session_start();

$servername = "localhost";
$username = "quotout";
$password = "qu0t_";
$dbname = "citation";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$quote = $_POST['quote'];
$author_vorname = $_POST['author_vorname'];
$author_nachname = $_POST['author_nachname'];
$rawPassword = $_POST['password']; 

// Überprüfen, ob das Passwort korrekt ist
$checkPass = "SELECT * FROM password"; 
$checkResult = mysqli_query($conn, $checkPass);
$passwordMatch = false;

while($row = mysqli_fetch_assoc($checkResult)) {
    if(password_verify($rawPassword, $row['password'])) {
        $passwordMatch = true;
        break;
    }
}

if(!$passwordMatch) {
    echo 'Falsches Passwort.';
    mysqli_close($conn);
    exit();
}

// Prüfen, ob das Zitat bereits existiert
$checkQuote = $conn->prepare("SELECT * FROM citation WHERE quote = ? AND author_vorname = ? AND author_nachname = ?");
$checkQuote->bind_param("sss", $quote, $author_vorname, $author_nachname);

$checkQuote->execute();
$checkQuote->store_result();

if($checkQuote->num_rows > 0) {
    echo 'Dieses Zitat existiert bereits.';
    $checkQuote->close();
    mysqli_close($conn);
    exit();
}

$checkQuote->close();

$insertSql = $conn->prepare("INSERT INTO citation (quote, author_vorname, author_nachname) VALUES (?, ?, ?)");
$insertSql->bind_param("sss", $quote, $author_vorname, $author_nachname);

if($insertSql->execute()) {
    echo "1"; // Erfolg
} else {
    echo "Fehler: " . $insertSql . "<br>" . $conn->error;
}

$insertSql->close();
$conn->close();

?>
