<?php 
   $cararteresAdmitidos="/^[a-zA-Z0-9 ]*$/";
   $imageTypes= array(
       "image/jpeg",
       "image/jpg"
   );
   $imageSizeMax = 2097152; //2 MB
   $Post_max_size=8388608 ; //8MB en php.ini

   
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

function cleanInput($input){

    $input= trim($input);
    $input= stripslashes($input);
    $input= htmlspecialchars($input);
    return $input;
}

function validPhone($PhoneNumber){

    if(!preg_match("/[0-9]+/", $PhoneNumber)){
        global $phoneError;
        $phoneError="Introduzca un numero de telefono valido";
        return false;
    }else{
        return true;
    }
}

function validImage(){
    global $imageTypes, $imageSizeMax, $imgError;
    
 $Errors= array();

 if($_FILES["Imagen"]["size"] > $imageSizeMax){
     array_push($Errors,"Tamaño maximo 2Mb "); 
  
 }

 if((!in_array($_FILES["Imagen"]["type"], $imageTypes))){
     array_push($Errors, "Solo imagenes de tipo .Jpeg y .Jpg ");       
 }

 if(sizeof($Errors)>0){
    $imgError = implode(" ,", $Errors);
     
     return false;   
   
 }else{
     return true;
    }

}
?>