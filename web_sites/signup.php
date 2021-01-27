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
    <script src="../js/singup.js"></script>

</head>
</head>
<body onload="valid_inputs()">
<?php
    require_once ("../php_scripts/user.php");
    require_once ("../php_scripts/valid_inputs.php");

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $mail = $_POST["user_mail"];
        $username = $_POST["user_name"];
        $pass = $_POST["user_pass"];

        if(validName($username) && validPass($pass) && validMail($mail)){
            $NewUser=new User($username, $pass, $mail);
            if($NewUser-> mail_verify()){
                if($NewUser-> Insert()){
                    header("location: login.php");
                }else{
                    echo "<script></script>";
                }
            }else{
                echo "<script> alert_mail() </script>";
            }
        }else{
            echo "<script> message('Revise que los campos esten completos y que no contengan caracteres especiales', 'danger')  </script>";
        }
    }
?>

    <button class="btn btn-secondary btn-sm ml-2 mt-2" type="button" onclick="go_login()  ">Atrás</button>

    <div class="border border-primary container-fluid p-3 mx-auto mt-5 " style="width: 50%; min-width:300px;">

        <form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>">

            <p class="form-text">Registro</p>
            <div class="form-group">
                <label for="mail">correo electronico:</label>
                <input id="input_mail" class="form-control" type="email" name="user_mail" required>
                <small id="mail_info" class="form-text text-danger" hidden>Ingrese un e-mail valido</small>
            </div>

            <div class="form-group">
                <label for="user">Nombre de usuario:</label>
                <input id="input_name" class="form-control" type="text" name="user_name" required>
                <small id="name_info" class="form-text text-muted">Solo letras, numeros y parentesis</small>
            </div>

            <div class="form-group">
                <label for="pass">Contraseña:</label>
                <input id="input_pass" class="form-control" type="password" name="user_pass" required>
                <small id="pass_info" class="form-text text-muted">Ingrese 6 letras como minimo, nada de caracteres especiales</small>
            </div>
            <button id="btn_submit" class="btn btn-primary" type="submit">Registrarse</button>

        </form>
    </div>

</body>
</html>