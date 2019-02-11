<?php
/**
 * Created by PhpStorm.
 * User: Stefan
 * Date: 15.03.2018
 * Time: 08:26
 * S. Rorhauer, 15.03.2018
 * Kochrezeptverwaltung
 */
$server = 'localhost';
$user = 'root';
$pwd = '';
$db = 'rezept';

try {
    $con = new PDO('mysql:host='.$server.';dbname='.$db.';charset=utf8', $user, $pwd);
    // ExceptionHandling einschalten
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch(Exception $e)
{
    echo $e->getMessage();
}