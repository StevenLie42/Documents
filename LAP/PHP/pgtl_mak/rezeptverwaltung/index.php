<?php
/**
 * Created by PhpStorm.
 * User: Stefan
 * Date: 15.03.2018
 * Time: 08:28
 * S. Rorhauer, 15.03.2018
 * Kochrezeptverwaltung
 */
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Rezepteverwaltung</title>
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
    include'config.php';
    if(isset($_POST['search'])){
        try{
        ?>
            <h1>Nach Rezepten suchen</h1>
        <form method="post">
            <div class="table">
                <div class="tr">
                    <div class="th">
                        <label for="rez">Ergebnisliste der Suche:</label>
                    </div>
                    <div class="td">
                        <select id="rez" name="rezept">
                            <?php
                            $teilstring = $_POST['rname'];
                            $teilstring = '%'.$teilstring.'%';
                            $query = 'select * from rezeptname
                                      where rez_name like ?
                                      order by rez_name';
                            $stmt = $con->prepare($query);
                            $stmt->bindParam(1, $teilstring);
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
                        <input type="submit" name="send" value="Anzeigen">
                    </div>
                </div>
            </div>
        </form>
        <?php
        } catch (Exception $e)
        {
            echo $e->getMessage();
        }
    } elseif(isset($_POST['send'])){
        try{
            echo '<h1>Gefundene Rezepte</h1>';
                $value = $_POST['rezept'];
                $query1 = 'select zub_id, zub_beschreibung from zubereitung
                           where rez_id like ?';
                $stmt2 = $con->prepare($query1);
                $stmt2->bindParam(1, $value);
                $stmt2->execute();
                while($row = $stmt2->fetch(PDO::FETCH_NUM)) {
                    echo $row[1].':<br>';
                    $query2 = 'select zubein_menge AS "Menge", ein_name AS "Einheit", zut_name AS "Zutat" from zubereitung_einheit
                      join zutat_einheit using(zuei_id)
                      join zutat using(zut_id)
                      join einheit using(ein_id)
                      join zubereitung using(zub_id)
                      join rezeptname using(rez_id)
                      where zub_id like "' . $row[0] . '" 
                      group by zuei_id';
                    $stmt = $con->prepare($query2);
                    $stmt->execute();
                    echo '<table border="1">';
                    echo '<tr>';
                    for ($i = 0; $i < $stmt->columnCount(); $i++) {
                        echo '<th>' . $stmt->getColumnMeta($i)['name'] . '</th>';
                    }
                    echo '</tr>';
                    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                        echo '<tr>';
                        foreach ($row as $r) {
                            echo '<td>' . $r . '</td>';
                        }
                        echo '</tr>';
                    }
                    echo '</table>';
                }
        } catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
    else{
        ?>
        <h1>Nach Rezepten suchen</h1>
        <form method="post">
            <div class="table">
                <div class="tr">
                    <div class="th">
                        <label for="rn">Rezept:</label>
                    </div>
                    <div class="td">
                        <input id="rn" type="text" name="rname" required>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">
                        <input type="submit" name="search" value="Suchen">
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