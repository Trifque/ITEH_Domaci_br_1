/* Kada kliknemo na dugme izmeni sa glavnog menija pozivamo ovu funkciju 
   kako bismo dobili trenutne informacije izabranog nalazista           */

    $('#dugme-izmeni').click(function () 
    {

        const checked = $('input[name=Izabrano_nalaziste]:checked');

        req = $.ajax(
            {
                url: 'CRUD_funkcije/GetFunkcijaZaNalaziste.php',
                type:'post',
                data: {'ID_nalazista':checked.val()},
                dataType: 'json'
            });
        
    
            req.done(function (response) 
            {
                //Ovde vrednosti koje smo dobili preko poziva GetByID prepisujemo u formu/modal

                $('#ID_nalazista_izmena').val(checked.val());

                $('#Ime_nalazista_izmena').val(response[0]['Ime_nalazista'].trim());

                $('#Zemlja_izmena').val(response[0]['Zemlja'].trim());

                $('#Vremensko_doba_izmena').val(response[0]['Vremensko_doba'].trim());

                $('#Znacaj_izmena').val(response[0]['Znacaj'].trim());

                $('#Datum_otkrivanja_izmena').val(response[0]['Datum_otkrivanja'].trim());

                $('#Pronalazac_izmena option').each(function()
                {
                    if($(this).val() == response[0]['Pronalazac'].trim())
                    {
                        $(this).prop('selected', true);
                    }
                });

            });
    });

/* Spajamo CRUD funkciju za izmenu podataka o nalazistu 
   sa dugmetom koje se nalaziu Modalu za izmenu        */

   $('#izmeniForm').submit(function () 
   {

        event.preventDefault();

        const $form = $(this);
        const $inputs = $form.find('input, select, button, textarea');
        const serijalizacijaForme = $form.serialize();

        $inputs.prop('disabled', true);

        req = $.ajax(
            {
                url: 'CRUD_funkcije/UpdateFunkcijaZaNalaziste.php',
                type:'post',
                data: serijalizacijaForme
            });


        req.done(function () 
        {

            alert("Izmenili ste vec postojece nalaziste");
            location.reload(true);
            
        });
    });