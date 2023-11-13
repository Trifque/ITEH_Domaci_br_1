
<!--PHP kod koji je neophodan za pokretanje i zatim pracenja sesije-->

<?php

require "DataBaseBroker.php";
require "PHP_Klase/Nalaziste.php";
require "PHP_Klase/Arheolog.php";

session_start();
if (!isset($_SESSION['id_nalog'])) {
    header('Location: index.php');
    exit();
}

$nalazista = Nalaziste::getAll($conn);
if (!$nalazista) {
    echo "Doslo je do greske pri preuzimanju podataka za nalazista";
    die();
}

$arheolozi = Arheolog::getAll($conn);
if (!$arheolozi) {
    echo "Doslo je do greske pri preuzimanju podataka za arheologe";
    die();
}

if ($nalazista->num_rows == 0) {
    echo "U bazi nema arheoloskih nalazista";
    die();
}

if ($arheolozi->num_rows == 0) {
    echo "U bazi nema arheologa";
    die();
}

?>
















<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <link rel="shortcut icon">

    <link rel="stylesheet" type="text/css" href="css/glavna_strana.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Domaci 1: Belezenje arheoloskih nalaza</title>

</head>

<body>


    <div class="jumbotron">

        <h1>Centar Za belezenje arheoloskih nalaza</h1>

    </div>

    <!--Ovde se prikazuju svi podaci-->

    <div id="pregled" class="panel panel-success" >

        <div class="panel-body">

            <table id="Tabela" class="table table-striped" style="color: black; background-color: rgb(126, 124, 8); border: 3px solid black;">
                
                <!--Naslovi kolona-->
            
                <thead class="thead">
                    <tr>
                        <th scope="col">Ime nalazista</th>
                        <th scope="col">Zemlja u kojoj se nalazi nalaziste</th>
                        <th scope="col">Vremensko doba iz kog je nalaziste</th>
                        <th scope="col">Datum otkrivanja nalazista</th>
                        <th scope="col">Znacaj nalazista</th>
                        <th scope="col">Otkrivac nalazista</th>
                        <th scope="col">Biranje nalazista za izmenu/brisanje</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <!--Sami podaci-->
                    <?php
                        while ($red = $nalazista->fetch_array()) :
                    ?>

                        <tr>
                            <td><?php echo $red["Ime_nalazista"] ?></td>
                            <td><?php echo $red["Zemlja"] ?></td>
                            <td><?php echo $red["Vremensko_doba"] ?></td>
                            <td><?php echo $red["Datum_otkrivanja"] ?></td>
                            <td><?php echo $red["Znacaj"] ?></td>
                            <td><?php echo Arheolog::vratiImeIPrezime($red["Pronalazac"],$conn) ?></td>
                            <td>
                                <label class="custom-radio-btn">
                                    <input type="radio" name="Izabrano_nalaziste" value=<?php echo $red["ID_nalazista"] ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </td>

                        </tr>

                        <?php
                            endwhile;
                        ?>

                </tbody>
            </table>

            <!-- Poslednji red sa dugmicima -->
            <div class="row" name="poslednja_linija">
                <div class="col-md-4">
                    <button id="dugme-dodaj"          name="dugme-dodaj"          data-toggle="modal" data-target="#dodajNalazisteModal"            style="background-color: rgb(153, 128, 4); color: black; font-size: large; border: 3px solid black;"> Zapisi novo arheolosko nalaziste</button>
                </div>
                <div class="col-md-4">
                    <button id="dugme-izmeni"         name="dugme-izmeni"         data-toggle="modal" data-target="#izmeniArheoloskoNalazisteModal" style="background-color: rgb(153, 128, 4); color: black; font-size: large; border: 3px solid black; ">Izmeni Podatke nalazista</button>
                </div>
                <div class="col-md-4">
                    <button id="dugme-obrisi"         name="dugme-obrisi"                                                                           style="background-color: rgb(153, 128, 4); color: black; font-size: large; border: 3px solid black; ">Obrisi nalaziste</button>
                </div>
                <div class="col-md-4">
                    <button id="dugme-prikazi"        name="dugme-prikazi"                                                                          style="background-color: rgb(153, 128, 4); color: black; font-size: large; border: 3px solid black; "> Prikazi Arheoloska nalazista</button>
                </div>
                <div class="col-md-4">
                    <button id="dugme-sortiraj-modal" name="dugme-sortiraj-modal" data-toggle="modal" data-target="#sortirajNalazistaModal"         style="background-color: rgb(153, 128, 4); color: black; font-size: large; border: 3px solid black; ">Sortiraj nalazista</button>
                </div>
                <div class="col-md-4">
                    <button id="dugme-pretrazi-modal" name="dugme-pretrazi-modal" data-toggle="modal" data-target="#pretraziNalazistaModal"         style="background-color:  rgb(153, 128, 4); color: black; font-size: large; border: 3px solid black;"> Pretrazi arheoloska nalazista</button>
                </div>
            </div>

        </div>
    </div>

    
























    <!-- Modal za ubacivanje novog arheoloskog nalazista -->
    <div class="modal fade" id="dodajNalazisteModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="container prijava-promena-form">
                        <form action="#" method="post" id="dodajForm">

                            <h3 style="color: black;">Dodaj novo Nalaziste</h3>
                            <br>

                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <input type="text" style="border: 1px solid black" id="Ime_nalazista" name="Ime_nalazista" class="form-control"placeholder="Ime nalazista" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" style="border: 1px solid black" id="Zemlja" name="Zemlja" class="form-control" placeholder="Zemlja otkrica nalazista"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" style="border: 1px solid black" id="Vremensko_doba" name="Vremensko_doba" class="form-control" placeholder="Iz kog je vremenskog doba nalaziste"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" style="border: 1px solid black" id="Znacaj" name="Znacaj" class="form-control" placeholder="Znacaj nalazista"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" style="border: 1px solid black" id="Datum_otkrivanja" name="Datum_otkrivanja" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <select style="border: 1px solid black" id="Pronalazac" name="Pronalazac" class="form-control">
                                            <?php while ($redArheolozi = $arheolozi->fetch_array()) :?>
                                                <option value = "<?php echo $redArheolozi["ID_nalog"]?>">
                                                    <?php echo $redArheolozi["Ime"] . " " . $redArheolozi["Prezime"] ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button id="btnDodaj" type="submit" style="color: white; max-width: 500px; background-color: yellow; border: 1px solid white">Okaci otkrice</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal za izmenu arheoloskih nalazista-->
    <div class="modal fade" id="izmeniArheoloskoNalazisteModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="container prijava-promena-form">
                        <form action="#" method="post" id="izmeniForm">

                            <h3 style="color: black">Izmeni podatke vezane za nalaziste</h3>
                            <br>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="number" id="ID_nalazista_izmena" name="ID_nalazista_izmena" class="form-control" placeholder="Id nalazista (ne mozes da menjas)" readonly value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="Ime_nalazista_izmena" name="Ime_nalazista_izmena" class="form-control" placeholder="Ime nalazista" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="Zemlja_izmena" name="Zemlja_izmena" class="form-control" placeholder="Zemlja gde se nalazi nalaziste" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="Vremensko_doba_izmena" name="Vremensko_doba_izmena" class="form-control" placeholder="Vremensko doba nalazista" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="number" id="Znacaj_izmena" name="Znacaj_izmena" class="form-control" placeholder="Znacaj nalazista" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="date" id="Datum_otkrivanja_izmena" name="Datum_otkrivanja_izmena" class="form-control" placeholder="Datum otkrivanja nalazista" value="" />
                                    </div>
                                    <div class="form-group">
                                        <select style="border: 1px solid black" id="Pronalazac_izmena" name="Pronalazac_izmena" class="form-control">
                                            <?php $arheolozi = Arheolog::getAll($conn); ?>
                                            <?php while ($redArheolozi = $arheolozi->fetch_array()) :?>
                                                <option value = <?php echo $redArheolozi["ID_nalog"]?>>
                                                    <?php echo $redArheolozi["Ime"] . " " . $redArheolozi["Prezime"] ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button id="btnIzmeni" type="submit" style="color: white; max-width: 500px; background-color: yellow; border: 1px solid white">Izmeni</button>
                                    </div>                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Modal za biranje kriterijuma po cemu sortiramo arheoloska nalazista -->
<div class="modal fade" id="sortirajNalazistaModal" name="sortirajNalazistaModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container prijava-promena-form">
                    <form action="#" method="post" id="SortirajForm">

                        <h3 style="color: black;">Odaberite po cemu zelite da sortirate nalazista</h3>
                        <br>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <select style="border: 1px solid black" id="Kriterijum_sortiranja" name="Kriterijum_sortiranja" class="form-control">
                                        <option value = 0>Ime nalazista</option>
                                        <option value = 1>Zemlja porekla nalazista</option>
                                        <option value = 2>Vremensko doba nalazista</option>
                                        <option value = 3>Datum otkrica nalazista</option>
                                        <option value = 4>Znacaj nalazista</option>
                                        <option value = 5>Otkrivac nalazista</option>
                                    </select>
                                </div>
                                    <div class="form-group">
                                    <button id="dugme-sortiraj" style="background-color: rgb(153, 128, 4); color: black; font-size: large; border: 3px solid black; ">Sortiraj</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal za biranje kriterijuma po cemu pretrazujemo i unos podataka po cemu pretrazujemo -->
<div class="modal fade" id="pretraziNalazistaModal" name="pretraziNalazistaModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="container prijava-promena-form">
                    <form action="#" method="post" id="SortirajForm">

                        <h3 style="color: black;">Odaberite po cemu zelite da pretrazite nalazista:</h3>
                        <br>

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <select style="border: 1px solid black" id="Kriterijum_pretrage" name="Kriterijum_pretrage" class="form-control">
                                        <option value = 0>Ime nalazista</option>
                                        <option value = 1>Zemlja porekla nalazista</option>
                                        <option value = 2>Vremensko doba nalazista</option>
                                        <option value = 3>Datum otkrica nalazista</option>
                                        <option value = 4>Znacaj nalazista</option>
                                        <option value = 5>Otkrivac nalazista</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="Pretraga"  name="Pretraga" class="form-control" placeholder="Upisite vrednost:" value="">
                                </div>
                                <div class="form-group">
                                    <button id="dugme-pretrazi" style="background-color: rgb(153, 128, 4); color: black; font-size: large; border: 3px solid black; ">Pretrazi</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>










    <!--Koje su skripte koriscene -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="JavaScript/DodavanjeNalazista.js"></script>
    <script src="JavaScript/BrisanjeNalazista.js"></script>
    <script src="JavaScript/IzmenaNalazista.js"></script>
    <script src="JavaScript/SortirajTabeluNalazista.js"></script>
    <script src="JavaScript/PretraziTabeluNalazista.js"></script>
    <script src="Javascript/PrikaziSvaNalazista.js"></script>

</body>


</html>