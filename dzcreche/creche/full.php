<?php 
    session_start();
    if(!isset($_SESSION) or $_SESSION['type']!="creche"){
        header("Location: identificationPage.php");
    }
    $title="demande d'inscription  a la creche ";
include 'header.php';
require_once '../includes/bd.php'; 
?>
<div class="container" style="padding-top:60px;">
<?php
      if(isset($_GET["id"])){
            $id=$_GET["id"];
            $query="SELECT * FROM inscription WHERE id='$id'";
  
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0){
    $row=mysqli_fetch_assoc($result)?>
       <div class="message">
         
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="row" style="margin:0;">
            <button type="submit" name="submit" value="<?php echo $row['id'].' '.$row['date_insc']; ?>" class="close pull-right" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;حذف</span>
            </button>
         </form>
         <div style="direction:rtl;">
             <p><strong>نوع : </strong><?php echo htmlspecialchars(stripslashes($row['type'])); ?></p>
             <p><strong>اسم الطفل : </strong><?php echo htmlspecialchars(stripslashes($row['nom_enfant'])); ?></p>
             <p><strong>لقب الطفل : </strong><?php echo htmlspecialchars(stripslashes($row['prenom_enfant'])); ?></p>
             <p><strong>تاريخ الميلاد : </strong><?php echo htmlspecialchars(stripslashes($row['date_naiss'])); ?></p>
             <p><strong>العنوان : </strong><?php echo htmlspecialchars(stripslashes($row['adr'])); ?></p>
             <p><strong>رقم الهاتف : </strong><?php echo htmlspecialchars(stripslashes($row['tel'])); ?></p>      
             <p><strong>تاريخ الدخول : </strong><?php echo htmlspecialchars(stripslashes($row['date_entre'])); ?></p>
             <p><strong>ايام الحضور : </strong><?php echo htmlspecialchars(stripslashes($row['joure'])); ?></p>
             <p><strong>البريد الالكتروني : </strong><?php echo htmlspecialchars(stripslashes($row['email'])); ?></p>
             <p><strong>الجنسية : </strong><?php echo htmlspecialchars(stripslashes($row['nationalite'])); ?></p>
             <p><strong>اسم الام : </strong><?php echo htmlspecialchars(stripslashes($row['nom_mere'])); ?></p>
             <p><strong>عمل الام : </strong><?php echo htmlspecialchars(stripslashes($row['prof_mere'])); ?></p>
             <p><strong>البريد الالكتروني للام : </strong><?php echo htmlspecialchars(stripslashes($row['email_mere'])); ?></p>
             <p><strong>رقم الهاتف الام : </strong><?php echo htmlspecialchars(stripslashes($row['tel_mere'])); ?></p>
             <p><strong>اسم الاب : </strong><?php echo htmlspecialchars(stripslashes($row['nom_pere'])); ?></p>
             <p><strong>عمل الاب : </strong><?php echo htmlspecialchars(stripslashes($row['prof_pere'])); ?></p>
             <p><strong>البريد الالكتروني للاب : </strong><?php echo htmlspecialchars(stripslashes($row['email_pere'])); ?></p>
             <p><strong>رقم الهاتف الاب : </strong><?php echo htmlspecialchars(stripslashes($row['tel_pere'])); ?></p>

         </div>
       </div>
</div>
</div>

</div>

<?php
    }}else{
        header("demade.php");
    } 
mysqli_close($con);
include 'footer.php';
?>