<?php 
    session_start(); 
    if(isset($_SESSION)){
      if(!empty($_SESSION['type']) and !empty($_SESSION['id']) and $_SESSION['type']=="entreprise"){
        header("Location: index.php");
      }
    }
?>
<?php
require_once '../includes/bd.php';
$email_err=$password_err=$error="";
$email=$password="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //virifi l'email
  if(empty(trim($_POST["gemail"]))){
    $email_err="البريد الالكتروني اجباري";
  }else{
    $email=trim($_POST["gemail"]);
  }
  if(empty($_POST["gpass"])){
      $password_err="كلمة السر اجبارية";
  }else{
      $password=sha1($_POST["gpass"]);
  }
  if(!empty($_POST["gemail"]) and !empty($_POST["gpass"])){
      $query="SELECT id,nom FROM entreprise WHERE email='$email' and mot_passe='$password'";
      $result=mysqli_query($con,$query);
      if (mysqli_num_rows($result) > 0){
        $row=mysqli_fetch_array($result);
        session_start();
        $_SESSION['type']="entreprise";
        $_SESSION['id'] = $row['id'];
        $_SESSION['nom'] = $row['nom'];
        header('Location: index.php');
      }else{
        $error="Mauvais identifiant ou mot de passe !";
      }

  }
}


mysqli_close($con);
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
      <img src="images/bannieriage.jpg" style="height:250px;width:100%" alt=""/>
  </div>
  <div class="container">
      <h1>حساب المتعملين الاقتصاديين</h1>
      <div class="row">
        <div class="col-md-6 col-xs-12">
            <p>قم بالاتصال بحسلابك</p>
            <p class="bg-danger text-danger"><?php echo $error; ?></p>
            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">البريد الالكتروني</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" value="<?php echo $email;?>" name="gemail" placeholder="Enter email">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">كلمة السر</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="pwd" name="gpass" placeholder="Enter password">
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
                  <button type="submit" class="btn btn-default btn-lg">تسجيل الدخول</button>
                </div>
              </div>
            </form> 
        </div> 
        
        <div class="col-md-6 col-xs-12">
            <p>هل تريد الانظمام الى اسرتنا والاستفادة من الميزات الممنوحة</p>
            <form action="ges.php" method="get">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default btn-lg">انشاء حساب</button>
                </div>
              </div>
            </form>
            <p style="text-align:right">نقاط تدفعك للانضمام </p>
            <ul style="direction:rtl;">
               <li>يوفر الموقع مساحة مخصصة لعرض الخدمات والاشهار و طلبات التوظيف و عروض العمل , والسلع المتعلقة بعالم الطفل و رياض الاطفال</li>
               <li>الاستفادة من الخدمات التي يعطيها الموقع لكل عملائه المسجلين عندنا</li> 
               <li><strong>التسجيل مجاني</strong></li>
            </ul>
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
</body>
</html>