<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agregar contacto</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="../css/bootstrap.css">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/valid_inputs.js"></script>

</head>
<body onload="valid_inputs()" >
  <?php
    session_start();

    if(empty($_SESSION["username"]) or empty($_SESSION["mail"]) or empty($_SESSION["loggedin"])){
        header("location: login.php");
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
                        <a class="nav-link" href="new_contact.php">Crear nuevo contacto <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" aria-label="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION["username"] ?>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a href="profile.php" class="dropdown-item">Perfil</a>
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

    <div id="form-container">
        <div class="border border-primary container-fluid p-3 mx-auto mt-5 " id="form" style="width: 50%; min-width:300px">
            <form action="<?php htmlspecialchars('addContact.php')  ?>" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="name_contact">Nombre:</label>
                    <input type="text" name="name_contact" id="input_name" class="form-control" required>
                    <small id="name_info" class="form-text text-muted">Solo letras, numeros y parentesis</small>
                </div>

                <div class="form-group">
                    <label for="mail_contact">E-mail:</label>
                    <input type="email" name="mail_contact" id="input_mail" class="form-control" required>
                    <small id="mail_info" class="form-text text-danger" hidden>Ingrese un e-mail valido</small>
                </div>

                <div class="form-group">
                    <label for="phone_contact">Telefono:</label>
                    <input type="tel" name="phone_contact" id="input_phone" class="form-control" required >
                    <small id="phone_info" class="form-text text-muted">Solo numero (10 digitos), parentesis y los caracteres (+) y (-)</small>
                </div>

                <div class="form-group">
                    <label for="Imagen">Imagen de contacto (opcional):</label>
                    <input type="file" name="img_contact" id="input_img" class="form-control" accept="image/jpeg, image/png">
                    <small id="img_info" class="form-text text-muted">Imagen no mayor a 2 MB y en formato jpg o png</small>
                </div>

                <button  type="submit" class="btn btn-primary btn-block" id="btn_submit">Agregar nuevo contacto</button>

            </form>
        </div>
    </div>

<?php
     require_once ("../php_scripts/valid_inputs.php");

    if($_SERVER["REQUEST_METHOD"]=="POST"){

     $name = $_POST["name_contact"];
     $mail = $_POST["mail_contact"];
     $phone = $_POST["phone_contact"];
     $img = $_FILES["img_contact"]["name"];

        if(validName($name) && validMail($mail) && validPhone($phone)){

            require_once ("../php_scripts/Contact.php");

            $Contact = new Contact($name, $phone, $mail, $img);

            if ($Contact-> Add_contact()){
                echo "<script> message('Contacto agregado', 'success') </script>";
                echo "<script> clean_inputs() </script>";
            }else{
                   echo "<script>message('Error al agregar contacto', 'danger')</script>";
                }
        }else{
            echo "<script> message('Revise que los campos esten completos y que no contengan caracteres especiales', 'danger')  </script>";
        }
 }
?>

</body>
</html>