<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Library</title>
    <link rel="stylesheet" href="./main.css">
    <script src="getData.js"></script>
</head>

<body>
    <div id="forms">
        <form onsubmit="getByGenre(event)">
        <div class="form-info">
            <h2>Select movies by genre</h2>
            <label for="genre">Genre</label> <br>
            <select name="genre" id="genre">
                <?php
                include("connect.php");

                $SELECT = "SELECT title FROM genre";
                try {
                    $stmt = $dbh->prepare($SELECT);
                    $stmt->execute();

                    $res = $stmt->fetchAll();

                    foreach ($res as $row) {
                        echo("<option value='$row[0]'>$row[0]</option>");
                    }
                } catch (PDOException $ex) {
                    echo $ex->GetMessage();
                }
                ?>
            </select>
        </div>
            <input type="submit" value="Submit" >
        </form>

        <form onsubmit="getByActor(event)">
        <div class="form-info">
            <h2>Select movies by actor</h2>
            <label for="actor">Actor</label> <br>
            <select name="actor" id="actor">
                <?php
                $SELECT = "SELECT name FROM actor";
                try {
                    $stmt = $dbh->prepare($SELECT);
                    $stmt->execute();

                    $res = $stmt->fetchAll();

                    foreach ($res as $row) {
                        echo("<option value='$row[0]'>$row[0]</option>");
                    }
                    $dbh = null;
                } catch (PDOException $ex) {
                    echo $ex->GetMessage();
                }
                ?>
            </select>
        </div>
        <input type="submit" value="Submit">
        </form>

        <form onsubmit="getByPeriod(event)">
            <h2>Select movies by time period</h2>
            <label for="start_date">Start date</label>
            <input type="date" name="start_date" id="start_date" required> <br>
            <label for="end_date">End date</label>
            <input type="date" name="end_date" id="end_date" required>
            <br>
            <input type="submit" value="Submit">
        </form>
    </div>

    <div id="data">
        <table id="table">
            <thead>
                <th>Name</th>
                <th>Date</th>
                <th>Country</th>
                <th>Director</th>
                <th>Genre</th>
            </thead>
            <tbody id="dataTable">

            </tbody>
        </table>
    </div>
</body>
</html>