<?php 


class Contact{
    
    public $Name_contact;
    public $Phone_contact;
    public $Mail_contact;
    public $Img_contact;
    

    function __construct($Name_contact, $Phone_contact, $Mail_contact){

        $this->Name_contact=$Name_contact;
        $this->Phone_contact=$Phone_contact;
        $this->Mail_contact=$Mail_contact;
        $this->Img_contact;

    } 
    
     function Add_contact(){

            Include ("ServerSql.php");
            Include ("user.php");

            if(empty($_FILES["Imagen"])){
                $this->Img_contact="F:/wamp64/www/Agenda/Imagenes/Default.png";

                    }else{
                        if(validImage()){
                            move_uploaded_file( $_FILES["Imagen"]["tmp_name"],__DIR__."\Imagenes/". $_FILES["Imagen"]["name"]);
                           $this->Img_contact=$_FILES["Imagen"]["name"]; 
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
                $stmt-> bindValue(":Img", $this->Img_contact);

                $stmt-> execute();

                $conn=null;

              //  header("location: Agenda.php");
            }

            catch(PDOException $e){
                echo $e;
            }
     }    

     }   

    
    
} 

?>