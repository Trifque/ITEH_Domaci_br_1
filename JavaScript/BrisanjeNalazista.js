/*JavaScript koji spaja  CRUD funkciju za brisanje sa odgovarajucim dugmetom*/

    $('#dugme-obrisi').click(function(){

        const checked = $('input[name=Izabrano_nalaziste]:checked');

        req = $.ajax({
            url: 'CRUD_funkcije/DeleteFunkcijaZaNalaziste.php',
            type:'post',
            data: {'ID_nalazista':checked.val()}
        });

        req.done(function()
        { 
            alert("Obrisali ste postojece nalaziste");
            location.reload(true);
        });

    });