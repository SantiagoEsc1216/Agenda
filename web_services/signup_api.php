<?php
    require_once ("../php_scripts/user.php");
    require_once ("../php_scripts/valid_inputs.php");

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $mail = $_POST["user_email"];
        $username = $_POST["user_name"];
        $pass = $_POST["user_pass"];

        if(validName($username) && validPass($pass) && validMail($mail)){
            $NewUser=new User($username, $pass, $mail);
            if($NewUser-> mail_verify()){
                if($NewUser-> Insert()){
                    echo "OK";
                }else{
                    echo "error";
                }
            }else{
                echo "email unavailable";
            }
        }else{
            echo "invalid params";
        }
    }
?>