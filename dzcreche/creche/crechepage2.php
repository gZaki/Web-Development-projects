<?php 
    session_start();

require_once '../includes/bd.php';

if(isset($_SESSION)){
 if(isset($_SESSION['type']) and $_SESSION['type']=="creche"){
       $id=$_SESSION['id'];
       $query="SELECT * FROM creche WHERE id='{$_SESSION['id']}'";
       $horaires_err=$espace_exterieur_err=$Age_accueil_err=$Fermetures_annuelles_err=$description_err=$capacite_err="";
       $uhoraires=$uespace_exterieur=$uAge_accueil=$uFermetures_annuelles=$udescription=$ucapacite="";
    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($result);
    $horaires=stripslashes($row['horaires']);
    $espace_exterieur=stripslashes($row['espace_exterieur']);
    $Age_accueil=stripslashes($row['Age_accueil']);
    $Fermetures_annuelles=stripslashes($row['Fermetures_annuelles']);
    $capacite=stripslashes($row['capacite']);
    $description=stripslashes($row['description']);
    $type=$row['type'];
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST['submit']=="submit1"){
            if(empty($_POST["horaires"])){
                $horaires_err="يرجى ادخال اوقات العمل";
            }else{
                $uhoraires=addslashes(trim($_POST["horaires"]));
                    $query="UPDATE `creche` SET horaires='$uhoraires' WHERE id='$id'";
                    $result=mysqli_query($con,$query);
                    if($result){
                        $horaires=stripslashes($uhoraires);
                    }
            }

        }
        if($_POST['submit']=="submit2"){
            if(empty($_POST["espace_exterieur"])){
                $espace_exterieur_err=" يرجى ادخال وصف";
            }else{
                $uespace_exterieur=addslashes(trim($_POST["espace_exterieur"]));
                    $query="UPDATE `creche` SET espace_exterieur='$uespace_exterieur' WHERE id='$id'";
                    $result=mysqli_query($con,$query);
                    if($result){
                        $espace_exterieur=stripslashes($uespace_exterieur);
                    }
            }

        }
        
        if($_POST['submit']=="submit3"){
            if(empty($_POST["Age_accueil"])){
                $Age_accueil_err=" يرجى ادخال وصف";
            }else{
                $uAge_accueil=addslashes(trim($_POST["Age_accueil"]));
                    $query="UPDATE `creche` SET Age_accueil='$uAge_accueil' WHERE id='$id'";
                    $result=mysqli_query($con,$query);
                    if($result){
                        $Age_accueil=stripslashes($uAge_accueil);
                    }
            }

        }

        if($_POST['submit']=="submit4"){
            if(empty($_POST["Fermetures_annuelles"])){
                $Fermetures_annuelles_err=" يرجى ادخال وصف";
            }else{
                $uFermetures_annuelles=addslashes(trim($_POST["Fermetures_annuelles"]));
                    $query="UPDATE `creche` SET Fermetures_annuelles='$uFermetures_annuelles' WHERE id='$id'";
                    $result=mysqli_query($con,$query);
                    if($result){
                        $Fermetures_annuelles=stripslashes($uFermetures_annuelles);
                    }
            }

        }

        if($_POST['submit']=="submit5"){
            if(empty($_POST["capacite"])){
                $capacite_err=" يرجى ادخال وصف";
            }else{
                $ucapacite=addslashes(trim($_POST["capacite"]));
                    $query="UPDATE `creche` SET capacite='$ucapacite' WHERE id='$id'";
                    $result=mysqli_query($con,$query);
                    if($result){
                        $capacite=stripslashes($ucapacite);
                    }
            }

        }

        if($_POST['submit']=="submit6"){
            if(empty($_POST["description"])){
                $description_err=" يرجى ادخال وصف";
            }else{
                $udescription=addslashes(trim($_POST["description"]));
                    $query="UPDATE `creche` SET description='$udescription' WHERE id='$id'";
                    $result=mysqli_query($con,$query);
                    if($result){
                        $description=stripslashes($udescription);
                    }
            }

        }
          if ($_POST["submit"]=="submit8"){
            $file=$_FILES['glogo']['tmp_name'];
            $Target="Upload/".time().basename($_FILES["glogo"]["name"]);
        if(!isset($file)){
            $file_err="يرجى ادخال صورة";
        }else{
            $image_size=getimagesize($_FILES['glogo']['tmp_name']);
            if($image_size==FALSE){
                $file_err="هذه ليس صورة";
            }else{
                $query="SELECT COUNT(*) FROM image_creche WHERE id_creche='$id";
                $result=mysqli_query($con,$query);
                if($result){
                $row1=mysqli_fetch_array($result);
                $total=array_shift($row1);}else $total=0;
                if($type=='silver') $im=5;
                else $im=15;
                if($total>=$im){
                    echo "<script>alert('$im photo is your limit');</script>";
                }else{
                $image=time().$_FILES['glogo']['name'];
                $query="INSERT INTO `image_creche`(`nom`, `id_creche`) VALUES('{$image}','$id')";
                $Execute=mysqli_query($con,$query);
                move_uploaded_file($_FILES["glogo"]["tmp_name"],$Target);
                }
            }
        }
         }
         if($_POST["submit"]=="delete"){
             $query="DELETE FROM image_creche WHERE nom='{$_POST['delete']}'";
             $result=mysqli_query($con,$query);
         }
    }
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
        <script>

    $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-body #id_p').val(recipient)
})
</script>
 <script>
    function affiche(i){
        document.getElementsByClassName("open")[i].style.display="block";
        document.getElementsByClassName("affiche")[i].style.display="none";
    }
    function affiche2(i){
        document.getElementsByClassName("open")[i].style.display="none";
        document.getElementsByClassName("affiche")[i].style.display="block";
       
    }
    document.getElementById("uploadBtn").onchange = function () {
document.getElementById("uploadFile").value = this.value;
};
</script>


    <!-- Custom CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="margin-top: 0px;width: 65%;height: 100%;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="text-align:right">تغير الصور</h5>
            <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body col-container">
               <?php 
      $query="SELECT * FROM image_creche WHERE id_creche='$id'";
                $result=mysqli_query($con,$query);
                if (mysqli_num_rows($result) > 0) {
                $row=mysqli_fetch_assoc($result);
                ?>  
                  <?php   while($row=mysqli_fetch_assoc($result)):?>         
    <div class="col" style="width:150px;">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="hidden" name="delete" value="<?php echo $row['nom']; ?>" />
            <button type="submit" name="submit" value="delete" class="close pull-left">
              <span aria-hidden="true">&times;</span>
            </button>
        </form>
      <img src="Upload/<?php echo $row['nom']; ?>" style="width:100%;height: 150px;" alt="creche images silder">
    </div>
                 <?php endwhile; } ?>
                 <form  class="form-horizontal open" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <div class="fileUpload">
            <span class="custom-span">+</span>
            <p class="custom-para">اضف صورة</p>
            <input id="uploadBtn" type="file" name="glogo" class="upload" />
        </div>
        <input id="uploadFile" placeholder="0 files selected" disabled="disabled" />
    </div>    
    <div class="form-group center-block" style="margin:auto">
        <div class="col-sm-10">
                <button type="submit" name="submit" value="submit8" class="btn btn-primary btn-sm">تاكيد</button>
        </div>
    </div>
</form>
          </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق النافذة</button>
          </div>

        </div>
      </div>
    </div>
  <!-- Content here --> 
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div>
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="<?php if(isset($_SESSION) and $_SESSION['type']=='creche') echo 'index.php'; else echo '../index.php'; ?>"><span style="color:rgb(223,90,71);">D</span><span style="color:rgb(154,175,74);">Z</span> <span style="color:rgb(255,167,45);">C</span><span style="color:rgb(217,75,71);">r</span><span style="color:rgb(72,176,207);">è</span><span style="color:rgb(223,90,71);">c</span><span style="color:rgb(72,176,207);">h</span><span style="color:rgb(71,170,106);">e</sapn></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav nav-pills nav-justified">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown text-uppercase" data-toggle="dropdown" href="#" rol="toggle">حسابي</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="setting.php">المعلومات<i class="fa fa-cog" aria-hidden="true" style="float:right"></i></a>
                <a class="dropdown-item" href="crechepage2.php"> صفحتي</a>

                <a class="dropdown-item" href="store/index.php">المتجر</a>
                <a class="dropdown-item" href="crechepage.php"> اراء الزبائن</a>

                <a class="dropdown-item" href="../deconnection.php"> الخروج<i class="fa fa-sign-out" aria-hidden="true" style="float:right"></i></a>
            </div>
        </li>
        <li class="nav-item"><a href="recurtement.php" class="nav-link text-uppercase">طلبات الخدمة</a></li>
        <li class="nav-item"><a href="demade.php" class="nav-link text-uppercase">طلبات الالتحاق</a></li> 
        <li class="nav-item"><a href="message.php" class="nav-link text-uppercase">رسائلي</a></li> 
      </ul>
    </div>
  </div>
</nav>
<main role="main" id="content" style="padding:60px;">
            <div class="container-fluid creche-detail nopadding">
    <div class="container">
        <div class="row">
                        
            </div>
            
            <div id="block-creche-2289" class="col-xs-12 col-md-6 nopaddingleft" data-link="/creche/helicie/992289?from=liste" data-adresse="16 rue du Général de Gaulle"  data-ville="Brumath" data-codepostal="67170" >
                
                <h1><?php echo htmlspecialchars(stripslashes($row['nom'])); ?></h1>

                
                
                <div itemprop="contactPoints" class="adresse">
                        <adr>
                            <?php echo htmlspecialchars(stripslashes($row['adr'])); ?>

                        </adr>
                </div>

                <!--<div class="label-creche">
                    <a href="/qui-sommes-nous"><img height="133" width="88" src="" alt="Logo La Belle Crèche Engagée"></a>                    <img width="90" height="87" src="" alt="Logo Crèche Solidarité Emploi">                </div>-->
                <hr class="sepa-label"/>
                <ul class="infos-creche">
                    <li>
                                                    <div class="img-info"><img src="images/ico-creche-horaires-orange.svg" alt="Horaires d'ouverture de la crèche Hélicie" title="Horaires d'ouverture de la crèche Hélicie"></div>
                            <div class="info">
                                <div class="title">اوقات العمل</div>
                                <div>
                                    <table class="table"  style="direction: rtl;">
                                        <tr>
                                            <td>
                                                <p class="affiche" style="<?php if(!empty($horaires_err)) echo "display:none;"; ?>"><?php echo htmlspecialchars(stripslashes($horaires)); ?></p>
                                                
                                                <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($horaires_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                                    <a href="javascript:void(0)" onclick="affiche2(1);">&times;</a>
                                                    <div class="form-group" >
                                                        <div class="col-xs-12">
                                                            <textarea type="text" class="form-control" value="<?php echo htmlspecialchars(stripslashes($horaires)); ?>" id="horaires" name="horaires"  placeholder="اوقات العمل" required></textarea>
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
                                    </table>      
                                </div>
                            </div>
                                            </li>

                    <li>
                                                    <div class="img-info"><img src="images/ico-creche-jardin-orange.svg" alt="Crèche avec Espace extérieur" title="Crèche avec Espace extérieur"></div>
                            <div class="info">
                                <div class="title">المساحة الخارجية</div>
                                <div>
                                    <table class="table" style="direction: rtl;">
                                        <tr>
                                            <td>
                                                <p class="affiche" style="<?php if(!empty($espace_exterieur_err)) echo "display:none;"; ?>"><?php echo htmlspecialchars(stripslashes($espace_exterieur)); ?></p>
                                                
                                                <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($espace_exterieur_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                                    <a href="javascript:void(0)" onclick="affiche2(2);">&times;</a>
                                                    <div class="form-group" >
                                                        <div class="col-xs-12">
                                                            <textarea type="text" class="form-control" value="<?php echo htmlspecialchars(stripslashes($espace_exterieur)); ?>" id="espace_exterieur" name="espace_exterieur"  placeholder="المساحة الخارجية" required></textarea>
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
                                    </table>   
                                </div>
                            </div>
                                            </li>

                    <li>
                                            </li>

                    <li>
                        <div class="img-info"><img src="images/ico-creche-age-orange.svg" alt="Age d'accueil de la crèche Hélicie" title="Age d'accueil de la crèche Hélicie"></div>
                        <div class="info">
                            <div class="title">اعمار القبول</div>
                            <div>
                                
                                    <table class="table" style="direction: rtl;">
                                        <tr>
                                            <td>
                                                <p class="affiche" style="<?php if(!empty($Age_accueil_err)) echo "display:none;"; ?>"><?php echo htmlspecialchars(stripslashes($Age_accueil)); ?></p>
                                                
                                                <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($Age_accueil_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                                    <a href="javascript:void(0)" onclick="affiche2(3);">&times;</a>
                                                    <div class="form-group" >
                                                        <div class="col-xs-12">
                                                            <textarea type="text" class="form-control" value="<?php echo htmlspecialchars(stripslashes($Age_accueil)); ?>" id="Age_accueil" name="Age_accueil"  placeholder="اعمار القبول" required></textarea>
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
                                    </table>
                            </div>
                        </div>
                    </li>

                    <li>
                                                    <div class="img-info"><img src="images/ico-creche-fermetures-orange.svg" alt="Fermetures annuelles de la crèche Hélicie" title="Fermetures annuelles de la crèche Hélicie"></div>
                            <div class="info">
                                <div class="title">العطلة السنوية</div>
                                <div>
                                    <table class="table" style="direction: rtl;">
                                        <tr>
                                            <td>
                                                <p class="affiche" style="<?php if(!empty($Fermetures_annuelles_err)) echo "display:none;"; ?>"><?php echo htmlspecialchars(stripslashes($Fermetures_annuelles)); ?></p>
                                                
                                                <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($Fermetures_annuelles_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                                    <a href="javascript:void(0)" onclick="affiche2(4);">&times;</a>
                                                    <div class="form-group" >
                                                        <div class="col-xs-12">
                                                            <textarea type="text" class="form-control" value="<?php echo htmlspecialchars(stripslashes($Fermetures_annuelles)); ?>" id="Fermetures_annuelles" name="Fermetures_annuelles"  placeholder="العطلة السنوية" required></textarea>
                                                        </div>  
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
                                    </table>
                                </div>
                            </div>
                                            </li>

                    <li>
                                                    <div class="img-info"><img src="images/ico-creche-capacite-orange.svg" alt="Capacité de la crèche Hélicie" title="Capacité de la crèche Hélicie"></div>
                            <div class="info">
                                <div class="title">قدرة التحمل</div>
                                <div>
                                    <table class="table" style="direction: rtl;">
                                        <tr>
                                            <td>
                                                <p class="affiche" style="<?php if(!empty($capacite_err)) echo "display:none;"; ?>"><?php echo htmlspecialchars(stripslashes($capacite)); ?></p>
                                                
                                                <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($capacite_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                                    <a href="javascript:void(0)" onclick="affiche2(5);">&times;</a>
                                                    <div class="form-group" >
                                                        <div class="col-xs-12">
                                                            <textarea type="text" class="form-control" value="<?php echo htmlspecialchars(stripslashes($capacite)); ?>" id="capacite" name="capacite"  placeholder="قدرة التحمل" required></textarea>
                                                        </div>  
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
                                    </table>
                                </div>
                            </div>
                                            </li>
                </ul>

                <div class="description-creche container-wysiwyg">
                                                                <h2>La crèche</h2>
                                    <table class="table" style="direction: rtl;">
                                        <tr>
                                            <td>
                                                <p class="affiche" style="<?php if(!empty($description_err)) echo "display:none;"; ?>text-align: justify;"><?php echo htmlspecialchars(stripslashes($description)); ?></p>
                                                
                                                <form  class="form-horizontal open" role="form" style="display:none;<?php if(!empty($description_err)) echo "display:block;"; ?>" data-toggle="validator" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                                    <a href="javascript:void(0)" onclick="affiche2(6);">&times;</a>
                                                    <div class="form-group" >
                                                        <div class="col-xs-12">
                                                            <textarea type="text" class="form-control" value="<?php echo htmlspecialchars(stripslashes($description)); ?>" id="description" name="description"  placeholder="قدرة التحمل" required></textarea>
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
                                        </tr>
                                    </table>
<br />
<br />
<div id="myCarouselcomment" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->

  <!-- Wrapper for slides -->
  <div class="carousel-inner" style="width: 250px;height:200px;margin:auto;">
      <?php 
       $query="SELECT * FROM commentaire_creche WHERE id_creche='$id'";
                $result=mysqli_query($con,$query);
                if (mysqli_num_rows($result) > 0) {
                    $row=mysqli_fetch_assoc($result)?>
                        <div class="item active" style="direction:rtl;">
                            <?php 
                               $query1="SELECT * FROM parent WHERE id='{$row['id_parent']}'";
                               $result1=mysqli_query($con,$query1);
                               $row1=mysqli_fetch_assoc($result1);

                             ?>
                            <p>بتاريخ <?php echo htmlspecialchars(stripslashes($row['date_ecrire'])); ?></p>
                            <p> <?php echo htmlspecialchars(stripslashes($row['message'])); ?></p>
                            <p>من طرف <?php echo htmlspecialchars(stripslashes($row1['nom'])); ?></p>
                        </div>   
    
                  <?php   while($row=mysqli_fetch_assoc($result)):?>         
<div class="item">
                            <?php 
                               $query1="SELECT * FROM parent WHERE id='{$row['id_parent']}'";
                               $result1=mysqli_query($con,$query1);
                               $row1=mysqli_fetch_assoc($result1);
                             ?>
                            <p>بتاريخ <?php echo htmlspecialchars(stripslashes($row['date_ecrire'])); ?></p>
                            <p> <?php echo htmlspecialchars(stripslashes($row['message'])); ?></p>
                            <p>من طرف <?php echo htmlspecialchars(stripslashes($row1['nom'])); ?></p>
                        </div> 
                 <?php endwhile; }else{?>
                         <div class="item active" style="width:100%;">
                         <p>ليس هناك اي اراء</p>
    </div>
                <?php } ?>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarouselcomment" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" style="color:#d13130;"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarouselcomment" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" style="color:#d13130;"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<br />
<br />
 <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $row1['id']; ?>">تغير الصور</button>
                 </div>
            </div>

            <div class="col-xs-12 col-md-6 nopaddingright">
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->

  <!-- Wrapper for slides -->
  <div class="carousel-inner" style="width: 570px;height:400px;">
      <?php 
      $query="SELECT * FROM image_creche WHERE id_creche='$id'";
                $result=mysqli_query($con,$query);
                if (mysqli_num_rows($result) > 0) {
                $row=mysqli_fetch_assoc($result);
                ?>  
    <div class="item active" style="width:100%;">
      <img src="Upload/<?php echo $row['nom']; ?>" style="width:100%;" alt="Los Angeles">
    </div>
                  <?php   while($row=mysqli_fetch_assoc($result)):?>         
    <div class="item" style="width:100%;">
      <img src="Upload/<?php echo $row['nom']; ?>" style="width:100%;" alt="Los Angeles">
    </div>
                 <?php endwhile; }else{?>
                         <div class="item active" style="width:100%;">
      <img src="images/20986459_127614434449815_255473107_n.png" style="width:100%;" alt="Los Angeles">
    </div>
                <?php } ?>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" style="color:#d13130;"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" style="color:#d13130;"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
                
                <div class="left map hidden-md-down" id="map" style="margin-top:50px;"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d802.0058467056176!2d2.839012937974831!3d36.4811512168655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128f0c0d1d4fd76b%3A0xdc7a5b3de089d588!2z2YXYs9is2K8g2KfZhNit2YLYjCDYtNin2LHYuSDZitmI2LPZgdmKINi52KjYryDYp9mE2YLYp9iv2LHYjCBCbGlkYQ!5e0!3m2!1sfr!2sdz!4v1503351836866" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></div>

                                <hr class="sepa-label">
                
                
            </div>
        </div>
    </div>
</div>
        </main>

       <?php 
   }} include'footer.php'; ?>