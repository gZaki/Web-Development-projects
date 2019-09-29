<?php 
    session_start(); 
require_once '../includes/bd.php';
$email_err=$password_err=$passwordconfig_err=$entreprise_err=$entreprisetype_err=$tel_err=$adr_err=$ville_err=$codepostal_err=$service_err=$file_err=$acc_err="";
$email=$password=$entreprise=$tel=$adr=$ville=$codepostal=$service=$sex=$acc="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
  //virifi l'email
  if(empty(trim($_POST["gemail"]))){
    $email_err="البريد الالكتروني اجباري";
  }else{
    // check if e-mail address is well-formed
    if (!filter_var($_POST["gemail"], FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }else{
        $tmp=$_POST["gemail"];
        //virifi que l'email est unique dans la base de donne
        $query="SELECT * FROM entreprise WHERE email='$tmp'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
              $email_err="هذا البريد الالكتروني مستعمل";
        }else{
              $email=trim($_POST["gemail"]);
        }
    }
  }
  if(empty($_POST["gpass"])){
    $password_err="كلمة السر اجبارية";
  }else{
    if(strlen($_POST["gpass"])<5){
      $password_err="على الاقل 5 احرف";
    }else{
      if(empty($_POST["gcpass"])){
        $passwordconfig_err="يجب تاكيد كلمة السر";
      }elseif($_POST["gpass"]!=$_POST["gcpass"]){
        $passwordconfig_err="اسف, لكن كلمة السر غير متشابهة";
      }else{
        $password=sha1($_POST["gpass"]);
      }
    }
  }
  if(empty($_POST["gentr"])){
    $entreprise_err=" اسم المؤسسة اجباري";
  }else{
    $entreprise=trim($_POST["gentr"]);
    if (!preg_match("#^[a-zA-Z \.,0-9]{5,}$#",$entreprise)) {
      $entreprise_err=" اسم المؤسسة اجباري";
    }
  }
  if(empty($_POST["gentrtype"])){
    $entreprisetype_err="نوع المؤسسة اجباري";
  }else{
    $entreprisetype=$_POST["gentrtype"];
  }
  if(empty(trim($_POST["gtel"]))){
    $tel_err="رقم الهاتف اجباري";
  }else{
    if (!preg_match("#^[0-9]{9,10}$#",$_POST["gtel"])) {
      $tel_err=" رقم الهاتف غير صحيح";
    }else{
        $tmp=$_POST["gtel"];
        //virifi que l'email est unique dans la base de donne
        $query="SELECT * FROM entreprise WHERE tel='$tmp'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
              $tel_err="هذا الرقم مستعمل";
        }else{
              $tel=trim($_POST["gtel"]);
        }
    }

  }
  if(empty($_POST["gadr"])){
    $adr_err=" العنوان اجباري";
  }else{
    $adr=trim($_POST["gadr"]);
    if (!preg_match("#^[a-zA-Z \.,0-9]{5,}$#",$adr)) {
      $adr_err=" العنوان غير صحيح";
    }
  }
  if(empty($_POST["gville"])){
    $ville_err="الولاية اجباري";
  }else{
    $ville=$_POST["gville"];
  } 
  //virification du code postal
  if(empty(trim($_POST["gposte"]))){
    $codepostal_err="الحساب المصرفي اجباري";
  }else{
    if (!preg_match("#^[0-9]{10} [0-9]{2}$#",$_POST["gposte"])) {
      $codepostal_err=" الحساب المصرفي غير صحيح";
    }else{
        $tmp=$_POST["gposte"];
        //virifi que l'email est unique dans la base de donne
        $query="SELECT * FROM entreprise WHERE code_postal='$tmp'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
              $codepostal_err="هذا الحساب مستعمل";
        }else{
             $codepostal=trim($_POST["gposte"]);
        }
    }
  }
  if(empty($_POST["gservice"])){
    $service_err=" اسم الخدمة اجباري";
  }else{
    $service=trim($_POST["gservice"]);
    if (!preg_match("#^[a-zA-Z \.0-9]{5,}$#",$service)) {
      $service_err="اسم الخدمة غير صحيح";
    }
  }
  if(empty($_POST["gacc"])){
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
    }
  }

  if(!empty($email) and !empty($password) and !empty($entreprise) and !empty($image) and !empty($tel) and !empty($adr) and !empty($ville) and !empty($codepostal) and !empty($service) and !empty($entreprisetype) and !empty($acc)){
    $query="INSERT INTO `entreprise`( `nom` , `email`  ,`code_postal`, `adr`, `willaya`, `type`, `tel`, `service`, `mot_passe`, `date_insc`, `logo`) VALUES ('{$entreprise}','{$email}','{$codepostal}','{$adr}','{$ville}','{$entreprisetype}','{$tel}','{$service}','{$password}',NOW(),'{$image}')";     
     $result = mysqli_query($con, $query);
     if($result){
        session_start();
        $_SESSION['type']="entreprise";
        $_SESSION['id']=mysqli_insert_id($con);
        $_SESSION['nom'] = $entreprise;
        header('Location: index.php');
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
<div class="col-md-12">
        <div >
            <div id="logo" class="col-md-2 col-sm-2 col-xs-12">
             <a href="../index.php"><img src="images/CrechesDZLogo.png" style="width: 100%;height: 150px;"  /></a>
            </div>
               <div id="pub" class="col-md-8 col-sm-8 col-xs-12"><img  src="images/bannieriage.jpg" style="width:100%;display: inline-block;height: 150px;" /></div>
               <div id="sponsor" class="col-md-2 col-sm-2 col-xs-12"><img src="logo.png" width="100%" /></div>
                    <div style="clear:both"></div>

        </div>
            </div>

<div class="bg-compte">
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
                  <input type="email" class="form-control" name="gemail" id="email" value="<?php echo $email;?>" placeholder="البريد الالكتروني" data-error="هذا البريد الالكتروني غير صحيح" required/>
                  <div class="help-block with-errors"><?php echo $email_err;?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">كلمة السر</label>
                <div class="col-sm-10">
                  <input type="password"  data-minlength="6" class="form-control" name="gpass" value="<?php if(isset($_POST["gpass"])) echo $_POST["gpass"];?>" id="pwd"  placeholder="كلمة السر" required>
        <div class="help-block">على الاقل 5 احرف</div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="cpwd">تاكيد كلمة السر </label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="cpwd" name="gcpass" data-match="#pwd" data-match-error="اسف, لكن كلمة السر غير متشابهة" placeholder="تاكيد كلمة السر" required>
        <div class="help-block with-errors"><?php echo $passwordconfig_err;?></div>
                </div>
              </div>
              </fieldset>
              <fieldset>
                  <legend>معلومات حول صاحب الخدمة</legend>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="entr">اسم المؤسسة</label>
                    <div class="col-sm-10">
                       <input type="text" pattern="^[a-zA-Z \.0-9]{5,}$" class="form-control" id="entr" value="<?php echo $entreprise;?>" name="gentr" placeholder="اسم المؤسسة او الخدمة"  required>
                       <div class="help-block with-errors"><?php echo $entreprise_err;?></div>
                    </div>  
                  </div> 
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="sel1">نوع المؤسسة</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="sel1" name="gentrtype" required>
                        <option>فردية</option>
                        <option>جمعية</option>
                        <option>خاصة</option>
                        <option>عامة</option>
                      </select>
                      <div class="help-block with-errors"><?php echo $entreprisetype_err;?></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="telfix">رقم الهاتف الثابت</label>
                    <div class="col-sm-10">
                    <input type="tel" pattern="^[0-9]{9,10}$" minlenght="9" maxlength="10" value="<?php echo $tel;?>" class="form-control" id="telfix" name="gtel" placeholder="رقم الهاتف الثابت :   025405049"   required>
                    <div class="help-block with-errors"><?php echo $tel_err;?></div>
                  </div>  
                  </div>       
              </fieldset>
              <fieldset>
                  <legend>العنوان</legend>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="adr">العنوان</label>
                        <div class="col-sm-10">
                            <input type="text" pattern="^[a-zA-Z \.0-9]{5,}$" class="form-control" value="<?php echo $adr;?>" id="adr" name="gadr"  placeholder="العنوان"  required>
                            <div class="help-block with-errors"><?php echo $adr_err;?></div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-2" for="ville">الولاية</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="ville" name="gville" required>
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
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="poste">الحساب المصرفي</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" pattern="^[0-9]{10} [0-9]{2}$" id="poste" name="gposte" value="<?php echo $codepostal;?>" placeholder="الحساب المصرفي"  required>
                          <div class="help-block with-errors"><?php echo $codepostal_err;?></div>
                        </div>
                    </div>
              </fieldset>
              <fieldset>
                  <legend>معلوماتك الخاصة</legend> 
                <div class="form-group">
                <label class="control-label col-sm-2" for="service">الخدمة</label>
                <div class="col-sm-10">
                  <input type="text" pattern="^[a-zA-Z \.0-9]{5,}$" class="form-control" id="service" value="<?php echo $service;?>" name="gservice" placeholder="الخدمة"  required>
                  <div class="help-block with-errors"><?php echo $service_err;?></div>
                </div>
                </div>
                <div class="form-group">
                <label class="control-label col-sm-2" for="file">صورة</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control text-right" id="file" name="glogo"  required />
                  <div class="help-block with-errors"><?php echo $file_err;?></div>
                </div>
                </div>
              </fieldset>
              <div class="form-group"  style="text-align:right;">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label for="gacc">انا اوافق على سياسة الموقع</label>
                    <div class="col-sm-10">
                        <input type="checkbox" name="gacc" id="gacc" <?php if($acc) echo "checked" ?>  data-error="يجب الموافق قبل المواصلة" required>
                        <div class="help-block with-errors"><?php echo $acc_err; ?></div>
                    </div>
                  </div>
                </div>
              </div>
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
</div>
 <footer class="bg-karim">
    <div class="row">
        <ul>
            <li>Mentions Légales |</li>
            <li>CGU</li>
        </ul>
    </div>
    <div class="row">
        <a href="#"><img src="images/99.png" alt="" /></a>
    </div>
  </footer>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/validator.js"></script>
  <?php mysqli_close($con);
 ?>
</body>
</html>
