<?php

use function PHPSTORM_META\type;
//TODO: Crear nombre propio de imagenes subidas desde el sitio web

require_once "valid_inputs.php";

class User{

public $user;
public $pass;
public $mail;

function __construct($user, $pass, $mail){

    $this->user = cleanInput($user);
    $this->pass = cleanInput($pass);
    $this->mail = cleanEmail($mail);
}

function Insert(){

    include("server_sql.php");

    try{
        $conn=new PDO($dns, $db_username, $db_password);

        $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO Users (Username, Password, Mail) VALUES (:User, :Pass, :Mail)");

        $stmt->bindValue(":User", $this->user);
        $stmt->bindValue(":Pass", password_hash($this->pass, PASSWORD_DEFAULT) );
        $stmt->bindValue(":Mail", $this->mail);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

        $conn= null;

    }

    catch(PDOException $e){
        echo "error: ".$e->getMessage();
        return false;
    }

 }

 function mail_verify(){

    include("server_sql.php");

    try{
        $conn=new PDO($dns, $db_username, $db_password);

        $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT Mail From Users where Mail = :Mail" );
        $stmt->bindValue(":Mail", $this->mail);
        $stmt->execute();

        $RowNumber= $stmt->rowCount();

        if($RowNumber>0){
            return false;
        }else{
            return true;
        }
        $conn=null;


    }

    catch(PDOException $e){
        echo "error: ".$e->getMessage();
    }

}

    function pass_verify(){
        include("server_sql.php");

        try{
            $conn=new PDO($dns, $db_username, $db_password);

            $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT Password From Users where Mail = :Mail" );
            $stmt->bindValue(":Mail", $this->mail);
            $stmt->execute();

           $hash=$stmt->fetchColumn();



            if(password_verify($this->pass, $hash)){
                return true;
            }else{
                return false;
            }
            $conn=null;

        }

        catch(PDOException $e){
            echo "error: ".$e->getMessage();
        }
    }

    function get_username(){
        include("server_sql.php");

        try{
            $conn=new PDO($dns, $db_username, $db_password);

            $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT Username From Users where Mail = :Mail" );
            $stmt->bindValue(":Mail", $this->mail);
            $stmt->execute();

            $nombre=$stmt->fetchColumn();
            return $nombre;

            $conn=null;
        }

        catch(PDOException $e){
            echo "error: ".$e->getMessage();
        }
    }

     function Get_ID(){
        include("server_sql.php");

            try{
                $conn=new PDO($dns, $db_username, $db_password);

                $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT ID from Users where Mail = :Mail");

                $stmt->bindValue(":Mail", $this->mail);
                $stmt-> execute();

                $ID_User =  $stmt->fetchColumn();

                return (int)$ID_User;

                $conn = null;
            }

            catch(PDOException $e){
                echo "error: ".$e->getMessage();
            }
    }

    function get_contacts($ID_User){

       include("server_sql.php");

       try{
        $conn=new PDO($dns, $db_username, $db_password);

        $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT Name_Contact, Phone_Contact, Mail_Contact, Img_Contact, ID_Contact from Contact where ID_user = :Id_u");

        $stmt->bindValue(":Id_u", $ID_User);
        $stmt-> execute();

        $contact_details= $stmt->fetchAll(pdo::FETCH_ASSOC);

        return $contact_details;

        $conn = null;
    }
    catch(PDOException $e){
        echo "error: ".$e->getMessage();
    }
    }

    function get_numberOfContacts($ID_User){
        include("server_sql.php");
        try{
            $conn=new PDO($dns, $db_username, $db_password);

            $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT count(Name_Contact) from Contact where ID_user = :Id_u");

            $stmt->bindValue(":Id_u", $ID_User);
            $stmt-> execute();

            $numberOfContacts =  $stmt->fetchColumn();

            return $numberOfContacts;

            $conn = null;
        }

        catch(PDOException $e){
            echo "error: ".$e->getMessage();
        }

    }


function change_password($id_user, $new_pass){
    require("server_sql.php");
    try{
        $conn = new PDO($dns, $db_username, $db_password);

        $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn-> prepare("UPDATE users set Password = :new_pass WHERE ID = :id_user");

        $stmt-> bindValue(":new_pass", password_hash($new_pass, PASSWORD_DEFAULT));
        $stmt-> bindValue(":id_user", $id_user);

        if($stmt-> execute()){
            return true;
        }else{
            return false;
        }

        $conn = null;

    }

    catch(PDOException $e){
        echo "error: ".$e->getMessage();
    }
}

function change_username($id_user, $new_username){
    require("server_sql.php");
    try{
        $conn = new PDO($dns, $db_username, $db_password);

        $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("UPDATE users set Username = :new_username WHERE ID = :id_user");

        $stmt-> bindValue(":new_username", cleanInput($new_username), PDO::PARAM_STR);
        $stmt-> bindValue(":id_user", $id_user, PDO::PARAM_INT);

        if($stmt-> execute()){
            return true;
        }else{
            return false;
        }

        $conn=null;

    }

    catch(PDOException $e){
        echo "error: ".$e->getMessage();
        return false;
    }
}

function change_mail($id_user, $new_mail){
    require("server_sql.php");
    try{
        $conn = new PDO($dns, $db_username, $db_password);

        $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn-> prepare("UPDATE users set Mail = :new_mail WHERE ID = :id_user");

        $stmt-> bindValue(":new_mail", cleanEmail($new_mail));
        $stmt-> bindValue(":id_user", $id_user);

        if($stmt-> execute()){
            return true;
        }else{
            return false;
        }

        $conn = null;

    }

    catch(PDOException $e){
        echo "error: ".$e->getMessage();
    }
}

}

?>