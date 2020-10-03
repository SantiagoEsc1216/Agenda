<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contactos</title>

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">

    <script src="../js/ContactOptions.js" ></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</head>
<body>
    <?php
        require_once("../php_scripts/user.php");

        session_start();

        if(empty($_SESSION["username"]) or empty($_SESSION["mail"]) or empty($_SESSION["loggedin"])){
           header("location: login.php");
        }

        $UserSession =  new User($_SESSION["username"],"",$_SESSION["mail"]);
        $id_user = $UserSession->Get_ID();
        $num_contacts = $UserSession->get_numberOfContacts($id_user);

        $id_contact_div = array();

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            header("location: ".$_SERVER["PHP_SELF"]);
        }
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
                        <a class="nav-link" href="new_contact.php">Crear nuevo contacto <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" aria-label="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION["username"] ?>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a href="profile.php" class="dropdown-item">Perfil</a>
                                <div class="dropdown-divider"></div>
                            <a href="../php_scripts/closeSession.php" class="dropdown-item">Cerrar sesion</a>

                        </div>
                    </li>

            </ul>

            <form class="form-inline" method="post" action="">
               <input type="search" class="form-control mr-sm-2" id="search_input" onclick="search_contact(this)" placeholder="Buscar contacto" aria-label="Buscar contacto">
               <button class="btn btn-outline-success my-2- my-sm-0" id="btn_search" onclick="return false" >Buscar</button>
            </form>


        </div>
    </nav>

    <!------------------------------------------------ Contactos ---------------------------------------------------->

    <div class="block-lock" id="padlock"> </div>

    <div class="contaier mt-2 px-2 " id="contacts-container" >

             <div class="row justify-content-start" id="cards_container">
        <?php
        if($num_contacts > 0 ){

            $i = 0;

                foreach($UserSession->get_contacts($UserSession->Get_ID()) as $Contact){
                    $i += 1;

                    $id_contact_div[$i] = $Contact["ID_Contact"];
       ?>
            <div class="col col-12 col-md-4 col-lg-3 align-items-stretch mt-2" >

                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" enctype="multipart/form-data" >

                        <div class="card" name="card" id="<?php  echo "card-".$i;?>">

                            <input type="hidden" name="id_div" value="<?php echo $i;?>">

                            <div class="card-header" id="<?php echo "card-header-".$i;?>">
                                <p class="card-text"><?php  echo $Contact["Name_Contact"];?></p>
                                <small id="name_info" class="form-text text-danger" hidden>Solo letras, numeros y parentesis</small>
                            </div>

                            <div>
                                <div class="img_edit" id="<?php echo "img-edit-".$i;?>" hidden>
                                    <small class="form-text  bg-danger text-white" hidden > Imagen no mayor a 2 MB y en formato jpg o png </small>
                                </div>
                                <img src="../Imagenes/<?php echo $Contact["Img_Contact"];?>" alt="card image top" class="card-img-top" style="width:100%; height:25vh; object-fit:cover; ">
                                <input type="hidden" name="img_name" value="<?php echo $Contact["Img_Contact"]?>">
                            </div>

                            <div class="card-body" id="<?php echo "card-body-".$i;?>">
                                <p class="card-text"><?php  echo $Contact["Mail_Contact"];?></p>
                                <small id="mail_info" class="form-text text-danger" hidden>Ingrese un e-mail valido</small>
                                <p class="card-text"><?php echo $Contact["Phone_Contact"]?></p>
                                <small id="phone_info" class="form-text text-danger" hidden>Solo numero (10 digitos), parentesis y los caracteres (+) y (-)</small>
                            </div>

                            <div class="card-footer text-center" id ="<?php echo "card-footer-".$i; ?>">
                                <button type="button" class="btn btn-primary m-2" onclick="edit_options(<?php echo $i;?>)"  name="btn_edit" >Editar</button>
                                <button type="button" class="btn btn-danger m-2" onclick="confirm_delete(<?php echo $i; ?>)"  name="btn_delete" >Eliminar</button>

                                <button type="button" class="btn btn-danger m-2" name="btn_cancel" onclick="edit_cancel(<?php echo $i; ?>)" style="display: none;" >Cancelar</button>
                                <button type="submit" class="btn btn-primary m-2" name="btn_accept" onclick="confirm_edit(<?php echo $i; ?>)" style="display: none;" >Aceptar</button>
                            </div>

                            <div id="div-delete-<?php echo $i;?>"  class="div_delete container mw-100">
                                <div class="row align-items-center" style="height: 100%;">
                                        <div class="col col-12">
                                            <p class="text-center">¿Estas seguro de eliminar el contacto?</p>
                                            <button type="submit" class="btn btn-danger btn-block" name="btn_confirm_delete" >Eliminar</button>
                                            <button type="button" class="btn btn-primary btn-block" onclick="cancel_delete(<?php echo $i?>)">Cancelar</button>
                                        </div>
                                 </div>
                             </div>

                         </div>
                    </form>
                </div>
     <?php
                 }
             }
     ?>
            </div>
         </div>
     </div>
<?php
    if($num_contacts == 0){
        echo "<h1 class='text-muted text-center mt-5'>No hay contactos</h1>";
    }
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            require_once "../php_scripts/Contact.php";
            require_once "../php_scripts/valid_inputs.php";

            $id_div = $_POST["id_div"];
            $name = $_POST["name_contact"];
            $mail = $_POST["mail_contact"];
            $phone = $_POST["phone_contact"];
            $new_img = $_FILES["img_contact"];
            $name_old_img = $_POST["img_name"];

            if(isset($_POST["btn_confirm_delete"])){
                if(validName($name) && validMail($mail) && validPhone($phone) ){
                    $contact = new Contact($name, $phone, $mail, $name_old_img);
                    $id_contact = $id_contact_div[$id_div];
                    $contact-> Delete_contact($id_contact);
                }
            }

            if(isset($_POST["btn_accept"])){
                if(validName($name) && validMail($mail) && validPhone($phone) && validImage($new_img)){
                    $contact = new Contact($name, $phone, $mail, $new_img);
                    $id_contact = $id_contact_div[$id_div];
                    $contact-> edit_contact($id_contact, $name_old_img);
                }
            }
        }
?>
</body>
</html>