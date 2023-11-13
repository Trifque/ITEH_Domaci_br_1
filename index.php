
<!--Ovaj PHP kod sluzi da bi se proverili kredencijali za ulogovanje kao i za pokretanje sesije-->

<?php

require "DataBaseBroker.php";
require "PHP_Klase/Arheolog.php";

session_start();
if(isset($_POST['username']) && isset($_POST['password'])){
    $username  = $_POST['username'];
    $upassword = $_POST['password'];

    $arheolog = new Arheolog(1, null, null, null, null, $username, $upassword);
    $odg      = Arheolog::logInArheolog($arheolog, $conn);

    if($odg->num_rows == 1){
        echo  `
        <script>
        console.log( "Uspesno ste se ulogovali.");
        </script>
        `;
        $_SESSION['id_nalog'] = $arheolog->id_nalog;
        header('Location: glavna_strana.php');
        exit();
    }else{
        echo `
        <script>
        console.log( "Niste se ulogovali.");
        </script>
        `;
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="css/ulogovanje.css">

    <title>Domaci 1 (OOP MySql AJAX): Belezenje arheoloskih nalaza</title>
</head>
<body>

    <div class="login-forma">

        <div class="glavni">

            <form method="POST" action="#">

                <div class="container">

                    <label class="naslov">Dobrodosli!!!</label>
                    <br><br><br>
                    <label class="username">Molimo Vas unesite Vas username:</label>
                    <br><br>
                    <input type="text" name="username" class="form-control"  required>
                    <br><br>
                    <label for="password">Molimo Vas unesite Vasu lozinku:</label>
                    <br><br>
                    <input type="password" name="password" class="form-control" required>
                    <br><br>
                    <button type="submit" class="dugme dugme-za-ulogovanje" name="submit">Ulogujte se</button>

                </div>

            </form>

        </div>
            
    </div>
    
</body>
</html>