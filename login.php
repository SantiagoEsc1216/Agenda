
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<?php 
 require ("user.php");
 require ("validInputs.php");
 
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
                $_SESSION["Nombre"] = $sesion->Nombre();
                
                header("location: Agenda.php");

            }else{
                $mailError="El usuario o contraseña es incorrecto";
            }

        }else{
            $mailError="No se a encontrado este usuario";
        }
    }
?>

    
    <div class="form">
    
        <p>Inicio de sesion</p>

        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="mail">Correo electronico</label>  <input type="text" name="mail" id="mail">
            <span class="error"><?php echo $mailError ?></span>

            <label for="pass">Contraseña:</label> <input type="text" name="pass" id="pass">
           <button type="submit">Iniciar sesion</button>
        </form>
    
        <div class="registro">
         <a href="Registro.php">¿No tienes una cuenta? <br> Puedes registrate aqui</a>
        </div>
    </div>

</body>
</html>