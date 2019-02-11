<!DOCTYPE HTML>
<html>
<head>
    <title>DB versand</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="versand.css">
</head>
<body>
<?php
/**
/**
 * Created by PhpStorm.
 * User: Martl
 * Date: 21.03.2018
 * Time: 13:10
 */
?>
<nav>
    <?php
    include'nav.html';
    ?>
</nav>
<main>
    <?php
    include'funktionen.php';
    $con = DatabaseConnection('versand');
    if(isset($_POST['send'])) {
        try {

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        ?>
        <h2>Kundenliste</h2>
        <form method="post">
            <div class="table">
                <div class="tr">
                    <div class="th">
                        <h3>Tabelle 1</h3>
                        <?php
                        $query = 'select per_nname as "Nachname", per_vname as "Vorname", art_name as "Artikel", sum(bes_menge) as "Bestellmenge"
                                  from bestellung natural join (person, artikel)
                                  group by art_id
                                  having Bestellmenge > 1
                                  order by per_nname';
                        PrintTable($con, $query);
                        ?>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">
                        <h3>Tabelle 2</h3>
                        <?php
                        $query = 'select per_nname as "Nachname", per_vname as "Vorname"
                                  from person left outer join bestellung using(per_id)
                                  where bestellung.per_id is null';
                        PrintTable($con, $query);
                        ?>
                    </div>
                </div>
            </div>
        </form>
        <?php
    }
    ?>
</main>
</body>
</html>

