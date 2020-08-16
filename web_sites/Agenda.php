<!DOCTYPE html>
<html lang="en">
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
         
        require("../php_scripts/user.php");       

        session_start();

        if(empty($_SESSION["username"]) or empty($_SESSION["mail"]) or empty($_SESSION["loggedin"])){
            header("location: login.php");
        }

        $UserSession =  new User($_SESSION["username"],"",$_SESSION["mail"]);

        $IDs = array();

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
                            <?php echo $_SESSION["username"] ?> 
                        </a>
                        
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            
                            <a href="#" class="dropdown-item">Perfil</a>
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
        $num_contacts = $UserSession->get_numberOfContacts($UserSession->Get_ID());
        
        if($num_contacts > 0 ){

            $i = 0;

                foreach($UserSession->get_contacts($UserSession->Get_ID()) as $Contact){  
                    $i += 1;

                    $IDs[$i] = $Contact["ID_Contact"]; 

       ?>


            <div class="col col-12 col-md-4 col-lg-3 mt-2" >
                 
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" >
                        <div class="card" name="card" id=" <?php  echo "card-".$i ?>">

                                <input type="hidden" name="id_div" value="<?php echo $i ?>">

                            <div class="card-header" id="<?php echo "card-header-".$i ?>">
                                <input name="name_contact" type="text" class="form-control" readonly value="<?php  echo $Contact["Name_Contact"]; ?>"> 
                            </div>

                            <img src="../Imagenes/<?php echo $Contact["Img_Contact"]?>" alt="card image top" class="card-img-top" style="width:100%; height:25vh; object-fit:cover; ">

                            <div class="card-body" id="<?php echo "card-body-".$i ?>" >
                                <input  name="mail_contact" type="text" class="form-control card-text" readonly value="<?php   echo $Contact["Mail_Contact"]; ?>"> 
                                 <input name="phone_contact" type="text" class="form-control card-text my-2" readonly  value="<?php   echo $Contact["Phone_Contact"]; ?>"> 
                            </div>
                
                            <div class="card-footer text-center" id ="<?php echo "card-footer-".$i ?>">
                                <button type="submit" class="btn btn-primary m-2" id="<?php echo $i ?>"  onclick=" return edit_options(<?php echo $i ?>)"  name="btn_edit" >Editar</button>
                                <button type="submit" class="btn btn-danger m-2"  name="btn_delete" >Eliminar</button>

                                <button class="btn btn-danger m-2" name="btn_cancel" id="<?php echo $i ?>" onclick="" style="display: none;" >Cancelar</button>
                                <button type="submit" class="btn btn-primary m-2" name="btn_accept" onclick="" style="display: none;" >Aceptar</button>
                            </div>

                         </div>   
                    </form>
                    
                </div>

     <?php
                 }
             }else{
                    echo "No hay contactos";
                    }
     ?>
                </div>

         </div>
     </div>

        <?php
        
        
        if($_SERVER["REQUEST_METHOD"]=="POST"){
        
            require "../php_scripts/Contact.php";
            require "../php_scripts/valid_inputs.php";
          
        
            if(isset($_POST["btn_delete"])){

                $name = $_POST["name_contact"];
                $mail = $_POST["mail_contact"];
                $phone = $_POST["phone_contact"];

                if(empty($name) or empty($mail) or empty($phone) ){
                    echo "<script> delete_error() </script>";
                }else{
                    $thisContact=new Contact($name, $phone, $mail);
        
                    $idContact = $thisContact->Get_IDContact();
                    $thisContact->Delete_contact($idContact);
                }
            }
            
            if(isset($_POST["btn_accept"])){
                $id_div = $_POST["id_div"];
                $name = $_POST["name_contact"];
                $mail = $_POST["mail_contact"];
                $phone = $_POST["phone_contact"];

                
                    if(empty($id_div) or empty($name) or empty($mail) or empty($phone) ){
                        echo "<script> edit_error() </script>";
                    }else{

                        if(validName($name) && validMail($mail) && validPhone($phone)){

                            $id_contact = $IDs[$id_div];
                                
                                $contact_update = new Contact($name, $phone, $mail);
            
                            if ($contact_update-> edit_contact($id_contact)){
                              
                                echo "<script> edit_success() </script>";
            
                            }
                        }
                    }
                
            }
        
        }

        
        ?>

</body>
</html>