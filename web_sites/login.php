
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

<meta name="viewport" content="width=device-width, initial-scale=1"> 

<link rel="stylesheet" href="../css/bootstrap.css">
    
    <script src="js/jquery.min.js"></script> 
    <script src="js/popper.min.js"></script> 
    <script src="js/bootstrap.min.js"></script>
    
</head>
<body>

<?php 
 require ("../php_scripts/user.php");
 require ("../php_scripts/valid_inputs.php");
 
 $mailError = $passError = "";
 $mail = $pass = "";

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(empty($_POST["mail"])){
            $mailError="Introduzca un correo electronico";
        }else{
            $mail=$_POST["mail"];
        }

        if(empty($_POST["pass"])){
            $passError="Introduzca una contraseña";

        }else{
            $pass=$_POST["pass"];
            $pass=cleanInput($pass);
        }

        if(validMail($mail)&&validPass($pass)){
            $sesion= new User("",$pass, $mail);
            if($sesion->Pass()){
                session_start();
                $_SESSION["Username"] = $sesion->Nombre();
                $_SESSION["Mail"]=$mail;
                header("location: Agenda.php");

            }else{
                $mailError="El usuario o contraseña es incorrecto";
            }

        }else{
            $mailError="No se a encontrado este usuario";
        }
    }
?>


  <!----------------------------- Formulario inicio de sesion  ---------------------------------->
    <div class="border border-primary container-fluid p-3 mx-auto mt-5 " style="width: 50%; min-width:300px">
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

            <div class="form-group">
            
                <p class="form-text" >Inicio de sesion</p>
                    <label for="mail">Correo electronico</label>
                    <input type="text" name="mail" id="mail" class="form-control">
                    <div class="alert alert-danger mt-1"><?php echo $mailError ?></div>

            </div>

            <div class="form-group">
                    <label for="pass">Contraseña:</label>
                    <input type="text" name="pass" id="pass" class="form-control">

            </div>
            
            <button type="submit" class="btn btn-primary">Iniciar sesion</button>
                </form>
            
                <div class="btn btn-link text-center mx-auto mt-1" style="width: 100%;" >
                <a href="Registro.php">¿No tienes una cuenta? <br> Puedes registrate aqui</a>
                </div>
        </div>
     
</body>
</html>