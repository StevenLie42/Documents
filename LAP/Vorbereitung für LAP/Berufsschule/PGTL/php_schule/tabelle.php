<?php
/**
 * Created by PhpStorm.
 * User: G.Jovanovic
 * Date: 01.03.2018
 * Time: 09:35
 */
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>DB schule</title>
    <meta charset="utf-8">
</head>
<body>
<nav>
    <?php
    include'nav.html';
    ?>
</nav>
<main>
    <?php
    include'config.php';
    try{

       $query1 = 'select PER_ID,
                  per_vname AS "Vorname",
                  per_nname AS "Nachname"
                  from person';
       /* Erstellen Sie eine Funktion, die für ein beliebiges Query eine Tabelle ausgibt
       und geben Sie folgende Tabellen aus:
       Alle Personen
       Alle Orte
       Personen + Wohnort
       Alle Personen und falls vorhanden den Wohnort */

       $query2 = 'select per_vname as "Vorname", per_nname as "Nachname" from person';
       $query3 = 'select ort_name as "Ort" from ort';
       $query4 = 'select per_vname as "Vorname", per_nname as "Nachname", ort_name as "Wohnort" from person_ort
                  natural join (person, ort)';
       $query5 = 'select per_vname as "Vorname", per_nname as "Nachname", ort_name as "Wohnort" from person
                    left outer join person_ort using(per_id)
                    left outer join ort using(ort_id)';

       function showTable($query, $con) {
           $stmt = $con->prepare($query);
           $stmt-> execute();

           echo '<table border="1">';

           echo'<tr>';
           for($i = 0; $i < $stmt->columnCount(); $i++)
           {
               echo '<th>'.$stmt->getColumnMeta($i) ['name'].'</th>';
           }
           echo '</tr>';
           while($row = $stmt->fetch(PDO::FETCH_NUM))
           {
               echo '<tr>';
               foreach($row as $r)
               {
                   echo '<td>'.$r.'</td>';

               }
               echo '</tr>';
           }
           echo '</table>';
       }

        /*
        $query = 'select per_vname as "Vorname", per_nname as "Nachname", ort_name as "Ort"
                  from person_ort natural join (person, ort)';
        */
       // prepare: DB auf Abfrage "vorbereiten
       /*
       $stmt = $con->prepare($query);

       $stmt->execute();
       */
       showTable($query1, $con);
       showTable($query2, $con);
       showTable($query3, $con);
       showTable($query4, $con);
       showTable($query5, $con);


       /* getColumnMeta: Attributeigenschaften auslesen */

       //echo $stmt->getColumnMeta(0) ['name'].'<br>'; --> ermittelt die Eigenschaften eines Attributs
       //echo $stmt->columnCount().'<br>';
       /*
        echo '<table border="1">';

       echo'<tr>';
       for($i = 0; $i < $stmt->columnCount(); $i++)
       {
           echo '<th>'.$stmt->getColumnMeta($i) ['name'].'</th>';
       }
       echo '</tr>';
       while($row = $stmt->fetch(PDO::FETCH_NUM))
       {
           echo '<tr>';
           foreach($row as $r)
           {
               echo '<td>'.$r.'</td>';

           }
           echo '</tr>';
       }
       */
       /*
       while($row = $stmt->fetch())
       {
           echo '<tr>
                   <td>'.$row['PER_ID'].'</td>
                   <td>'.$row['Vorname'].'</td>
                   <td>'.$row[2].'</td>
                 </tr>';
       }
       */
       /*echo '</table>'; */
    } catch (Exception $e)
    {
        echo $e->getMessage();
    }
    ?>
</main>
</body>
</html>
