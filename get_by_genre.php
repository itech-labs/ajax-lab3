<?php
include("connect.php");

$genre_title = $_GET["genre"];

$SELECT = "SELECT name, date, country, director, title FROM film
JOIN film_genre ON ID_FILM = FID_Film
JOIN genre ON FID_Genre = ID_Genre
WHERE title = :genre_title
ORDER BY name";

try {
    $stmt = $dbh->prepare($SELECT);
    $stmt->bindValue(":genre_title", $genre_title);
    $stmt->execute();

    $res = $stmt->fetchAll();

    foreach ($res as $row) {
        echo("<tr><td>$row[0]</td>");
        echo("<td>$row[1]</td>");
        echo("<td>$row[2]</td>");
        echo("<td>$row[3]</td>");
        echo("<td>$row[4]</td></tr>");
    }

    $dbh = null;
} catch (PDOException $ex) {
    echo $ex->GetMessage();
}
