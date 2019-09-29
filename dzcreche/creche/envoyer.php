<?php 
    session_start();
require_once '../includes/bd.php';
   if($_SERVER["REQUEST_METHOD"] == "POST"){
       $query="INSERT INTO `date`(`date_insc`) VALUES (NOW())";
            $result=mysqli_query($con,$query);
                $message=addcslashes($_POST["message"]);
                $suject=addcslashes($_POST["suject"]);
       $id=$_POST["id"];
       $id_c=$_SESSION['id'];
       
            $query="INSERT INTO `contact`(`suject`, `message`, `id`, `id_creche`, `date_insc` ,`destinataire`) VALUES ('$suject','$message','$id','$id_c',NOW(),'parent')";
            $result=mysqli_query($con,$query);
            if($result){
                header("Location: message.php");
            }else{
                echo "error";
            }

   }

?>