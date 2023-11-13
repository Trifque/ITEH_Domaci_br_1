<?php

require "../DataBaseBroker.php";
require "../PHP_Klase/Nalaziste.php";

if(isset($_POST['ID_nalazista_izmena'])     &&
   isset($_POST['Ime_nalazista_izmena'])    &&
   isset($_POST['Zemlja_izmena'])           && 
   isset($_POST['Vremensko_doba_izmena'])   && 
   isset($_POST['Znacaj_izmena'])           &&
   isset($_POST['Datum_otkrivanja_izmena']) &&
   isset($_POST['Pronalazac_izmena']))
   {
    $nalaziste = new Nalaziste($_POST['ID_nalazista_izmena'],
                               $_POST['Ime_nalazista_izmena'], 
                               $_POST['Zemlja_izmena'], 
                               $_POST['Vremensko_doba_izmena'],
                               $_POST['Znacaj_izmena'], 
                               $_POST['Datum_otkrivanja_izmena'],
                               $_POST['Pronalazac_izmena']);
    $status = Nalaziste::update($nalaziste, $conn);

    if($status)
    {
        echo 'Uspesno smo update-ovali novo nalaziste';
    }else
    {
        echo $status;
        echo "Nismo uspeli da update-ujemo novo nalaziste";
    }
   }


?>