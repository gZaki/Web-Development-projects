<?php 
    session_start();

   require_once '../includes/bd.php';
   if($_SERVER["REQUEST_METHOD"] == "POST"){
        $comment=addslashes($_POST['comment']);
        $id=$_SESSION['id'];

        $id_e=$_POST['submit'];
       // $query="INSERT INTO commentaire_entreprise (message,date_ecrire,id_creche,id_entreprise) VALUES ()";
        $query="INSERT INTO `commentaire_entreprise`( `message`, `date_ecrire`, `id_creche`, `id_entreprise`) VALUES ('$comment',NOW(),'$id','$id_e')";
        $result=mysqli_query($con,$query);
        if($result){
            header("Location: getentrepage.php?id=".$_POST['submit']);
        }else{
            echo "errror";
        }
    }
?>