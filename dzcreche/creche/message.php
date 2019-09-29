<?php 
    session_start();
    if(!isset($_SESSION) or $_SESSION['type']!="creche"){
        header("Location: identificationPage.php");
    }
include 'header.php';
require_once '../includes/bd.php'; 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      if($_POST["submit"]){
        $ar=explode(' ',$_POST["submit"],2);
        $query1="DELETE FROM `contact` WHERE id='{$ar[0]}' and id_creche='{$_SESSION['id']}' and date_insc='{$ar[1]}'";
        $result1=mysqli_query($con,$query1);
        if(!$result1)
          echo "<script>alert('هناك خطاء لم يتم الحذف');</script>";
      }

    }
?>
<div class="container" style="padding-top:60px;">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="text-align:right">رسالة</h5>
            <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="envoyer.php" method="post">
              <div class="form-group" style="text-align:right">
                <label for="suject" class="form-control-label"> : الموضوع</label>
                <input type="text" class="form-control" name="suject" id="suject">
                <input type="hidden" name="id" id="id_p" />
              </div>
              <div class="form-group" style="text-align:right">
                <label for="message" class="form-control-label"> : الرسالة</label>
                <textarea class="form-control" name="message" id="message"></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق النافذة</button>
            <button type="submit" class="btn btn-primary">ارسال</button>
          </div>
        </form>

        </div>
      </div>
    </div>
    <?php 
      if(isset($_GET["page"])){
            $page=$_GET["page"];
            if($page==0 or $page<0){
                $page=1;
                $showcreche=0;
            }elseif($page>0){
                $showcreche=($page*6)-6;
            }
            $query="SELECT * FROM contact WHERE id_creche='{$_SESSION['id']}'  LIMIT $showcreche,6";
  }else{
    $query="SELECT * FROM contact WHERE id_creche='{$_SESSION['id']}' LIMIT 0,6";
  }
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0){
    while($row=mysqli_fetch_assoc($result)):?>
       <div class="message">
         
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="row" method="post" style="margin:0;">
            <button type="submit" name="submit" value="<?php echo $row['id'].' '.$row['date_insc']; ?>" class="close pull-right" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;حذف</span>
            </button>
         </form>
          <div class="row">
                <div class="col-md-3" style="text-align: end;"><?php echo htmlspecialchars(stripslashes($row['suject']));?> : الموضوع</div>
                <div class="col-md-3 pull-left">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo htmlspecialchars(stripslashes($row["date_insc"])); ?>
                </div>
           </div>
           <?php 
            $query1="SELECT * FROM parent WHERE id='{$row['id']}'";
            $result1=mysqli_query($con,$query1);
            $row1=mysqli_fetch_assoc($result1);
           
           ?>
           <div class="row pull-right">
                <div class="col-md-12">
                    <?php if($row['destinataire']=="parent")  echo htmlspecialchars(stripslashes($row1['nom'])).' : رسالتي الى'; else echo htmlspecialchars(stripslashes($row1['nom'])).': من';  ?> 
                </div>
               
           </div>
           <div class="row">
              <div class="col-md-12">
                <?php echo htmlspecialchars(stripslashes($row['message'])); ?>
              </div>
           </div>
           <?php if($row['destinataire']=="creche"){?>
                <div class="row" style="margin:0;">
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $row1['id']; ?>">اجب</button>
                </div>
            <?php }
           ?>
       </div>
       
<?php

    endwhile;
    
      $query="SELECT COUNT(*) FROM contact WHERE id_creche='{$_SESSION['id']}'";
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
<script>

    $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-body #id_p').val(recipient)
})
</script>