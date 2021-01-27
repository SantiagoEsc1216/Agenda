<?php
       require_once("../php_scripts/user.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require_once("../php_scripts/valid_inputs.php");
        $pass = $_POST["password"];
        $username = $_POST["name_session"];
        $email = $_POST["email_session"];
        $user = new User($username,$pass,$email);
        $id_user = $user-> Get_ID();

        if(isset($_POST["new_name"])){
            $new_name = $_POST["new_name"];
            if (validName($new_name) && validPass($pass)) {
                if($user->pass_verify()){
                    if($user->change_username($id_user, $new_name)){
                        echo "OK_name";
                    }else{
                        echo "error";
                    }
                }else {
                    echo "incorrect password";
                }
            } else {
                echo "invalid params";
            }
        }
        if(isset($_POST["new_email"])){
            $new_mail = $_POST["new_email"];

            if(validMail($new_mail) && validPass($pass)){
                if($user->pass_verify()){
                    $user->mail = $new_mail;
                    if ($user->mail_verify()) {
                        if($user->change_mail($id_user, $new_mail)){
                           echo "OK_email";
                        }else{
                            echo "error";
                        }
                    }else {
                        echo "email unavailable";
                    }
                } else {
                   echo "incorrect password";
                }
            }else{
                   echo "invalid paramas";
            }
        }
        if(isset($_POST["new_pass"])){
            $new_pass = $_POST["new_pass"];
            if (validPass($new_pass) &&  validPass($pass)) {
                if($user->pass_verify()){
                    if($user->change_password($id_user, $new_pass)){
                        echo "OK_password";
                    }else{
                       echo "error";
                    }
                }else {
                    echo "incorrect password";
                }
            } else {
                echo "invalid paramas";
            }
        }
    }
?>