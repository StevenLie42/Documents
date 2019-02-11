<?php
/**
 * A L L E    N I C H T    B E N Ö T I G T E N    K O M M E N T A R E    L Ö S C H E N ! ! ! ! ! ! ! ! ! ! ! ! ! ! ! !
 * I N    J E D E M    F I L E ! ! ! ! ! ! ! ! ! ! ! ! ! !
 * Created by PhpStorm. NAMEN ÄNDERN NICHT VERGESSEN!!!!!!!!!!!!
 * User: goran
 * Date: 04.04.2018
 * Time: 23:51
 */
?>

<!DOCTYPE HTML>
<html lang="de">
<head>
    <!-- NICHT VERGESSEN TITLE VALUE ÄNDERN -->
    <title>DB "name"</title>
    <meta charset="utf-8">
    <!-- RICHTIGEN NAMEN FÜR CSS-DATEI ANGEBEN-->
    <link rel="stylesheet" href="name.css">
</head>
<body>
<?php
?>
<nav>
    <?php
    include'nav.html';
    ?>
</nav>
<main>
    <?php
    include'functions.php';
    //RICHTIGEN DATENBANKNAMEN ANGEBEN!!!
    $con = DatabaseConnection('dbname');
    //RICHTIGEN NAME-VALUE VOM BUTTON VERWENDEN!!!
    if(isset($_POST['value'])) {
        try {



        } catch (Exception $e) {
            //Falls notwendig dann $con->rollback() auskommentieren
            //$con->rollBack();
            echo $e->getMessage();
        }
    } else {
        ?>
        <!-- FORMULAR ERZEUGEN!!! -->
        <h2>TEXT HIER EINGEBEN</h2>
        <form method="post">
            <div class="tabel">

                <!-- CODE FÜR DROPDOWN-FELD -->
                <div class="tr">
                    <div class="th">
                        <!-- WERT FÜR FOR VERGEBEN -->
                        <label for="wert">TEXT HIER EINGEBEN:</label>
                    </div>
                    <div class="td">
                        <!-- RICHTIGEN WERT FÜR NAME-ATTRIBUT VERGEBEN (AUCH FÜR ID, FALLS NOTWENDIG) -->
                        <select id="wert" name="wert">
                            <?php
                            /*QUERY ZUSAMMENBAUEN
                            $query = 'select bs_id, concat(bs_zusatz, " ", bs_ort)
                            from bs';
                            $stmt = $con->prepare($query);
                            $stmt->execute();
                            while($row = $stmt->fetch(PDO::FETCH_NUM))
                            {
                                echo '<option value="'.$row[0].'">'.$row[1];
                            }
                            */
                            ?>
                        </select>
                    </div>
                </div>

                <!-- CODE FÜR INPUT-FELDER
                NICHT VERGESSEN FÜR DIE ATTRIBUTE DIE RICHTIGEN WERTE ZU VERGEBEN-->

                <!-- CODE NUR FÜR LABEL -->
                <div class="tr">
                    <div class="th">
                        <label for="wert">TEXT HIER EINGEBEN:</label>
                    </div>
                </div>

                <!-- CODE FÜR LABEL + INPUT-FELDER -->
                <div class="tr">
                    <div class="th">
                        <label for="wert">TEXT HIER EINGEBEN:</label>
                    </div>
                    <div class="td">
                        <input id="wert" type="text" name="wert" required>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">
                        <label for="wert">TEXT HIER EINGEBEN:</label>
                    </div>
                    <div class="td">
                        <input id="wert" type="text" name="wert" required>
                    </div>
                </div>

                <!-- CODE FÜR SUBMIT-BUTTON -->
                <div class="tr">
                    <div class="th">
                        <input type="submit" name="value" value="wert">
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


