<?php 

$servername="localhost";
$db_username="root";
$db_password="pass";
$db_name="Agenda";

$dns="mysql::host=$servername;dbname=$db_name";
/*
function Conection(){

        $servername="localhost";
        $db_username="root";
        $db_password="pass";
        $db_name="Agenda";

        $dns="mysql::host=$servername;dbname=$db_name";
    
        try{
            $conn=new PDO($dns, $db_username, $db_password);

            $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }

    
        catch(PDOException $e){
            echo "error: ".$e->getMessage();
        }
    }
    
    function Close_Connection(){
        $conn=null;
    }*/
?>