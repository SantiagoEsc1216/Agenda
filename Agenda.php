<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos</title>
</head>
<body>
<?php

require("user.php");

session_start();
echo $_SESSION["Username"];

$UserSession =  new User($_SESSION["Username"],"",$_SESSION["Mail"]);



    foreach($UserSession->get_contacts($UserSession->Get_ID()) as $Contact ){

        $img_Contact= $Contact["Img_Contact"];

        echo $Contact["Name_Contact"];
        echo $Contact["Phone_Contact"];
        echo $Contact["Mail_Contact"];
       
        echo "<img src='Imagenes/$img_Contact'>";

       echo $img_Contact;

       $Carpeta="Imagenes";
     
    }



?>
    
<a href="NuevoContacto.php">Crear nuevo contacto</a>

</body>
</html>