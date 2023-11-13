/* U ovom dokumentu se nalazi funkcija za prikazibanje svih nalazista */

$('#dugme-prikazi').click(function() {

    var input, filter, tabela, tr, td, i, txtValue, izbor;

    event.preventDefault();

    izbor  = document.getElementById("Kriterijum_pretrage").value;
    input  = document.getElementById("Pretraga");
    filter = "";
    tabela  = document.getElementById("Tabela");
    tr     = tabela.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {

        td = tr[i].getElementsByTagName("td")[izbor];

        if (td) {

            txtValue = td.textContent || td.innerText;

            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }

    }

});