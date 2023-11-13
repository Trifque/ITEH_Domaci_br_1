<?php
$host = "localhost";
$db = "arheoloska nalazista";
$user = "root";
$pass = "";

$conn = new mysqli($host,$user,$pass,$db);


if ($conn->connect_errno){
    exit("Doslo je do greske prilikom uspostavljanja veze sa bazom:> ".$conn->connect_error.", err kod:>".$conn->connect_errno);
}

?>