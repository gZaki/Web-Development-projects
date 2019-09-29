<?php 
    session_start();

require_once '../includes/bd.php';
include 'header.php';

if(isset($_GET['id'])){ 
    $id=$_GET['id'];
    if(!isset($_SESSION)){
        header("Location: gestionnaire.php");
    }
?>
    <div class="contentn">
<div class="row">
    <div class="col-md-9">
        <div class="row">
            <h1><center>خدماتي</center></h1>
            <?php 
            $query="SELECT * FROM service WHERE id_entreprise='$id'";
            $result=mysqli_query($con,$query);
            if (mysqli_num_rows($result) > 0) {
                while($row=mysqli_fetch_assoc($result)): 
                $id=$row['id_entreprise'];
                $query1="SELECT nom,service FROM entreprise WHERE id='$id'";
                $result1=mysqli_query($con,$query1);
                $row1=mysqli_fetch_assoc($result1); ?>
                <div class="offre">
                <p>الخدمة : <?php echo $row['titre']; ?></p>
                <p>وصف : <?php echo $row['description']; ?></p>
                <p>السعر: <strong><?php echo $row['prix']; ?>DZ</strong></p>
                </div>
            <?php endwhile; 
            }else{
                echo "<p>ليس هناك اي نتائج</p>";
            }
            ?>
        </div>
        <div class="row">
            <h1><center>صور</center></h1>
            <div>
                <?php 
                $query="SELECT * FROM image_entreprise WHERE id_entreprise='$id'";
                $result=mysqli_query($con,$query);
                if (mysqli_num_rows($result) > 0) {
                    while($row=mysqli_fetch_assoc($result)){?>
                       <div class="inline">
                            <a target="_blank" href="Upload/<?php echo $row['nom']; ?>">
                                <img src="Upload/<?php echo $row['nom']; ?>" />
                            </a>

                       </div>
                                            <?php
                    }
                }
                ?>
            </div>

        </div>
    </div>
    <div class="col-md-3">
        <?php 
           $query="SELECT * FROM entreprise WHERE id='$id'";
           $result=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($result);
        ?>
        <div class="card">
            <img src="../includes/getimage.php?id=<?php echo $id.'&type=entreprise'; ?>" alt="John" style="max-width:100px;margin:auto;">
            <div class="containe">
                <h1><?php echo $row['nom'] ?></h1>
                <p class="title"><?php echo $row['description']; ?></p>
                <p class="title"><?php echo $row['service']; ?></p>
                <p><?php echo $row['adr']; ?></p>
                <div style="margin: 24px 0;">
                <a href="<?php echo $row['google']; ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                <a href="<?php echo $row['facebook']; ?>"><i class="fa fa-facebook"></i></a>  
            </div>
            </div>
        </div>

    </div>

</div>
<?php

}elseif($_SESSION['type']=="entreprise"){
        $file_err="";
        $id=$_SESSION['id'];
        if(!empty($_POST)){
         if ($_POST["submit"]=="submit8"){
            $file=$_FILES['glogo']['tmp_name'];
            $Target="Upload/".time().basename($_FILES["glogo"]["name"]);
        if(!isset($file)){
            $file_err="يرجى ادخال صورة";
        }else{
            $query="SELECT COUNT(*) FROM image_entreprise WHERE id_entreprise='$id";
                $result=mysqli_query($con,$query);
                $row1=mysqli_fetch_array($result);
                $total=array_shift($row1);
                if($total>=5){
                    echo "<script>alert('5 photo is your limit');</script>";
                }else{
            $image_size=getimagesize($_FILES['glogo']['tmp_name']);
            if($image_size==FALSE){
                $file_err="هذه ليس صورة";
            }else{
                $image=time().$_FILES['glogo']['name'];
                $query="INSERT INTO `image_entreprise`(`nom`, `id_entreprise`) VALUES('{$image}','$id')";
                $Execute=mysqli_query($con,$query);
                move_uploaded_file($_FILES["glogo"]["tmp_name"],$Target);
            }
                }
        }
         }
         if($_POST["submit"]=="delete"){
             $query="DELETE FROM image_entreprise WHERE nom='{$_POST['delete']}'";
             $result=mysqli_query($con,$query);
         }
        }

?>

    <div class="contentn">
<div class="row">
        <div class="col-md-3">
        <?php 
        $query="SELECT * FROM entreprise WHERE id='$id'";
           $result=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($result);
        ?>
        <div class="card">
            <img src="../includes/getimage.php?id=<?php echo $id.'&type=entreprise';?>" alt="John" style="width:100%;margin:auto;">
            <div class="containe">
                <h1><?php echo $row['nom'] ?></h1>
                <p class="title"><?php echo $row['description']; ?></p>
                <p class="title"><?php echo $row['service']; ?></p>
                <p><?php echo $row['adr']; ?></p>
                <div style="margin: 24px 0;">
                <a href="<?php echo $row['google']; ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                <a href="<?php echo $row['facebook']; ?>"><i class="fa fa-facebook"></i></a> 
            </div>
            </div>
        </div>

    </div>
    <div class="col-md-9">
        <div class="row">
            <h1><center>خدماتي</center></h1>
            <?php 
                $query="SELECT * FROM service WHERE id_entreprise='$id'";
                $result=mysqli_query($con,$query);
                if (mysqli_num_rows($result) > 0) {
                    while($row=mysqli_fetch_assoc($result)): 
                    $id=$row['id_entreprise'];
                    $query1="SELECT nom,service FROM entreprise WHERE id='$id'";
                    $result1=mysqli_query($con,$query1);
                    $row1=mysqli_fetch_assoc($result1); ?>
                    <div class="offre">
                        <p>الخدمة : <?php echo $row['titre']; ?></p>
                        <p>وصف : <?php echo $row['description']; ?></p>
                        <p>السعر: <strong><?php echo $row['prix']; ?>DZ</strong></p>
                    </div>
                <?php endwhile; 
                }else{
                    echo "<p>ليس هناك اي نتائج</p>";
                }
            ?>
        </div>
        <div class="row">
            <h1><center>صور</center></h1>
            <div>
                <?php 
                $query="SELECT * FROM image_entreprise WHERE id_entreprise='$id'";
                $result=mysqli_query($con,$query);
                if (mysqli_num_rows($result) > 0) {
                    while($row=mysqli_fetch_assoc($result)){?>
                       <div class="inline">
                           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="hidden" name="delete" value="<?php echo $row['nom']; ?>" />
            <button type="submit" name="submit" value="delete" class="close pull-left">
              <span aria-hidden="true">&times;</span>
            </button>
        </form>
                            <a target="_blank" href="Upload/<?php echo $row['nom']; ?>">
                                <img src="Upload/<?php echo $row['nom']; ?>" />
                            </a>

                       </div>
                                            <?php
                    }
                }
                ?>
                <div class="inline">
                <form  class="form-horizontal open" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                            <div class="fileUpload">
                                <span class="custom-span">+</span>
                                <p class="custom-para">اضف صورة</p>
                                <input id="uploadBtn" type="file" name="glogo" class="upload" />
                            </div>
                            <input id="uploadFile" placeholder="0 files selected" disabled="disabled" />
                        </div>    
                        <div class="form-group center-block" style="margin:auto;">
                            <div class="col-sm-10">
                                <button type="submit" name="submit" value="submit8" class="btn btn-primary btn-sm">تاكيد</button>
                            </div>
                        </div>
            </form>
            </div>
            </div>

        </div>
        <div class="row">
            <h1><center>اراء الزبائن</center></h1>
            <?php 
                $query="SELECT * FROM commentaire_entreprise WHERE id_entreprise='$id'";
                $result=mysqli_query($con,$query);
                if (mysqli_num_rows($result) > 0) {
                    while($row=mysqli_fetch_assoc($result)):?>
                        <div class="offre">
                            <?php 
                               $query1="SELECT * FROM creche WHERE id='{$row['id_creche']}'";
                               $result1=mysqli_query($con,$query1);
                               $row1=mysqli_fetch_assoc($result1);

                             ?>
                             <a href="../creche/crechepage.php?id=<?php echo $row1['id']; ?>" title="<?php echo $row1['nom']; ?>">
                                <img src="../includes/getimage.php?id=<?php echo $row1['id'].'&type=creche';?>" alt="John" style="width:100px;margin:auto;">
                             </a>
                            <p> <?php echo $row['date_ecrire']; ?></p>
                            <p> <?php echo $row['message']; ?></p>
                        </div>   
            <?php
                    endwhile;
                }   
            ?> 
        </div>
    </div>


</div>
<?php 
}else{
    header("Location: gestionnaire.php");
}
include 'footer.php'; 
?>

<script type="text/javascript">
document.getElementById("uploadBtn").onchange = function () {
document.getElementById("uploadFile").value = this.value;
};
</script>