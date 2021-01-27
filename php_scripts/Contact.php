<?php


class Contact{

    public $Name_contact;
    public $Phone_contact;
    public $Mail_contact;
    public $Img_contact;
    public $Img_state;


    function __construct($Name_contact, $Phone_contact, $Mail_contact, $Img_contact){
        require_once "valid_inputs.php";

        $this->Name_contact = cleanInput($Name_contact);
        $this->Phone_contact = cleanInput($Phone_contact);
        $this->Mail_contact = filter_var($Mail_contact, FILTER_SANITIZE_EMAIL);
        $this->Img_contact = $Img_contact;

    }



     function Add_contact($id_user){

            require ("server_sql.php");
            require_once ("user.php");

            $img_name;
            $dir_images = $_SERVER["DOCUMENT_ROOT"]."/Agenda/Imagenes/";

            if($this->Img_contact == "Default.png"){
                $img_name = $this->Img_contact;
            }else{
                if(!isset($img_contact["name"])){

                    if(empty($this->Img_contact)){
                    
                        $img_name = "Default.jpg";
                        
                    }else{
                        while(true){
                            $img_name = uniqid("img",true).".png";
                            if(!file_exists($dir_images.$img_name)) break;
                        }
        
                        file_put_contents($dir_images.$img_name, base64_decode($this->Img_contact));
                    }
    
                }else{
    
                    if($this->Img_contact["name"] == ""){
                        $this->Img_contact["name"]="Default.png";
                    }
        
                    if($this->Img_contact["name"] != "Default.png"){
                        move_uploaded_file( $this->Img_contact["tmp_name"],$path.$this->Img_contact["name"]);
                        $img_name = $this->Img_contact["name"];
                    }
                }
    
            }

        
                try{

                    $conn = new PDO($dns, $db_username, $db_password);

                    $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $conn->prepare("INSERT INTO contact (Name_Contact, Phone_Contact, Mail_Contact, ID_user, Img_Contact) VALUES (:Name, :Phone, :Mail, :ID_U, :Img )");

                    $stmt-> bindValue(":Name", $this->Name_contact);
                    $stmt-> bindValue(":Phone",$this->Phone_contact);
                    $stmt-> bindValue(":Mail", $this->Mail_contact);
                    $stmt-> bindValue(":ID_U", $id_user );
                    $stmt-> bindValue(":Img", $img_name);

                    $stmt-> execute();

                    if($stmt->rowCount()>0){
                        return true;
                    }else{
                        return false;
                    }

                    $conn=null;
                }

                catch(PDOException $e){
                    echo $e;
                    return false;
                }
     }


     function Delete_contact($ID_Contact, $id_user){
        require ("server_sql.php");
        require_once ("user.php");

            try{

                $conn = new PDO($dns, $db_username, $db_password);

                $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("DELETE FROM Contact WHERE ID_Contact = :ID_C AND ID_user = :id_u");

                $stmt-> bindValue(":ID_C", $ID_Contact);
                $stmt-> bindValue(":id_u", $id_user);

                $stmt-> execute();

                if($stmt-> rowCount()==1){

                    if($this->Img_contact != "Default.png" && $this->img_count($this->Img_contact) == 0){
                        unlink($_SERVER["DOCUMENT_ROOT"]."/Agenda/Imagenes/".$this->Img_contact);
                    }
                    return true;
                }else{
                    return false;
                }

                $conn=null;
            }

            catch(PDOException $e){
                return false;
                echo $e;
            }

     }

    function edit_contact($id_contact, $id_user ,$name_old_img){

        require ("server_sql.php");

            try{

                $conn = new PDO($dns, $db_username, $db_password);
                $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $conn->prepare("UPDATE contact SET
                    Name_Contact = :name,
                    Phone_Contact = :phone,
                    Mail_Contact = :mail
                    WHERE
                    ID_Contact = :id_c
                    AND
                    id_user = :id_u");

                    $stmt-> bindValue(":name", $this->Name_contact);
                    $stmt-> bindValue(":phone",$this->Phone_contact);
                    $stmt-> bindValue(":mail", $this->Mail_contact);
                    $stmt-> bindValue(":id_c", $id_contact);
                    $stmt-> bindValue(":id_u", $id_user);

                    if($stmt-> execute()){
                        if(!empty($this->Img_contact)){
                            $this->edit_img($id_contact, $name_old_img, $id_user);
                        }
                        return true;
                    }else{
                        return false;
                    }

                $conn=null;
            }

            catch(PDOException $e){
                echo $e;
                return false;
            }

    }

    private function edit_img($id_contact, $name_old_img, $id_user){
        require("server_sql.php");
        $dir_images = $_SERVER["DOCUMENT_ROOT"]."/Agenda/Imagenes/";
        $img_name;
        try{

            if(gettype($this->Img_contact) == "string"){
                while(true){
                    $img_name = uniqid("img",true).".png";
                    if(!file_exists($dir_images.$img_name)) break;
                }
            }else{
                $img_name = $this->Img_contact["name"];
            }

            $conn = new PDO($dns, $db_username, $db_password);
            $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("UPDATE contact set Img_Contact = :new_img where ID_Contact = :id_c AND ID_user = :id_u");

            $stmt-> bindValue(":new_img", $img_name);
            $stmt-> bindValue(":id_c", $id_contact);
            $stmt-> bindValue(":id_u", $id_user);

            $stmt->execute();

            if($stmt->rowCount() == 1){
                if($name_old_img != "Default.png" && $this->img_count($name_old_img) == 0){
                    unlink($_SERVER["DOCUMENT_ROOT"]."/Agenda/Imagenes/".$name_old_img);
                }
                if(gettype($this->Img_contact) == "string"){
                    file_put_contents($dir_images.$img_name, base64_decode($this->Img_contact));
                }else{
                    move_uploaded_file( $this->Img_contact["tmp_name"],$_SERVER["DOCUMENT_ROOT"]."/Agenda/Imagenes/".$this->Img_contact["name"]);
                }
            }
        }catch(PDOException $e){
            echo $e;
        }
    }

    private function img_count($img_name){
        require("server_sql.php");

        try{

            $conn = new PDO($dns, $db_username, $db_password);
            $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT Img_Contact FROM contact where Img_Contact = :img");

            $stmt-> bindValue(":img", $img_name);

            $stmt-> execute();

            return $stmt->rowCount();

            $conn = null;

        }catch(PDOException $e){
            echo $e;
             return  false;
        }
    }

    public static function img_name($id_contact, $id_user){
        require("server_sql.php");

        try{

            $conn = new PDO($dns, $db_username, $db_password);
            $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("select img_contact from contact where ID_Contact = :id_contact and id_user = :id_user");

            $stmt-> bindValue(":id_contact", (int)$id_contact);
            $stmt-> bindValue(":id_user", (int)$id_user);

            if($stmt-> execute()){
                return $stmt->fetchColumn();
            }else{
                return null;
            }

           
            $conn = null;

        }catch(PDOException $e){
            echo $e;
             return  false;
        }
    }

}
?>