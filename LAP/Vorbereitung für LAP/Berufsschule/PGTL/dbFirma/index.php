<?php
/**
 * Created by PhpStorm.
 * User: goran
 * Date: 02.04.2018
 * Time: 19:44
 */
?>
<!-- HTML-Grundgerüst -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
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
    //Test, ob die Seite funktionsfähig ist!
    try {
        echo '<h3>Das ist ein Test</h3>';
    } catch(Exception $e) {
        $e->getMessage();
    }
    ?>
</main>
</html>