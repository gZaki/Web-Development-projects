<?php 
    session_start();
        if(!isset($_SESSION) or $_SESSION['type']!="creche"){
        header("Location: gestionnaire.php");
    }
require_once '../includes/bd.php';


        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $query="INSERT INTO `date`(`date_insc`) VALUES (NOW())";
            $result=mysqli_query($con,$query);
                $id=$_SESSION['id'];
                $id_service=$_POST['submit'];
                $content=date("Y-m-d",strtotime($_POST['content']));
            $query="INSERT INTO `demander`(`id`, `id_service`, `date_insc`, `status`, `content`) VALUES ('$id','$id_service',NOW(),'en attent de reponse','$content')";
            $result=mysqli_query($con,$query);
            if($result){
                header("Location: recurtement.php");
            }else{
                header("Location: recurtement.php?ero=ero");
            }
        }


?>
<?php include 'header.php'; ?>
<div class="contentn">
<div class="container">
<h1><center>الخدمات</center></h1>
<div id="container-2">
<?php
    if(isset($_GET["page"])){
            $page=$_GET["page"];
            if($page==0 or $page<0){
                $page=1;
                $showservice=0;
            }elseif($page>0){
                $showservice=($page*5)-5;
            }
            $query="SELECT * FROM service ORDER BY id DESC LIMIT $showservice,5";

  }else{
            $query="SELECT * FROM service ORDER BY id DESC LIMIT 0,5";
  }

        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result) > 0) {
            while($row=mysqli_fetch_assoc($result)): 
             $id=$row['id_entreprise'];
             $query1="SELECT nom,service FROM entreprise WHERE id='$id'";
             $result1=mysqli_query($con,$query1);
             $row1=mysqli_fetch_assoc($result1); ?>
            <div class="offre">
                <a href="getentrepage.php?id=<?php echo $id; ?>"><img src="../includes/getimage.php?id=<?php echo $id; ?>&type=<?php echo 'entreprise'; ?>" alt="Avatar" style="width:100px"></a>
                <p><span><a href="getentrepage.php?id=<?php echo $id; ?>"><?php echo htmlspecialchars(stripslashes($row1['nom'])); ?></a></span></p>
                <p>الوظيفة : <?php echo htmlspecialchars(stripslashes($row1['service'])); ?></p>
                <p>الخدمة : <?php echo htmlspecialchars(stripslashes($row['titre'])); ?></p>
                <p>وصف : <?php echo htmlspecialchars(stripslashes($row['description'])); ?></p>
                <p>السعر: <strong><?php echo htmlspecialchars(stripslashes($row['prix'])); ?>DZ</strong></p>
                
                <form action="insert.php" method="post">
                    <?php 
                        $ide=$_SESSION['id'];
                        
                        $ids=$row['id'];
                        $query1="SELECT * FROM demander WHERE id='$ide' and id_service='$ids' ORDER BY date_insc DESC";
                        $result1=mysqli_query($con,$query1);
                    ?>
                    <div class="form-group">
                        <?php if(!$row1=mysqli_fetch_assoc($result1)){ 
                            $mes= "طلب الخدمة";
                              $des="";
                        }else{
                               if(strtotime(date("Y-m-d"))>=strtotime($row1['content'])){                   
                                $mes= "طلب الخدمة";
                                $des="";              

                               }else{
                                    $mes= $row1['status'];
                                    $des="disabled";
                               }
                            
                        } ?>
                        <div class="col-md-3 pull-right">
                             <input type="text" name="content" class="form-control col-md-3" <?php if(!empty($des)) echo 'style="display:none;"'; ?> />
                        </div>
                        <button type="submit"  name="submit" value="<?php echo $row['id']; ?>" class="btn btn-primary btn-sm <?php echo $des; ?>">
                        <?php echo $mes; ?>
                        </button>
                    </div>
                </form>
            </div>
 <?php endwhile; 
        }else{
            echo "<p>ليس هناك اي نتائج</p>";
        }
     ?>

</div>
<?php 
      $query="SELECT COUNT(*) FROM service";
      $result=mysqli_query($con,$query);
      $row=mysqli_fetch_array($result);
      $total=array_shift($row);
      $tpage=$total/4;
      $tpage=ceil($tpage);

?>
      <nav aria-label="Page navigation example" style="text-align:center">
        <ul class="pagination justify-content-center">
          <li class="page-item <?php if($page==0 or $page==1) echo 'hidden'; ?>">
            <a class="page-link" href="recurtement.php?page=<?php $previous=$page-1;echo $previous; ?>" tabindex="-1">Previous</a>
          </li>
      <?php 
      for($i=1;$i<=$tpage;$i++){?>
          <li class="page-item <?php if($i==$page) echo 'active'; ?>"><a class="page-link" href="recurtement.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php
      }?>
          <li class="page-item <?php if($page==$tpage) echo 'hidden'; ?>">
      <a class="page-link" href="recurtement.php?page=<?php $next=$page+1;echo $next; ?>">Next</a>
    </li>
  </ul>
</nav>
<?php


?>

</div>

<?php include 'footer.php'; ?>
