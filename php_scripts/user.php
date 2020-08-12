<?php 


class User{

public $user;
public $pass;
public $mail;

function __construct($user, $pass, $mail){
    $this->user = $user;
    $this->pass = $pass;
    $this->mail = $mail;
}

function Insert(){

    include("ServerSql.php");

    try{
        $conn=new PDO($dns, $db_username, $db_password);

        $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO Users (Username, Password, Mail) VALUES (:User, :Pass, :Mail)");

        $stmt->bindValue(":User", $this->user);
        $stmt->bindValue(":Pass", password_hash($this->pass, PASSWORD_DEFAULT) );
        $stmt->bindValue(":Mail", $this->mail);

        $stmt->execute();

        $conn= null;

    }

    catch(PDOException $e){
        echo "error: ".$e->getMessage();
    }

 }

 function Existencia(){

    include("ServerSql.php");

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

    function Pass(){
        include("ServerSql.php");

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

    function Nombre(){
        include("ServerSql.php");

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
        include("ServerSql.php");
        
            try{
                $conn=new PDO($dns, $db_username, $db_password);
        
                $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT ID from Users where Mail = :Mail");

                $stmt->bindValue(":Mail", $_SESSION["Mail"]);
                $stmt-> execute();

                $ID_User =  $stmt->fetchColumn();

                return $ID_User;

                $conn = null;
            }
        
            catch(PDOException $e){
                echo "error: ".$e->getMessage();
            }
    }

    function get_contacts($ID_User){

       include("ServerSql.php");

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
        include("ServerSql.php");
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
}


?>