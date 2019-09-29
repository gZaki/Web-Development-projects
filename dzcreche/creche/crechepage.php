<?php 
    session_start();

require_once '../includes/bd.php';
include 'header.php';

    if(!isset($_SESSION)){
        header("Location: identificationPage.php");
    }
    $id=$_SESSION['id'];
?>

    <div class="contentn">
<div class="row">
        <div class="col-md-3 col-md-offset-4">
        <?php 
        $query="SELECT * FROM creche WHERE id='$id'";
           $result=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($result);
        ?>
        <div class="card">
                <h1><?php echo $row['nom'] ?></h1>
                <p><?php echo $row['adr']; ?></p>
                
        </div>
     </div>   

    </div>
        <div class="row">
            <h1><center>اراء الزبائن</center></h1>
            <?php 
                $query="SELECT * FROM commentaire_creche WHERE id_creche='$id'";
                $result=mysqli_query($con,$query);
                if (mysqli_num_rows($result) > 0) {
                    while($row=mysqli_fetch_assoc($result)):?>
                        <div class="offre">
                            <?php 
                               $query1="SELECT * FROM creche WHERE id='{$row['id_creche']}'";
                               $result1=mysqli_query($con,$query1);
                               $row1=mysqli_fetch_assoc($result1);

                             ?>
                             <a href="" title="commentaire">
                                <img src="images/user.png" alt="John" style="width:100px;margin:auto;">
                             </a>
                            <p> <?php echo $row['date_ecrire']; ?></p>
                            <p> <?php echo $row['message']; ?></p>
                        </div>   
            <?php
                    endwhile;
                }else{
                    echo " ليس هناك نتائج";
                }
                if($_SESSION['type']=="parent"){ 
            ?>
            <div class="offre">
                <a href="#">
                    <img src="images/user.png" alt="John" style="width:50px;hieght:50px">
                </a>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="form-group">
                    <textarea name="comment" class="form-control" placeholder="اكتب رئيك" ></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" />
                    
                </form>
            </div> 
            <?php } ?>
        </div>
    </div>

</div>
</div>
<?php 

include 'footer.php'; 
?>

<script type="text/javascript">
document.getElementById("uploadBtn").onchange = function () {
document.getElementById("uploadFile").value = this.value;
};
</script>