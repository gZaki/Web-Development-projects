<?php require_once("includes/DB.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php
function Redirect_to($New_Location){
    header("Location:".$New_Location);
	exit;
}

function gettitle(){
    global $title;
    if($title){
        echo $title;
    }else{
        echo 'Admin Panal DZ-Creche ';
    }
}

function Login_Attempt($Username,$Password){
    global $DB;
    $query="SELECT * FROM registration
    WHERE username='$Username' AND password='$Password'";
    $result=mysqli_query($DB,$query);
    if($admin=mysqli_fetch_assoc($result)){
	return $admin;
    }else{
	return null;
    }
}
function Login(){
    if(isset($_SESSION["User_Id"])){
	return true;
    }
}
 function Confirm_Login(){
    if(!Login()){
	$_SESSION["ErrorMessage"]="Login Required ! ";
	Redirect_to("Login.php");
    }
    
 }




?>