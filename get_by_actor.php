<?php
include("connect.php");

$actor_name = $_GET["actor"];

$SELECT = "SELECT  film.name, film.date, film.country, film.director, GROUP_CONCAT(genre.title) AS genres FROM film
JOIN film_actor ON film.ID_FILM = film_actor.FID_Film
JOIN actor ON film_actor.FID_Actor = actor.ID_Actor
JOIN film_genre ON film.ID_FILM = film_genre.FID_Film
JOIN genre ON film_genre.FID_Genre = genre.ID_Genre 
WHERE actor.name = :actor_name
GROUP BY film.ID_FILM
ORDER BY film.name";

try {
    $stmt = $dbh->prepare($SELECT);
    $stmt->bindValue(":actor_name", $actor_name);
    $stmt->execute();

    $res = $stmt->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($res);

    $dbh = null;
} catch (PDOException $ex) {
    echo $ex->GetMessage();
}
?>
