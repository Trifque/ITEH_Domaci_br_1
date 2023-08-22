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

            <table id="Tabela" class="table table-hover table-striped" style="color: black; background-color: rgb(126, 124, 8); border: 3px solid black;">
                
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
                        <tr>
                            <td><?php echo $red["ime_nalazista"] ?></td>
                            <td><?php echo $red["zemlja_nalazista"] ?></td>
                            <td><?php echo $red["vremensko_doba_nalazista"] ?></td>
                            <td><?php echo $red["datum_otkrivanja_nalazista"] ?></td>
                            <td><?php echo $red["znacaj_nalazista"] ?></td>
                            <td><?php echo $red["otkrivac_nalazista"] ?></td>
                            <td>
                                <label class="custom-radio-btn">
                                    <input type="radio" name="checked-donut" value=<?php echo $red["id_nalazista"] ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </td>

                        </tr>
                </tbody>
            </table>

            <!--Dugmici za sortiranje, izmenu podataka i brisanje-->

            <div class="row">

                <div class="col-md-4">
                    <button id="btn-sortiraj" class="btn btn-normal" onclick="sortTable()">Sortiraj</button>
                </div>

                <div class="col-md-4">
                    <button id="btn-izmeni" class="btn btn-warning" data-toggle="modal" data-target="#izmeniArheoloskoNalazisteModal">Izmeni Podatke</button>
                </div>

                <div class="col-md-4" style="text-align: center;">
                    <button id="btn-obrisi" formmethod="post" class="btn btn-danger">Obrisi</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Poslednji red sa dugmicima za prikaz, zapisivanje i pretragu nalazista -->

    <div class="row" name="poslednja_linija">

        <div class="col-md-4">

            <button id="dugme-prikazi" class="btn btn-info btn-block" style="background-color: rgb(153, 128, 4); color: black; font-size: large; border: 3px solid black; "> Prikazi Arheoloska nalazista</button>

        </div>

        <div class="col-md-4">

            <button id="dugme-dodaj" type="button" class="btn btn-success btn-block" style="background-color: rgb(153, 128, 4); color: black; font-size: large; border: 3px solid black;" data-toggle="modal" data-target="#dodajNalazisteModal"> Zapisi novo arheolosko nalaziste</button>

        </div>

        <div class="col-md-4">

            <button id="dugme-pretrazi" class="btn btn-warning btn-block" style="background-color:  rgb(153, 128, 4); color: black; font-size: large; border: 3px solid black;"> Pretrazi arheoloska nalazista</button>
            <input type="text" id="myInput" onkeyup="funkcijaZaPretragu()" placeholder="Pretrazi nalazista po imenu" hidden>
            
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
                                        <input type="text" style="border: 1px solid black" name="ime_nalazista" class="form-control"placeholder="Ime nalazista" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" style="border: 1px solid black" name="zemlja_nalazista" class="form-control" placeholder="Zemlja otkrica nalazista"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" style="border: 1px solid black" name="vremensko_doba_nalazista" class="form-control" placeholder="Iz kog je vremenskog doba nalaziste"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" style="border: 1px solid black" name="datum_otkrica_nalazista" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" style="border: 1px solid black" name="znacaj_nalazista" class="form-control" placeholder="Znacaj nalazista"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" style="border: 1px solid black" name="otkrivac_nalazista" class="form-control" placeholder="Otkrivac nalazista"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button id="btnDodaj" type="submit" class="btn btn-success btn-block" style="color: white; max-width: 500px; background-color: yellow; border: 1px solid white">Okaci otkrice</button>
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
                                        <input id="id_nalazista" type="text" name="id_nalazista" class="form-control" placeholder="Id nalazista (ne mozes da menjas)" value="" readonly />
                                    </div>
                                    <div class="form-group">
                                        <input id="ime_nalazista" type="text" name="ime_nalazista" class="form-control" placeholder="Ime nalazista" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="zemlja_nalazista" type="text" name="zemlja_nalazista" class="form-control" placeholder="Zemlja gde se nalazi nalazista" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="vremensko_doba_nalazista" type="text" name="vremensko_doba_nalazista" class="form-control" placeholder="Vremensko doba nalazista" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="datum_otkrica_nalazista" type="date" name="datum_otkrica_nalazista" class="form-control" placeholder="Datum otkrivanja nalazista" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="znacaj_nalazista" type="text" name="znacaj_nalazista" class="form-control" placeholder="Znacaj nalazista" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="number" style="border: 1px solid black" name="otkrivac_nalazista" class="form-control" placeholder="Otkrivac nalazista"/>
                                    </div>

                                    <div class="form-group">
                                        <button id="btnIzmeni" type="submit" class="btn btn-success btn-block" style="color: white; max-width: 500px; background-color: yellow; border: 1px solid white">Izmeni</button>
                                    </div>
                                    

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


















    <!--JavaScript funkcije za sortiranje tabele kao i za pretrazivanje tabele-->

    <script>
        function sortTable() {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("Tabela");
            switching = true;

            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[1];
                    y = rows[i + 1].getElementsByTagName("TD")[1];
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }

        function funkcijaZaPretragu() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("Tabela");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>




















    <!--Koje su skripte koriscene -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>


</html>