<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 14.03.2018
 * Time: 14:27
 * ort_neu.php
 * Neuen Ortsnamen einfügen
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
            $ort = $_POST['ortsname'];
            /* übergebene Werte der Variablen überprüfen
               Methode quote überprüft, ob es sich um einen einfachen String oder eine SQL-Anweisung handelt */
            $con->quote($ort);

            // Query vorbereiten
            $query = 'insert into ort (ort_name) values(?)';
            $stmt = $con->prepare($query);
            $stmt->bindParam(1, $ort);
            //oder statt bindParam: $stmt->execute([$ort]);
            $stmt->execute();
            echo 'Der Ort '.$ort.' wurde erfasst!<br>';
        } catch (Exception $e)
        {
            echo $e->getMessage();
        }
    } else {
        // Formular anzeigen
        ?>
        <h2>Ort erfassen</h2>
        <form method="post">
            <div class="table">
                <div class="tr">
                    <div class="th">
                        <label for="ort">Ort:</label>
                    </div>
                    <div class="td">
                        <input id="ort" type="text" name="ortsname" required>
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