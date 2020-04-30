<?php 
   $cararteresAdmitidos="/^[a-zA-Z0-9 ]*$/";
   $imageTypes= array(
       "image/jpeg",
       "image/jpg"
   );
   $imageSizeMax = 2097152; //2 MB
   $Post_max_size=8388608 ; //8MB en php.ini

   
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

function validImage(){
    global $imageTypes, $imageSizeMax, $imgError, $Post_max_size;
    
       if($_FILES["Imagen"]["size"]>$Post_max_size) throw new Exception("Post contentn lengt exceeds the limit of php.ini");

    $Errors= array();

    if($_FILES["Imagen"]["size"] > $imageSizeMax or $_FILES["Imagen"]["error"]=1 ){
        array_push($Errors,"Tamaño maximo 2Mb \n");        
    }

    if((!in_array($_FILES["Imagen"]["type"], $imageTypes))){
        array_push($Errors, "Solo imagenes de tipo .Jpeg y .Jpg");       
    }

    if(sizeof($Errors)>0){
       $imgError = implode(" ,", $Errors);
        
        return false;   
      
    }else{
        return true;
    
}

}
?>