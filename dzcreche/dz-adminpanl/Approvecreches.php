<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("../includes/bd.php"); ?>
<?php
if(isset($_GET["id"])){
    $IdFromURL=$_GET["id"];
    $Admin=$_SESSION["Username"];
	$date_c=date("Y-m-d",time());
	$query="SELECT * FROM creche WHERE id='$IdFromURL'";
	$query_run=mysqli_query($con,$query);
    if(mysqli_num_rows($query_run)>0){
		$row=mysqli_fetch_assoc($query_run);
		if($row['type']=="gold"){
			$query="INSERT INTO `store`() VALUES () ";
			$query_run=mysqli_query($con,$query);
			$id= mysqli_insert_id($con);		
		}else{
			$id=1;
		}
	}else{
			$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
	Redirect_to("creche.php");
	}
$Query="UPDATE creche SET reday='1', date_contrat='$date_c',id_store='$id' WHERE id='$IdFromURL' ";
$Execute=mysqli_query($con,$Query);
if($Execute){
	$_SESSION["SuccessMessage"]="Creche Approved Successfully";

	Redirect_to("creche.php");
	}else{
	$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
	Redirect_to("creche.php");
		
	}
    
    
    
    
    
}

?>