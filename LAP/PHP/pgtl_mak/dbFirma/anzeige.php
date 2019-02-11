<?php
/**
 * Created by PhpStorm.
 * User: goran
 * Date: 02.04.2018
 * Time: 20:18
 */
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Anzeige</title>
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
    include 'config.php';
    include 'functions.php';
    ?>
    <h1>Willkommen!</h1>
    <?php
    //Anzeige der Tables einer Datenbank mithilfe der showTable-Funktion!!!
    try {
        $query1 = 'select * from personal';
        $query2 = 'select * from dienststelle';
        $query3 = 'select * from personal_dienststelle';

        showTable($connection, $query1);
        showTable($connection, $query2);
        showTable($connection, $query3);

    } catch(Exception $e) {
        $e->getMessage();
    }
    ?>
</main>
</html>