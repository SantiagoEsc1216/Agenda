<?php 
   $cararteresAdmitidos="/^[a-zA-Z0-9 ]*$/";
   $imageTypes= array(
       "image/jpeg",
       "image/jpg"
   );
   $imageSizeMax = 2097152; //2 MB


   
function validName($user){
    global $userError, $cararteresAdmitidos; 
    if (!preg_match($cararteresAdmitidos, $user)){
        $userError="Solo puedes usar letras y espacios en blanco";
        return false;
    }

    else{
    
        return true;
    }
}

function validPass($pass){
    global $passError, $cararteresAdmitidos; 
    if (!preg_match($cararteresAdmitidos, $pass)){
        $passError="Solo puedes usar letras y espacios en blanco";
        return false;
    }

    else{
        return true;
    }
}

function validMail($mail_input){
    global $mailError;
    if(!filter_var($mail_input, FILTER_VALIDATE_EMAIL)){
        
        $mailError="Introduzca un e-mail valido";      
        return false;
    }
    else{
        return true;
    }
}

function cleanInput($input){

    $input= trim($input);
    $input= stripslashes($input);
    $input= htmlspecialchars($input);
    return $input;
}

function validPhoneNumber($PhoneNumber){

    if(!preg_match("/[0-9]+/", $PhoneNumber)){
        global $phoneError;
        $phoneError="Introduzca un numero de telefono valido";
        return false;
    }else{
        return true;
    }
}

function validImage($size, $type){
    global $imageTypes, $imageSizeMax;
  
 
    $Errors= array();

    if($size > $imageSizeMax){
        $Errors[]="El tamaño de la imagen no puede ser mayor a 2MB \n";
    }

    if((!in_array($type, $imageTypes))){
        $Errors[]="Solo imagenes de tipo .Jpeg y .Jpg";  
    }

    if(sizeof($Errors)>0){
        global $imgError;
        return false;
        $imgError="error2";
       
    }else{
       
        return true;
        $imgError="bien";
    }

    global $imgError;
    $imgError="Aaaaaaa";

}
?>