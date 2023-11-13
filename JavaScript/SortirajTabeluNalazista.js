/* U ovom dokumentu nalazi se funkcija za sortiranje nalazista*/

$('#dugme-sortiraj').click(function() {

    var modal, izbor, tabela, redovi, sortiranje, i, x, y, zameni, kriterijum_za_zamenu;

    tabela     = document.getElementById("Tabela");
    izbor      = document.getElementById("Kriterijum_sortiranja").value;
    modal      = document.getElementById("sortirajNalazistaModal");
    sortiranje = true;

    event.preventDefault();

    while (sortiranje) {

        sortiranje = false;
        redovi = tabela.rows;

        for (i = 1; i < (redovi.length - 1); i++) {

            zameni = false;
            kriterijum_za_zamenu = false;

            x = redovi[i].getElementsByTagName("TD")[izbor];
            y = redovi[i + 1].getElementsByTagName("TD")[izbor];
            
            if(izbor != 4)
            {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase())
                {
                    kriterijum_za_zamenu = true;
                }
            }
            else
            {
                if (parseFloat(x.innerHTML) > parseFloat(y.innerHTML))
                {
                    kriterijum_za_zamenu = true;
                }
            }
            
            if (kriterijum_za_zamenu) 
            {
                zameni = true;
                break;
            }

        }
        if (zameni) {
            redovi[i].parentNode.insertBefore(redovi[i + 1], redovi[i]);
            sortiranje = true;
        }
    }

    $('#sortirajNalazistaModal').modal('toggle');

});