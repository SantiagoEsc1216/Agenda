<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<meta name="viewport" content="width=device-width, initial-scale=1"> 

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    
    <?php

        require("user.php");

        session_start();

        $UserSession =  new User($_SESSION["Username"],"",$_SESSION["Mail"]);

    ?>

 <!-------------------------------------------- Navbar ---------------------------------------------------->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        
        <a class="navbar-brand" href="Agenda.php">Agenda</a>

        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto ">

                    <li class="nav-item active">
                        <a class="nav-link" href="NuevoContacto.php">Crear nuevo contacto <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" aria-label="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <?php echo $_SESSION["Username"] ?> 
                        </a>
                        
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            
                            <a href="#" class="dropdown-item">Perfil</a>
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

    <!------------------------------------------------ Contactos ---------------------------------------------------->

    <div class="contaier mt-3 px-2">
        <div class="row">

        <?php foreach($UserSession->get_contacts($UserSession->Get_ID()) as $Contact){?>

                <div class="col col-md-3 mx-auto col-xs-12">
                    <div class="card">

                        <div class="card-header">
                                <?php   echo $Contact["Name_Contact"]; ?>
                        </div>

                            <img src="Imagenes/<?php echo $Contact["Img_Contact"]?>" alt="card image top" class="card-img-top" style="width:100%; height:25vh; object-fit:cover; ">

                        <div class="card-body">
                            <p class="card-text">  <?php   echo $Contact["Mail_Contact"]; ?> </p>
                            <p class="card-text">  <?php   echo $Contact["Phone_Contact"]; ?></p>
                        </div>

                    </div>
                </div>

        <?php }?>

         </div>
     </div>

</body>
</html>