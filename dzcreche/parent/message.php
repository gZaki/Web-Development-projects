<?php 
    session_start();

require_once '../includes/bd.php';
include 'header.php';
?>
<div class="container" style="padding-top:60px;">
<div class="col-sm-10">
<?php
if(isset($_SESSION)){
  if(isset($_GET["page"])){
            $page=$_GET["page"];
            if($page==0 or $page<0){
                $page=1;
                $showcreche=0;
            }elseif($page>0){
                $showcreche=($page*6)-6;
            }
            $query="SELECT * FROM contact WHERE id='{$_SESSION['id']}'  LIMIT $showcreche,6";
  }else{
    $query="SELECT * FROM contact WHERE id='{$_SESSION['id']}' LIMIT 0,6";
  }
    $result=mysqli_query($con,$query);
    while($row=mysqli_fetch_assoc($result)):?>
       <div class="message">
           <div class="row">
                <div class="col-md-3" style="text-align: end;"><?php echo $row['suject'];?> : الموضوع</div>
                <div class="col-md-3 pull-left">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $row["date_insc"]; ?>
                </div>
           </div>
           <?php 
            $query1="SELECT * FROM creche WHERE id='{$row['id_creche']}'";
            $result1=mysqli_query($con,$query1);
            $row1=mysqli_fetch_assoc($result1);
           
           ?>
           <div class="row pull-right">
                <div class="col-md-12">
                    <?php if($row['destinataire']=="creche")  echo $row1['nom'].' : رسالتي الى'; else echo $row1['nom'].': من';  ?> 
                </div>               
           </div>
           <div class="row">
              <div class="col-md-12">
                <?php echo $row['message']; ?>
              </div>
           </div>
       </div>
       
<?php

    endwhile;
} 
      $query="SELECT COUNT(*) FROM contact";
      $result=mysqli_query($con,$query);
      $row=mysqli_fetch_array($result);
      $total=array_shift($row);
      $tpage=$total/4;
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
</div>

<div class="col-sm-2" style="padding-top:10px;">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="">ارسل رسالة</button>
</div>

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
                <label for="sel1" class="form-control-label"> : الى</label>
                <select class="form-control" id="sel1" name="creche" required>
                    <?php  
                        $query="SELECT DISTINCT id_creche FROM `contact` WHERE id='{$_SESSION['id']}'";
                        $result=mysqli_query($con,$query);
                        while($row=mysqli_fetch_assoc($result)):
                             $query1="SELECT * FROM creche WHERE id='{$row['id_creche']}'";
                             $result1=mysqli_query($con,$query1);
                             $row1=mysqli_fetch_assoc($result1);
                            
                    ?>
                        <option value="<?php echo $row1['id']; ?>"><?php echo $row1['nom']; ?></option>
                    <?php endwhile; ?>
             </select>
             </div>
              <div class="form-group" style="text-align:right">
                <label for="suject" class="form-control-label"> : الموضوع</label>
                <input type="text" class="form-control" name="suject" id="suject">
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