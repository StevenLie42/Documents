<?php
/**
 * Created by PhpStorm.
 * User: Jovanovic
 * Date: 28.02.2018
 * Time: 13:33
 */
/* bei form method=get wird ein globales Array $_GET erstellt
bei der Methode post --> $_POST*/

if(isset($_GET['send']))
{
    echo 'Senden ausgewählt<br>';
    $nname = $_GET['nname'];
    echo 'Nachname: '.$nname.'<br>';

    $ort = $_GET['ort'];
    $buch = $_GET['buch'];
    $alter = $_GET['alter'];
    //echo 'Ort: '.$ort.'<br>';
    foreach($ort as $o)
    {
        echo $o.' ';
    }

    echo '<br>';

    foreach($buch as $b)
    {
        echo $b.' ';
    }

    echo '<br>';

    echo 'Alter: '.$alter.'<br>';

    echo 'Wollen Sie die Daten speichern?';
    ?>
    <form method="get">
        <input type="radio" name="jn" value="0">Nein
        <input type="radio" name="jn" value="1" checked>Ja
        <?php
        echo '<input type="hidden" name="nname" value="'.$nname.'">';
        foreach($ort as $o)
        {
            echo '<input type="hidden" name="ort[]" value="'.$o.'">';
        }

        foreach($buch as $b) {
            echo '<input type="hidden" name="buch[]" value="'.$b.'">';
        }

        echo '<input type="hidden" name="alter" value="'.$alter.'">';
        ?>
        <input type="submit" name="save" value="bestätigen">
    </form>
<?php
} else if(isset($_GET['save']))
{
    $nname = $_GET['nname'];
    echo $nname.'<br>';

    $ort = $_GET['ort'];
    foreach($ort as $o)
    {
        echo $o.' ';
    }

    echo '<br>';

    $buch = $_GET['buch'];
    foreach($buch as $b)
    {
        echo $b.' ';
    }

    $alter = $_GET['alter'];
    echo $alter.'<br>';

    echo 'speichern';
}