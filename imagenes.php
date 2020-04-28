<?php

$name=$_FILES["image"]["name"];
$tmp_name=$_FILES["image"]["tmp_name"];
$size=$_FILES["image"]["size"];

$directory="F:/wamp64/www/Agenda/images/".$name;

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if($size==0){
        echo "aaaaaaaa";
    }else{
       move_uploaded_file($tmp_name, $directory);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php htmlspecialchars( $_SERVER["PHP_SELF"])?>" method="POST" enctype="multipart/form-data">
    
    <input type="file" name="image" id="image">
    <button type="submit">Enviar</button>
    </form>
</body>
</html>