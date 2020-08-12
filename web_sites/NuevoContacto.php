<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Agregar contacto</title>

   

<meta name="viewport" content="width=device-width, initial-scale=1"> 

<link rel="stylesheet" href="../css/bootstrap.css">

    <script src="js/jquery.min.js"></script> 
    <script src="js/popper.min.js"></script> 
    <script src="js/bootstrap.min.js"></script>

</head>
<body>
  <?php
  session_start();
    require ("../php_scripts/valid_inputs.php");
    $imagen = $name = $telefono = $mail= $userError = $mailError = $phoneError = $imgError= $Success = "";

   
   
   if($_SERVER["REQUEST_METHOD"]=="POST"){
   
    $name = $_POST["name_contact"];
    $mail = $_POST["mail_contact"];
    $phone = $_POST["phone_contact"];

       if(empty($name)){
           $userError="Rellene este campo";
       }
   
       if(empty($mail)){
           $mailError="Rellene este campo";
       }
   
        if(empty($phone)){
            $phoneError="Rellene este campo";
        }
   
       if(validName($name) && validMail($mail) && validPhone($phone)){
    
            require ("../php_scripts/Contact.php");
            
            $Contact = new Contact($name, $phone, $mail);

         if ($Contact-> Add_contact()){
               $Success="Contacto agregado";
           }
       }
}
  ?>

                    <!------------------------------- Navbar ------------------------------------->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        
        <a class="navbar-brand" href="Agenda.php">Agenda</a>

        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto ">

                    <li class="nav-item active">
                        <a class="nav-link" href="NuevoContacto.php">Crear nuevo contacto <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" aria-label="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <?php echo $_SESSION["Username"] ?> 
                        </a>
                        
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            
                            <a href="#" class="dropdown-item">Perfil</a>
                                <div class="dropdown-divider"></div>
                            <a href="closeSession.php" class="dropdown-item">Cerrar sesion</a>

                        </div>
                    </li>

            </ul>

            <form class="form-inline" method="post" action="">
               <input type="search" class="form-control mr-sm-2" placeholder="Buscar contacto" aria-label="Buscar contacto">
               <button class="btn btn-outline-success my-2- my-sm-0">Buscar</button>
            </form>

            
        </div>
    </nav>


                    <!------------------------------- Formulario de contacto ------------------------------------->

                    <div class="alert alert-success mx-auto mt-4" style="width: 45vw;"><?php echo $Success?></div>

    <div class="border border-primary container-fluid p-3 mx-auto mt-5 " style="width: 50%; min-width:300px">
        <form action="<?php htmlspecialchars('addContact.php')  ?>" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name_contact">Nombre:</label> <input type="text" name="name_contact" class="form-control">
                <div class="alert alert-danger mt-1"><?php echo $userError ?></div>
            </div>

            <div class="form-group">
                <label for="mail_contact">E-mail:</label> <input type="text" name="mail_contact" class="form-control">
                <div class="alert alert-danger mt-1"><?php echo $mailError ?></div>
            </div>

            <div class="form-group">
                <label for="phone_contact">phone_contact:</label> <input type="text" name="phone_contact" class="form-control">
                <div class="alert alert-danger mt-1"><?php echo $phoneError ?></div>
            </div>

            <div class="form-group">
                <label for="Imagen">Imagen de contacto (opcional) :</label> <input type="file" name="Imagen" class="form-control">
                <div class="alert alert-danger mt-1"><?php echo $imgError ?></div>
            </div>

            <button  type="submit" class="btn btn-primary ">Agregar nuevo contacto</button>

        </form>

    </div>


</body>
</html>