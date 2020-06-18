<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php 
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $imageTypes= array(
            "image/jpeg",
            "image/jpg"
        );

        if(empty($_POST["Imagen1"])){
          echo 2;
        }else{
            if($_FILES["Imagen1"]["size"]>2097152){
                echo "Demasiado pesado";
            }else{}

            if(in_array($_FILES["Imagen1"]["type"],$imageTypes)){
                echo "Diferente tipo";

            }else{}
        }
    }

    ?>

    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
    
        <label for="Imagen1">Imagen:</label><input type="file" name="Imagen1" id="">
        <button type="submit">Enviar</button>
    </form>

</body>
</html>