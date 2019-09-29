<?php 
    session_start(); 
?>
<!DOCTYPE html>
<html lang="ar">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link  href="css/swiper.min.css" rel="stylesheet" type="text/css">
<link href="css/cpt.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="../font-awesome/css/font-awesome.css" />
        <link href="../images/CrechesDZLogo .ico" rel="icon" />


    <!-- Custom CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<?php
require_once '../includes/bd.php'; 
$email_err=$password_err=$passwordconfig_err=$creche_err=$crechestatus_err=$tel_err=$adr_err=$ville_err=$codepostal_err=$file_err=$acc_err="";
$email=$password=$creche=$tel=$adr=$ville=$codepostal=$acc="";
$price="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
  //virifi l'email
  if(empty(trim($_POST["cemail"]))){
    $email_err="البريد الالكتروني اجباري";
  }else{
    // check if e-mail address is well-formed
    if (!filter_var($_POST["cemail"], FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }else{
        //virifi que l'email est unique dans la base de donne
        $tmp=addslashes($_POST["cemail"]);
        $query="SELECT * FROM creche WHERE email='$tmp'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
              $email_err="هذا البريد الالكتروني مستعمل";
        }else{
              $email=trim(addslashes($_POST["cemail"]));
        }
    }
  }
  if(empty($_POST["cpass"])){
    $password_err="كلمة السر اجبارية";
  }else{
    if(strlen($_POST["cpass"])<5){
      $password_err="على الاقل 5 احرف";
    }else{
      if(empty($_POST["ccpass"])){
        $passwordconfig_err="يجب تاكيد كلمة السر";
      }elseif($_POST["cpass"]!=$_POST["ccpass"]){
        $passwordconfig_err="اسف, لكن كلمة السر غير متشابهة";
      }else{
        $password=sha1($_POST["ccpass"]);
      }
    }
  }
  if(empty($_POST["creche"])){
    $creche_err=" اسم الروضة اجباري";
  }else{
    if (!preg_match("#^[a-zA-Z \.,0-9]{5,}$#",$_POST["creche"])) {
      $creche_err=" اسم الروضة غير صحيح";
    }else{
        $tmp=addslashes($_POST["creche"]);
        //virifi que l'email est unique dans la base de donne
        $query="SELECT * FROM creche WHERE nom='$tmp'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
              $creche_err="هذا الاسم مستعمل";
        }else{
              $creche=trim(addslashes($_POST["creche"]));
        }
    }
  }
  if(empty($_POST["crechestatus"])){
    $crechestatus_err="نوع الروضة اجباري";
  }else{
    $crechestatus=$_POST["crechestatus"];
  }
  if(empty(trim($_POST["ctel"]))){
    $tel_err="رقم الهاتغ اجباري";
  }else{
    if (!preg_match("#^[0-9]{9,10}$#",$_POST["ctel"])) {
      $tel_err=" رقم الهاتف غير صحيح";
    }else{
        $tmp=addslashes($_POST["ctel"]);
        //virifi que l'email est unique dans la base de donne
        $query="SELECT * FROM creche WHERE tel='$tmp'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
              $tel_err="هذا الرقم مستعمل";
        }else{
              $tel=trim(addslashes($_POST["ctel"]));
        }
    }
  }
  if(empty($_POST["cadr"])){
    $adr_err=" العنوان اجباري";
  }else{
    $adr=trim(addslashes($_POST["cadr"]));
    if (!preg_match("#^[a-zA-Z \.,0-9]{5,}$#",$adr)) {
      $adr_err=" العنوان غير صحيح";
    }
  }
  if(empty($_POST["cville"])){
    $ville_err="الولاية اجباري";
  }else{
    $ville=addslashes($_POST["cville"]);
  } 
  //virification du code postal
  /*if(empty($_POST["cposte"])){
    $codepostal_err="الحساب المصرفي اجباري";
  }else{
    if (!preg_match("#^[0-9]{10} [0-9]{2}$#",$_POST["cposte"])) {
      $codepostal_err=" الحساب المصرفي غير صحيح";
    }else{
        $tmp=$_POST["cposte"];
        //virifi que l'email est unique dans la base de donne
        $query="SELECT * FROM creche WHERE code_postal='$tmp'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
              $codepostal_err="هذا الحساب مستعمل";
        }else{
             $codepostal=$_POST["cposte"];
        }
    }
  }*/
  if(empty($_POST["cacc"])){
    $acc_err="يجب الموافق قبل المواصلة";
  }else { $acc="true"; }
  $file=$_FILES['glogo']['tmp_name'];
  if(!isset($file)){
    $file_err="يرجى ادخال صورة";
  }else{
    $image_size=getimagesize($_FILES['glogo']['tmp_name']);
    if($image_size==FALSE){
      $file_err="هذه ليس صورة";
    }else{
      $image=addslashes(file_get_contents($_FILES['glogo']['tmp_name']));
      $image_name=addslashes($_FILES['glogo']['name']);
    }
  }
  if(!empty($_POST['price'])){
    $price=$_POST['price'];
  }
  if(!empty($email) and !empty($price) and !empty($password) and !empty($creche) and !empty($image) and !empty($image_name) and !empty($crechestatus) and !empty($adr) and !empty($ville) and !empty($tel) and !empty($acc)){
      $query="INSERT INTO store(equipe)VALUES(' ')";
         $result=mysqli_query($con, $query);
         $id=mysqli_insert_id($con);
    $query="INSERT INTO `creche`( `email`, `nom`, `mot_passe`, `adr`, `willaya`, `tel`, `status`, `date_insc`, `logo`,id_store) VALUES ('{$email}','{$creche}','{$password}','{$adr}','{$ville}','{$tel}','{$crechestatus}',NOW(),'{$image}',{$id})";
     $result = mysqli_query($con, $query);
     var_dump($result);
     if($result){
        session_start();
        $_SESSION['type']="creche";
        
            $id_c= mysqli_insert_id($con);
         $_SESSION['id'] =$id_c;
         
      
         
             $_SESSION['nom'] = $creche;
            header('Location: index.php?test='.$id_c.'&ho='.$id.'&u='.$result);
         
        
     }else{
                     echo "<h1>erroor</h1>";

     }
  } 
}
?>
<!doctype html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>creche comfiguration page</title>
            <link rel="stylesheet" href="css/bootstrap.min.css" />
            <link rel="stylesheet" href="css/style.css" />
        </head>
        <body>
        <body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div>
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php"><span style="color:rgb(223,90,71);">D</span><span style="color:rgb(154,175,74);">Z</span> <span style="color:rgb(255,167,45);">C</span><span style="color:rgb(217,75,71);">r</span><span style="color:rgb(72,176,207);">è</span><span style="color:rgb(223,90,71);">c</span><span style="color:rgb(72,176,207);">h</span><span style="color:rgb(71,170,106);">e</sapn></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav nav-pills nav-justified">
      </ul>
    </div>
  </div>
</nav>

<div class="bg" style="padding-top:50px;">
    <div>
      <img src="images/bannieriage.jpg" style="height:250px;width:100%" alt=""/>
  </div>
  <div class="container">
      <h1>انشاء حساب في دزكرش</h1>
      <div class="row" style="margin:auto;">
        <div class="col-md-12 col-xs-12">
            <form class="form-horizontal" role="form" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                <fieldset>
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">البريد الالكتروني</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" name="cemail" id="email" value="<?php echo htmlspecialchars(stripslashes($email));?>" placeholder="البريد الالكتروني" data-error="هذا البريد الالكتروني غير صحيح" required/>
                  <div class="help-block with-errors"><?php echo $email_err;?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">كلمة السر</label>
                <div class="col-sm-10">
                  <input type="password"  data-minlength="6" class="form-control" value="<?php if(isset($_POST["cpass"])) echo $_POST["cpass"];?>" name="cpass" id="pwd"  placeholder="كلمة السر" required>
        <div class="help-block">على الاقل 5 احرف</div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="cpwd">تاكيد كلمة السر </label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="cpwd" name="ccpass" data-match="#pwd" data-match-error="اسف, لكن كلمة السر غير متشابهة" placeholder="تاكيد كلمة السر" required>
        <div class="help-block with-errors"><?php echo $passwordconfig_err;?></div>
                </div>
              </div>
              </fieldset>
              <fieldset>
                  <legend>معلومات حول صاحب الخدمة</legend>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="creche">اسم الروضة</label>
                    <div class="col-sm-10">
                       <input type="text" pattern="^[a-zA-Z \.0-9]{5,}$" class="form-control" id="creche" value="<?php echo htmlspecialchars(stripslashes($creche));?>" name="creche" placeholder="اسم الروضة"  required>
                       <div class="help-block with-errors"><?php echo $creche_err;?></div>
                    </div>  
                  </div> 
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="sel1">الوضعية القانونية</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="sel1" name="crechestatus" required>
                        <option>فردية</option>
                        <option>جمعية</option>
                        <option>خاصة</option>
                        <option>عامة</option>
                      </select>
                      <div class="help-block with-errors"><?php echo $crechestatus_err;?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="telfix">رقم الهاتف الثابت</label>
                    <div class="col-sm-10">
                    <input type="tel" pattern="^[0-9]{9,10}$" minlenght="9" maxlength="10" value="<?php echo htmlspecialchars(stripslashes($tel));?>" class="form-control" id="telfix" name="ctel" placeholder="رقم الهاتف الثابت :   025405049"   required>
                    <div class="help-block with-errors"><?php echo $tel_err;?></div>
                  </div>  
                  </div>       
              </fieldset>
              <fieldset>
                  <legend>العنوان</legend>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="adr">العنوان</label>
                        <div class="col-sm-10">
                            <input type="text" pattern="^[a-zA-Z \.0-9]{5,}$" class="form-control" value="<?php echo htmlspecialchars(stripslashes($adr));?>" id="adr" name="cadr"  placeholder="العنوان"  required>
                            <div class="help-block with-errors"><?php echo $adr_err;?></div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-2" for="ville">الولاية</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="ville" name="cville" required>
                        <?php $query1="SELECT * FROM willaya";
                              $result=mysqli_query($con,$query1);
                              while($row1=mysqli_fetch_assoc($result)):
                         ?>
                        <option value="<?php echo $row1['nom'] ?>"><?php echo $row1['nom'] ?></option>
                        <?php endwhile; ?>
                      </select>
                      <div class="help-block with-errors"><?php echo $ville_err;?></div>
                    </div>
                  </div>

              </fieldset>              
                <div class="form-group">
                <label class="control-label col-sm-2" for="file">رمز</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control text-right" id="file" name="glogo" />
                  <div class="help-block with-errors"><?php echo $file_err; ?></div>
                </div>
                </div>
              <div class="form-group"  style="text-align:right;">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label for="gacc">انا اوافق على سياسة الموقع</label>
                    <div class="col-sm-10">
                        <input type="checkbox" name="cacc" id="gacc" <?php if($acc) echo "checked" ?>  data-error="يجب الموافق قبل المواصلة" required>
                        <div class="help-block with-errors"><?php echo $acc_err; ?></div>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
                  if(isset($_GET['price'])){
                    $p=$_GET['price'];
                  }elseif(!empty($price)){
                    $p=$price;
                  }else{
                    $p="silver";
                  }
              ?>
              <input type="hidden" name="price" value="<?php echo $p; ?>" />

              <div class="form-group" style="text-align:right;">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default btn-lg">تسجيل الدخول</button>
                </div>
              </div>
            </form> 
        </div> 
    </div>
  </div>
  </div>
 <footer class="bg-karim">
    <div class="row">
        <ul>
            <li>Mentions Légales |</li>
            <li>CGU</li>
        </ul>
    </div>
    <div class="row">
        <a href="#"><img src="images/CrechesDZLogo.png" alt="" style="width:200px;" /></a>
    </div>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/validator.js"></script>
  <?php mysqli_close($con);
 ?>
</body>
</html>
