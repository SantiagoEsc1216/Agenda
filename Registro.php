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

    $mailError = $userError = $passError = "";
    $mail = $user = $pass = "";

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(empty($_POST["user"])){
            $userError="Este campo es requerido";
        }   else{
            $user= cleanInput($_POST["user"]);
        }

        if(empty($_POST["correo"])){
            $mailError="Este campo es requerido";
        }    else{
            $mail= cleanInput($_POST["correo"]);

        }

        if(empty($_POST["pass"])){
            $passError="Este campo es requerido";
        }    else{
            $pass= cleanInput($_POST["pass"]);
        }

      
         if(validName($user) && validPass($pass) && validMail($mail)){
            $NewUser=new User($user, $pass, $mail);
          if($NewUser-> Existencia()){
            $NewUser->   Insert();
            header("location: login.php");
         }
         else{
            $mailError="Este correo ya esta registrado";
         }     
        }

       
    }

   
 
    ?>

    <div class=form>
        <p>Registro</p>

        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <label for="correo"> Correo electronico</label><input type="text" name="correo" id="correo">
            <span class="error"><?php echo $mailError ?></span>

            <label for="user">Nombre de usuario</label> <input type="text" name="user" id="user">
            <span class="error"><?php echo $userError ?></span>

            <label for="pass">Contraseña</label> <input type="text" name="pass" id="pass">
            <span class="error"><?php echo $passError ?></span>

            <button type="submit">Registrarse</button>
        </form>
    </div>

    
</body>
</html>