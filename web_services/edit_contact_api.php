<?php
 if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "../php_scripts/Contact.php";
    require_once "../php_scripts/User.php";
    require_once "../php_scripts/valid_inputs.php";

    $id_contact = $_POST["id_contact"];
    $email_user = $_POST["email_user"];

    $user = new User("","", $email_user);
    $id_user = $user->Get_ID();

    if(isset($_POST["btn_confirm_delete"])){
        
            $name_old_img = Contact::img_name($id_contact, $id_user);
            $contact = new Contact("","","",$name_old_img);
            
           if( $contact-> Delete_contact($id_contact, $id_user)){
                echo "OK";
           }else{
               "error";
           }
    }

    if(isset($_POST["btn_accept"])){
        $new_img = "";
        $name = $_POST["name_contact"];
        $mail = $_POST["email_contact"];
        $phone = $_POST["phone_contact"];
        if(isset($_FILES["img_contact"])) $new_img = $_FILES["img_contact"];else{
            if(isset($_POST["img_contact"])) $new_img = $_POST["img_contact"];
        }

        if(validName($name) && validMail($mail) && validPhone($phone)){
            $contact = new Contact($name, $phone, $mail, $new_img);
            $old_img = $contact->img_name($id_contact, $id_user);
            if($contact-> edit_contact($id_contact, $id_user ,$old_img)){
             echo "OK";
            }else{
                echo "error";
            }
        }
    }
}
?>