
/*JavaScript koji spaja Modal za dodavanje sa neophodnom CRUD funkcijom*/
$('#dodajForm').submit(function()
    {
        event.preventDefault();
        
        const $form =$(this);
        const $input = $form.find('input, select, button, textarea');
        const serijalizacijaForme = $form.serialize();

        console.log(serijalizacijaForme);

        $input.prop('disabled', true);

        req = $.ajax(
        {
            url: 'CRUD_funkcije/AddFunkcijaZaNalaziste.php',
            type:'post',
            data: serijalizacijaForme
        });

        req.done(function()
        { 
            alert("Kreirali ste novo nalaziste");
            location.reload(true);
        });
    });

