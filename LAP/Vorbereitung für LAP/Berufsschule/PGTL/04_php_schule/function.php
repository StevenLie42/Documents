<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22.03.2018
 * Time: 09:09
 */

function showTable($con, $query, $bindArray = null) {
    $stmt = $con->prepare($query);
    if($bindArray != null) {
        for($i = 0; $i < sizeof($bindArray); $i++) {
            $stmt->bindParam($i + 1, $bindArray[$i]);
        }
    } else {

    }
    $stmt-> execute();

    echo '<table border="1">';

    echo'<tr>';
    for($i = 0; $i < $stmt->columnCount(); $i++)
    {
        echo '<th>'.$stmt->getColumnMeta($i) ['name'].'</th>';
    }
    echo '</tr>';
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