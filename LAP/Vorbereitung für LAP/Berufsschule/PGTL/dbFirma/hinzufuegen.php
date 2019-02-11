<?php
/**
 * Created by PhpStorm.
 * User: goran
 * Date: 02.04.2018
 * Time: 20:25
 */
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Person hinzufuegen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
    <?php
    include'nav.html';
    ?>
</nav>
<main>
    <?php
    include 'config.php';
    include 'functions.php';
    // 1. Schritt --> Erstellung der if-(elseif)-else Bedingung mit Überprüfung der globalen Variable $_POST
    if(isset($_POST['save'])) {
        // 'save' = Wert des buttons beim name-Attribut
        try {

            // 3. Schritt --> Speichern der Daten
            // Codezeile darunter auskommentieren, um zu überprüfen, ob man auf die nächste Seite weitergeleitet wird!
            // echo 'speichern<br>';

            // Werte der Input-Felder speichertn
            $vname = $_POST['vname'];
            $nname = $_POST['nname'];

            $bindArray = array($vname, $nname);

            $query = 'insert into personal(per_vname, per_nname) values(?, ?)';

            saveData($connection, $query, $bindArray);

            /*Die Table ausgeben, um zu Überprüfen ob die Werte in der Table gespeichert wurden!
            $query1 = 'select * from personal';
            showTable($connection, $query1);
            */

        } catch (Exception $e) {
            $e->getMessage();
        }

    } else {
        // 2. Schritt --> Formular im else-Zweig (zum Erfassen der neuen Person) erstellen
        ?>
        <h1>Neue Person erfassen!</h1>
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
                        <input type="submit" name="save" value="speichern">
                    </div>
                </div>
            </div>
        </form>
    <?php
    }
    ?>
</main>
</html>