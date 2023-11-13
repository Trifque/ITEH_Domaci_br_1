<?php

require "../DataBaseBroker.php";
require "../PHP_Klase/Nalaziste.php";
echo "Ovde sam u delete-u";
echo $_POST['ID_nalazista'];

if(isset($_POST['ID_nalazista'])){
    $obj = new Nalaziste($_POST['ID_nalazista']);
    $status = $obj->deleteById($conn);
    if ($status)
    {
        echo "Uspesno smo obrisali nalaziste";
    }else
    {
        echo "Nismo uspeli da obrisemo nalaziste";
    }
}

?>