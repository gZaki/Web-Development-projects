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
    <link rel="stylesheet" href="css/navstyle1.css" />
    <link rel="stylesheet" href="css/team.css" />
    <link rel="stylesheet" href="font-awesome/css/font-awesome.css" />
    <link href="images/CrechesDZLogo .ico" rel="icon" />

    <!-- Custom CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body  onload="closeNav();"  style="background:url(images/backgroundpng.png);">
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
<div>
<?php include 'nav.php'; ?>
<div class="contentn" style="background:white">
<div class="row">
    <img src="images/Sanstitre.png" alt="" style="width:100%;" />
</div>    <div class="contnaier">

    <h1><center>من نحن</center></h1>
<p>
فريق محترف من الخبراء والأخصائيين النفسيين والتقنيين، من مختلف التخصصات، نهدف إلى تطوير الخدمات في رياض الأطفال ومراكز الرعاية النفسية في الجزائر، وفق معايير عالية ترتكز على أسس علمية وعملية فعالة، انطلاقا من الاحتياجات الفعلية للآباء والمدراء وأصحاب المراكز وكل المهنيين الذين يطلبون توفير فضاء واسع يضم كل هؤلاء المتعاملين والمهتمين بعالم الطفل ما قبل المدرسة للتواصل فيما بينهم وتبادل الخدمات والخبرات، في موقع إلكتروني سهل وتفاعلي واحترافي يستفيد منه الجميع لتحقيق قفزة نوعية وجودة عالية برياض الأطفال في الجزائر، وعلى هذا تم إنشاء موقع  dz crèche ..
</p>
<h2><center>فريقنا</center></h2>
 <div class="row">
  <div class="column">
    <div class="card">
      <img src="images/karim.jpg" alt="Jane" style="width:100%">
      <div class="cont">
        <h2>عبد الكريم رميد</h2>
        <p class="title">مطور ويب</p>
        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
        <p>example@example.com</p>
        <!--<p><button class="button">Contact</button></p>-->
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img src="images/karim.jpg" alt="Mike" style="width:100%">
      <div class="cont">
        <h2>Mike Ross</h2>
        <p class="title">Art Director</p>
        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
        <p>example@example.com</p>
        <!--<p><button class="button">Contact</button></p>-->
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img src="images/karim.jpg" alt="John" style="width:100%">
      <div class="cont">
        <h2>John Doe</h2>
        <p class="title">Designer</p>
        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
        <p>example@example.com</p>
        <!--<p><button class="button">Contact</button></p>-->
      </div>
    </div>
  </div>
</div> 
</div>
<?php include 'includes/footer.php'; ?>