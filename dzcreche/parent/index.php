<?php 
    session_start();
?>
<?php include 'header.php';
require_once '../includes/bd.php';
header("Location: blog.php");
 ?>
<div>
<div class="contentn" style="">
<div class="row">
    <div class="col-md-12">
        <div style="background:white;">
            <img src="../images/CrechesDZLogo.png" style="width: 20%;height: 150px;float:left;"  />
               <h1><center>Logo spensor</center></h1>
                    <div style="clear:both"></div>

        </div>

<div style="background:url(images/20986459_127614434449815_255473107_n.png);height: 150px;width:100%;"></div>
    </div>
    <!--<div class="col-md-3">
        <div class="card">
            <!--<img src="getimage.php?id=<?php echo $id; ?>" alt="John" style="width:100%">
            <div class="containe">
                <h1><?php echo $_SESSION['name'] ?></h1>
                <p class="title">description</p>
                <p><?php //echo $row['cadr']; ?></p>
                <div style="margin: 24px 0;">
                <a href="#"><i class="fa fa-dribbble"></i></a> 
                <a href="#"><i class="fa fa-twitter"></i></a>  
                <a href="#"><i class="fa fa-linkedin"></i></a>  
                <a href="#"><i class="fa fa-facebook"></i></a> 
            </div>
            </div>
        </div>

    </div>-->

</div>
<?php //include 'footer.php'; ?>
