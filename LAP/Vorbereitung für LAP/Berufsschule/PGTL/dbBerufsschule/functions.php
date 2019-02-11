<?php
/**
 * Created by PhpStorm.
 * User: goran
 * Date: 03.04.2018
 * Time: 22:49
 */

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

function GetStatement($con, $query, $paramArray = null)
{
    try
    {
        $stmt = $con->prepare($query);
        if($paramArray != null)
        {
            for($i = 0; $i < sizeof($paramArray); $i++)
            {
                $stmt->bindParam($i+1, $paramArray[$i]);
            }
        }
        $stmt->execute();
        return $stmt;
    } catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

function PrintTable($con, $query, $boundParam=null)
{
    try {
        $stmt = $con->prepare($query);
        if($boundParam != null)
        {
            for($i = 0; $i < sizeof($boundParam); $i++)
            {
                $stmt->bindParam($i+1, $boundParam[$i]);
            }
        }
        $stmt->execute();
        echo '<table class="table function-table">';
        echo '<tr class="tr" id="tr1">';
        for ($i = 0; $i < $stmt->columnCount(); $i++) {
            echo '<th class="th" id="th1">' . $stmt->getColumnMeta($i)['name'] . '</th>';
        }
        echo '</tr>';
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo '<tr class="tr" id="tr1">';
            foreach ($row as $r) {
                echo '<td class="td" id="td1">' . $r . '</td>';
            }
            echo '</tr>';
        }

        echo '</table>';
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}