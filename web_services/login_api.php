<?php

require "../php_scripts/user.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];

    if(validMail($email) && validPass($password)){
        $user = new User("", $password, $email);
        if($user->pass_verify()){
            header('Content-Type: application/json');

            $response = array(
                "message"=> "correct login",
                "email"=> $user->mail,
                "username"=> $user->get_username()
            );

            echo json_encode($response);
            
        }else{
            header('Content-Type: application/json');
            $response = array(
                "message"=> "incorrect password",
                "email"=> null,
                "username"=> null
            );

            echo json_encode($response);
        }
    }else{
        header('Content-Type: application/json');
        $response = array(
            "message"=> "invalid params",
            "email"=> null,
            "username"=> null
        );
        
        echo json_encode($response);
    }

}

?>