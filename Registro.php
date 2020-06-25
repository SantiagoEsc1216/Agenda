<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <title>Document</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<meta name="viewport" content="width=device-width, initial-scale=1"> 

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
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
          if($NewUser-> Existencia()){
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