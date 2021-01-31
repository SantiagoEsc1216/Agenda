<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
    require "../php_scripts/user.php";
    $email = $_GET["session_email"];

    $user = new User("","", $email);
    $id = $user->Get_ID();

    $contacts = $user->get_contacts($id);


    $dir_images = $_SERVER["DOCUMENT_ROOT"]."/Agenda/Imagenes/";
    
    foreach($contacts as $key=>$value){
        $img_name = $value["Img_Contact"];
        $data = file_get_contents($dir_images.$img_name);
    
        $base64_img = base64_encode($data);

        $contacts[$key]["base64_img"] = $base64_img;

    
    }

    unset($contact);

    $json_response = json_encode($contacts);

    print_r($json_response);
    
}
?>