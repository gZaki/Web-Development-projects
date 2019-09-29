<?php 
    session_start();

require_once 'includes/bd.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id=$_SESSION['id'];
    $commentaire=$_POST['comment'];
    $id_creche=$_POST['submit'];
    $query="INSERT INTO commentaire_creche (`message`, `date_ecrire`, `id_parent`, `id_creche`) VALUES ('$commentaire',NOW(),'$id','$id_creche')";
    $result=mysqli_query($con,$query);
}
if(isset($_GET['id'])){ 

    $id=$_GET['id'];
    if(!isset($_SESSION['id'])){
        ///header("Location: moncompt.php");
    }

    $id=$_GET['id'];
    $query="SELECT * FROM creche WHERE id='$id'";
    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($result);
    $type=$row['type'];
    $horaires=stripslashes($row['horaires']);
    $espace_exterieur=stripslashes($row['espace_exterieur']);
    $Age_accueil=stripslashes($row['Age_accueil']);
    $Fermetures_annuelles=stripslashes($row['Fermetures_annuelles']);
    $capacite=stripslashes($row['capacite']);
    $description=stripslashes($row['description']);
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
    <link  href="../creche/css/swiper.min.css" rel="stylesheet" type="text/css">
<link href="../creche/css/cpt.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.css" />
    <link href="../images/CrechesDZLogo .ico" rel="icon" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="js/query.dotdotdot.min.js"></script>
        <script>

    $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-body #id_c').val(recipient)
})
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
            <h5 class="modal-title" id="exampleModalLabel" style="text-align:right">رسالة</h5>
            <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <form action="crechepage2.php?id=<?php echo $id; ?>" method="post">
          <div class="modal-body">
                    <div class="form-group">
                    <textarea name="comment" class="form-control" placeholder="اكتب رئيك" ></textarea>
                    </div>
          </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق النافذة</button>
            <button type="submit" name="submit" value="<?php echo $id; ?>" class="btn btn-primary">ارسال</button>
          </div>
        </form>

        </div>
      </div>
    </div>
  <!-- Content here --> 
  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div>
    <div class="navbar-header pull-right">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php"><span style="color:rgb(223,90,71);">D</span><span style="color:rgb(154,175,74);">Z</span> <span style="color:rgb(255,167,45);">C</span><span style="color:rgb(217,75,71);">r</span><span style="color:rgb(72,176,207);">è</span><span style="color:rgb(223,90,71);">c</span><span style="color:rgb(72,176,207);">h</span><span style="color:rgb(71,170,106);">e</sapn></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav nav-pills nav-justified">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown text-uppercase" data-toggle="dropdown" href="#" rol="toggle">تسجيل الدخول</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="creche/identificationPage.php"><img src="images/picto_espace_privée.png" alt="" />  مساحة خاصة للحضانة</a>
                <a class="dropdown-item" href="parent/moncompt.php"><img src="images/picto_compte_parent.png" alt="" />  انا اب</a>
                <a class="dropdown-item" href="gestionnaire/gestionnaire.php"><img src="images/picto_gestionnaire.png" alt="" /> انا مؤسسة </a>
            </div>
        </li>
        <li class="nav-item"><a href="rechecher.php" class="nav-link text-uppercase">البحث عن روضة او مركز</a></li>
        <li class="nav-item"><a href="blog.php" class="nav-link text-uppercase">طفلي 365</a></li> 
        <li class="nav-item"><a href="contact.php" class="nav-link text-uppercase">تواصل معنا</a></li> 
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
                
                <h1><?php echo $row['nom']; ?></h1>

                
                
                <div itemprop="contactPoints" class="adresse">
                        <adr>
                            <?php echo $row['adr']; ?>

                        </adr>
                </div>

                
                <hr class="sepa-label"/>
                <ul class="infos-creche">
                    <li>
                                                    <div class="img-info"><img src="creche/images/ico-creche-horaires-orange.svg" alt="Horaires d'ouverture de la crèche Hélicie" title="Horaires d'ouverture de la crèche Hélicie"></div>
                            <div class="info">
                                <div class="title">اوقات العمل</div>
                                <div>
                                                <p class="affiche" style=""><?php echo $horaires; ?></p>
                                                  
                                </div>
                            </div>
                                            </li>

                    <li>
                                                    <div class="img-info"><img src="creche/images/ico-creche-jardin-orange.svg" alt="Crèche avec Espace extérieur" title="Crèche avec Espace extérieur"></div>
                            <div class="info">
                                <div class="title">المساحة الخارجية</div>
                                <div>
                                                <p class="affiche" style=""><?php echo $espace_exterieur; ?></p>
                                               
                                </div>
                            </div>
                                            </li>

                    <li>
                                            </li>

                    <li>
                        <div class="img-info"><img src="creche/images/ico-creche-age-orange.svg" alt="Age d'accueil de la crèche Hélicie" title="Age d'accueil de la crèche Hélicie"></div>
                        <div class="info">
                            <div class="title">اعمار القبول</div>
                            <div>
                                
                                                <p class="affiche" style=""><?php echo $Age_accueil; ?></p>
                                            
                            </div>
                        </div>
                    </li>

                    <li>
                                                    <div class="img-info"><img src="creche/images/ico-creche-fermetures-orange.svg" alt="Fermetures annuelles de la crèche Hélicie" title="Fermetures annuelles de la crèche Hélicie"></div>
                            <div class="info">
                                <div class="title">العطلة السنوية</div>
                                <div>
                                                <p class="affiche" style=""><?php echo $Fermetures_annuelles; ?></p>
                                                
                                                
                                </div>
                            </div>
                                            </li>

                    <li>
                                                    <div class="img-info"><img src="creche/images/ico-creche-capacite-orange.svg" alt="Capacité de la crèche Hélicie" title="Capacité de la crèche Hélicie"></div>
                            <div class="info">
                                <div class="title">قدرة التحمل</div>
                                <div>
                                                <p class="affiche" style=""><?php echo $capacite; ?></p>
                                </div>
                            </div>
                                            </li>
                </ul>

                <div class="description-creche container-wysiwyg">
                                                                <h2>La crèche</h2>
                                                <p class="affiche" style="text-align: justify;"><?php echo $description; ?></p>
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
                            <p>بتاريخ <?php echo $row['date_ecrire']; ?></p>
                            <p> <?php echo $row['message']; ?></p>
                            <p>من طرف <?php echo $row1['nom'] ?></p>
                        </div>   
    
                  <?php   while($row=mysqli_fetch_assoc($result)):?>         
<div class="item"  style="direction:rtl;">
                            <?php 
                               $query1="SELECT * FROM parent WHERE id='{$row['id_parent']}'";
                               $result1=mysqli_query($con,$query1);
                               $row1=mysqli_fetch_assoc($result1);

                             ?>
                            <p>بتاريخ <?php echo $row['date_ecrire']; ?></p>
                            <p> <?php echo $row['message']; ?></p>
                            <p>من طرف <?php echo $row1['nom'] ?></p>
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
    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $id; ?>">اكتب رئيك</button>
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
      <img src="../creche/Upload/<?php echo $row['nom']; ?>" style="width:100%;" alt="Los Angeles">
    </div>
                  <?php   while($row=mysqli_fetch_assoc($result)):?>         
    <div class="item" style="width:100%;">
      <img src="../creche/Upload/<?php echo $row['nom']; ?>" style="width:100%;" alt="Los Angeles">
    </div>
                 <?php endwhile; } ?>
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
<?php if($type=="gold"){ ?>
<div style="margin-top:20px;">
    <a href="../creche/store/index.php" class="btn btn-default">اذهب الى المتجر</a>

</div>
<?php } ?>
                
                <div class="left map hidden-md-down" id="map" style="margin-top:50px;"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d802.0058467056176!2d2.839012937974831!3d36.4811512168655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128f0c0d1d4fd76b%3A0xdc7a5b3de089d588!2z2YXYs9is2K8g2KfZhNit2YLYjCDYtNin2LHYuSDZitmI2LPZgdmKINi52KjYryDYp9mE2YLYp9iv2LHYjCBCbGlkYQ!5e0!3m2!1sfr!2sdz!4v1503351836866" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></div>

                                <hr class="sepa-label">
                
                
            </div>
        </div>
    </div>
</div>
        </main>
<?php 
}else{
    header("Location: moncompt.php");
}
//include 'footer.php'; 
?>