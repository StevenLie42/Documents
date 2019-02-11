<?php
/**
 * Created by PhpStorm.
 * User: Martl
 * Date: 21.03.2018
 * Time: 13:05
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
        echo '<table>';
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
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}