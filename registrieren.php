<?php

session_start();

if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] !== true) {
    header("Location: login.html");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>
    <script src="dalle.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Registrierung</title>
</head>
<body>
    <div class="form-container">
        <h2>Registrierung</h2>
        <form id="register-form" action="register.php" method="post">
            <label for="password">Passwort:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Registrieren</button>
        </form>
        <a href="logout.php">Logout</a>

        <p id="form-message"></p>
    </div>
</body>
</html>
