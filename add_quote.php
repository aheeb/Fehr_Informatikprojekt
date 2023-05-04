<?php
header("Content-Type: text/plain; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["quote"]) && !empty($_POST["author"])) {
        $quote = $_POST["quote"];
        $author = $_POST["author"];

        // Verbindung zur Datenbank herstellen
        $servername = "localhost"; // Servername
        $username = "root"; // Benutzername
        $password = ""; // Passwort (leer, wenn keine Passwort erforderlich)
        $dbname = "citation"; // Datenbankname

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Überprüfen ob die Verbindung hergestellt werden konnte
        if (!$conn) {
            echo -1;
        } else {
            // Einfügen des neuen Zitats in die Datenbank
            $sql = "INSERT INTO citation (quote, author) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ss", $quote, $author);

                if (mysqli_stmt_execute($stmt)) {
                    // Erfolgreich eingefügt
                    echo 1;
                } else {
                    // Fehler beim Einfügen
                    echo -1;
                }
            } else {
                // Fehler beim Vorbereiten des SQL-Statements
                echo -1;
            }
            mysqli_close($conn);
        }
    } else {
        echo -1;
    }
} else {
    echo -1;
}

?>
