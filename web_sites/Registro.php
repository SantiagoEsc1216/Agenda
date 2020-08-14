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
</head>
<body>
    <?php
    
    require ("../php_scripts/user.php");
    require ("../php_scripts/valid_inputs.php");

    $mailError = $userError = $passError = "";
    $mail = $user = $pass = "";

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(empty($_POST["user"])){
            $userError="Este campo es requerido";
        }   else{
            $user= cleanInput($_POST["user"]);
        }

        if(empty($_POST["mail"])){
            $mailError="Este campo es requerido";
        }    else{
            $mail= cleanInput($_POST["mail"]);

        }

        if(empty($_POST["pass"])){
            $passError="Este campo es requerido";
        }    else{
            $pass= cleanInput($_POST["pass"]);
        }

      
         if(validName($user) && validPass($pass) && validMail($mail)){
            $NewUser=new User($user, $pass, $mail);
          if($NewUser-> user_verify()){
            $NewUser->   Insert();
            header("location: login.php");
         }
         else{
            $mailError="Este correo ya esta registrado";
         }     
        }

       echo $user, $mail, $pass;
    }

   
 
    ?>


    <div class="border border-primary container-fluid p-3 mx-auto mt-5 " style="width: 50%; min-width:300px;">

        <form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>">

            <p class="form-text">Registro</p>
            <div class="form-group">
                <label for="mail">correo electronico:</label>
                <input id="mail" class="form-control" type="text" name="mail">
                <div class="alert alert-danger mt-1"><?php echo $mailError ?></div>
            </div>

            <div class="form-group">
                <label for="user">Nombre de usuario:</label>
                <input id="user" class="form-control" type="text" name="user">
                <div class="alert alert-danger mt-1"><?php echo $userError ?></div>
            </div>

            <div class="form-group">
                <label for="pass">Contraseña:</label>
                <input id="pass" class="form-control" type="text" name="pass">
                <div class="alert alert-danger mt-1"><?php echo $passError ?></div>
            </div>
            <button class="btn btn-primary" type="submit">Registrarse</button>

        </form>  
    </div>
    
</body>
</html>