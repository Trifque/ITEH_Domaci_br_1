<?php

class Arheolog{

    public $id_nalog;
    public $ime;
    public $prezime;
    public $godina_rodjenja;
    public $nacionalnost;
    public $username;
    public $password;

    #Konstruktor
    public function __construct($id_nalog = null, $ime = null,$prezime = null, $godina_rodjenja = null, $nacionalnost = null, $username = null, $password = null)
    {
        
        $this->id_nalog = $id_nalog;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->godina_rodjenja = $godina_rodjenja;
        $this->nacionalnost = $nacionalnost;
        $this->username = $username;
        $this->password = $password;
        
    }

    #LogIn funkcija
    public static function logInArheolog($arheolog, mysqli $conn)
    {
        $query = "SELECT * FROM arheolozi WHERE Username = '$arheolog->username' AND Password = '$arheolog->password'";
        return $conn->query($query);
    }

    #Vrati ime i prezime Arheologa
    public static function vratiImeIPrezime($id_nalog, mysqli $conn)
    {
        $query = "SELECT Ime, Prezime FROM arheolozi WHERE ID_nalog = '$id_nalog'";
        $ImeIPrezime = $conn->query($query);
        $red = $ImeIPrezime->fetch_array();
        return($red["Ime"] . " " . $red["Prezime"]);
    }

    #getAll funkcija za arheologe
    public static function getAll(mysqli $conn)
    {
        $query = "SELECT ID_nalog, Ime, Prezime FROM arheolozi";
        return $conn->query($query);
    }
    
}


?>