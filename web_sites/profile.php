<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/profile.js"></script>
</head>
<body onload="profile_options()">
<?php
       require_once("../php_scripts/user.php");

       session_start();

       if(empty($_SESSION["username"]) or empty($_SESSION["mail"]) or empty($_SESSION["loggedin"])){
           header("location: login.php");
       }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require_once("../php_scripts/valid_inputs.php");
        $pass = $_POST["password"];
        $user = new User($_SESSION["username"],$pass,$_SESSION["mail"]);
        $id_user = $user-> Get_ID();

        if(isset($_POST["new_name"])){
            $new_name = $_POST["new_name"];
            if (validName($new_name) && validPass($pass)) {
                if($user->pass_verify()){
                    if($user->change_username($id_user, $new_name)){
                        $_SESSION["username"] = $user->get_username();
                        echo "<script>message('Nombre cambiado', 'success')</script>";
                    }else{
                        echo "<script>message('Error al cambiar nombre', 'danger')</script>";
                    }
                }else {
                    echo "<script>message('Contraseña incorrecta', 'danger');</script>";
                }
            } else {
                echo "<script>message('Ingrese un nombre valido', 'danger');</script>";
            }
        }
        if(isset($_POST["new_mail"])){
            $new_mail = $_POST["new_mail"];

            if(validMail($new_mail) && validPass($pass)){
                if($user->pass_verify()){
                    $user->mail = $new_mail;
                    if ($user->mail_verify()) {
                        if($user->change_mail($id_user, $new_mail)){
                            $_SESSION["mail"] = $new_mail;
                            echo "<script>message('Corrreo cambiado', 'success');</script>";
                        }else{
                            echo "<script>message('error al cambiar correo', 'danger');</script>";
                        }
                    } else {
                        echo "<script>message('Este correo ya fue registrado','danger');</script>";
                    }
                }else{
                    echo "<script>message('contraseña incorrecta', 'danger');</script>";
                }
            }else{
                echo "<script>message('revise que haya ingresado un correo valido', 'danger');</script>";
            }
        }
        if(isset($_POST["new_pass"])){
            $new_pass = $_POST["new_pass"];
            if (validPass($new_pass) &&  validPass($pass)) {
                if($user->pass_verify()){
                    if($user->change_password($id_user, $new_pass)){
                        echo "<script>message('Contraseña cambiada', 'success')</script>";
                    }else{
                        echo "<script>message('Error al cambiar contraseña', 'danger')</script>";
                    }
                }else{
                    echo "<script>message('Contraseña incorrecta', 'danger')</script>";
                }
            } else {
                echo "<script>message('Ingrese una contraseña valida', 'danger')</script>";
            }
        }
    }
?>

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
                           <?php echo $_SESSION["username"]?>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a href="profile.php" class="dropdown-item">Perfil</a>
                                <div class="dropdown-divider"></div>
                            <a href="../php_scripts/closeSession.php" class="dropdown-item">Cerrar sesion</a>

                        </div>
                    </li>

            </ul>
        </div>
</nav>



<div id="user_options" class="container mt-5 ">
    <div id="row_name" class="row">
        <p class="col  col-9"><span class="font-weight-bold mr-2">Nombre: </span><?php echo $_SESSION["username"];?></p>
        <button type="button" id="btn_edit_username" class="col col-3 btn btn-primary " onclick="valid_inputs()">Editar</button>
    </div>
    <div id="row_mail" class="row my-5">
        <p class="col col-9"><span class="font-weight-bold mr-2">Correo electronico: </span> <?php echo $_SESSION["mail"]?></p>
        <button type="button" id="btn_edit_mail" class="col col-3 btn btn-primary" onclick="valid_inputs()">Editar</button>
    </div>
    <div id="row_pass" class="row">
        <button type="button" id="btn_edit_pass" class="col col-5 btn btn-primary mx-auto mx-sm-0 mb-3" onclick="valid_inputs()">Cambiar contraseña</button>
    </div>
</div>

<div id="form" class="form-row col col-12" style="display:none;">
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="col col-10">
        <div class="form-group row">
            <label for="input" id="label" class="col col-12 col-md-3 col-lg-2"></label>
            <input class="form-control col col-12 col-md-3 col-lg-4 ml-3 ml-md-0" type="text" id="input" required>
        </div>
        <div class="form-group row" id="div_pass" style="display: none;">
            <label for="password" class="col col-12 col-md-3 col-lg-2">Confirmar contraseña:</label>
            <input class="form-control col col-12 col-md-3 col-lg-4 ml-3 ml-md-0" type="password" id="input_confirm_pass">
        </div>
        <div class="form-group row">
            <label for="password" class="col col-12 col-md-3 col-lg-2">Contraseña:</label>
            <input class="form-control col col-12 col-md-3 col-lg-4 ml-3 ml-md-0" type="password" name="password" id="input_password" required>
        </div>
        <button type="button" id="btn_submit" class="btn btn-success">Aceptar</button>
        <button type="button" class="btn btn-danger" id="btn_cancel" >Cancelar</button>
    </form>
</div>

</body>
</html>