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



     function Add_contact(){

            require ("server_sql.php");
            require_once ("user.php");

            if($this->Img_contact["name"] == ""){
                $this->Img_contact["name"]="Default.png";
            }

        if($this->Img_contact != "Default.png"){
            move_uploaded_file( $this->Img_contact["tmp_name"],$_SERVER["DOCUMENT_ROOT"]."/Agenda/Imagenes/".$this->Img_contact["name"]);
        }

                $User = new User("","","");
                $IdUser=$User->Get_ID();

                try{

                    $conn = new PDO($dns, $db_username, $db_password);

                    $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $conn->prepare("INSERT INTO contact (Name_Contact, Phone_Contact, Mail_Contact, ID_user, Img_Contact) VALUES (:Name, :Phone, :Mail, :ID_U, :Img )");

                    $stmt-> bindValue(":Name", $this->Name_contact);
                    $stmt-> bindValue(":Phone",$this->Phone_contact);
                    $stmt-> bindValue(":Mail", $this->Mail_contact);
                    $stmt-> bindValue(":ID_U", $IdUser );
                    $stmt-> bindValue(":Img", $this->Img_contact["name"]);

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


     function Delete_contact($ID_Contact){
        require ("server_sql.php");
        require_once ("user.php");

            try{

                $User = new User("","","");
                $id_user = $User->Get_ID();


                $conn = new PDO($dns, $db_username, $db_password);

                $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("DELETE FROM Contact WHERE ID_Contact = :ID_C AND ID_user = :id_u");

                $stmt-> bindValue(":ID_C", $ID_Contact);
                $stmt-> bindValue(":id_u", $id_user);

                $stmt-> execute();

                if($stmt-> rowCount()==1){
                    echo $this->img_count($this->Img_contact);
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

    function edit_contact($id_contact, $name_old_img){

        require ("server_sql.php");
        require_once ("user.php");

            try{
                $User = new User("","","");
                $id_user = $User->Get_ID();

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

                    $stmt-> execute();
                    if($this->Img_contact["size"]>0){
                        $this->edit_img($id_contact, $name_old_img, $id_user);
                    }
                    echo $stmt->rowCount();

                $conn=null;
            }

            catch(PDOException $e){
                echo $e;
                return false;
            }

    }

    private function edit_img($id_contact, $name_old_img, $id_user){
        require("server_sql.php");
        try{

            $conn = new PDO($dns, $db_username, $db_password);
            $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("UPDATE contact set Img_Contact = :new_img where ID_Contact = :id_c AND ID_user = :id_u");

            $stmt-> bindValue(":new_img", $this->Img_contact["name"]);
            $stmt-> bindValue(":id_c", $id_contact);
            $stmt-> bindValue(":id_u", $id_user);

            $stmt->execute();

            if($stmt->rowCount() == 1){
                if($name_old_img != "Default.png" && $this->img_count($name_old_img) == 0){
                    unlink($_SERVER["DOCUMENT_ROOT"]."/Agenda/Imagenes/".$name_old_img);
                }
                move_uploaded_file( $this->Img_contact["tmp_name"],$_SERVER["DOCUMENT_ROOT"]."/Agenda/Imagenes/".$this->Img_contact["name"]);
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

            $stmt-> bindValue((":img"), $img_name);

            $stmt-> execute();

            return $stmt->rowCount();

            $conn = null;

        }catch(PDOException $e){
            echo $e;
             return  false;
        }
    }

}
?>