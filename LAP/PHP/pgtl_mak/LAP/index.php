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
            ?>
            <h2>Suche nach Kundennummer</h2>
            <form action="ergebnis.php" method="post">
                <input type="text" name="suche">
                <input type="submit" name="submit" value="Suche">
                <input type="reset" name="reset" value="Leeren">
            </form>
            <?php
            ?>
        </main>
    </body>
</html>
