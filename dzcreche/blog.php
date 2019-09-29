<?php 
    session_start(); 
 require_once("dz-adminpanl/Include/DB.php");

 ?>
 <!DOCTYPE html>
<html lang="ar">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="parent/css/style.css" />
    <link  href="creche/css/swiper.min.css" rel="stylesheet" type="text/css">
<link href="creche/css/cpt.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css" />
    <link href="images/CrechesDZLogo .ico" rel="icon" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="parent/js/query.dotdotdot.min.js"></script>


    <!-- Custom CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="/*background:url(images/21148676_128811064330152_43078248_n.jpg);background-size: cover;*/">
  <!-- Content here --> 
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div>
    <div class="navbar-header  pull-right">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php"><span style="color:rgb(223,90,71);">D</span><span style="color:rgb(154,175,74);">Z</span> <span style="color:rgb(255,167,45);">C</span><span style="color:rgb(217,75,71);">r</span><span style="color:rgb(72,176,207);">è</span><span style="color:rgb(223,90,71);">c</span><span style="color:rgb(72,176,207);">h</span><span style="color:rgb(71,170,106);">e</sapn></a>
    </div>
    <div class="collapse navbar-collapse " id="myNavbar">
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
    <div class="col-md-12"style="padding-top:60px;">
        <div style="/*background:white;*/">
            <img src="images/CrechesDZLogo.png" style="width: 20%;height: 150px;float:left;"  />
               <div id="pub" style="width:60%;display: inline-block;"></div>
               <div id="sponsor" style="display: inline-block;"><img src="logo.png" width="100%" /></div>
                    <div style="clear:both"></div>

        </div>

<div></div>
    </div>
        
        <main role="main" id="content">
            <div id="listing-actus">
    
   
    <div class="container listing-creches listing-actus">

        <div class="nopadding intro">
            <h1><center>طفلي 365</center></h1>
            <!--<div class="pull-right">
                <p>ستجد هنا كل الجديد</p>
            </div>-->
        </div>
        <div style="clear:both"></div>
        <div>
            <form action="" method="get">
                <div class="row">
                    <center>
                        <div class="col-lg-6 col-lg-offset-4">
                            <div class="input-group">
                            <input type="text" class="form-control" name="q"  placeholder="ابحث عن" aria-label="ابحث عن">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" name="qButton" type="submit">بحث</button>
                            </span>
                            </div>
                        </div>
                
                    </center>
                </div>
            </form>
        </div>
        <?php
		// Query when q Button is Active
		if(isset($_GET["q"])){
			$q=$_GET["q"];
			
		$query="SELECT * FROM admin_panel
		WHERE datetime LIKE '%$q%' OR title LIKE '%$q%'
		OR post LIKE '%$q%' and category='365' ORDER BY id desc";
		}
		// Query When Pagination is Active i.e Blog.php?page=1
		elseif(isset($_GET["page"])){
		$page=$_GET["page"];
		if($page==0||$page<1){
			$showarticle=0;
		}else{
		$showarticle=($page*8)-8;}
	$query="SELECT * FROM admin_panel WHERE category='365' ORDER BY id desc LIMIT $showarticle,8";
		}
		// The Default Query for Blog.php page
		else{
			
		$query="SELECT * FROM admin_panel WHERE category='365' ORDER BY id desc LIMIT 0,8";}
		$result=mysqli_query($DB,$query);
		while($row=mysqli_fetch_array($result)):
			$id=$row["id"];
			$date_ec=$row["datetime"];
			$title=$row["title"];
			$cat=$row["category"];
			$admin=$row["author"];
			$image=$row["image"];
			$post=$row["post"];
            
		
		?>

        <div id="ias-items-list" class="liste tips nopadding" style="margin-top:20px;">
                <div class="ias-item shadow actualites" style="margin-right:8px;">
                    <div class="illustration" style="width:500px;height:330px;">
                        <a href="FullPost.php?id=<?php echo $id; ?>">
                            <img style="width:500px;height:330px;" alt="<?php echo htmlspecialchars($title); ?>" title="<?php echo htmlspecialchars($title); ?>" src="dz-adminpanl/Upload/<?php echo $image;  ?>"  /></a>
                    </div>

                    <div class="contenu desc-conseils">
                        <div class="sub-actualites"><?php echo htmlspecialchars($date_ec); ?></div>
                        <h3><a href="FullPost.php?id=<?php echo $id; ?>" title="<?php echo $title; ?>"><?php echo htmlspecialchars($title); ?></a></h3>
                        <div class="content-max"><?php echo htmlspecialchars($post); ?></div>
                        <a href="FullPost.php?id=<?php echo $id; ?>" title="<?php echo htmlspecialchars($title); ?>"><div class="suite proxima-bold"><div class="arrow"><img src="parent/images/ui-fleche-suite.svg" alt="Suite"></div><span>Lire la suite</span></div></a>
                    </div>
                    
                </div> 
                   
        </div> 
                   <?php endwhile; ?>    
                 
                   
    </div>
</div>
<?php 
if(isset($_GET["Category"]) or isset($_GET["q"])){
    $query="SELECT COUNT(*) FROM admin_panel
		WHERE datetime LIKE '%$q%' OR title LIKE '%$q%'
		 OR post LIKE '%$q%' and category='365'";
}
else{
$query="SELECT COUNT(*) FROM admin_panel WHERE category='365'";
}
      $result=mysqli_query($DB,$query);
      $row=mysqli_fetch_array($result);
      $total=array_shift($row);
      $tpage=$total/7;
      $tpage=ceil($tpage);

?>
      <nav aria-label="Page navigation example" style="text-align:center">
        <ul class="pagination justify-content-center">
          <li class="page-item <?php if($page==0 or $page==1) echo 'hidden'; ?>">
            <a class="page-link" href="blog.php?page=<?php $previous=$page-1;echo $previous; ?>" tabindex="-1">Previous</a>
          </li>
      <?php 
      for($i=1;$i<=$tpage;$i++){?>
          <li class="page-item <?php if($i==$page) echo 'active'; ?>"><a class="page-link" href="blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php
      }?>
          <li class="page-item <?php if($page==$tpage) echo 'hidden'; ?>">
      <a class="page-link" href="blog.php?page=<?php $next=$page+1;echo $next; ?>">Next</a>
    </li>
  </ul>
</nav>



<script>
    $(document).ready(function(){
        /* Height block article */
        var initDotdotdot = function() {
            $(".desc-conseils .content-max").dotdotdot({
                ellipsis	: '... ',
                height		: null
            });
        }
        initDotdotdot();});
</script>        </main>

            </body>
</html>