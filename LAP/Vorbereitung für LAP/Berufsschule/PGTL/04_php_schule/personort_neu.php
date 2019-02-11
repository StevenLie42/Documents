<?php
/**
 * Created by PhpStorm.
 * User: G.Jovanovic
 * Date: 14.03.2018
 * Time: 14:27
 * personort_neu.php
 * Personen erfassen und gleichzeitig einem Ort zuordnen
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
if(isset($_POST['save'])) {
    try {
        $vname = $_POST['vname'];
        $nname = $_POST['nname'];
        $ort_id = $_POST['ort_id'];
        $con->quote($vname);
        $con->quote($nname);
        $con->quote($ort_id);
        echo '<h2>Persone + Ort erfassen</h2>';
        echo 'Folgende Daten werden gespeichert: '.$vname.'|'.$nname.' | '.$ort_id.'<br>';

        $con->beginTransaction(); // funktioniert eventuell nicht
        $query1 = 'insert into person(per_vname, per_nname) values(?, ?)';
        $stmt = $con->prepare($query1);
        $stmt->bindParam(1, $vname);
        $stmt->bindParam(2, $nname);
        $stmt->execute();
        $perID = $con->lastInsertId();

        $query2 = 'insert into person_ort(per_id, ort_id) values(?, ?)';
        $stmt = $con->prepare($query2);
        $stmt->bindParam(1, $perID);
        $stmt->bindParam(2, $ort_id);
        $stmt->execute();

        $con->commit();

        echo '<span>Der Datensatz wurde gespeichert!<br></span>';
    } catch (Exception $e)
    {
        $con->rollBack();
        echo $e->getMessage();
    }
} else {
    // Formular anzeigen
    ?>
    <h2>Person + Ort erfassen</h2>
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
        </div>
        <div class="tr">
            <div class="th">
                <label for="ort">Ort:</label>
            </div>
            <div class="td">
                <select id="ort" name="ort_id">
                    <?php
                    $query = 'select * from ort order by ort_name';
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
                    <input type="submit" name="save" value="speichern">
                </div>
        </div>
    </form>
    <?php
}
?>
</main>
</body>
</html>
