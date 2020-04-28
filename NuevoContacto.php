<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Agregar contacto</title>
</head>
<body>
  <?php
    require ("validInputs.php");
    $imagen = $nombre = $telefono = $mail= $userError = $mailError = $phoneError = $imgError= "";
   
   
   
   if($_SERVER["REQUEST_METHOD"]=="POST"){
   
       if(empty($_POST["Nombre"])){
           $userError="Rellene este campo";
   
       }else{
           $nombre = $_POST["Nombre"];
           $nombre= cleanInput($nombre);
           validName($nombre);
       }
   
       if(empty($_POST["Mail"])){
           $mailError="Rellene este campo";
   
       }else{
           $mail = $_POST["Mail"];
           $mail= cleanInput($mail);
           validMail($mail);
       }
   
       if(empty($_POST["Telefono"])){
           $phoneError="Rellene este campo";
   
       }else{
           $telefono = $_POST["Telefono"];
           $telefono= cleanInput($telefono);
           validPhoneNumber($telefono);
       }
   
       if(empty($_FILES["Imagen"])){
         
   
       }else{
        $CarpetaImagen="F:/wamp64/www/Agenda/Imagenes/".$_FILES["Imagen"]["name"];

        $imagen = $_FILES["Imagen"]["tmp_name"];
        $sizeImage= $_FILES["Imagen"]["size"];
        $ImageType=$_FILES["Imagen"]["type"];

        if(validImage($sizeImage, $ImageType)){
        move_uploaded_file($imagen, $CarpetaImagen);
        $imgError="1";
        
        }
    
        

       }

       if(validName($nombre) && validMail($mail) && validPhoneNumber($telefono) && validImage($sizeImage, $ImageType)){
       
       }
       else{}
   
   
   }
  ?>
    <div class="form">
    <form action="<?php htmlspecialchars('addContact.php')  ?>" method="POST" enctype="multipart/form-data">
        <label for="Nombre">Nombre:</label> <input type="text" name="Nombre">
        <span class="error"><?php echo $userError ?></span>

        <label for="Mail">E-mail:</label> <input type="text" name="Mail">
        <span class="error"><?php echo $mailError ?></span>
        <label for="Telefono">Telefono:</label> <input type="text" name="Telefono">
        <span class="error"><?php echo $phoneError ?></span>

        <label for="Imagen">Imagen de contacto (opcional) :</label> <input type="file" name="Imagen">
        <span class="error"><?php echo $imgError ?></span>
        
        <button  type="submit">Agregar nuevo contacto</button>
    </form>

    </div>
</body>
</html>