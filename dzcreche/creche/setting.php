<?php 
    session_start();
            if(!isset($_SESSION) or $_SESSION['type']!="creche"){
        header("Location: identificationPage.php");
    }
?>
<?php 
    include 'header.php';
require_once '../includes/bd.php'; 
    $id=addslashes($_SESSION['id']);
   $query="SELECT * FROM creche WHERE id='$id'";
   $result=mysqli_query($con,$query);
   $row=mysqli_fetch_assoc($result);
   //echo $row['cid']
   $creche= $row['nom'];
   $email=$row['email'];
   //$codepostal=$row['code_postal'];
   $adr=$row['adr'];
   $ville=$row['willaya'];
   $tel=$row['tel'];
   $status=$row['status'];
   $date_insc=$row['date_insc'];
   $description=$row['description'];
   $facebook=$row['facebook'];
   $google=$row['google'];
    $email_err=$description_err=$password_err=$facebook_err=$google_err=$passwordconfig_err=$file_err=$creche_err=$crechestatus_err=$tel_err=$adr_err=$ville_err=$codepostal_err="";
    $uemail=$upassword=$udescription=$ucreche=$utel=$uadr=$uville=$ufacebook=$ugoogle=$ucodepostal="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
  //virifi l'email
  if($_POST['submit']=="submit1"){
    if(empty(trim($_POST["cemail"]))){
        $email_err="البريد الالكتروني اجباري";
    }else{
        // check if e-mail address is well-formed
        if (!filter_var($_POST["cemail"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        }else{
            //virifi que l'email est unique dans la base de donne
            $tmp=addslashes($_POST["cemail"]);
            $query="SELECT id FROM creche WHERE email='$tmp'";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                $email_err="هذا البريد الالكتروني مستعمل";
            }else{
                $uemail=addslashes(trim($_POST["cemail"]));
                $query="UPDATE `creche` SET email='$uemail' WHERE id='$id'";
                $result=mysqli_query($con,$query);
                if($result){
                    $email=stripslashes($uemail);
                }
            }
        }
    }
  }
  if($_POST['submit']=="submit2"){
    if(empty($_POST["pass"])){
        $password_err="يرجى ادخال كلمة السر الحالية";
    }else{
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
                $upassword=sha1($_POST["ccpass"]);
                $query="UPDATE `creche` SET mot_passe='$upassword' WHERE id='$id'";
                $result=mysqli_query($con,$query);
                if($result){
                $password="تم بنجاح";                }
            }
            }
        }
    }
  }
  if($_POST['submit']=="submit0"){
    if(empty($_POST["creche"])){
        $creche_err=" اسم الروضة اجباري";
    }else{
        if (!preg_match("#^[a-zA-Z \.,0-9]{5,}$#",$_POST["creche"])) {
        $creche_err=" اسم الروضة غير صحيح";
        }else{
            $tmp=addslashes($_POST["creche"]);
            //virifi que l'email est unique dans la base de donne
            $query="SELECT id FROM creche WHERE nom='$tmp'";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                $creche_err="هذا الاسم مستعمل";
            }else{
                $ucreche=trim(addslashes($_POST["creche"]));
                $query="UPDATE `creche` SET nom='$ucreche' WHERE id='$id'";
                $result=mysqli_query($con,$query);
                if($result){
                    $creche=stripslashes($ucreche);
                }
            }
        }
    }
  }
  if($_POST['submit']=="submit3"){
    if(empty($_POST["cadr"])){
        $adr_err=" العنوان اجباري";
    }else{
        $uadr=trim(addslashes($_POST["cadr"]));
        if (!preg_match("#^[a-zA-Z \.,0-9]{5,}$#",$adr)) {
        $adr_err=" العنوان غير صحيح";
        }else{
            $query="UPDATE `creche` SET adr='$uadr' WHERE id='$id'";
            $result=mysqli_query($con,$query);
            if($result){
                $adr=stripslashes($uadr);
            }
        }
    }

  }
  if($_POST['submit']=="submit4"){
    if(empty($_POST["cville"])){
        $ville_err="الولاية اجباري";
    }else{
        $uville=addslashes($_POST["cville"]);
        $query="UPDATE `creche` SET willaya='$uville' WHERE id='$id'";
        $result=mysqli_query($con,$query);
        if($result){
            $ville=stripslashes($uville);
        }
    }    
  }
  if($_POST['submit']=="submit5"){
    if(empty(trim($_POST["ctel"]))){
        $tel_err="رقم الهاتغ اجباري";
    }else{
        if (!preg_match("#^[0-9]{9,10}$#",$_POST["ctel"])) {
        $tel_err=" رقم الهاتف غير صحيح";
        }else{
            $tmp=addslashes($_POST["ctel"]);
            //virifi que l'email est unique dans la base de donne
            $query="SELECT id FROM creche WHERE tel='$tmp'";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                $tel_err="هذا الرقم مستعمل";
            }else{
                $utel=trim(addslashes($_POST["ctel"]));
                $query="UPDATE `creche` SET tel='$utel' WHERE id='$id'";
                $result=mysqli_query($con,$query);
                if($result){
                    $tel=stripslashes($utel);
                }
            }
        }
    }      
  }
  /*if($_POST['submit']=="submit6"){
    if(empty($_POST["cposte"])){
        $codepostal_err="الحساب المصرفي اجباري";
    }else{
        if (!preg_match("#^[0-9]{10} [0-9]{2}$#",$_POST["cposte"])) {
        $codepostal_err=" الحساب المصرفي غير صحيح";
        }else{
            $tmp=$_POST["cposte"];
            //virifi que l'email est unique dans la base de donne
            $query="SELECT id FROM creche WHERE code_postal='$tmp'";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                $codepostal_err="هذا الحساب مستعمل";
            }else{
                $ucodepostal=$_POST["cposte"];
                $query="UPDATE `creche` SET code_postal='$ucodepostal' WHERE id='$id'";
                $result=mysqli_query($con,$query);
                if($result){
                    $codepostal=$ucodepostal;
                }
            }
        }
    }
      
  }*/
  if($_POST['submit']=="submit7"){
    if(empty($_POST["crechestatus"])){
        $crechestatus_err="نوع المؤسسة اجباري";
    }else{
        $ucrechestatus=addslashes($_POST["crechestatus"]);
        $query="UPDATE `creche` SET status='$ucrechestatus' WHERE id='$id'";
        $result=mysqli_query($con,$query);
        if($result){
            $crechestatus=stripslashes($ucrechestatus);
        }
    }     
  }
  if($_POST['submit']=="submit8"){
    $file=$_FILES['glogo']['tmp_name'];
    if(!isset($file)){
        $file_err="يرجى ادخال صورة";
    }else{
        $image_size=getimagesize($_FILES['glogo']['tmp_name']);
        if($image_size==FALSE){
        $file_err="هذه ليس صورة";
        }else{
        $uimage=addslashes(file_get_contents($_FILES['glogo']['tmp_name']));
        $query="UPDATE `creche` SET logo='$uimage' WHERE id='$id'";
        $result=mysqli_query($con,$query);
        if($result){
            $image=$uimage;
        }
        }
    }
  }
    if($_POST['submit']=="submit10"){
      if(empty($_POST['description'])){
        $description_err="يرجى ادخال الوصف";
      }else{
          $udescription=addslashes($_POST['description']);
        $query="UPDATE `creche` SET description='$udescription' WHERE id='$id'";
        $result=mysqli_query($con,$query);
        if($result){
            $description=stripslashes($udescription);
        }
      }

  }
  if($_POST['submit']=="submit11"){
      if(empty($_POST['facebook'])){
          $facebook_err="error";
      }else{
          if(!preg_match("#^(https://www.facebook.com/)([a-zA-Z0-9\.]*)$#",$_POST['facebook'])){
              $facebook_err="error1";
          }else{
               $ufacebook=addslashes($_POST['facebook']);
        $query="UPDATE `creche` SET facebook='$ufacebook' WHERE id='$id'";
        $result=mysqli_query($con,$query);
        if($result){
            $facebook=$ufacebook;
        }
          }
      }
  }
  if($_POST['submit']=="submit12"){
      if(empty($_POST['google'])){
          $google_err="";
      }else{
          if(!preg_match("#^(https://plus.google.com/)([a-zA-Z0-9\.]*)$#",$_POST['google'])){
              $google_err="";
          }else{
               $ugoogle=addslashes($_POST['google']);
        $query="UPDATE `creche` SET google='$ugoogle' WHERE id='$id'";
        $result=mysqli_query($con,$query);
        if($result){
            $google=$ugoogle;
        }
          }
      }
  }


  
}

  
  
  
  //virification du code postal
 
?>
<div>
<div class="contentn" style="background:white;margin-top:40px;">
    <h1>الاعدادات</h1>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
            <!--<div class="form-group">
                    <label class="control-label col-sm-2" for="creche">اسم الروضة <span><?php //echo $creche;?></span><a href="javascript:void(0)" onclick="affice();">edit</a></label>
                    <div class="col-sm-10">
                       <input type="text" pattern="^[a-zA-Z \.0-9]{5,}$" style="display:none" class="form-control" id="creche" name="creche" placeholder="اسم الروضة"  required>
                       <div class="help-block with-errors"><?php //echo $creche_err;?></div>
                    </div>  
            </div>-->
            <table class="table table-hover">
                <!--la modification du nom de la creche-->
                <tr>
                    <td>
                        <label class="control-label" for="creche">اسم الروضة</label>
                    </td>
                    <td>
                        <p class="affiche" style="<?php if(!empty($creche_err)) echo "display:none;"; ?>"><?php echo htmlspecialchars(stripslashes($creche)); ?></p>
                        <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($creche_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(0);">&times;</a>
                            <div class="form-group" >
                                <div class="col-xs-12">
                                    <input type="text" pattern="^[a-zA-Z \.0-9]{5,}$"  class="form-control" value="<?php echo htmlspecialchars(stripslashes($creche)); ?>" id="creche" name="creche" placeholder="اسم الروضة"  required>
                                    <div class="help-block with-errors"><?php echo $creche_err;?></div>
                                </div>  
                            </div>
                            <div class="form-group" style="text-align:right;">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" value="submit0" class="btn btn-primary btn-sm">تاكيد</button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td><a href="javascript:void(0)" onclick="affiche(0);">تغير</a></td>
                </tr>
                <!--modification du email de la creche-->
                <tr>
                    <td>
                        <label class="control-label" for="email">البريد الالكتروني</label>
                    </td>
                    <td>
                        <p class="affiche" style="<?php if(!empty($email_err)) echo "display:none;"; ?>"><?php echo htmlspecialchars(stripslashes($email)); ?></p>
                        
                        <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($email_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(1);">&times;</a>
                            <div class="form-group" >
                                <div class="col-xs-12">
                                    <input type="email" class="form-control" value="<?php echo htmlspecialchars(stripslashes($email)); ?>" id="email" name="cemail"  placeholder="البريد الالكتروني"  data-error="هذا البريد الالكتروني غير صحيح" required>
                                    <div class="help-block with-errors"><?php echo $email_err;?></div>
                                </div>  
                            </div>
                            <div class="form-group" style="text-align:right;">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" value="submit1" class="btn btn-primary btn-sm">تاكيد</button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td><a href="javascript:void(0)" onclick="affiche(1);">تغير</a></td>
                </tr>
                <!--modification du mot de passe-->
                <tr>
                    <td>
                        <label class="control-label" for="pwd">كلمة السر</label>
                    </td>
                    <td>
                        <p class="affiche">************<?php  if(!empty($password)) echo "( ".$password." )"; ?></p>
                        <form  class="form-horizontal open" role="form" style="display:none" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(2);">&times;</a>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <input type="password"  data-minlength="6" class="form-control" name="pass" id="pwd"  placeholder="كلمة السر الحالية" required>
                                    <div class="help-block with-errors"><?php echo $password_err;?></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <input type="password"  data-minlength="6" class="form-control" name="cpass" id="pwd1"  placeholder="كلمة السر الجديدة" required>
                                    <div class="help-block with-errors"><?php echo $password_err;?></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">
                                <input type="password" class="form-control" id="cpwd" name="ccpass" data-match="#pwd1" data-match-error="اسف, لكن كلمة السر غير متشابهة" placeholder="تاكيد كلمة السر" required>
                                <div class="help-block with-errors"><?php echo $passwordconfig_err;?></div>
                                </div>
                            </div>
                            <div class="form-group" style="text-align:right;">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" value="submit2" class="btn btn-primary btn-sm">تاكيد</button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td><a href="javascript:void(0)" onclick="affiche(2);">تغير</a></td>
                </tr>
                <!--modification of adresse-->
                <tr>
                    <td>
                        <label class="control-label" for="adr">العنوان</label>
                    </td>
                    <td>
                        <p class="affiche" style="<?php if(!empty($adr_err)) echo "display:none;"; ?>"><?php echo htmlspecialchars(stripslashes($adr)); ?></p>
                        <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($adr_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(3);">&times;</a>
                            <div class="form-group" >
                                <div class="col-xs-12">
                                    <input type="email" class="form-control" value="<?php echo htmlspecialchars(stripslashes($adr)); ?>" id="adr" name="cadr"  placeholder="العنوان"  data-error="هذا البريد الالكتروني غير صحيح" required>
                                    <div class="help-block with-errors"><?php echo $adr_err;?></div>
                                </div>  
                            </div>
                            <div class="form-group" style="text-align:right;">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" value="submit3" class="btn btn-primary btn-sm">تاكيد</button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td><a href="javascript:void(0)" onclick="affiche(3);">تغير</a></td>
                </tr>
                <!--modification of the ville-->
                <tr>
                    <td>
                        <label class="control-label" for="ville">الولاية</label>
                    </td>
                    <td>
                        <p class="affiche" style="<?php if(!empty($ville_err)) echo "display:none;"; ?>"><?php echo htmlspecialchars(stripslashes($ville)); ?></p>
                        <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($ville_err)) echo "display:block;";?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(4);">&times;</a>
                            <div class="form-group">
                                <select class="form-control" id="ville" name="cville" required>
                                    <?php $query1="SELECT * FROM willaya";
                                        $result=mysqli_query($con,$query1);
                                        while($row1=mysqli_fetch_assoc($result)):
                                    ?>
                                    <option value="<?php echo $row1['nom'] ?>"><?php echo $row1['nom'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <div class="help-block with-errors"><?php echo htmlspecialchars(stripslashes($ville_err));?></div>
                            </div>
                            <div class="form-group" style="text-align:right;">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" value="submit4" class="btn btn-primary btn-sm">تاكيد</button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td><a href="javascript:void(0)" onclick="affiche(4);">تغير</a></td>
                </tr>                
                <!--modification du numru du tel-->
                <tr>
                    <td>
                    <label class="control-label" for="telfix">رقم الهاتف الثابت</label>
                    </td>
                    <td>
                        <p class="affiche" style="<?php if(!empty($tel_err)) echo "display:none;"; ?>"><?php echo htmlspecialchars(stripslashes($tel)); ?></p>
                        <form  class="form-horizontal open" role="form" style="display:none;;<?php if(!empty($tel_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(5);">&times;</a>
                            <div class="form-group">
                                <input type="tel" pattern="^[0-9]{9,10}$" minlenght="9" maxlength="10" value="<?php echo htmlspecialchars(stripslashes($tel));?>" class="form-control" id="telfix" name="ctel" placeholder="رقم الهاتف الثابت :   025405049"   required>
                                <div class="help-block with-errors"><?php echo $tel_err;?></div>  
                            </div>
                            <div class="form-group" style="text-align:right;">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" value="submit5" class="btn btn-primary btn-sm">تاكيد</button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td><a href="javascript:void(0)" onclick="affiche(5);">تغير</a></td>
                </tr>
                <!--modification of the code postal
                
                <tr>
                    <td>
                        <label class="control-label" for="poste">الحساب المصرفي</label>
                    </td>
                    <td>
                        <p class="affiche"  style="<?php if(!empty($codepostal_err)) echo "display:none;"; ?>direction:ltr;text-align:right;"><?php echo $codepostal; ?></p>
                        <form  class="form-horizontal open" role="form" style="display:none;;<?php if(!empty($codepostal_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(6);">&times;</a>
                            <div class="form-group">
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="poste" pattern="^[0-9]{10} [0-9]{2}$" name="cposte" value="<?php echo $codepostal;?>" placeholder="الحساب المصرفي"  required>
                                <div class="help-block with-errors"><?php echo $codepostal_err;?></div>
                                </div>
                           </div>
                            <div class="form-group" style="text-align:right;">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" value="submit6" class="btn btn-primary btn-sm">تاكيد</button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td><a href="javascript:void(0)" onclick="affiche(6);">تغير</a></td>
                </tr>-->
                <!--modification du status de creche-->
                
                  
                <tr>
                    <td>
                        <label class="control-label" for="sel1">الوضعية القانونية</label>
                    </td>
                    <td>
                        <p class="affiche"  style="<?php if(!empty($crechestatus_err)) echo "display:none;"; ?>"><?php echo htmlspecialchars(stripslashes($status)); ?></p>
                        <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($crechestatus_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(6);">&times;</a>
                            <div class="form-group">
                                <select class="form-control" id="sel1" name="crechestatus" required>
                                    <option>فردية</option>
                                    <option>جمعية</option>
                                    <option>خاصة</option>
                                    <option>عامة</option>
                                </select>
                                <div class="help-block with-errors"><?php echo $crechestatus_err; ?></div>
                            </div>
                            <div class="form-group" style="text-align:right;">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" value="submit7" class="btn btn-primary btn-sm">تاكيد</button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td><a href="javascript:void(0)" onclick="affiche(6);">تغير</a></td>
                </tr>
                <tr>
                    <td>
                        <label class="control-label" for="description">الوصف</label>
                    </td>
                    <td>
                        <p class="affiche" style="<?php if(!empty($description_err)) echo "display:none;"; ?>"><?php echo htmlspecialchars(stripslashes($description)); ?></p>
                        <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($description_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(7);">&times;</a>
                            <div class="form-group" >
                                <div class="col-xs-12">
                                    <textarea id="description" name="description" class="form-control" required>

                                    </textarea>
                                    <div class="help-block with-errors"><?php echo $description_err;?></div>
                                </div>  
                            </div>
                            <div class="form-group" style="text-align:right;">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" value="submit10" class="btn btn-primary btn-sm">تاكيد</button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td><a href="javascript:void(0)" onclick="affiche(7);">تغير</a></td>
                </tr>
                <tr>
                    <td>
                        <label class="control-label" for="facebook">facebook</label>
                    </td>
                    <td>
                        <p class="affiche" style="<?php if(!empty($facebook_err)) echo "display:none;"; ?>"><?php echo htmlspecialchars(stripslashes($facebook)); ?></p>
                        <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($facebook_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(8);">&times;</a>
                            <div class="form-group" >
                                <div class="col-xs-12">
                                    <input type="url" class="form-control" value="<?php echo htmlspecialchars(stripslashes($facebook)); ?>" id="facebook" name="facebook"  placeholder="اكتب صفحتك"  data-error="اكتب صفحتك" required>
                                    <div class="help-block with-errors"><?php echo $facebook_err;?></div>
                                </div>  
                            </div>
                            <div class="form-group" style="text-align:right;">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" value="submit11" class="btn btn-primary btn-sm">تاكيد</button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td><a href="javascript:void(0)" onclick="affiche(8);">تغير</a></td>
                </tr>
                <tr>
                    <td>
                        <label class="control-label" for="google">google</label>
                    </td>
                    <td>
                        <p class="affiche" style="<?php if(!empty($google_err)) echo "display:none;"; ?>"><?php echo htmlspecialchars(stripslashes($google)); ?></p>
                        <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($google_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(9);">&times;</a>
                            <div class="form-group" >
                                <div class="col-xs-12">
                                    <input type="url" class="form-control" value="<?php echo htmlspecialchars(stripslashes($google)); ?>" id="google" name="google"  placeholder="اكتب صفحتك"  data-error="اكتب صفحتك" required>
                                    <div class="help-block with-errors"><?php echo $google_err;?></div>
                                </div>  
                            </div>
                            <div class="form-group" style="text-align:right;">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" value="submit12" class="btn btn-primary btn-sm">تاكيد</button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td><a href="javascript:void(0)" onclick="affiche(9);">تغير</a></td>
                </tr>
                <tr>
                    <td>
                        <label class="control-label" for="file">رمز</label>
                    </td>
                    <td>
                        <p class="affiche"  style="<?php if(!empty($file_err)) echo "display:none;"; ?>direction:ltr;text-align:right;"><img src="../includes/getimage.php?id=<?php echo $id.'&type=creche'; ?>" style='width:300px;height:300px;' /></p>
                        <form  class="form-horizontal open" role="form" style="display:none;;<?php if(!empty($file_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                            <a href="javascript:void(0)" onclick="affiche2(10);">&times;</a>
                            <div class="form-group">
                                <input type="file" class="form-control text-right" id="file" name="glogo"  required />
                                <div class="help-block with-errors"><?php echo $file_err; ?></div>
                            </div>
                            <div class="form-group" style="text-align:right;">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="submit" value="submit8" class="btn btn-primary btn-sm">تاكيد</button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td><a href="javascript:void(0)" onclick="affiche(10);">تغير</a></td>
                </tr>
            </table>
    </div>

</div>
<?php include 'footer.php';

mysqli_close($con);
 ?>
<script>
    function affiche(i){
        document.getElementsByClassName("open")[i].style.display="block";
        document.getElementsByClassName("affiche")[i].style.display="none";
    }
    function affiche2(i){
        document.getElementsByClassName("open")[i].style.display="none";
        document.getElementsByClassName("affiche")[i].style.display="block";
       
    }
</script>