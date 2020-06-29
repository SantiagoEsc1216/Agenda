<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Agregar contacto</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<meta name="viewport" content="width=device-width, initial-scale=1"> 

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
  <?php
  session_start();
    require ("validInputs.php");
    $imagen = $nombre = $telefono = $mail= $userError = $mailError = $phoneError = $imgError= $Success = "";

   
   
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
                <label for="Nombre">Nombre:</label> <input type="text" name="Nombre" class="form-control">
                <div class="alert alert-danger mt-1"><?php echo $userError ?></div>
            </div>

            <div class="form-group">
                <label for="Mail">E-mail:</label> <input type="text" name="Mail" class="form-control">
                <div class="alert alert-danger mt-1"><?php echo $mailError ?></div>
            </div>

            <div class="form-group">
                <label for="Telefono">Telefono:</label> <input type="text" name="Telefono" class="form-control">
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