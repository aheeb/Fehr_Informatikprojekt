<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Zitatstatistik</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Statistik</h1>

    <?php
    include('fetchstats.php');
    ?>

    <p>Gesamtanzahl der Zitate: <span id="total-quotes"><?= $totalQuotes ?></span></p>
    <p>Gesamtanzahl der Ansichten: <span id="total-views"><?= $totalViews ?></span></p>
    <button onclick="window.location.href='clearstats.php'">Views zurücksetzen</button>

    <table>
        <thead>
            <tr>
                <th>Zitat</th>
                <th>Autor</th>
                <th>Ansichten</th>
            </tr>
        </thead>
        <tbody id="quote-table">
        <?php
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>{$row['quote']}</td><td>{$row['author_first_name']} {$row['author_last_name']}</td><td>{$row['views']}</td></tr>";
            }
        ?>
        </tbody>
    </table>

    <?php
    mysqli_close($conn);
    ?>

</body>
</html>
