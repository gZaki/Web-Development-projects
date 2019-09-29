<?php 
    session_start(); 
    if(isset($_SESSION)){
        if(!empty($_SESSION['type']) and !empty($_SESSION['id']) and $_SESSION['type']=="creche"){
            header("Location: index.php");
        }
    }
?>
<?php
require_once("../includes/bd.php"); 
$email_err=$password_err=$error="";
$email=$password="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  //virifi l'email
  if(empty(trim($_POST["creche"]))){
    $email_err="البريد الالكتروني اجباري";
  }else{
    $email=trim(addslashes($_POST["creche"]));
  }
  if(empty($_POST["password"])){
      $password_err="كلمة السر اجبارية";
  }else{
      $password=sha1($_POST["password"]);
  }
  if(!empty($_POST["creche"]) and !empty($_POST["password"])){
      $query="SELECT id,nom FROM creche WHERE email='$email' or nom='$email' and mot_passe='$password'";
      $result=mysqli_query($con,$query);
      if (mysqli_num_rows($result) > 0){
        $row=mysqli_fetch_array($result);
        session_start();
        $_SESSION['type']="creche";
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
<html lang="ar">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/style.css"/>
    </head>
    <body class="bg">
        <header>
            <img src="../images/CrechesDZLogo.png" class="img-responsive" width="100px" alt="logo" />
        </header>
        <section class="bg-2" >
            <div>
                    <h1 class="rainbowize">مساحة الحضانة الخاصة</h1>               
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <p><a href="registercreche.php">اريد الحصول على مساحة</a><br /><span class="bg-danger text-danger col-md-6 col-sm-5 col-xs-5 col-md-offset-3 col-sm-offset-4 col-xs-offset-4"><?php echo $error; ?></span>
<br /></p>
                <div class="form-group col-md-6 col-sm-5 col-xs-5 col-md-offset-3 col-sm-offset-4 col-xs-offset-4">
                    <input class="form-control input-lg" type="text" name="creche" placeholder="البريد الالكتروني" required /><br />
                </div>
                <div class="form-group col-md-6 col-sm-5 col-xs-5 col-md-offset-3 col-sm-offset-4 col-xs-offset-4">
                    <input class="form-control input-lg" type="password" name="password" placeholder="كلمة السر" required /><br />
                </div>
                <button class="btn btn-lg btn-2 col-sm-4 col-sm-offset-5 col-xs-6 col-xs-offset-5" type="submit">التحقق من صحة</button>
            </form>
            </div>
           
                        
        </section>
    </body>
</html>