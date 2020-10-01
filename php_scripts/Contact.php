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

            if($this->Img_contact == ""){
                $this->Img_contact="Default.png";
                    }

        if(validImage($_FILES["img_contact"]) or $this->Img_contact == "Default.png" ){

            move_uploaded_file( $_FILES["img_contact"]["tmp_name"],$_SERVER["DOCUMENT_ROOT"]."/Agenda/Imagenes/".$_FILES["img_contact"]["name"]);

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
                    $stmt-> bindValue(":Img", $this->Img_contact);

                    $stmt-> execute();
                    $conn=null;

                    return true;
                }

                catch(PDOException $e){
                    echo $e;
                }
        }else{
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
                $stmt->bindValue(":id_u", $id_user);

                if($stmt-> execute()){

                    if($this->Img_contact != "Default.png"){
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

     function Get_IDContact(){
        require ("server_sql.php");
        require_once ("user.php");


            $User = new User("","","");
            $IdUser=$User->Get_ID();

            try{

                $conn = new PDO($dns, $db_username, $db_password);

                $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("SELECT ID_Contact FROM contact where Name_Contact = :Name AND Phone_Contact = :Phone AND Mail_Contact = :Mail AND Img_Contact = :Img AND ID_user = :ID_U");

                $stmt-> bindValue(":Name", $this->Name_contact);
                $stmt-> bindValue(":Phone",$this->Phone_contact);
                $stmt-> bindValue(":Mail", $this->Mail_contact);
                $stmt-> bindValue(":Img", $this->Img_contact);
                $stmt-> bindValue(":ID_U", $IdUser );

                $stmt-> execute();

                $Id_Contact = $stmt->fetchColumn();

                return $Id_Contact;

                $conn=null;

            }

            catch(PDOException $e){
                echo $e;
            }

     }




    function edit_contact($id_contact){

        require ("server_sql.php");
        require_once ("user.php");


            $User = new User("","","");
            $id_user = $User->Get_ID();

            try{
                $conn = new PDO($dns, $db_username, $db_password);

                $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                if($_FILES["img_contact"]["size"]>0){

                    if(validImage($_FILES["img_contact"])){
                        $new_image = $_FILES["img_contact"]["name"];
                        move_uploaded_file( $_FILES["img_contact"]["tmp_name"],$_SERVER["DOCUMENT_ROOT"]."/Agenda/Imagenes/".$new_image);

                        $sql_image = "UPDATE contact SET Name_Contact = :name, Phone_Contact = :phone,
                        Mail_Contact = :mail, Img_Contact = :img WHERE ID_Contact = :id_c AND id_user = :id_u";

                        $stmt = $conn->prepare($sql_image);

                        $stmt-> bindValue(":name", $this->Name_contact);
                        $stmt-> bindValue(":phone",$this->Phone_contact);
                        $stmt-> bindValue(":mail", $this->Mail_contact);
                        $stmt-> bindValue(":img", $new_image);
                        $stmt-> bindValue(":id_c", $id_contact);
                        $stmt-> bindValue(":id_u", $id_user);

                        if($stmt-> execute()){
                            if($this->Img_contact != "Default.png"){
                                unlink($_SERVER["DOCUMENT_ROOT"]."/Agenda/Imagenes/".$this->Img_contact);
                             }
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }

                }else{

                    $sql_no_image = "UPDATE contact SET
                    Name_Contact = :name,
                    Phone_Contact = :phone,
                    Mail_Contact = :mail
                    WHERE
                    ID_Contact = :id_c
                    AND
                    id_user = :id_u";

                    $stmt = $conn->prepare($sql_no_image);

                    $stmt-> bindValue(":name", $this->Name_contact);
                    $stmt-> bindValue(":phone",$this->Phone_contact);
                    $stmt-> bindValue(":mail", $this->Mail_contact);
                    $stmt-> bindValue(":id_c", $id_contact);
                    $stmt-> bindValue(":id_u", $id_user);

                    if($stmt-> execute()){
                        return true;
                    }else{
                        return false;
                    }
                }
                $conn=null;
            }

            catch(PDOException $e){
                echo $e;
                return false;
            }

    }

}
?>