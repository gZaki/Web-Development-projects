<?php 
    session_start(); 
    if(isset($_SESSION)){
      if(!empty($_SESSION['type']) and !empty($_SESSION['id']) and $_SESSION['type']=="parent"){
        header("Location: blog.php");
      }
    }
require_once '../includes/bd.php';
$email_err=$password_err=$passwordconfig_err=$name_err=$acc_err=$error="";
$email=$password==$name=$acc="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if($_POST["submit"]=="submit"){
    //virifi l'email
      if(empty(trim($_POST["email"]))){
        $email_err="البريد الالكتروني اجباري";
      }else{
        // check if e-mail address is well-formed
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
        }else{
          $tmp=$_POST["email"];
            //virifi que l'email est unique dans la base de donne
            $query="SELECT id FROM parent WHERE email='$tmp'";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
              $email_err="هذا البريد الالكتروني مستعمل";
            }else{
              $email=trim($_POST["email"]);
            }
        }
      }
      if(empty($_POST["pass"])){
        $password_err="كلمة السر اجبارية";
      }else{
        if(strlen($_POST["pass"])<5){
          $password_err="على الاقل 5 احرف";
        }else{
          if(empty($_POST["cpass"])){
            $passwordconfig_err="يجب تاكيد كلمة السر";
          }elseif($_POST["pass"]!=$_POST["cpass"]){
            $passwordconfig_err="اسف, لكن كلمة السر غير متشابهة";
          }else{
            $password=sha1($_POST["pass"]);
          }
        }
      }
      if(empty($_POST["name"])){
        $name_err=" الاسم اجباري";
      }else{
        $name=trim($_POST["name"]);
        if (!preg_match("#^[\p{Arabic} a-zA-Z \.0-9]{5,}$#",$name)) {
          $name_err="الاسم غير صحيح";
        }
      }
      if(empty($_POST["acc"])){
        $acc_err="يجب الموافق قبل المواصلة";
      }else { $acc="true"; }

      if(!empty($email) and !empty($name) and !empty($password) and !empty($acc)){
        $query="INSERT INTO `parent`( `nom`, `email`, `mot_passe`, `date_insc`) VALUES ('{$name}','{$email}','{$password}',NOW())";
        $result = mysqli_query($con, $query);
        if($result){
            session_start();
            $_SESSION['type']="parent";
            $_SESSION['id']=mysqli_insert_id($con);
            $_SESSION['name'] = $name;
            header('Location: blog.php');
        }
      }
  }
  if($_POST["submit"]=="submit2"){
      if(empty(trim($_POST["email"]))){
        $email_err="البريد الالكتروني اجباري";
      }else{
        $email=trim($_POST["email"]);
      }
      if(empty($_POST["pass"])){
          $password_err="كلمة السر اجبارية";
      }else{
          $password=sha1($_POST["pass"]);
      }
      if(!empty($_POST["email"]) and !empty($_POST["pass"])){
          //$query="SELECT * FROM parent WHERE email='$email' and mot_passe='$password'";
          $query="SELECT * FROM parent WHERE email='$email'";
          $result=mysqli_query($con,$query);
          if (mysqli_num_rows($result) > 0){
            $row=mysqli_fetch_array($result);
            session_start();
            $_SESSION['type']="parent";
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['nom'];
            header('Location: blog.php');
          }else{
            $error="Mauvais identifiant ou mot de passe !";
          }

      }
  }
   
}
?>

<?php //include 'header.php'; ?>
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


<div class="bg-compte">
    <div>
      <img src="../images/bannieriage.jpg" style="height:250px;width:100%" alt=""/>
  </div>
  <div class="container">
      <h1>مرحبا بك في دزدكرش</h1>
      <p><b>قم بدخول الى الى حسابك الخاص للاستفادة من خدمتنا</b></p>
      <div class="row">
        <div class="col-md-6 col-xs-12">
            <p>هذه مرتك الاولى قم بانشاء حساب</p>
            <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" role="form" data-toggle="validator">
              <div class="form-group">
                <label class="control-label col-sm-2" for="nom">الاسم</label>
                <div class="col-sm-10">
                  <input type="text" pattern="^[a-zA-Z \.0-9 \p{Arabic}]{5,}$" class="form-control" id="nom" value="<?php echo $name;?>" name="name" placeholder="الاسم"  required>
                  <div class="help-block with-errors"><?php echo $name_err;?></div>
                </div>
                </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">البريد الالكتروني</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" name="email" id="email" value="<?php $email;?>" placeholder="البريد الالكتروني" data-error="هذا البريد الالكتروني غير صحيح" required/>
                  <div class="help-block with-errors"><?php echo $email_err;?></div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">كلمة السر</label>
                <div class="col-sm-10">
                  <input type="password"  data-minlength="6" class="form-control" name="pass" id="pwd"  placeholder="كلمة السر" required>
                  <div class="help-block">على الاقل 5 احرف</div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="cpwd">تاكيد كلمة السر </label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="cpwd" name="cpass" data-match="#pwd" data-match-error="اسف, لكن كلمة السر غير متشابهة" placeholder="تاكيد كلمة السر" required>
                  <div class="help-block with-errors"><?php echo $passwordconfig_err;?></div>
                </div>
              </div>
              <div class="form-group"  style="text-align:right;">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label for="gacc">انا اوافق على سياسة الموقع</label>
                    <div class="col-sm-10">
                        <input type="checkbox" name="acc" id="gacc"  data-error="يجب الموافق قبل المواصلة" required>
                        <div class="help-block with-errors"><?php echo $acc_err; ?></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default btn-lg" name="submit" value="submit">التحقق من صحة</button>
                </div>
              </div>
            </form> 
        </div>
        <div class="col-md-6 col-xs-12">
            <p>انت تمتلك حساب</p>
            <p class="bg-danger text-danger"><?php echo $error; ?></p>
            <form class="form-horizontal" role="form" data-toggle="validator" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">البريد الالكتروني</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" name="email" placeholder="البريد الالكتروني">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">كلمة السر</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="pwd" name="pass" placeholder="كلمة السر">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label><input type="checkbox">تذكرني</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" name="submit" value="submit2" class="btn btn-default btn-lg">تسجيل الدخول</button>
                </div>
              </div>
            </form> 
        </div>
        
      </div>
      
  </div>

  <!--<footer class="bg-karim">
    <div class="row">
        <ul>
            <li>Mentions Légales |</li>
            <li>CGU</li>
        </ul>
    </div>
    <div class="row">
        <a href="#"><img src="images/99.png" alt="" /></a>
    </div>
  </footer>-->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/validator.js"></script>
<?php mysqli_close($con);
 ?>
  </body>
  </html>