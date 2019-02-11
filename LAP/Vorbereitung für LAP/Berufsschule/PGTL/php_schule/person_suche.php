<!DOCTYPE html>
<html>
<head>
    <?php
    /**
    * Created by PhpStorm.
    * User: Admin
    * Date: 22.03.2018
    * Time: 08:54
    */
    ?>
    <title>Personensuche</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="schule.css">
</head>
<body>
<nav>
    <?php
    include 'nav.html';
    ?>
</nav>
<main>
    <h2>Personensuche</h2>
    <?php
    include 'config.php';
    include 'function.php';
    if(isset($_POST['search'])) {
        // to do
        echo 'Suchergebnis';
        try {
            $con->quote($_POST['nname']);
            $nname = $_POST['nname'];

            $con->beginTransaction();

            //Fragezeichen beim like wird ersetzt durch variable $nname mithilfe von bindParam()/$bindARray
            $query = 'select * from person where per_nname like ? or per_vname like ?';
            $nname = '%'.$nname.'%';
            $bindArray = array($nname, $nname);

            ShowTable($con, $query, $bindArray);
            /*
            $nname = '%'.$nname.'%';
            $stmt = $con->prepare($query);
            $stmt->bindParam(1, $nname);
            $stmt->execute();
            */
            $con->commit();
            /*
            //Ausgabe der Tabelle
            while($row = $stmt->fetch(PDO::FETCH_NUM)) {
                echo $row[0].' '.$row[1]. ' '.$row[2].'<br>';
            }
            */

        } catch (Exception $e) {
            $con->rollBack();
            $e->getMessage();
        }
    } else {
        // Formular
        ?>
        <form method="post">
            <label for="nn">Suche nach Nachname:</label>
            <input id="nn" type="text" name="nname" placeholder="z.B. baum">
            <br>
            <input type="submit" name="search" value="Suchen">
        </form>
        <?php
    }
    ?>
</main>
</body>
</html>

