<?php 
require_once '../includes/bd.php';
$id=addslashes($_REQUEST['id']);
$query="SELECT * FROM {$_REQUEST['type']} WHERE id='$id'";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($result);

header("Content-type:image/jpeg");
echo $row["logo"];
?>