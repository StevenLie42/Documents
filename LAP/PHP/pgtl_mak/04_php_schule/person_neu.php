<?php
/**
 * Created by PhpStorm.
 * User: G.Jovanovic
 * Date: 14.03.2018
 * Time: 09:35
 */
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>DB schule</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="schule.css"
</head>
<body>

<nav>
    <?php
    include'nav.html';
    ?>
</nav>
<main>
<?php
include'config.php';
if(isset($_POST['send'])) {
    try{
        //echo 'speichern<br>';
        $vname = $_POST['vname'];
        $nname = $_POST['nname'];
        /* übergebene Werte der Variablen überprüfen
           Methode quote überprüft, ob es sich um einen einfachen String oder eine SQL-Anweisung handelt */
        $con->quote($vname);
        $con->quote($nname);

        // Query vorbereiten
        $query = 'insert into person(per_vname, per_nname) values(?, ?)';
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $vname);
        $stmt->bindParam(2, $nname);
        $stmt->execute();
        echo $vname.' '.$nname.' wurde erfasst!<br>';
    } catch (Exception $e)
    {
        echo $e->getMessage();
    }
} else {
    // Formular anzeigen
    ?>
    <h2>Personen erfassen</h2>
    <form method="post">
        <div class="table">
            <div class="tr">
                <div class="th">
                    <label for="vn">Vorname:</label>
                </div>
                <div class="td">
                    <input id="vn" type="text" name="vname" required>
                </div>
            </div>
            <div class="tr">
                <div class="th">
                    <label for="nn">Nachname:</label>
                </div>
                <div class="td">
                    <input id="nn" type="text" name="nname" required>
                </div>
            </div>
            <div class="tr">
                <div class="th">
                    <input type="submit" name="send" value="speichern">
                </div>
            </div>
        </div>
    </form>
    <?php
}
?>
</main>
</body>
</html>


