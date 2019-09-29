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
<?php $page;
      if(isset($_GET["page"])){
            $page=$_GET["page"];
            if($page==0 or $page<0){
                $page=1;
                $showcreche=0;
            }elseif($page>0){
                $showcreche=($page*6)-6;
            }
            $query="SELECT * FROM inscription WHERE id_creche='{$_SESSION['id']}'  LIMIT $showcreche,6";
  }else{
    $query="SELECT * FROM inscription WHERE id_creche='{$_SESSION['id']}' LIMIT 0,6";
  }
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0){
    while($row=mysqli_fetch_assoc($result)):?>
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
             <p><strong>رقم الهاتف : </strong><?php echo htmlspecialchars(stripslashes($row['tel'])); ?></p>      
             <p><strong>تاريخ الدخول : </strong><?php echo htmlspecialchars(stripslashes($row['date_entre'])); ?></p>
             <p><strong>ايام الحضور : </strong><?php echo htmlspecialchars(stripslashes($row['joure'])); ?></p>
             <a href="full.php?id=<?php echo $row['id']; ?>">بقي العلومات</a>

         </div>
       </div>
       
<?php

    endwhile;
    
      $query="SELECT COUNT(*) FROM inscription WHERE id_creche='{$_SESSION['id']}'";
      $result=mysqli_query($con,$query);
      $row=mysqli_fetch_array($result);
      $total=array_shift($row);
      $tpage=$total/5;
      $tpage=ceil($tpage);

?>
      <nav aria-label="Page navigation example" style="text-align:center">
        <ul class="pagination justify-content-center">
          <li class="page-item <?php if($page==0 or $page==1) echo 'hidden'; ?>">
            <a class="page-link" href="message.php?page=<?php $previous=$page-1;echo $previous; ?>" tabindex="-1">Previous</a>
          </li>
      <?php 
      for($i=1;$i<=$tpage;$i++){?>
          <li class="page-item <?php if($i==$page) echo 'active'; ?>"><a class="page-link" href="message.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php
      }?>
          <li class="page-item <?php if($page==$tpage) echo 'hidden'; ?>">
      <a class="page-link" href="message.php?page=<?php $next=$page+1;echo $next; ?>">Next</a>
    </li>
  </ul>
</nav>
<?php }else{
  echo "<p> ليس هناك اي رسائل</p>";
} ?>
</div>
</div>

</div>

<?php 
mysqli_close($con);
include 'footer.php';
?>