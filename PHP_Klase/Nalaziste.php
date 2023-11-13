<?php
class Nalaziste{
    public $id_nalazista;   
    public $ime_nalazista;   
    public $zemlja;   
    public $vremensko_doba;
    public $znacaj;
    public $datum_otkrivanja;
    public $pronalazac;

    #Konstruktor
    public function __construct($id_nalazista = null, 
                                $ime_nalazista = null, 
                                $zemlja = null, 
                                $vremensko_doba = null, 
                                $znacaj = null, 
                                $datum_otkrivanja = null, 
                                $pronalazac = null)
    {
        $this->id_nalazista      = $id_nalazista;
        $this->ime_nalazista     = $ime_nalazista;
        $this->zemlja            = $zemlja;
        $this->vremensko_doba    = $vremensko_doba;
        $this->znacaj            = $znacaj;
        $this->datum_otkrivanja  = $datum_otkrivanja;
        $this->pronalazac        = $pronalazac;
    }

    #getAll funkcija za nalazista
    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM nalazista";
        return $conn->query($query);
    }

    #getById funkcija
    public static function getById($id_nalazista, mysqli $conn){
        $query = "SELECT * FROM nalazista WHERE ID_nalazista = $id_nalazista";

        $myObj = array();
        if($msqlObj = $conn->query($query)){
            while($red = $msqlObj->fetch_array(1)){
                $myObj[]= $red;
            }
        }

        return $myObj;

    }

    #deleteById funkcija
    public function deleteById(mysqli $conn)
    {
        $query = "DELETE FROM nalazista WHERE ID_nalazista=$this->id_nalazista";
        return $conn->query($query);
    }

    #update funkcija                                                                                  
    public static function update(Nalaziste $nalaziste, mysqli $conn)
    {
        $query = "UPDATE nalazista set Ime_nalazista = '$nalaziste->ime_nalazista', Zemlja = '$nalaziste->zemlja', Vremensko_doba = '$nalaziste->vremensko_doba', Znacaj = '$nalaziste->znacaj', Datum_otkrivanja = '$nalaziste->datum_otkrivanja', Pronalazac = '$nalaziste->pronalazac' WHERE ID_nalazista = $nalaziste->id_nalazista";
        return $conn->query($query);
    }

    #add funkcija
    public static function add(Nalaziste $nalaziste, mysqli $conn)
    {
        $query = "INSERT INTO nalazista(Ime_nalazista, Zemlja, Vremensko_doba, Znacaj, Datum_otkrivanja, Pronalazac) VALUES('$nalaziste->ime_nalazista', '$nalaziste->zemlja', '$nalaziste->vremensko_doba', '$nalaziste->znacaj', '$nalaziste->datum_otkrivanja', '$nalaziste->pronalazac')";
        return $conn->query($query);
    }
}

?>