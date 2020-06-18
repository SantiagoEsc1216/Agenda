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
  session_start();
    require ("validInputs.php");
    $imagen = $nombre = $telefono = $mail= $userError = $mailError = $phoneError = $imgError= "";

   $ImgDefault;
   
   
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
   

       if(validName($nombre) && validMail($mail) && validPhoneNumber($telefono)){

    
            include ("Contact.php");
            
            $Contact = new Contact($nombre, $telefono, $mail);
            $Contact-> Add_contact();
       }
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