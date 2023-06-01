<?php
$servername = "localhost";
$username = "quotout";
$password = "qu0t_";
$dbname = "citation";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT quote, author_vorname, author_nachname, views FROM citation ORDER BY views DESC";
$result = mysqli_query($conn, $sql);

$quotes = array();
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $quotes[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($quotes);

$conn->close();
?>
