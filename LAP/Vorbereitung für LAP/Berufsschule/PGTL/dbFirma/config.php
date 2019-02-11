<?php
/**
 * Created by PhpStorm.
 * User: goran
 * Date: 02.04.2018
 * Time: 20:02
 */

$server = 'localhost';
$user= 'root';
$pwd = '';
$database = 'firma';

try {
    $connection = new PDO('mysql:host='.$server.';dbname='.
        $database.';charset=utf8', $user, $pwd);
    // Exception Handling explizit einschalten
    $connection->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
} catch(Exception $e)
{
    echo $e->getMessage();
}