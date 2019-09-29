<?php session_start();
require_once "../includes/bd.php";
if(!isset($_SESSION) and $_SESSION['type']!="creche"){
     header("Location: identificationPage.php");
}
    $query="SELECT * FROM creche WHERE id='{$_SESSION['id']}'";
    $query_run=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($query_run);
    $id=$row['id_store'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if($_POST['submit']=="submit8"){
    if(!empty($_POST['equipe'])){
      $equipe=addslashes($_POST['equipe']);
      $query="UPDATE store SET equipe='$equipe' WHERE id='$id'";
      $resulat=mysqli_query($con,$query);
    }
    if(!empty($_POST['video'])){
      if(preg_match('#^(<iframe width="350" height="197" src="https:\/\/www.youtube.com\/embed\/)([a-zA-Z0-9&?;=]*") (frameborder="0" allowfullscreen><\/iframe>)$#',$_POST['video'])){
        $video=$_POST['video'];
        $query="UPDATE store SET video='$video' WHERE id='$id'";
        $resulat=mysqli_query($con,$query);  
      }
      
    }
    if(!empty($_POST['intro'])){
      $intro=addslashes($_POST['intro']);
      $query="UPDATE store SET intro='$intro' WHERE id='$id'";
      $resulat=mysqli_query($con,$query);
    }
    if(!empty($_POST['description'])){
      $description=addslashes($_POST['description']);
      $query="UPDATE store SET description='$description' WHERE id='$id'";
      $resulat=mysqli_query($con,$query);
    }
    if(!empty($_POST['payment'])){
      $payment=addslashes($_POST['payment']);
      $query="UPDATE store SET payment='$payment' WHERE id='$id'";
      $resulat=mysqli_query($con,$query);
    }
    if(!empty($_POST['presentation'])){
      $presentation=addslashes($_POST['presentation']);
      $query="UPDATE store SET presentation='$presentation' WHERE id='$id'";
      $resulat=mysqli_query($con,$query);
    }
  }
  if($_POST['submit']=="submit9"){
    if(!empty($_POST['enseigner1'])){
      $enseigner1=addslashes($_POST['enseigner1']);
      $query="UPDATE store SET enseigner1='$enseigner1' WHERE id='$id'";
      $resulat=mysqli_query($con,$query);
    }
    if(!empty($_POST['enseigner2'])){
      $enseigner2=addslashes($_POST['enseigner2']);
      $query="UPDATE store SET enseigner2='$enseigner2' WHERE id='$id'";
      $resulat=mysqli_query($con,$query);
    }
  }
  if($_POST['submit']=="submit7"){
    if(!empty($_POST['sortie'])){
      $sortie=addslashes($_POST['sortie']);
      $query="UPDATE store SET sortie='$sortie' WHERE id='$id'";
      $resulat=mysqli_query($con,$query);
    }   
    if(!empty($_POST['sortie2'])){
      $esortie2=addslashes($_POST['sortie2']);
      $query="UPDATE store SET sortie2='$sortie2' WHERE id='$id'";
      $resulat=mysqli_query($con,$query);
    }
  }
  if($_POST['submit']=="submit6"){
    if(!empty($_POST['feteinterne'])){
      $feteinterne=addslashes($_POST['feteinterne']);
      $query="UPDATE store SET feteinterne='$feteinterne' WHERE id='$id'";
      $resulat=mysqli_query($con,$query);
    }
    if(!empty($_POST['feteinvert'])){
      $feteinvert=addslashes($_POST['feteinvert']);
      $query="UPDATE store SET feteinvert='$feteinvert' WHERE id='$id'";
      $resulat=mysqli_query($con,$query);
    }   
  }
  if($_POST['submit']=="submit10"){
    if(!empty($_POST['map'])){
      if(preg_match("#^(https:\/\/(www.)?goo)([a-zA-Z0-9=!+\.,@:%-\/]*)$#",$_POST['map'])){
       $map=addslashes($_POST['map']);
      $query="UPDATE store SET map='$map' WHERE id='$id'";
      $resulat=mysqli_query($con,$query);
      }
      
    }    
  }
  if ($_POST["submit"]=="submit11"){
            $file=$_FILES['glogo']['tmp_name'];
            $Target="store/img/enseignement/".time().basename($_FILES["glogo"]["name"]);
        if(!isset($file)){
            $file_err="يرجى ادخال صورة";
        }else{
            $query="SELECT COUNT(*) FROM store_enseigner WHERE id_store='$id'";
                $result=mysqli_query($con,$query);
                $row1=mysqli_fetch_assoc($result);
                $total=array_shift($row1);
                if($total>=10){
                    echo "<script>alert('10 photo is your limit');</script>";
                }else{
            $image_size=getimagesize($_FILES['glogo']['tmp_name']);
            if($image_size==FALSE){
                $file_err="هذه ليس صورة";
            }else{
                $image=time().$_FILES['glogo']['name'];
                $query="INSERT INTO `store_enseigner`(`nom`, `id_store`) VALUES('{$image}','$id')";
                $Execute=mysqli_query($con,$query);
                move_uploaded_file($_FILES["glogo"]["tmp_name"],$Target);
            }
                }
        }
         }
         if($_POST["submit"]=="delete1"){
             $query="DELETE FROM store_enseigner WHERE nom='{$_POST['delete']}'";
             $result=mysqli_query($con,$query);
         }
if ($_POST["submit"]=="submit12"){
            $file=$_FILES['glogo']['tmp_name'];
            $Target="store/img/sorties/".time().basename($_FILES["glogo"]["name"]);
        if(!isset($file)){
            $file_err="يرجى ادخال صورة";
        }else{
            $query="SELECT COUNT(*) FROM store_sorties WHERE id_store='$id'";
                $result=mysqli_query($con,$query);
                $row1=mysqli_fetch_assoc($result);
                $total=array_shift($row1);
                if($total>=10){
                    echo "<script>alert('10 photo is your limit');</script>";
                }else{
            $image_size=getimagesize($_FILES['glogo']['tmp_name']);
            if($image_size==FALSE){
                $file_err="هذه ليس صورة";
            }else{
                $image=time().$_FILES['glogo']['name'];
                $query="INSERT INTO `store_sorties`(`nom`, `id_store`) VALUES('{$image}','$id')";
                $Execute=mysqli_query($con,$query);
                move_uploaded_file($_FILES["glogo"]["tmp_name"],$Target);
            }
                }
        }
         }
         if($_POST["submit"]=="delete2"){
             $query="DELETE FROM store_sorties WHERE nom='{$_POST['delete']}'";
             $result=mysqli_query($con,$query);
         }
if ($_POST["submit"]=="submit13"){
            $file=$_FILES['glogo']['tmp_name'];
            $Target="store/img/animations/".time().basename($_FILES["glogo"]["name"]);
        if(!isset($file)){
            $file_err="يرجى ادخال صورة";
        }else{
            $query="SELECT COUNT(*) FROM store_animation WHERE id_store='$id'";
                $result=mysqli_query($con,$query);
                $row1=mysqli_fetch_assoc($result);
                $total=array_shift($row1);
                if($total>=10){
                    echo "<script>alert('10 photo is your limit');</script>";
                }else{
            $image_size=getimagesize($_FILES['glogo']['tmp_name']);
            if($image_size==FALSE){
                $file_err="هذه ليس صورة";
            }else{
                $image=time().$_FILES['glogo']['name'];
                $query="INSERT INTO `store_animation`(`nom`, `id_store`) VALUES('{$image}','$id')";
                $Execute=mysqli_query($con,$query);
                move_uploaded_file($_FILES["glogo"]["tmp_name"],$Target);
            }
                }
        }
         }
         if($_POST["submit"]=="delete3"){
             $query="DELETE FROM store_animation WHERE nom='{$_POST['delete']}'";
             $result=mysqli_query($con,$query);
         }
  

}
include("header.php");
 ?>
<div class="container-fluid" style="padding-top:60px;">
  <div class="row">
    <center><p>  هذه الصفحة تعنى بتغير محتوى المتجر اذا اردت المزيد حول كيفية تغير المتجر <a href="#">اضغط هنا</a></center>
</p>

</div>
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'presentation')" id="defaultOpen">عرض</button>
  <button class="tablinks" onclick="openCity(event, 'contact')">الاتصال بالمدرسة</button>
  <button class="tablinks" onclick="openCity(event, 'enseigner')">التدريس</button>
  <button class="tablinks" onclick="openCity(event, 'sortie')">خرجات</button>
  <button class="tablinks" onclick="openCity(event, 'animation')">تنشيط</button>
  <a href="store/index.php?id=<?php echo $row['id_store']; ?>" class="btn btn-primary btn-lg tablinks" >رؤية النتيجة</a>


</div>


<div id="presentation" class="tabcontent">
  <h3>عرض</h3>
  <form  class="form-horizontal" role="form" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="equipe">فريقنا</label>
      <div class="col-sm-6 pull-right">
        <input type="text" class="form-control" name="equipe" id="equipe" placeholder="فريقنا"/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="video">فديو تعريفي</label>
      <div class="col-sm-6 pull-right">
        <input type="text" class="form-control" name="video" id="video" placeholder="عنوان الفديو من يتوب مع الطول 197 والعرض 350"/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="description">وصف الفديو</label>
      <div class="col-sm-6 pull-right">
        <textarea class="form-control" name="description" id="description" placeholder="وصف الفديو"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="intro">مقدمة عن الروضة</label>
      <div class="col-sm-6 pull-right">
        <textarea class="form-control" name="intro" id="intro" placeholder="مقدمة عن الروضة"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="payment">الدفع</label>
      <div class="col-sm-6 pull-right">
        <textarea class="form-control" name="payment" id="payment" placeholder="الدفع"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="presentation">presentation</label>
      <div class="col-sm-6 pull-right">
        <textarea class="form-control" name="presentation" id="presentation" placeholder="presentation"></textarea>
      </div>
    </div>
    <div class="form-group" style="text-align:right;">
      <div class="col-sm-offset-2 col-sm-6 pull-right">
         <button type="submit" name="submit" value="submit8" class="btn btn-primary btn-lg">تاكيد</button>
      </div>
    </div>
  </form>
</div>

<div id="contact" class="tabcontent">
<h3>الاتصال بالمدرسة</h3>
  <form  class="form-horizontal" role="form" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="map">عنوان </label>
      <div class="col-sm-6 pull-right">   
        <input type="url" class="form-control" name="map" id="map" placeholder="عنوان: https://www.google.com/maps/place/Chr%C3%A9a,+Alg%C3%A9rie/@36.4256277,2.8290626,12z/data=!4m5!3m4!1s0x128f0e6a667c662d:0x887e84e4b979a2c8!8m2!3d36.4336226!4d2.9076094" /> 
      </div>
    </div>
    <div class="form-group" style="text-align:right;">
      <div class="col-sm-offset-2 col-sm-6 pull-right">
         <button type="submit" name="submit" value="submit10" class="btn btn-primary btn-lg">تاكيد</button>
      </div>
    </div>
  </form>
</div>

<div id="enseigner" class="tabcontent">
  <h3>التدريس</h3>
  <form  class="form-horizontal" role="form" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="enseigner1">المواد الدروسة الفئة 1</label>
      <div class="col-sm-6 pull-right">
        <textarea class="form-control" name="enseigner1" id="enseigner1" placeholder="المواد الدروسة 1"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="enseigner2">المواد الدروسة الفئة 2</label>
      <div class="col-sm-6 pull-right">
        <textarea class="form-control" name="enseigner2" id="enseigner2" placeholder="المواد الدروسة 2"></textarea>
      </div>
    </div>
    <div class="form-group" style="text-align:right;">
      <div class="col-sm-offset-2 col-sm-6 pull-right">
         <button type="submit" name="submit" value="submit9" class="btn btn-primary btn-lg">تاكيد</button>
      </div>
    </div>
  </form>
  <div>
  <?php 
                $query="SELECT * FROM store_enseigner WHERE id_store='{$row['id_store']}'";
                $result=mysqli_query($con,$query);
                if (mysqli_num_rows($result) > 0) {
                    while($row1=mysqli_fetch_assoc($result)){?>
                       <div class="inline">
                           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="hidden" name="delete" value="<?php echo $row1['nom']; ?>" />
            <button type="submit" name="submit" value="delete1" class="close pull-left">
              <span aria-hidden="true">&times;</span>
            </button>
        </form>
                            <a target="_blank" href="store/img/enseignement/<?php echo $row1['nom']; ?>">
                                <img src="store/img/enseignement/<?php echo $row1['nom']; ?>" />
                            </a>

                       </div>
                                            <?php
                    }
                }
                ?>
  </div>
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
                            <div class="col-sm-6 pull-right">
                                <button type="submit" name="submit" value="submit11" class="btn btn-primary btn-lg">تاكيد</button>
                            </div>
                        </div>
            </form>
            </div>
</div>

<div id="sortie" class="tabcontent">
<h3>خرجاتنا</h3>
  <form  class="form-horizontal" role="form" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="sortie"> خرجاتنا الفئة 1 </label>
      <div class="col-sm-6 pull-right">
        <textarea class="form-control" name="sortie" id="sortie" placeholder="خرجاتنا"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="sortie2">خرجاتنا الفئة 2</label>
      <div class="col-sm-6 pull-right">
        <textarea class="form-control" name="sortie2" id="sortie2" placeholder="خرجاتنا"></textarea>
      </div>
    </div>
    <div class="form-group" style="text-align:right;">
      <div class="col-sm-offset-2 col-sm-6 pull-right">
         <button type="submit" name="submit" value="submit7" class="btn btn-primary btn-lg">تاكيد</button>
      </div>
    </div>
  </form>
  
  <div>
  <?php 
                $query1="SELECT * FROM `store_sorties` WHERE id_store='{$row['id_store']}' ";
                $result1=mysqli_query($con,$query1);
                if (mysqli_num_rows($result1) > 0) {
                    while($row1=mysqli_fetch_assoc($result1)){?>
                       <div class="inline">
                           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="hidden" name="delete" value="<?php echo $row1['nom']; ?>" />
            <button type="submit" name="submit" value="delete2" class="close pull-left">
              <span aria-hidden="true">&times;</span>
            </button>
        </form>
                            <a target="_blank" href="store/img/sorties/<?php echo $row1['nom']; ?>">
                                <img src="store/img/sorties/<?php echo $row1['nom']; ?>" />
                            </a>

                       </div>
                                            <?php
                    }
                }else echo "what23"; 
                ?>
  </div>
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
                            <div class="col-sm-6 pull-right">
                                <button type="submit" name="submit" value="submit12" class="btn btn-primary btn-lg">تاكيد</button>
                            </div>
                        </div>
            </form>
            </div>
</div>

<div id="animation" class="tabcontent">
  <h3>عرض</h3>
  <form  class="form-horizontal" role="form" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="feteinterne">الحفلات الداخلية</label>
      <div class="col-sm-6 pull-right">
        <input type="text" class="form-control" name="feteinterne" id="feteinterne" placeholder="الحفلات الداخلية"/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="feteinvert">الحفلات التي الاولياء مدعون لحضورها</label>
      <div class="col-sm-6 pull-right">
        <input type="text" class="form-control" name="feteinvert" id="feteinvert" placeholder="الحفلات التي الاولياء مدعون لحضورها"/>
      </div>
    </div>
    <div class="form-group" style="text-align:right;">
      <div class="col-sm-offset-2 col-sm-6 pull-right">
         <button type="submit" name="submit" value="submit6" class="btn btn-primary btn-lg">تاكيد</button>
      </div>
    </div>
  </form>
  
  
  <div>
  <?php 
                $query="SELECT * FROM store_animation WHERE id_store='{$row['id_store']}'";
                $result=mysqli_query($con,$query);
                if (mysqli_num_rows($result) > 0) {
                    while($row1=mysqli_fetch_assoc($result)){?>
                       <div class="inline">
                           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="hidden" name="delete" value="<?php echo $row1['nom']; ?>" />
            <button type="submit" name="submit" value="delete3" class="close pull-left">
              <span aria-hidden="true">&times;</span>
            </button>
        </form>
                            <a target="_blank" href="store/img/animations/<?php echo $row1['nom']; ?>">
                                <img src="store/img/animations/<?php echo $row1['nom']; ?>" />
                            </a>

                       </div>
                                            <?php
                    }
                }
                ?>
  </div>
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
                            <div class="col-sm-6 pull-right">
                                <button type="submit" name="submit" value="submit13" class="btn btn-primary btn-lg">تاكيد</button>
                            </div>
                        </div>
            </form>
            </div>
</div>

<!--<div id="insc" class="tabcontent">
  <h3>Tokyo</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>-->
</div>
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
    document.getElementById("uploadBtn").onchange = function () {
document.getElementById("uploadFile").value = this.value;
};
</script>
</script>
     
</body>
</html> 
