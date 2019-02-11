<?php
/**
 * Created by PhpStorm.
 * User: goran
 * Date: 02.04.2018
 * Time: 20:11
 */

function showTable($con, $query, $bindArray = null) {
    $stmt = $con->prepare($query);
    if($bindArray != null) {
        for($i = 0; $i < sizeof($bindArray); $i++) {
            $stmt->bindParam($i + 1, $bindArray[$i]);
        }
    } else {
        $stmt-> execute();

        echo '<table border="1" style="border-collapse: collapse">';

        echo'<tr>';
        for($i = 0; $i < $stmt->columnCount(); $i++)
        {
            echo '<th>'.$stmt->getColumnMeta($i) ['name'].'</th>';
        }
        echo '</tr>';

        echo '<br>'.'<br>';

        while($row = $stmt->fetch(PDO::FETCH_NUM))
        {
            echo '<tr>';
            foreach($row as $r)
            {
                echo '<td>'.$r.'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }
}



function saveData($connection, $query, $bindArray) {
    $stmt = $connection->prepare($query);

    if($bindArray != null) {
        try {

            // übergebene Werte der Variablen überprüfen
            // Methode quote überprüft, ob es sich um einen einfachen String oder eine SQL-Anweisung handelt
            for($i = 0; $i < sizeof($bindArray); $i++) {
                $connection->quote($bindArray[$i]);
            }

            $connection->beginTransaction();


            for($i = 0; $i < sizeof($bindArray); $i++) {
                $stmt->bindParam($i + 1, $bindArray[$i]);
            }

            $stmt->execute();

            $connection->commit();

            //Überprüfung, ob die Werte des Arrays auf den Bildschirm ausgegeben worden sind!
            for($i = 0; $i < sizeof($bindArray); $i++) {
                echo $bindArray[$i].' wurde erfasst!<br>';
            }

        } catch (Exception $e) {
            $connection->rollback();
            $e->getMessage();
        }
    }
}


