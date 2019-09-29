<?php require_once("Include/DB.php"); 
require_once("../includes/bd.php");
 include("Include/Sessions.php");
 include("Include/Functions.php");
if(isset($_POST["Submit"])){
$Name=$_POST["Name"];
$Comment=$_POST["Comment"];
//$CurrentTime=time();
//$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
//$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
//$DateTime;
$DateTime=date("Y-m-d h:i:sa",time());

$PostId=$_GET["id"];

if(empty($Name)||empty($Comment)){
	$_SESSION["ErrorMessage"]="All Fields are required";
	
}elseif(strlen($Comment)>500){
	$_SESSION["ErrorMessage"]="only 500  Characters are Allowed in Comment";
	
}else{
	$PostIDFromURL=$_GET['id'];
        $Query="INSERT into comments (datetime,name,comment,approvedby,status,admin_panel_id)
	VALUES ('$DateTime','$Name','$Comment','Pending','OFF','$PostIDFromURL')";
	$Execute=mysqli_query($DB,$Query);
	if($Execute){
	$_SESSION["SuccessMessage"]="Comment Submitted Successfully";
	Redirect_to("FullPost.php?id={$PostId}");
	}else{
	$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
	Redirect_to("FullPost.php?id={$PostId}");
		
	}
	
}	
	
}

?>
<!DOCTYPE>

<html>
	<head>
		<title>Full Blog Post</title>
                <link rel="stylesheet" href="css/bootstrap.min.css">
                <script src="js/jquery-3.2.1.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/publicstyles.css">
               <style>
		

.FieldInfo{
    color: rgb(251, 174, 44);
    font-family: Bitter,Georgia,"Times New Roman",Times,serif;
    font-size: 1.2em;
}
.CommentBlock{
background-color:#F6F7F9;
}
.Comment-info{
	color: #365899;
	font-family: sans-serif;
	font-size: 1.1em;
	font-weight: bold;
	padding-top: 10px;
        
	
}
.comment{
    margin-top:-2px;
    padding-bottom: 10px;
    font-size: 1.1em
}


	       </style> 
	</head>
	<body>
		<?php include 'header.php'; ?>
<div class="container" style="padding-top:60px;direction:rtl;"> 
	<!--Container-->
	<div class="col-md-12">
        <div>
            <div id="logo" class="col-md-2 col-sm-2 col-xs-12">
             <a href="../index.php"><img src="images/CrechesDZLogo.png" style="width: 100%;height: 150px;"  /></a>
            </div>
               <div id="pub" class="col-md-8 col-sm-8 col-xs-12"><img  src="images/bannieriage.jpg" style="width:100%;display: inline-block;height: 150px;" /></div>
               <div id="sponsor" class="col-md-2 col-sm-2 col-xs-12"><img src="logo.png" width="100%" /></div>
                    <div style="clear:both"></div>

        </div>
            </div>
	<div class="row"> <!--Row-->
		<div class="col-sm-8"> <!--Main Blog Area-->
		<?php echo Message();
	      echo SuccessMessage();
	?>
		<?php
		if(isset($_GET["qButton"])){
			$q=$_GET["q"];
		$ViewQuery="SELECT * FROM admin_panel
		WHERE datetime LIKE '%$q%' OR title LIKE '%$q%'
		OR category LIKE '%$q%' OR post LIKE '%$q%'";
		}else{
			$PostIDFromURL=$_GET["id"];
		$ViewQuery="SELECT * FROM admin_panel WHERE id='$PostIDFromURL'
		ORDER BY datetime desc";}
		$Execute=mysqli_query($DB,$ViewQuery);
		while($DataRows=mysqli_fetch_array($Execute)){
			$PostId=$DataRows["id"];
			$DateTime=$DataRows["datetime"];
			$Title=$DataRows["title"];
			$Category=$DataRows["category"];
			$Admin=$DataRows["author"];
			$Image=$DataRows["image"];
			$Post=$DataRows["post"];
		
		?>
		<div class="blogpost thumbnail">
			<img class="img-responsive img-rounded"src="../dz-adminpanl/Upload/<?php echo $Image;  ?>" >
		<div class="caption">
			<h1 id="heading"> <?php echo htmlentities($Title); ?></h1>
		<p class="description">فئة :<?php echo htmlentities($Category); ?> نشر بتاريخ 
		<?php echo htmlentities($DateTime);?></p>
		<p class="post"><?php
		echo nl2br($Post); ?></p>
		</div>
			
		</div>
		<?php } ?>
		<br><br>
		<br><br>
		<span class="FieldInfo">الأراء</span>
<?php
$PostIdForComments=$_GET["id"];
$ExtractingCommentsQuery="SELECT * FROM comments
WHERE admin_panel_id='$PostIdForComments' AND status='ON' ";
$Execute=mysqli_query($DB,$ExtractingCommentsQuery);
while($DataRows=mysqli_fetch_array($Execute)){
	$CommentDate=$DataRows["datetime"];
	$CommenterName=$DataRows["name"];
	$Comments=$DataRows["comment"];


?>
<div class="CommentBlock">
	<img style="margin-left: 10px; margin-top: 10px;" class="pull-left" src="../dz-adminpanl/images/comment.png" width=70px; height=70px;>
	<p style="margin-left: 90px;" class="Comment-info"><?php echo $CommenterName; ?></p>
	<p style="margin-left: 90px;"class="description"><?php echo $CommentDate; ?></p>
	<p style="margin-left: 90px;" class="Comment"><?php echo nl2br($Comments); ?></p>
	
</div>

	<hr>
<?php } ?>
		
		
		<br>
		<span class="FieldInfo">شركنا برئيك</span>
		
		
<div>
<form action="FullPost.php?id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data">
	<fieldset>
	<div class="form-group">
	<?php 
	$id=$_SESSION['id'];
	$query="SELECT * FROM parent WHERE id='$id' ";
	$result=mysqli_query($con,$query);
	$row=mysqli_fetch_assoc($result);	 ?>
	<input class="form-control hidden" type="text" name="Name" value="<?php echo $row['nom']; ?>" id="Name" placeholder="Name">
	<p><?php echo $row['nom']; ?></p>
	</div>
	<!--<div class="form-group">
	<label for="Email"><span class="FieldInfo">Email</span></label>
	<input class="form-control" type="email" name="Email" id="Email" placeholder="email">
	</div>-->
	<div class="form-group">
	<label for="commentarea"><span class="FieldInfo">رئيك</span></label>
	<textarea class="form-control" name="Comment" id="commentarea"></textarea>
	<br>
<input class="btn btn-primary" type="Submit" name="Submit" value="Submit">
	</fieldset>
	<br>
</form>
</div>

		</div> <!--Main Blog Area Ending-->
		<div class="col-sm-offset-1 col-sm-3"> <!--Side Area -->
<div class="panel panel-primary">
	<div class="panel-heading">
		<h2 class="panel-title">الفئات</h2>
	</div>
	<div class="panel-body">
<?php
$ViewQuery="SELECT * FROM category ORDER BY id desc";
$Execute=mysqli_query($DB,$ViewQuery);
while($DataRows=mysqli_fetch_array($Execute)){
	$Id=$DataRows['id'];
	$Category=$DataRows['name'];
?>
<a href="Blog.php?Category=<?php echo $Category; ?>">
<span id="heading"><?php echo $Category."<br>"; ?></span>
</a>
<?php } ?>
		
	</div>
	<div class="panel-footer">
		
		
	</div>
</div>




<div class="panel panel-primary">
	<div class="panel-heading">
		<h2 class="panel-title">اخر الموضيع</h2>
	</div>
	<div class="panel-body background">
<?php
$ViewQuery="SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,5";
$Execute=mysqli_query($DB,$ViewQuery);
while($DataRows=mysqli_fetch_array($Execute)){
	$Id=$DataRows["id"];
	$Title=$DataRows["title"];
	$DateTime=$DataRows["datetime"];
	$Image=$DataRows["image"];
	if(strlen($DateTime)>11){$DateTime=substr($DateTime,0,12);}
	?>
<div>
<img class="pull-left" style="margin-top: 10px; margin-left: 0px;"  src="../dz-adminpanl/Upload/<?php echo htmlentities($Image); ?>" width=120; height=60;>
    <a href="FullPost.php?id=<?php echo $Id;?>">
     <p id="heading" style="margin-left: 130px; padding-top: 10px;"><?php echo htmlentities($Title); ?></p>
     </a>
     <p class="description" style="margin-left: 130px;"><?php echo htmlentities($DateTime);?></p>
	<hr>
</div>	
	
	
<?php } ?>		
		
	</div>
	<div class="panel-footer">
		
		
	</div>
</div>
		
		
		
		
		</div> <!--Side Area Ending-->
	</div> <!--Row Ending-->
	
	
</div><!--Container Ending-->







	    
	</body>
</html>