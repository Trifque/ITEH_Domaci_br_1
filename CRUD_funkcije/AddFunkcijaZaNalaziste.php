<?php

require "../DataBaseBroker.php";
require "../PHP_Klase/Nalaziste.php";

if(isset($_POST['Ime_nalazista'])    &&
   isset($_POST['Zemlja'])           && 
   isset($_POST['Vremensko_doba'])   && 
   isset($_POST['Znacaj'])           &&
   isset($_POST['Datum_otkrivanja']) &&
   isset($_POST['Pronalazac']))
   {
    $nalaziste = new Nalaziste(null,
                               $_POST['Ime_nalazista'], 
                               $_POST['Zemlja'], 
                               $_POST['Vremensko_doba'],
                               $_POST['Znacaj'], 
                               $_POST['Datum_otkrivanja'],
                               $_POST['Pronalazac']);
    $status = Nalaziste::add($nalaziste, $conn);

    if($status)
    {
        echo 'Uspesno smo kreirali novo nalaziste';
    }else
    {
        echo $status;
        echo "Nismo uspeli da kreiramo novo nalaziste";
    }
   }


?>