<?php
$servername = "localhost";
$username = "quotout";
$password = "qu0t_";
$dbname = "citation";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT quote, author_first_name, author_last_name, views FROM citation ORDER BY views DESC";
$result = mysqli_query($conn, $sql);

$totalQuotes = mysqli_num_rows($result);
$totalViews = 0;
while($row = mysqli_fetch_assoc($result)) {
    $totalViews += $row['views'];
}

mysqli_data_seek($result, 0);

?>
