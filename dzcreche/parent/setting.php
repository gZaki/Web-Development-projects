<?php 
    session_start();
?>
<?php 
    include 'header.php';
require_once '../includes/bd.php';
    $id=addslashes($_SESSION['id']);
   $query="SELECT * FROM parent WHERE id='$id'";
   $result=mysqli_query($con,$query);
   $row=mysqli_fetch_assoc($result);
   //echo $row['cid']
   $name= $row['nom'];
   $email=$row['email'];
   $adr=$row['adr'];
   $ville=$row['willaya'];
   //$tel=$row['tel'];
   $date_insc=$row['date_insc'];
   $sex=$row['sex'];
   $tel=$row['tel'];
    $email_err=$password_err=$passwordconfig_err=$sex_err=$name_err=$tel_err=$adr_err=$ville_err="";
    $uemail=$upassword=$utel=$uadr=$uville=$usex=$uname="";
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
            $tmp=$_POST["cemail"];
            $query="SELECT id FROM parent WHERE email='$tmp'";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                $email_err="هذا البريد الالكتروني مستعمل";
            }else{
                $uemail=trim($_POST["cemail"]);
                $query="UPDATE `parent` SET email='$uemail' WHERE id='$id'";
                $result=mysqli_query($con,$query);
                if($result){
                    $email=$uemail;
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
                $query="UPDATE `parent` SET mot_passe='$upassword' WHERE id='$id'";
                $result=mysqli_query($con,$query);
                if($result){
                    $password="تم بنجاح";
                }
            }
            }
        }
    }
  }
  if($_POST['submit']=="submit0"){
    if(empty($_POST["name"])){
        $name_err=" الاسم اجباري";
    }else{
        if (!preg_match("#^[a-zA-Z \.,0-9]{5,}$#",$_POST["name"])) {
        $name_err="الاسم غير صحيح";
        }else{
                $uname=trim($_POST["name"]);
                $query="UPDATE `parent` SET nom='$uname' WHERE id='$id'";
                $result=mysqli_query($con,$query);
                if($result){
                    $name=$uname;
                }
        }
    }
  }
  if($_POST['submit']=="submit3"){
    if(empty($_POST["cadr"])){
        $adr_err=" العنوان اجباري";
    }else{
        $uadr=trim($_POST["cadr"]);
        if (!preg_match("#^[a-zA-Z \.,0-9]{5,}$#",$adr)) {
        $adr_err=" العنوان غير صحيح";
        }else{
            $query="UPDATE `adr` SET adr='$uadr' WHERE id='$id'";
            $result=mysqli_query($con,$query);
            if($result){
                $adr=$uadr;
            }
        }
    }

  }
  if($_POST['submit']=="submit4"){
    if(empty($_POST["cville"])){
        $ville_err="الولاية اجباري";
    }else{
        $uville=$_POST["cville"];
        $query="UPDATE `parent` SET willaya='$uville' WHERE id='$id'";
        $result=mysqli_query($con,$query);
        if($result){
            $ville=$uville;
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
            $tmp=$_POST["ctel"];
            //virifi que l'email est unique dans la base de donne
            $query="SELECT id FROM parent WHERE tel='$tmp'";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                $tel_err="هذا الرقم مستعمل";
            }else{
                $utel=trim($_POST["ctel"]);
                $query="UPDATE `parent` SET tel='$utel' WHERE cid='$id'";
                $result=mysqli_query($con,$query);
                if($result){
                    $tel=$utel;
                }
            }
        }
    }      
  }
  if($_POST['submit']=="submit7"){
    if(empty($_POST["sex"])){
        $sex_err="الجنس";
    }else{
        $usex=$_POST["sex"];
        $query="UPDATE `parent` SET sex='$usex' WHERE id='$id'";
        $result=mysqli_query($con,$query);
        if($result){
            $sex=$usex;
        }
    }     
  }


mysqli_close($con);


  
}

  
  
  
  //virification du code postal
 
?>
<div>
<div class="contentn" style="background:white;margin-top:40px;">
    <h1>الاعدادات</h1>


<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table table-hover">
                <tr>
                    <td>
                        <label class="control-label" for="name">الاسم الكامل</label>
                    </td>
                    <td>
                        <p class="affiche" style="<?php if(!empty($name_err)) echo "display:none;"; ?>"><?php echo $name; ?></p>
                        <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($name_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(0);">&times;</a>
                            <div class="form-group" >
                                <div class="col-xs-12">
                                    <input type="text" pattern="^[a-zA-Z \.0-9]{5,}$"  class="form-control" value="<?php echo $name; ?>" id="name" name="name" placeholder="الاسم الكامل"  required>
                                    <div class="help-block with-errors"><?php echo $name_err;?></div>
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
                <tr>
                    <td>
                        <label class="control-label" for="email">البريد الالكتروني</label>
                    </td>
                    <td>
                        <p class="affiche" style="<?php if(!empty($email_err)) echo "display:none;"; ?>"><?php echo $email; ?></p>
                        
                        <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($email_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(1);">&times;</a>
                            <div class="form-group" >
                                <div class="col-xs-12">
                                    <input type="email" class="form-control" value="<?php echo $email; ?>" id="email" name="cemail"  placeholder="البريد الالكتروني"  data-error="هذا البريد الالكتروني غير صحيح" required>
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
                <tr>
                    <td>
                        <label class="control-label" for="adr">العنوان</label>
                    </td>
                    <td>
                        <p class="affiche" style="<?php if(!empty($adr_err)) echo "display:none;"; ?>"><?php echo $adr; ?></p>
                        <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($adr_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(3);">&times;</a>
                            <div class="form-group" >
                                <div class="col-xs-12">
                                    <input type="email" class="form-control" value="<?php echo $adr; ?>" id="adr" name="cadr"  placeholder="العنوان"  data-error="هذا البريد الالكتروني غير صحيح" required>
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
                <tr>
                    <td>
                        <label class="control-label" for="ville">الولاية</label>
                    </td>
                    <td>
                        <p class="affiche" style="<?php if(!empty($ville_err)) echo "display:none;"; ?>"><?php echo $ville; ?></p>
                        <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($ville_err)) echo "display:block;";?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(4);">&times;</a>
                            <div class="form-group">
                                <select class="form-control" id="ville" name="cville" required>
                                    <option>فردية</option>
                                    <option>جمعية</option>
                                    <option>خاصة</option>
                                    <option>عامة</option>
                                </select>
                                <div class="help-block with-errors"><?php echo $ville_err;?></div>
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
                <tr>
                    <td>
                    <label class="control-label" for="telfix">رقم الهاتف الثابت</label>
                    </td>
                    <td>
                        <p class="affiche" style="<?php if(!empty($tel_err)) echo "display:none;"; ?>"><?php echo $tel; ?></p>
                        <form  class="form-horizontal open" role="form" style="display:none;;<?php if(!empty($tel_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(5);">&times;</a>
                            <div class="form-group">
                                <input type="tel" pattern="^[0-9]{9,10}$" minlenght="9" maxlength="10" value="<?php echo $tel;?>" class="form-control" id="telfix" name="ctel" placeholder="رقم الهاتف الثابت :   025405049"   required>
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
                <tr>
                    <td>
                         <label class="control-label" for="sel1">الجنس</label>
                    </td>
                    <td>
                        <p class="affiche"  style="<?php if(!empty($sex_err)) echo "display:none;"; ?>"><?php echo $sex; ?></p>
                        <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($sex_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <a href="javascript:void(0)" onclick="affiche2(6);">&times;</a>
                            <div class="form-group">
                                <select class="form-control" id="sel1" name="gsex" required>
                                    <option>ذكر</option>
                                    <option>انثى</option>
                                </select>
                                <div class="help-block with-errors"><?php echo $sex_err;?></div>
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
            </table>
    </div>

</div>
<?php //include 'footer.php'; ?>
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