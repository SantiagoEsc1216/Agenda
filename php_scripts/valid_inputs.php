<?php 
   $cararteresAdmitidos="/^[a-zA-Zá-ýÁ-Ý0-9\u{00f1}\u{00d1}\(\)+ ]+$/";
   $imageTypes= array(
       "image/jpeg",
       "image/jpg",
       "image/png"
   );
   $imageSizeMax = 2097152; //2 MB
  

   
function validName($user){
    global  $cararteresAdmitidos; 
    if (!preg_match($cararteresAdmitidos, $user)){
        return false;
    }else{
        return true;
    }
}

function validPass($pass){
    global $cararteresAdmitidos; 
    if (!preg_match($cararteresAdmitidos, $pass)){
        return false;
    }else{
        return true;
    }
}

function validMail($mail_input){
    if(!filter_var($mail_input, FILTER_VALIDATE_EMAIL)){
        return false;
    }else{
        return true;
    }
}

function validPhone($PhoneNumber){

    if(!preg_match("/^[0-9\+\- ]{10,18}$/", $PhoneNumber)){
        global $phoneError;
        $phoneError="Introduzca un numero de telefono valido";
        return false;
    }else{
        return true;
    }
}

function validImage(){
    global $imageTypes, $imageSizeMax;

    if($_FILES["Imagen"]["size"] > $imageSizeMax or !in_array($_FILES["Imagen"]["type"], $imageTypes)){
        return false;
    }else{
        return true;
    }


}

function cleanInput($input){

    $input= trim($input);
    $input= stripslashes($input);
    $input= htmlspecialchars($input);
    return $input;
}

?>