<!DOCTYPE HTML>
<html>
<head>
    <title>DB versand</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="versand.css">
</head>
<body>
<?php
/**
/**
 * Created by PhpStorm.
 * User: Martl
 * Date: 21.03.2018
 * Time: 13:10
 */
?>
<nav>
    <?php
    include'nav.html';
    ?>
</nav>
<main>
    <?php
    include'funktionen.php';
    $con = DatabaseConnection('versand');
    if(isset($_POST['send'])) {
        try {
            $con->quote($_POST['nummer']);
            $nummer = $_POST['nummer'];

            // Kunden der Bestellung ermitteln
            $queryKunde = 'select per_id from bestellung where bes_id = ?';
            $bindArray = array($nummer);
            $stmt = GetStatement($con, $queryKunde, $bindArray);
            $row = $stmt->fetch(PDO::FETCH_NUM);
            $kdID = $row[0];

            // Artikel der Bestellung ermitteln
            $queryArtikel = 'select art_id from bestellung where bes_id = ?';
            $bindArray = array($nummer);
            $stmt = GetStatement($con, $queryArtikel, $bindArray);
            $row = $stmt->fetch(PDO::FETCH_NUM);
            $artID = $row[0];

            // Menge der Bestellung ermitteln
            $queryMenge = 'select bes_menge from bestellung where bes_id = ?';
            $bindArray = array($nummer);
            $stmt = GetStatement($con, $queryMenge, $bindArray);
            $row = $stmt->fetch(PDO::FETCH_NUM);
            $menge = $row[0];

            ?>


            <form method="post">
                <div class="table">
                    <div class="tr">
                        <div class="th">
                            <label for="bn">Bestellnummer:</label>
                        </div>
                        <div class="td">
                            <label><?php echo $nummer; ?></label>
                            <input type="text" value="<?php echo $nummer;?>" name="besNr">
                        </div>
                    </div>
                    <div class="tr">
                        <div class="th">
                            <label for="bn">Kunde:</label>
                        </div>
                        <div class="td">
                            <select id="bn" name="besKunde">
                                <?php
                                $query = 'select * from person';
                                $stmt = GetStatement($con, $query);
                                while($row = $stmt->fetch(PDO::FETCH_NUM))
                                {
                                    if($row[0] == $kdID)
                                        echo '<option value="'.$row[0].'" selected>'.$row[1];
                                    else
                                        echo '<option value="'.$row[0].'">'.$row[1];
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="tr">
                        <div class="th">
                            <label for="bn">Artikel:</label>
                        </div>
                        <div class="td">
                            <select id="bn" name="besArtikel">
                                <?php
                                $query = 'select * from artikel';
                                $stmt = GetStatement($con, $query);
                                while($row = $stmt->fetch(PDO::FETCH_NUM))
                                {
                                    if($row[0] == $artID)
                                        echo '<option value="'.$row[0].'" selected>'.$row[1];
                                    else
                                        echo '<option value="'.$row[0].'">'.$row[1];
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="tr">
                        <div class="th">
                            <label for="bn">Menge:</label>
                        </div>
                        <div class="td">
                            <input type="number" value="<?php echo $menge; ?>" name="besMenge">
                        </div>
                    </div>
                    <div class="tr">
                        <div class="th">
                            <input type="submit" name="change" value="ändern">
                        </div>
                    </div>
                </div>
            </form>
            <?php
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else if(isset($_POST['change']))
    {
        try {
            $con->quote($_POST['besNr']);
            $con->quote($_POST['besKunde']);
            $con->quote($_POST['besArtikel']);
            $con->quote($_POST['besMenge']);

            $besNr = $_POST['besNr'];
            $besKunde = $_POST['besKunde'];
            $besArtikel = $_POST['besArtikel'];
            $besMenge = $_POST['besMenge'];

            $query = 'update bestellung set per_id = ?, art_id= ?, bes_menge=? where bes_id = ?';
            $bindArray = array($besKunde, $besArtikel, $besMenge, $besNr);
            $stmt = GetStatement($con, $query, $bindArray);
            echo 'Daten wurden erfolgreich geändert!<br>';
        } catch (Exception $e)
        {

        }

    }
    else
    {
        ?>
        <h2>Bestellung ändern</h2>
        <h3>Bestllung auswählen</h3>
        <form method="post">
            <div class="table">
                <div class="tr">
                    <div class="th">
                        <label for="bn">Bestellnummer:</label>
                    </div>
                    <div class="td">
                        <select id="bn" name="nummer">
                            <?php
                            $query = 'select bes_id FROM bestellung order by bes_id';
                            $stmt = GetStatement($con, $query);
                            while($row = $stmt->fetch(PDO::FETCH_NUM))
                            {
                                echo '<option value="'.$row[0].'">'.$row[0];
                            }
                            ?>
                        </select>
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