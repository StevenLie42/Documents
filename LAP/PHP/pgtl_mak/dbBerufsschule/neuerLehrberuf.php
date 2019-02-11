<?php
/**
 * Created by PhpStorm.
 * User: goran
 * Date: 04.04.2018
 * Time: 21:33
 */
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>DB berufsschule</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="berufsschule.css">
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
    $con = DatabaseConnection('berufsschule');
    if(isset($_POST['save'])) {
        try {
            $con->quote($_POST['bezeichnung']);
            $con->quote($_POST['kuerzel']);
            $con->quote($_POST['bs_id']);

            $bezeichnung = $_POST['bezeichnung'];
            $kuerzel = $_POST['kuerzel'];
            $bs_id = $_POST['bs_id'];

            echo 'Folgende Daten werden gespeichert:'.'<br>'.$bezeichnung.'<br>'.$kuerzel.'<br>'.$bs_id.'<br>';

            //Neuer Lehrberuf wird gespeichert
            $con->beginTransaction();

            $query1 = 'insert into lehrberuf(lb_bezeichnung, lb_kurz) values(?, ?)';
            $bindArray = array($bezeichnung, $kuerzel);
            $stmt = GetStatement($con, $query1, $bindArray);

            $lehrberufID = $con->lastInsertId();
            //echo $lehrberufID;

            // Die richtigen IDs werden in der bs_lehrberuf Table gespeichert
            $query2 = 'insert into bs_lehrberuf(bs_id, lb_id) values(?, ?)';
            $bindArray = array($bs_id, $lehrberufID);
            $stmt = GetStatement($con, $query2, $bindArray);

            $con->commit();

        } catch (Exception $e) {
            $con->rollBack();
            echo $e->getMessage();
        }
    } else {
        ?>
        <h2>Neuen Lehrberuf anlegen</h2>
        <form method="post">
            <div class="tabel">
                <div class="tr">
                    <div class="th">
                        <label for="bs">Berufsschule:</label>
                    </div>
                    <div class="td">
                        <select id="bs" name="bs_id">
                            <?php
                            $query = 'select bs_id, concat(bs_zusatz, " ", bs_ort)
                            from bs';
                            $stmt = $con->prepare($query);
                            $stmt->execute();
                            while($row = $stmt->fetch(PDO::FETCH_NUM))
                            {
                                echo '<option value="'.$row[0].'">'.$row[1];
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">
                        <label for="lb">Lehrberuf:</label>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">
                        <label for="bez">Bezeichnung:</label>
                    </div>
                    <div class="td">
                        <input id="bez" type="text" name="bezeichnung" required>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">
                        <label for="kuer">Kürzel:</label>
                    </div>
                    <div class="td">
                        <input id="kuerz" type="text" name="kuerzel" required>
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
</body>
</html>

