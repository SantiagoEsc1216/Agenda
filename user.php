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
}


?>