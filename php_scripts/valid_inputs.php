<?php

function validName($name){
    $re = "/^[a-zA-Zá-ýÁ-Ý0-9\u{00f1}\u{00d1}\(\)+ ]+$/";
    if(!empty($name)){
        if (preg_match($re, $name)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function validPass($pass){
    $re = "/^([a-zA-Zá-ýÁ-Ý0-9\u{00f1}\u{00d1}]{6,})+$/";
    if(!empty($pass)){
        if (preg_match($re, $pass)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function validMail($mail_input){
    if(!empty($mail_input)){
        if(filter_var($mail_input, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function validPhone($input_phone){
    $re = "/^[0-9\+\- ]{10,18}$/";
    if(!empty($input_phone)){
        if(preg_match($re, $input_phone)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function validImage($img_file){
    $imageTypes= array(
        "image/jpeg",
        "image/jpg",
        "image/png"
    );
    $imageSizeMax = 2097152; //2 MB

    if($img_file["size"] > $imageSizeMax or !in_array($img_file["type"], $imageTypes)){
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