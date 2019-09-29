<?php include 'header.php'; ?>
<div>
<div class="contentn">
<div class="row">
    <img src="images/slide/timthumb (10).jpg" alt="" style="width:100%;" />
</div>

<?php 

require_once '../includes/bd.php';
?>
    <h1><center>ابحث عن روضة</center></h1>

<div class="container">

      <form action="" method="get">
                    <center>
                        <div class="col-lg-6 pull-right">
                            <div class="input-group">
                            <input type="text" class="form-control" name="q"  placeholder="البحث بالولاية اوالاسم">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" name="qButton" type="submit">بحث</button>
                            </span>
                            </div>
                        </div>
                
                    </center>
      </form>  

</div>
<div class="row" style="padding:20px 10px;">

<?php
    if(isset($_GET["page"])){
            $page=$_GET["page"];
            if($page==0 or $page<0){
                $page=1;
                $showcreche=0;
            }elseif($page>0){
                $showcreche=($page*15)-15;
            }
            $query="SELECT * FROM creche WHERE reday='1' ORDER BY id DESC LIMIT $showcreche,15";

  }elseif(isset($_GET["q"])){
    $q=$_GET["q"];
     $query="SELECT * FROM creche WHERE willaya LIKE '%$q%' or adr LIKE '%$q%' or nom LIKE '%$q%' ORDER BY id DESC";
  }else{
    $query="SELECT * FROM creche ORDER BY id DESC LIMIT 0,15";
  }
      $result=mysqli_query($con,$query);
     if(!$result){
       echo "ليس هناك نتائج";
     }
  if (mysqli_num_rows($result) > 0) {
   while($row=mysqli_fetch_assoc($result)){
       $id=$row['id'];
       $name=$row['nom'];
       $adr=$row['adr'];
       $type=$row['type'];
       $facebook=$row['facebook'];
       $google=$row['google'];
       ?>
<div class='card' style="display:inline-block;">
  <a href='crechepage2.php?id=<?php echo $id; ?>'>
     <img src='../includes/getimage.php?id=<?php echo $id; ?>&type=creche' alt='<?php echo htmlspecialchars($name); ?>' style='width:100%;height:100%;'>
  </a>
  <div class='containe'>
    <a href='crechepage2.php?id=<?php echo $id; ?>'><h1><?php echo htmlspecialchars($name); ?></h1></a>
    <a href="../creche/store/index.php?id=<?php echo $row['store_id']; ?>">اذهب الى المتجر</a>
    <p class='title'><?php echo htmlspecialchars($row['tel']); ?></p>
    <p><?php echo htmlspecialchars($adr); ?></p>
    <div style='margin: 24px 0;'>
      <a href='<?php echo htmlspecialchars($facebook); ?>'><i class='fa fa-facebook'></i></a> 
      <a href="<?php echo htmlspecialchars($google); ?>"><i class="fa fa-google-plus"></i></a>
   </div>
  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $id; ?>">اتصال</button>
  </div>
</div>

<?php
   }
  }



?>

</div>
<?php 
      $query="SELECT COUNT(*) FROM creche WHERE reday='1'";
      $result=mysqli_query($con,$query);
      $row=mysqli_fetch_array($result);
      $total=array_shift($row);
      $tpage=$total/14;
      $tpage=ceil($tpage);

?>
      <nav aria-label="Page navigation example" style="text-align:center">
        <ul class="pagination justify-content-center">
          <li class="page-item <?php if($page==0 or $page==1) echo 'hidden'; ?>">
            <a class="page-link" href="rechechercreche.php?page=<?php $previous=$page-1;echo $previous; ?>" tabindex="-1">Previous</a>
          </li>
      <?php 
      for($i=1;$i<=$tpage;$i++){?>
          <li class="page-item <?php if($i==$page) echo 'active'; ?>"><a class="page-link" href="rechechercreche.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php
      }?>
          <li class="page-item <?php if($page==$tpage) echo 'hidden'; ?>">
      <a class="page-link" href="rechechercreche.php?page=<?php $next=$page+1;echo $next; ?>">Next</a>
    </li>
  </ul>
</nav>

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
                <input type="hidden" name="creche" id="id_c" />
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
  modal.find('.modal-body #id_c').val(recipient)
})
</script>