<?php
/**
 * Created by PhpStorm.
 * User: goran
 * Date: 03.04.2018
 * Time: 22:49
 */
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>DB versand</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="versand.css">
</head>
<body>
<nav>
    <?php
    include'nav.html';
    ?>
</nav>
<main>
    <?php
    include'functions.php';
    $connection = DatabaseConnection('versand');
    if(isset($_POST['send'])) {
        try {

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        ?>
        <h2>Kundenliste</h2>
        <h3>Tabelle 1</h3>
        <?php
        $query = 'select per_nname as "Nachname", per_vname as "Vorname", art_name as "Artikel", sum(bes_menge) as "Bestellmenge"
          from bestellung natural join (person, artikel)
          group by art_id
          having Bestellmenge > 1
          order by per_nname';
        PrintTable($connection, $query);
            ?>
        <h3>Tabelle 2</h3>
        <?php
        $query = 'select per_nname as "Nachname", per_vname as "Vorname"
          from person left outer join bestellung using(per_id)
          where bestellung.per_id is null';
        PrintTable($connection, $query);}
    ?>
</main>
</body>
</html>