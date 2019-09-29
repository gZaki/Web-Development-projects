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
    <link  href="css/swiper.min.css" rel="stylesheet" type="text/css">
<link href="css/cpt.css" rel="stylesheet" type="text/css" />

    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.css" />
        <link href="../images/CrechesDZLogo .ico" rel="icon" />


    <!-- Custom CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="background: url(images/f_login.jpg);background-size: contain;background-attachment: fixed;">
<div class="col-md-12">
        <div style="/*background:white;*/">
            <div id="logo" class="col-md-2 col-sm-2 col-xs-12">
             <a href="../index.php"><img src="images/CrechesDZLogo.png" style="width: 100%;height: 150px;"  /></a>
            </div>
               <div id="pub" class="col-md-8 col-sm-8 col-xs-12"><img  src="images/bannieriage.jpg" style="width:100%;display: inline-block;height: 150px;" /></div>
               <div id="sponsor" class="col-md-2 col-sm-2 col-xs-12"><img src="logo.png" width="100%" /></div>
                    <div style="clear:both"></div>

        </div>
            </div>
<div class="container" style="display: flex;padding-top:10px;">
<div class="columns" style="flex:1;">
  <ul class="price">
    <li class="header" style="background: url(images/silver.jpg);">Basic</li>
    <li class="grey">4500 DZ / annnes</li>
    <li>10GB Storage</li>
    <li>10 Emails</li>
    <li>10 Domains</li>
    <li>1GB Bandwidth</li>
    <li class="grey">
      <form action="registercreche.php" method="get">
        <button type="submit" name="price" value="silver" class="button">Sign Up</button>
      </form>
    </li>
  </ul>
</div>

<div class="columns" style="flex:1;">
  <ul class="price">
    <li class="header" style="background: url(images/gold.jpg);">Pro</li>
    <li class="grey" >7500 DZ / annnes</li>
    <li>25GB Storage</li>
    <li>25 Emails</li>
    <li>25 Domains</li>
    <li>2GB Bandwidth</li>
    <li class="grey">
      <form action="registercreche.php" method="get">
        <button type="submit" name="price" value="gold" class="button">Sign Up</button>
      </form>
    </li>
  </ul>
</div>
</div>

<?php '../includes/footer.php'; ?>
