<?php
require_once ("../php_scripts/Contact.php");
require_once ("../php_scripts/user.php");
require_once ("../php_scripts/valid_inputs.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){

$name = $_POST["name_contact"];
$mail = $_POST["email_contact"];
$phone = $_POST["phone_contact"];

if(isset($_POST["img_contact"])){
    $img = $_POST["img_contact"];
}else{
    if(isset($_FILES["img_contact"])){
        $img = $_FILES["img_contact"];
    }else{
        $img = "Default.png";
    }
}

$session_email = $_POST["session_email"];

   if(validName($name) && validMail($mail) && validPhone($phone)){

       $Contact = new Contact($name, $phone, $mail, $img);
       $user = new User("", "", $session_email);
       $id_user = $user->Get_ID();

       if ($Contact-> Add_contact($id_user)){
           echo "OK";
       }else{
        echo "error";
           }
   }else{
        echo "invalid params";
   }

}

?>