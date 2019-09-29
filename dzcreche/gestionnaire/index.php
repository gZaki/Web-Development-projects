<?php 
    session_start();
    if(!isset($_SESSION) or $_SESSION['type']!="entreprise"){
        header("Location: gestionnaire.php");
    }
?>
<?php include 'header.php';
require_once '../includes/bd.php';
 ?>
<div>
<div class="contentn">
<div class="row">
    <div class="col-md-9">
<h1><center>الخدمات المطلوبة</center></h1>

<?php 
$query="SELECT * FROM demander1 WHERE id='{$_SESSION['id']}' and content>=NOW()";
$result=mysqli_query($con,$query);
if (mysqli_num_rows($result) > 0) {
    while($row=mysqli_fetch_assoc($result)){
        $query="SELECT * FROM service WHERE id='{$row['id_service']}'";
        $result1=mysqli_query($con,$query);
        while($row1=mysqli_fetch_assoc($result1)):
             $query1="SELECT id,nom,service FROM entreprise WHERE id='{$row1['id_entreprise']}'";
             $result2=mysqli_query($con,$query1);
             $row2=mysqli_fetch_assoc($result2);
        ?>
            <div class="offre">
                <img src="../includes/getimage.php?id=<?php echo $row2['id'].'&type=entreprise'; ?>" alt="Avatar" style="width:100px">
                <p><span><a href="#"><?php echo htmlspecialchars($row2['nom']); ?></a></span></p>
                <p>الوظيفة : <?php echo htmlspecialchars($row2['service']); ?></p>
                <p>الخدمة : <?php echo htmlspecialchars($row1['titre']); ?></p>
                <p>وصف : <?php echo htmlspecialchars($row1['description']); ?></p>
                <p>السعر: <strong><?php echo htmlspecialchars($row1['prix']); ?>DZ</strong></p>
            <p><strong><?php echo htmlspecialchars($row['status']); ?></strong></p>
                <p><?php echo htmlspecialchars($row['content']); ?></p>
            </div>
        <?php endwhile;

    } 
}else{

    echo "<p>ليس هناك اي خدمات</p>";
}
?>
    </div>
    <?php
        $query="SELECT * FROM entreprise WHERE id='{$_SESSION['id']}'";
        $result=mysqli_query($con,$query);
        $row=mysqli_fetch_assoc($result);
    ?>
    <div class="col-md-3">
        <div class="card">
            <img src="../includes/getimage.php?id=<?php echo $_SESSION['id'].'&type=entreprise'; ?>" alt="John" style="width:100%;margin:auto;">
            <div class="containe">
                <h1><?php echo $_SESSION['nom'] ?></h1>
                <p class="title"><?php echo htmlspecialchars($row['description']); ?> <a href="setting.php">تغير</a> </p>
                <p><?php echo $row['adr']; ?></p>
                <div style="margin: 24px 0;">
                <a href="<?php echo htmlspecialchars($row['google']); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                <a href="<?php echo htmlspecialchars($row['facebook']); ?>"><i class="fa fa-facebook"></i></a> 
            </div>
            </div>
        </div>

    </div>

</div>
<?php include 'footer.php'; ?>
