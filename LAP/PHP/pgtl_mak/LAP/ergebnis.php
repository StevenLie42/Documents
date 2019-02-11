<!DOCTYPE HTML>
<html lang="de">
    <head>
        <title>LAP</title>
        <meta charset="utf-8">
        <!-- RICHTIGEN NAMEN FÜR CSS-DATEI ANGEBEN-->
        <link rel="stylesheet" href="styles/styles.css">
    </head>
    <body>
        <main>
        <?php
            include'functions.php';
            //RICHTIGEN DATENBANKNAMEN ANGEBEN!!!
            $con = DatabaseConnection('tankstelle');

            if(isset($_POST['suche'])){
                $teilstring = $_POST['suche'];
                $query = 'select * from kunde
                            where kunde_id like ?';
                            PrintTable($con,$query,$teilstring);

                $query = 'select sum(menge) as "Treibstoffver", sum(preis) as "preis" from verbrauch
                            where kunde_id like ?';

                PrintTable($con,$query,$teilstring);
            } else{
                echo("kein wert eingegeben");
            }

            ?>
            
        </main>
    </body>
</html>