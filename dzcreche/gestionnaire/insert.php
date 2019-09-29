    <?php 
        session_start();

require_once '../includes/bd.php';
        //ll'insertion des demande de srvice 
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $query="INSERT INTO `date`(`date_insc`) VALUES (NOW())";
            $result=mysqli_query($con,$query);
                $id=$_SESSION['id'];
                $id_service=$_POST['submit'];
                $content=date("Y-m-d",strtotime($_POST['content']));
            $query="INSERT INTO `demander1`(`id`, `id_service`, `date_insc`, `status`, `content`) VALUES ('$id','$id_service',NOW(),'en attent de reponse','$content')";
            $result=mysqli_query($con,$query);
            if($result){
                header("Location: recurtement.php");
            }else{
                header("Location: recurtement.php?ero=ero");
            }
        }

        ?>