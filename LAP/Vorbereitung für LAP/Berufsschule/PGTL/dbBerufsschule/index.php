<?php
/**
 * Created by PhpStorm.
 * User: goran
 * Date: 03.04.2018
 * Time: 22:49
 */
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>DB berufsschule</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./berufsschule.css">
</head>
<body>
<nav>
    <?php
    include'nav.html';
    ?>
</nav>
<main>
    <?php
    include'functions.php';
    $con = DatabaseConnection('berufsschule');
    if(isset($_POST['send'])) {
        try {
            //echo 'test';
            $con->quote($_POST['vname']);
            $vname = $_POST['vname'];
            $con->quote($_POST['nname']);
            $nname = $_POST['nname'];

            $checkPerson = 'select pe_vname, pe_nname
            from person
            where pe_vname = ? and pe_nname = ?';

            $bindArray = array($vname, $nname);

            $stmt = GetStatement($con, $checkPerson, $bindArray);
            $row = $stmt->fetch(PDO::FETCH_NUM);
            $userVname = $row[0];
            $userNname = $row[1];
            ?>

            <h2>Überprüfung der Person</h2>
            <form method="post">
                <div class="table">
                    <div class="tr">
                        <div class="th">
                            <label for="vn">Vorname:</label>
                        </div>
                        <div class="td">
                            <label><?php echo $vname; ?></label>
                            <!-- Die Bestellnummer wird in einem "unsichtbaren" input Feld angezeigt und als Wert
                            für das name-Attribut "besNr" vergeben, damit dann auf der nächsten Seite die Bestellnummer
                            verwendet werden kann, da ansonst die Information verloren geht. -->
                            <input type="hidden" value="<?php echo $vname;?>" name="v_vname">
                        </div>
                    </div>
                    <div class="tr">
                        <div class="th">
                            <label for="vn">Nachname:</label>
                        </div>
                        <div class="td">
                            <label><?php echo $nname; ?></label>
                            <!-- Die Bestellnummer wird in einem "unsichtbaren" input Feld angezeigt und als Wert
                            für das name-Attribut "besNr" vergeben, damit dann auf der nächsten Seite die Bestellnummer
                            verwendet werden kann, da ansonst die Information verloren geht. -->
                            <input type="hidden" value="<?php echo $nname;?>" name="n_nname">
                        </div>
                    </div>
                    <?php
                    if($row[0] == $vname && $row[1] == $nname) {
                        echo 'Person existiert bereits!<br>Wollen Sie Die Person trotzdem speichern?';
                    }
                    else {
                        echo 'Person exisitert noch nicht!';
                    }
                    ?>
                    <div class="tr">
                        <div class="th">
                            <input type="submit" name="change" value="speichern">
                        </div>
                    </div>
                </div>
            </form>
            <?php

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } elseif (isset($_POST['change'])) {
        try {
            $con->quote($_POST['v_vname']);
            $con->quote($_POST['n_name']);

            $v_vname = $_POST['v_vname'];
            $n_name = $_POST['n_name'];

            $update = 'insert into person (pe_vname, pe_nname) values (?, ?)';
            $updateBindArray = array($v_vname, $n_name);
            $stmt = GetStatement($con, $update, $updateBindArray);
            echo 'Person wurde gespeichert';

        } catch (Exception $e) {
            $e->getMessage();
        }

    } else {
    // Formular anzeigen
    ?>
    <h1>Personenanmeldung</h1>
    <form method="post">
        <div class="table">
            <div class="tr">
                <div class="th">
                    <label for="vn">Vorname:</label>
                </div>
                <div class="td input">
                    <input id="vn" type="text" name="vname" required>
                </div>
            </div>
            <div class="tr">
                <div class="th">
                    <label for="nn">Nachname:</label>
                </div>
                <div class="td input">
                    <input id="nn" type="text" name="nname" required>
                </div>
            </div>
            <div class="tr">
                <div class="th">
                    <label for="job">Job:</label>
                </div>
                <div class="td input">
                    <input type="radio" name="job" value="direktor">Direktor
                    <input type="radio" name="job" value="lehrer">Lehrer
                    <input type="radio" name="job" value="lehrer" checked>Schüler
                </div>
            </div>
            <div class="tr">
                <div class="th">
                    <label for="bs">Berufsschulen:</label>
                </div>
                <div class="td input">
                    <?php
                    $queryBS = 'select distinct bs.bs_id, concat(bs_ort, " ", bs_zusatz)
                                from bs natural join bs_lehrberuf';

                    $stmt = GetStatement($con, $queryBS);
                        ?>
                        <table>
                            <tr>
                                <th class="th">Schule</th>
                                <th>Lehrberuf</th>
                            </tr>
                            <?php
                            while($row = $stmt->fetch(PDO::FETCH_NUM)) {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $bsid = array($row[0]);
                                    echo $row[1];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $query1 = 'select concat(bs_zusatz, " ", bs_ort) as "Schule", lb_kurz
                                      from bs_lehrberuf
                                      join bs using(bs_id)
                                      join lehrberuf using (lb_id)
                                      where bs_id = ?
                                      order by "Schule", lb_kurz';

                                        $stmt1 = GetStatement($con, $query1, $bsid);
                                        echo '<select id="bs" name="berufsschule">';
                                        while ($row1 = $stmt1->fetch(PDO::FETCH_NUM)) {
                                            //option value erstellt Dropdown
                                            echo '<option value="' . $row1[1] . '">' . $row1[1];
                                        }
                                        ?>
                                </td>
                            </tr>
                                <?php
                            }
                            ?>
                        </table>
                </div>
            </div>
            <div class="tr">
                <div class="th">
                    <input type="submit" name="send" value="Senden">
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