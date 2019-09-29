<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php $title="Manage Categories"; ?>
<?php
if(isset($_POST["Submit"])){
$Category=$_POST["Category"];
//date_default_timezone_set("Asia/Karachi");
//$CurrentTime=time();
//$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
//$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
$DateTime=date("Y-m-d h:i:sa",time());
$Admin=$_SESSION["Username"];
if(empty($Category)){
	$_SESSION["ErrorMessage"]="All Fields must be filled out";
	Redirect_to("Categories.php");
	
}elseif(strlen($Category)>99){
	$_SESSION["ErrorMessage"]="Too long Name for Category";
	Redirect_to("Categories.php");
	
}else{
	$Query="INSERT INTO category(datetime,name,creatorname)
	VALUES('$DateTime','$Category','$Admin')";
	$Execute=mysqli_query($DB,$Query);
	if($Execute){
	$_SESSION["SuccessMessage"]="Category Added Successfully";
	Redirect_to("Categories.php");
	}else{
	$_SESSION["ErrorMessage"]="Category failed to Add";
	Redirect_to("Categories.php");
		
	}
	
}	
	
}

?>

<!DOCTYPE>

<html>
	<head>
		<title><?php gettitle(); ?></title>
                <link rel="stylesheet" href="css/bootstrap.min.css">
                <script src="js/jquery-3.2.1.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/adminstyles.css">
<style>
	.FieldInfo{
    color: rgb(251, 174, 44);
    font-family: Bitter,Georgia,"Times New Roman",Times,serif;
    font-size: 1.2em;
}

</style>
                
	</head>
	<body>
<div class="container-fluid">
<div class="row">
	
	<div class="col-sm-2">
	<br><br>
	<ul id="Side_Menu" class="nav nav-pills nav-stacked">
	<li ><a href="Dashboard.php">
	<span class="glyphicon glyphicon-th"></span>
	&nbsp;Dashboard</a></li>
	<li><a href="AddNewPost.php">
	<span class="glyphicon glyphicon-list-alt"></span>
	&nbsp;Add New Post</a></li>
	<li class="active"><a href="Categories.php">
	<span class="glyphicon glyphicon-tags"></span>
	&nbsp;Categories</a></li>
	<li><a href="Admins.php">
	<span class="glyphicon glyphicon-user"></span>
	&nbsp;Manage Admins</a></li>
	<li ><a href="Comments.php">
	<span class="glyphicon glyphicon-comment"></span>
	&nbsp;Comments</a></li>
	<li><a href="Blog.php?Page=1" target="_Blank">
	<span class="glyphicon glyphicon-equalizer"></span>
	&nbsp;Live Blog</a></li>
		<li><a href="creche.php?Page=1" target="_Blank">
	<span class="glyphicon glyphicon-equalizer"></span>
	&nbsp;Manges creches</a></li>
	<li><a href="Logout.php">
	<span class="glyphicon glyphicon-log-out"></span>
	&nbsp;Logout</a></li>	
		
	</ul>
	
	
	
	
	</div> <!-- Ending of Side area -->
	<div class="col-sm-10">
	<h1>Manage Categories</h1>
	<?php echo Message();
	      echo SuccessMessage();
	?>
<div>
<form action="Categories.php" method="post">
	<fieldset>
	<div class="form-group">
	<label for="categoryname"><span class="FieldInfo">Name:</span></label>
	<input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name">
	</div>
	<br>
<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Category">
	</fieldset>
	<br>
</form>
</div>
<div class="table-responsive">
	<table class="table table-striped table-hover">
	<tr>
		<th>Sr No.</th>
		<th>Date & Time</th>
		<th>Category Name</th>
		<th>Creator Name</th>
		<th>Action</th>
		
	</tr>
<?php
$ViewQuery="SELECT * FROM category ORDER BY id desc";
$Execute=mysqli_query($DB,$ViewQuery);
$SrNo=0;
while($DataRows=mysqli_fetch_array($Execute)){
	$Id=$DataRows["id"];
	$DateTime=$DataRows["datetime"];
	$CategoryName=$DataRows["name"];
	$CreatorName=$DataRows["creatorname"];
	$SrNo++;


	
	


?>
<tr>
	<td><?php echo $SrNo; ?></td>
	<td><?php echo $DateTime; ?></td>
	<td><?php echo $CategoryName; ?></td>
	<td><?php echo $CreatorName; ?></td>
	<td><a href="DeleteCategory.php?id=<?php echo $Id;?>">
	<span class="btn btn-danger">Delete</span>
	</a></td>
	
</tr>
		
	<?php } ?>	
	</table>
</div>
	</div> <!-- Ending of Main Area-->
	
</div> <!-- Ending of Row-->
	
</div> <!-- Ending of Container-->

	    
	</body>
</html>