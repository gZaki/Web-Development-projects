<?php 
    session_start();
    if(!isset($_SESSION) or $_SESSION['type']!="creche"){
        header("Location: identificationPage.php");
    }
    require_once '../includes/bd.php'; 
    $id=addslashes($_SESSION['id']);
   $query="SELECT * FROM creche WHERE id='$id'";
   $result=mysqli_query($con,$query);
   $row=mysqli_fetch_assoc($result);
   /*if($row['reday']=='0' or strtotime($row['date_contrat'] . " + 365 day")<strtotime(date("Y-m-d"))){
$query="UPDATE creche SET reday='0' WHERE id ='$id'";
    $result=mysqli_query($con,$query);
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST['monda'])){
        $monda=$_POST['monda'];
        $query="UPDATE creche SET monda='$monda' WHERE id='$id'";
        $result=mysqli_query($con,$query);
    }
}*/
?>
<!doctype html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>creche comfiguration page</title>
            <link rel="stylesheet" href="css/bootstrap.min.css" />
        </head>
        <body style="background:url(images/f_login.jpg);"><!--
<div class="col-md-12">
        <div style="/*background:white;*/">
            <div id="logo" class="col-md-2 col-sm-2 col-xs-12" style="/*width: 10%;height: 150px;float:left;*/">
             <a href="../index.php"><img src="images/CrechesDZLogo.png" style="width: 100%;height: 150px;"  /></a>
            </div>
               <div id="pub" class="col-md-8 col-sm-8 col-xs-12" style="/*width:60%;display: inline-block;height: 150px;*/"><img  src="images/bannieriage.jpg" style="width:100%;display: inline-block;height: 150px;" /></div>
               <div id="sponsor" class="col-md-2 col-sm-2 col-xs-12" style="/*width:20%;display: inline-block;*/"><img src="logo.png" width="100%" /></div>
                    <div style="clear:both"></div>

        </div>
            </div>
    <a href="../deconnection.php" class="btn btn-danger">خروج</a>

        <center>
            <h1>مرحبا بك في دزدكرش</h1>
            <h3>نحن اسفون لكن يبدو انك اما غير مسجل او ان فترة اشتراكك قد انتهت</h3>
        </center>
<div class="container-fluid">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
         <div class="row">
                    <center>
                        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3" style="padding-top:40px;">
                            <?php $query="SELECT * FROM creche WHERE id='$id'";
                                     $result=mysqli_query($con,$query);
                                     $row=mysqli_fetch_assoc($result);
                                      ?>
                                          <p>يرجى ارسال المبلغ الى هذا الحساب 0235659874 25 وكتبات رقم الحوالة في هذا المدخل ثم انتضر فترة للتأكد</p>

                            <div class="input-group input-group-lg">
                                
                            <input type="text" class="form-control" name="monda" value="<?php echo htmlspecialchars(stripslashes($row['monda'])); ?>"  placeholder="المندة">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" name="submit" type="submit">ارسال</button>
                            </span>
                            </div>
                        </div>
                
                    </center>
                </div>
    </form>
</div>
</body>
    </html>-->


   <?php //}else{
        include 'header.php';
        $id=$_SESSION['id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST['title']) and !empty($_POST['description'])){
        $title=$_POST['title'];
        $description=$_POST['description'];
        $prix=$_POST['prix'];
        $query="INSERT INTO `offre`( `title`, `description`, `prix`, `id_creche`) VALUES ('$title','$description','$prix','$id')";
        $result=mysqli_query($con,$query);
    }
    if(isset($_POST) and !empty($_POST['delete'])){
        $query="DELETE FROM offre WHERE id='{$_POST['delete']}'";
        $result=mysqli_query($con,$query);
    }
}
 ?>
<div>
<div class="contentn">
<div class="row">
    <div class="col-md-9">
         <h1><center>هل تحتاج خدمة </center></h1>
         <div class="container-fluid">
<form class="form-horizontal ho" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table width="100%">
        <tr>
            <td><label class="control-label" for="title">الخدمة</label></td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control" id="title" name="title"  required />
                </div>
            </td>
        </tr>
        <tr>
            <td><label class="control-label" for="description">وصف الخدمة</label></td>
            <td>
                <div class="form-group">
                    <textarea name="description" class="form-control" id="description"></textarea>
                </div>
            </td>
        </tr>
        <tr>
            <td><label class="control-label" for="prix">السعر</label></td>
            <td>
                <div class="form-group">  
                    <input type="numbre" class="form-control" id="prix" name="prix"  required />
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-lg">اعرض الخدمة</button>
                </div>
            </td>
        </tr>
    </table>
</form>
         </div>
         <div>
         <?php 
$query="SELECT * FROM offre WHERE id_creche='$id'";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result) > 0) {
            while($row1=mysqli_fetch_assoc($result)): 
             $id=$row1['id_creche'];
            ?>
            <div class="offre">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <button type="submit" name="delete" class="btn btn-default btn-sm" value="<?php echo $row['id']; ?>">&times;</button>
            </form>
            <p>الخدمة : <?php echo htmlspecialchars(stripslashes($row1['title'])); ?></p>
            <p>وصف : <?php echo htmlspecialchars(stripslashes($row1['description'])); ?></p>
            <p>السعر: <strong><?php echo htmlspecialchars(stripslashes($row1['prix'])); ?>DZ</strong></p>
            </div>
 <?php endwhile; 
        }
     ?>
</div>
</div>

         
    <div class="col-md-3">
        <div class="card">
            <img src="../includes/getimage.php?id=<?php echo $id; ?>&type=<?php echo 'creche'; ?>" alt="John" style="width:100%">
            <div class="containe">
                <h1><?php echo htmlspecialchars(stripslashes($_SESSION['nom'])); ?></h1>
                <p><?php echo htmlspecialchars(stripslashes($row['adr'])); ?></p>
                <div style="margin: 24px 0;">
                <a href="<?php echo htmlspecialchars(stripslashes($row['google'])); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                <a href="<?php echo htmlspecialchars(stripslashes($row['facebook'])); ?>"><i class="fa fa-facebook"></i></a> 
            </div>
            </div>
        </div>

    </div>

</div>
<?php include 'footer.php'; 
//}
 ?>
