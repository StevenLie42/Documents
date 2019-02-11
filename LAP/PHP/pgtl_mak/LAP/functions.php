<?php

//VERBINDUNG ZUR DATENBANK AUFBAUEN
function DatabaseConnection($dbname)
{
    $server = 'localhost';
    $user = 'root';
    $pwd = '';
    $db = $dbname;

    try {
        $con = new PDO('mysql:host='.$server.';dbname='.
            $db.';charset=utf8', $user, $pwd);
        // Exception Handling explizit einschalten
        $con->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);
    } catch(Exception $e)
    {
        echo $e->getMessage();
    }
    return $con;
}

//gibt tabelle mit den werten aus

function PrintTable($con, $query, $boundParam=null)
{
    try {
        $stmt = $con->prepare($query);
        if($boundParam != null)
        {
                $stmt->bindParam(1, $boundParam);
        }
        $stmt->execute();
        //Wenn nicht gebraucht, dann class function-table löschen!
        if ($stmt->fetch(PDO::FETCH_NUM) ){
            $stmt->execute();
            echo '<table class="table function-table">';
            echo '<tr class="tr">';
            for ($i = 0; $i < $stmt->columnCount(); $i++) {
                echo '<th class="th">' . $stmt->getColumnMeta($i)['name'] . '</th>';
            }
            echo '</tr>';
            while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                echo '<tr class="tr">';
                foreach ($row as $r) {
                    echo '<td class="td">' . $r . '</td>';
                }
                echo '</tr>';
            }

            echo '</table>';
            
        }
        else{
            echo("nix gefunden");
        }
        
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}