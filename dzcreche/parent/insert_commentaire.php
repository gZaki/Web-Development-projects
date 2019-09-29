<?php 
    session_start();

   require_once '../includes/bd.php';
   if($_SERVER["REQUEST_METHOD"] == "POST"){
        $comment=$_POST['comment'];
        $id=$_SESSION['id'];

        $id_e=$_POST['submit'];
       // $query="INSERT INTO commentaire_creche (message,date_ecrire,id_creche,id_creche) VALUES ()";
        $query="INSERT INTO `commentaire_creche`( `message`, `date_ecrire`, `id_parent`, `id_creche`) VALUES ('$comment',NOW(),'$id','$id_e')";
        $result=mysqli_query($con,$query);
        if($result){
            header("Location: crechepage.php?id=".$_POST['submit']);
        }else{
            echo "errror";
        }
    }
?>