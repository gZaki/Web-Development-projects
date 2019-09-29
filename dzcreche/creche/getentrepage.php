<?php 
    session_start();

require_once '../includes/bd.php';
include 'header.php';

if(isset($_GET['id'])){ 
    $id=$_GET['id'];
    if(!isset($_SESSION)){
        header("Location: identificationPage.php");
    }
}else{
    
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
                <p>الخدمة : <?php echo htmlspecialchars(stripslashes($row['titre'])); ?></p>
                <p>وصف : <?php echo htmlspecialchars(stripslashes($row['description'])); ?></p>
                <p>السعر: <strong><?php echo htmlspecialchars(stripslashes($row['prix'])); ?>DZ</strong></p>
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
                            <a target="_blank" href="../gestionnaire/Upload/<?php echo $row['nom']; ?>">
                                <img src="../gestionnaire/Upload/<?php echo $row['nom']; ?>" />
                            </a>

                       </div>
                                            <?php
                    }
                }
                ?>
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
                             <a href="../creche/crechepage.php?id=<?php echo $row1['id']; ?>" title="<?php echo htmlspecialchars(stripslashes($row1['nom'])); ?>">
                                <img src="../includes/getimage.php?id=<?php echo $row1['id'].'&type=creche';?>" alt="<?php echo $row1['nom']; ?>" style="width:100px;margin:auto;">
                             </a>
                            <p> <?php echo htmlspecialchars(stripslashes($row['date_ecrire'])); ?></p>
                            <p> <?php echo htmlspecialchars(stripslashes($row['message'])); ?></p>
                            <p> من طرف <?php echo htmlspecialchars(stripslashes($row1['nom'])); ?></p>
                        </div>   
            <?php
                    endwhile;
                }else{
                    echo "ليس هناك نتائج";
                } 
            ?>
            <div class="offre">
                <a href="../creche/crechepage.php?id=<?php echo $row1['id']; ?>">
                    <img src="../includes/getimage.php?id=<?php echo $row1['id'].'&type=creche';?>" alt="<?php echo htmlspecialchars(stripslashes($row1['nom'])); ?>" style="width:50px;hieght:50px">
                </a>
                <form action="in.php" method="post">
                 
                    <div class="form-group">
                    <textarea name="comment" class="form-control" placeholder="اكتب رئيك" ></textarea>
                    </div>
                    <button type="submit" name="submit" value="<?php echo $_GET['id']; ?>" class="btn btn-primary">
                         ارسل
                    </button>
                    
                </form>
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
                <h1><?php echo htmlspecialchars(stripslashes($row['nom'])); ?></h1>
                <p class="title"><?php echo htmlspecialchars(stripslashes($row['description'])); ?></p>
                <p class="title"><?php echo htmlspecialchars(stripslashes($row['service'])); ?></p>
                <p><?php echo htmlspecialchars(stripslashes($row['adr'])); ?></p>
                <div style="margin: 24px 0;">
                <a href="<?php echo htmlspecialchars(stripslashes($row['google'])); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                <a href="<?php echo htmlspecialchars(stripslashes($row['facebook'])); ?>"><i class="fa fa-facebook"></i></a>  
            </div>
            </div>
        </div>

    </div>

</div>
<?php

?>

<script type="text/javascript">
document.getElementById("uploadBtn").onchange = function () {
document.getElementById("uploadFile").value = this.value;
};
</script>
<?php include 'footer.php'; 
?>