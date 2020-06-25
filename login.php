
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