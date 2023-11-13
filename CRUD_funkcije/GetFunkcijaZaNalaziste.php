<?php

require "../DataBaseBroker.php";
require "../PHP_Klase/Nalaziste.php";

if(isset($_POST['ID_nalazista'])){
    $myArray = Nalaziste::getById($_POST['ID_nalazista'], $conn);
    echo json_encode($myArray);
}

?>