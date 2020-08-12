<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    session_start();


    require "../php_scripts/Contact.php";
    require "../php_scripts/valid_inputs.php";

  

    if(isset($_POST["btn_delete"])){

        $thisContact=new Contact($_POST["name_contact"], $_POST["phone_contact"], $_POST["mail_contact"]);

        $idContact = $thisContact->Get_IDContact();
        $thisContact->Delete_contact($idContact);
        header("location: ../web_sites/Agenda.php ");
       
    }
    
    if(isset($_POST["btn_accept"])){
        
        echo $GLOBALS["id_contact"];

        $name = $_POST["name_contact"];
        $mail = $_POST["mail_contact"];
        $phone = $_POST["phone_contact"];

            if(empty($name)){
                $userError="Rellene este campo";
            }
        
            if(empty($mail)){
                $mailError="Rellene este campo";
            }
        
            if(empty($phone)){
                $phoneError="Rellene este campo";
            }
        
            if(validName($name) && validMail($mail) && validPhone($phone)){
                    
                    $Contact = new Contact($name, $phone, $mail);
                    $idContact = $Contact->Get_IDContact();

                if ($Contact-> edit_contact($idContact)){
                  
                  //  header("location: ../web_sites/Agenda.php ");

                }
            }
        
    }

}

?>