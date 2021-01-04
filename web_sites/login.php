
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/style.css">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/login.js" ></script>

</head>
<body>
<?php
require_once ("../php_scripts/user.php");
require_once ("../php_scripts/valid_inputs.php");

       session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $_SESSION["loggedin"] = false;

    $mail = $_POST["mail"];
    $pass = $_POST["pass"];

        if(validMail($mail) && validPass($pass)){
            $user_session = new User("",$pass, $mail);
            if($user_session->pass_verify()){
                $_SESSION["username"] = $user_session->get_username();
                $_SESSION["mail"]=$mail;
                $_SESSION["loggedin"] = true;
            }else{
                echo "<script> login_error()  </script>";
            }
        }else{
            echo "<script> message('Revise que los campos esten completos y que no contengan caracteres especiales', 'danger')  </script>";
        }

}

if(!empty($_SESSION["loggedin"])){
    if($_SESSION["loggedin"] === true){
        header("location: Agenda.php");
        die;
    }
}

?>
  <!----------------------------- Formulario inicio de sesion  ---------------------------------->
    <div class="border border-primary container-fluid p-3 mx-auto mt-5 " style="width: 50%; min-width:300px" id="div-form" >

        <p class="form-text" >Inicio de sesion</p>

        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="form">
                <div class="form-group" >
                    <label for="mail">Correo electronico</label>
                    <input type="text" name="mail" id="mail" class="form-control">
                </div>

                <div class="form-group" id="form-2">
                    <label for="pass">Contraseña:</label>
                    <input type="password" name="pass" id="pass" class="form-control">

                     <div class="form-check ml-1 my-2">
                        <input type="checkbox" class="form-check-input" id="pass-visibility" onclick="visible_password()" >
                        <label for="pass-visibility" class="form-check-label" > Mostrar contraseña </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block ">Iniciar sesion</button>

         </form>

            <div class="btn btn-link text-center mx-auto mt-1" style="width: 100%;" >
                <a href="signup.php">¿No tienes una cuenta? <br> Puedes registrate aqui</a>
            </div>
        </div>
</body>
</html>