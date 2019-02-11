<?php
/**
 * Created by PhpStorm.
 * User: G.Jovanovic
 * Date: 01.03.2018
 * Time: 09:24
 * Verbindungsaufbau zu Server und DB
 */
$server = 'localhost';
$user = 'root';
$pwd = '';
$db = 'schule';

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