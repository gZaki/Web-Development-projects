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
<title><?php 
include "store/fonction.php";
gettitle(); ?></title>
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
  <!-- Content here --> 
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div>
    <div class="navbar-header  pull-right">
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
                <a class="dropdown-item" href="crechepage2.php"> صفحتي <i class="fa fa-home" aria-hidden="true" style="float:right"></i>
</a>
                <?php
                require_once('../includes/bd.php');
                $id=$_SESSION['id'];
                $query="SELECT * FROM creche WHERE id='$id'";
                $result=mysqli_query($con,$query);
                $row=mysqli_fetch_assoc($result);

                 ?><a class="dropdown-item" href="store.php">المتجر <i class="fa fa-shopping-bag" aria-hidden="true" style="float:right"></i></a>


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