<?php
include("connect.php");
header("Content-Type: text/xml");

$start_date = $_GET["start_date"];
$end_date = $_GET["end_date"];

if($start_date > $end_date){
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

$SELECT = "SELECT name, date, country, director, GROUP_CONCAT(genre.title) AS genres FROM film
JOIN film_genre ON film.ID_FILM = film_genre.FID_Film
JOIN genre ON genre.ID_Genre = film_genre.FID_Genre
WHERE date BETWEEN :start_date AND :end_date
GROUP BY film.ID_FILM
ORDER BY date";

try {
    $stmt = $dbh->prepare($SELECT);
    $stmt->bindValue(":start_date", $start_date);
    $stmt->bindValue(":end_date", $end_date);
    $stmt->execute();

    echo "<?xml version='1.0' encoding='UTF-8'?>";
    echo "<films>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<film>";
        echo "<name>" . htmlspecialchars($row['name']) . "</name>";
        echo "<date>" . $row['date'] . "</date>";
        echo "<country>" . $row['country'] . "</country>";
        echo "<director>" . htmlspecialchars($row['director']) . "</director>";
        echo "<genres>" . $row['genres'] . "</genres>";
        echo "</film>";
    }

    echo "</films>";

} catch (PDOException $ex) {
    echo $ex->getMessage();
}
?>
