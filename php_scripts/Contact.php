<?php 


class Contact{
    
    public $Name_contact;
    public $Phone_contact;
    public $Mail_contact;
    public $Img_contact;
    public $Img_state;
    

    function __construct($Name_contact, $Phone_contact, $Mail_contact){
        require_once "valid_inputs.php";

        $this->Name_contact = cleanInput($Name_contact);
        $this->Phone_contact = cleanInput($Phone_contact);
        $this->Mail_contact = cleanInput($Mail_contact);
        $this->Img_contact;
        $this->Img_state=true;
    } 


    
     function Add_contact(){

            require ("ServerSql.php");
            require_once ("user.php");

            if($_FILES["Imagen"]["size"]==0){
                $this->Img_contact="Default.png";
                    }else{
                            if(validImage()){
                                move_uploaded_file( $_FILES["Imagen"]["tmp_name"],$_SERVER["DOCUMENT_ROOT"]."/Agenda/Imagenes/".$_FILES["Imagen"]["name"]);
                            $this->Img_contact=$_FILES["Imagen"]["name"]; 
                            }else{
                                $this->Img_state=false;
                            }
                    } 
                 
        if($this->Img_state==true){

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
        }
     }
         

     function Delete_contact($ID_Contact, $img){
        require ("ServerSql.php");
        require_once ("user.php");

            try{

                $User = new User("","","");
                $id_user = $User->Get_ID();
              

                $conn = new PDO($dns, $db_username, $db_password);

                $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("DELETE FROM Contact WHERE ID_Contact = :ID_C AND ID_user = :id_u");

                $stmt-> bindValue(":ID_C", $ID_Contact);
                $stmt->bindValue(":id_u", $id_user);
              
                $stmt-> execute();

                if($img != "Default.png"){
                unlink($_SERVER["DOCUMENT_ROOT"]."/Agenda/Imagenes/".$img);
            }
                $conn=null;

                return true;
            }

            catch(PDOException $e){
                echo $e;
            }

     }

     function Get_IDContact(){
        require ("ServerSql.php");
        require_once ("user.php");


            $User = new User("","","");
            $IdUser=$User->Get_ID();

            try{

                $conn = new PDO($dns, $db_username, $db_password);

                $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("SELECT ID_Contact FROM contact where Name_Contact = :Name AND Phone_Contact = :Phone AND Mail_Contact = :Mail AND ID_user = :ID_U");

                $stmt-> bindValue(":Name", $this->Name_contact);
                $stmt-> bindValue(":Phone",$this->Phone_contact);
                $stmt-> bindValue(":Mail", $this->Mail_contact);
                $stmt-> bindValue(":ID_U", $IdUser );

                $stmt-> execute();

                $Id_Contact = $stmt->fetchColumn();

                return $Id_Contact ;
                
                $conn=null;
            
            }

            catch(PDOException $e){
                echo $e;
            }
        
     }

 

    
    function edit_contact($id_contact){

        require ("ServerSql.php");
        require_once ("user.php");

   /*     if($_FILES["Imagen"]["size"]==0){
            
                }else{
                        if(validImage()){
                            move_uploaded_file( $_FILES["Imagen"]["tmp_name"],__DIR__."\Imagenes/". $_FILES["Imagen"]["name"]);
                        $this->Img_contact=$_FILES["Imagen"]["name"]; 
                        }else{
                            $this->Img_state=false;
                        }
                } */
             
   // if($this->Img_state==true){

            $User = new User("","","");
            $id_user = $User->Get_ID();
          

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
              
                $stmt-> execute();

                $conn=null;
                
                return true;
            }

            catch(PDOException $e){
                echo $e;
            }
    //}
    }
 
}  
?>