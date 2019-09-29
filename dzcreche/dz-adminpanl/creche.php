<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php //require_once("Include/DB.php"); ?>
<?php require_once("../includes/bd.php"); ?>
<?php Confirm_Login(); ?>
<?php $title="creches"; ?>
<!DOCTYPE>

<html>
	<head>
		<title><?php gettitle(); ?></title>
                <link rel="stylesheet" href="css/bootstrap.min.css">
                <script src="js/jquery-3.2.1.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/adminstyles.css">
<style>

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
	<li><a href="Categories.php">
	<span class="glyphicon glyphicon-tags"></span>
	&nbsp;Categories</a></li>
	<li><a href="Admins.php">
	<span class="glyphicon glyphicon-user"></span>
	&nbsp;Manage Admins</a></li>
	<li><a href="creches.php">
	<span class="glyphicon glyphicon-creche"></span>
	&nbsp;creches</a></li>
	<li><a href="Blog.php?Page=1" target="_Blank">
	<span class="glyphicon glyphicon-equalizer"></span>
	&nbsp;Live Blog</a></li>
    <li  class="active"><a href="creche.php?Page=1" target="_Blank">
	<span class="glyphicon glyphicon-equalizer"></span>
	&nbsp;Manges creches</a></li>
	<li><a href="Logout.php">
	<span class="glyphicon glyphicon-log-out"></span>
	&nbsp;Logout</a></li>	
		
	</ul>
	
	
	
	
	</div> <!-- Ending of Side area -->
	<div class="col-sm-10"> <!--Main Area-->
	<br>
	<div><?php echo Message();
	      echo SuccessMessage();
	?></div>	
	<h1>Un-Approved Creche</h1>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
	<tr>
	<th>No.</th>
	<th>Name</th>
	<th> Date Inscription</th>
	<th>Type</th>
	<th>Monda</th>
	<th>Approve</th>
	</tr>
<?php
$Query="SELECT * FROM creche WHERE reday='0' ORDER BY id desc";
$Execute=mysqli_query($con,$Query);
$SrNo=0;
while($row=mysqli_fetch_array($Execute)){
    $id=$row['id'];
    $nom=$row['nom'];
    $type=$row['type'];
    $date_insc=$row['date_insc'];
	$monda=$row['monda'];
	$SrNo++;

//if(strlen($PersonName) >10) { $typeName = substr($typeName, 0, 10).'..';}
	


?>
<tr>
	<td><?php echo htmlentities($SrNo); ?></td>
	<td style="color: #5e5eff;"><?php echo htmlentities($nom); ?></td>
	<td><?php echo htmlentities($date_insc); ?></td>
	<td><?php echo htmlentities($type); ?></td>
	<td><?php echo htmlspecialchars($monda); ?></td>
	<td><a href="Approvecreches.php?id=<?php echo $id; ?>">
	<span class="btn btn-success">Approve</span></a></td>
	<!--<td><a href="Deletecreches.php?id=<?php echo $id;?>">
	<span class="btn btn-danger">Delete</span></a></td>
	<!--<td><a href="FullPost.php?id=<?php echo $crecheedPostId; ?>" target="_blank">
	<span class="btn btn-primary">Live Preview</span></a></td>-->
</tr>
<?php } ?>			
			
			
		</table>
	</div>
	    <h1>Approved Creche</h1>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
	<tr>
	<th>No.</th>
	<th>Name</th>
	<th>Date & Time</th>
	<th>type</th>
	</tr>
<?php
$Query="SELECT * FROM creche WHERE reday='1' ORDER BY id desc";
$Execute=mysqli_query($con,$Query);
$SrNo=0;
while($row=mysqli_fetch_array($Execute)){
    $id=$row['id'];
    $nom=$row['nom'];
    $type=$row['type'];
    $date=$row['date_insc'];

	
	$SrNo++;
//if(strlen($PersonName) >10) { $PersonName = substr($PersonName, 0, 10).'..';}
//if(strlen($DateTimeofcreche)>18){$DateTimeofcreche=substr($DateTimeofcreche,0,18);}


?>
<tr>
	<td><?php echo htmlentities($SrNo); ?></td>
	<td style="color: #5e5eff;"><?php echo htmlentities($nom); ?></td>
	<td><?php echo htmlentities($date); ?></td>
	<td><?php echo htmlentities($type); ?></td>
	<!--<td><?php echo htmlentities($ApprovedBy); ?></td>-->
	<!--<td><a href="DisApprovecreches.php?id=<?php echo $crecheId;?>">
	<span class="btn btn-warning">Dis-Approve</span></a></td>
	<td><a href="Deletecreches.php?id=<?php echo $crecheId;?>">
	<span class="btn btn-danger">Delete</span></a></td>
	<td><a href="FullPost.php?id=<?php echo $crecheedPostId; ?>"target="_blank">
	<span class="btn btn-primary">Live Preview</span></a></td>-->
</tr>
<?php } ?>			
			
			
		</table>
	</div>
	    
	    
	    
	</div> <!-- Ending of Main Area-->
	
</div> <!-- Ending of Row-->
	
</div> <!-- Ending of Container-->

	    
	</body>
</html>