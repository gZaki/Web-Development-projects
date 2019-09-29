<?php 
    session_start();
    if(!isset($_SESSION) or $_SESSION['type']!="entreprise"){
        header("Location: gestionnaire.php");
    }
        $id=$_SESSION['id'];

require_once '../includes/bd.php';


if($_SERVER["REQUEST_METHOD"] == "POST"){
         /*accepte la demande de service dans la date   */
         if(isset($_POST['accepte'])){
             $query1="UPDATE {$_POST['type']} SET status='accepte' WHERE id_service='{$_POST['value']}' AND id='{$_POST['accepte']}'";
             $result1=mysqli_query($con,$query1);
         }
         /*refuser la demande et la supprimer*/
         if(isset($_POST['annuler'])){
             $query1="DELETE FROM `{$_POST['type']}` WHERE id_service='{$_POST['value']}' AND id='{$_POST['annuler']}'";
             $result1=mysqli_query($con,$query1);
         }
         /*accepter  la deander avec un cahngement de date */
         if(isset($_POST['change'])){
             $content=strtotime($_POST['day']);
             $content=date("Y-m-d",$content);
             $query1="UPDATE {$_POST['type']} SET status='accepte', content='$content' WHERE id_service='{$_POST['value']}' AND id='{$_POST['change']}'";
             $result1=mysqli_query($con,$query1);
         }
                  /*accepte la demande de service dans la date   */
         if(isset($_POST['accepte1'])){
             $query1="UPDATE {$_POST['type']} SET status='accepte' WHERE id_service='{$_POST['value1']}' AND id='{$_POST['accepte1']}'";
             $result1=mysqli_query($con,$query1);
         }
         /*refuser la demande et la supprimer*/
         if(isset($_POST['annuler1'])){
             $query1="DELETE FROM `{$_POST['type']}` WHERE id_service='{$_POST['value1']}' AND id='{$_POST['annuler1']}'";
             $result1=mysqli_query($con,$query1);
         }
         /*accepter  la deander avec un cahngement de date */
         if(isset($_POST['change1'])){
             $content=strtotime($_POST['day']);
             $content=date("Y-m-d",$content);
             $query1="UPDATE {$_POST['type']} SET status='accepte', content='$content' WHERE id_service='{$_POST['value1']}' AND id='{$_POST['change1']}'";
             $result1=mysqli_query($con,$query1);
         }

}


?>
<!DOCTYPE html>
<html lang="ar">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.css" />

    <!-- Custom CSS -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
    function ajex() {
  /*if (str=="") {
    document.getElementById("container-2").innerHTML="";
    return;
  } */
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    req=new XMLHttpRequest();
  } else { // code for IE6, IE5
    req=new ActiveXObject("Microsoft.XMLHTTP");
  }
  req.onreadystatechange=function() {
    if (req.readyState==4 && req.status==200) {
      document.getElementById("showdemand").innerHTML=req.responseText;
    }
  }
  req.open("GET","showdemand.php",true);
  req.send();
}
setInterval(function(){ajex();},120000);
</script>
  </head>
  <body onload="ajex()">
  <!-- Content here --> 
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div>
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php">DZ Crèche</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav nav-pills nav-justified">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown text-uppercase" data-toggle="dropdown" href="#" rol="toggle">حسابي</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="setting.php"><img src="images/picto_espace_privée.png" alt="" />  الاعدادات</a>
                <a class="dropdown-item" href="getentrepage.php"><img src="images/picto_compte_parent.png" alt="" />صفحتي</a>
                <a class="dropdown-item" href="../deconnection.php"><img src="images/picto_gestionnaire.png" alt="" /> خروج</a>
            </div>
        </li>
        <li class="nav-item"><a href="recurtement.php" class="nav-link text-uppercase">المساحة التوضيف </a></li>
        <li class="nav-item"><a href="offre.php" class="nav-link text-uppercase">خدماتي</a></li> 
        <li class="nav-item"><a href="demande.php" class="nav-link text-uppercase">الطلبات</a></li> 
      </ul>
    </div>
  </div>
</nav>
<div class="contentn">
<div class="container">
<h1><center>خدماتي</center></h1>
<?php
$query="SELECT * FROM service WHERE id_entreprise='$id' and type='service'";
$result=mysqli_query($con,$query);
if (mysqli_num_rows($result) > 0) {
    while($row=mysqli_fetch_assoc($result)):?>
                <div class="offre">
                    <p>الخدمة : <?php echo $row['titre']; ?></p>
                    <p>وصف : <?php echo $row['description']; ?></p>
                    <p>السعر: <strong><?php echo $row['prix']; ?>DZ</strong></p>
                    <h2>المؤسسات الطالبة</h2>
                    <div id="showdemand">
                        <?php     $query1="SELECT * FROM demander1 WHERE id_service='{$row['id']}'";
         $result1=mysqli_query($con,$query1);
         if (mysqli_num_rows($result1) > 0) {
            while($row1=mysqli_fetch_assoc($result1)):
                 ?>
           <?php      $query="SELECT * FROM entreprise WHERE id='{$row1['id']}'";
                 $result2=mysqli_query($con,$query);
                 $row2=mysqli_fetch_assoc($result2);
                 ?>
                 <div class="demander" style="margin:5px 50px 5px 5px;border-bottom:1px solid white;padding:10px;">
                    <a href="getentrepage.php?id=<?php echo $row2['id']; ?>"><img src="../includes/getimage.php?id=<?php echo $row2['id'].'&type=entreprise'; ?>" alt="Avatar" style="width:60px"></a>
                    <p><span>مؤسسة : <a href="getentrepage.php?id=<?php echo $row2['id']; ?>"><?php echo $row2['nom']; ?></a></span></p>
                    <p>التخصص : <?php echo $row2['service']; ?></p>
                    <p>العنوان : <?php echo $row2['adr']; ?></p>
                    <p><?php echo $row1['content']; ?></p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <?php if($row1['status']=="en attent de reponse"){?>
                      
                        <input type='hidden' name='type' value='demander1' />
                        <input type='hidden' name='value' value='<?php echo $row['id']; ?>' />
                        <button type='submit' name='accepte' value='<?php echo $row1['id']; ?>' class='btn btn-default btn-sm'>accepte</button>
                        <button type='submit' name='annuler' value='<?php echo $row1['id']; ?>' class='btn btn-default btn-sm'>annuler</button>
                        
                          <div class='col-lg-3'>
                            <div class='input-group'>
                              <input type='text' name='day' class='form-control' placeholder='اليوم'>
                              <span class='input-group-btn'>
                                <button type='submit' name='change' value='<?php echo $row1['id']; ?>' class='btn btn-default btn-sm'>change the day</button>
                              </span>
                            </div>
                          </div>
                        
                   <?php }else{
                        echo "<p><strong>{$row1['status']}</strong></p>";
                    } 
                    
                    ?>
                    </form>
                    
                    
                    
                   </div> 
                 <?php 
                


            endwhile;
         }
        echo "</div>";
?>



<?php  
         $query1="SELECT * FROM demander WHERE id_service='{$row['id']}'";
         $result1=mysqli_query($con,$query1);
         if (mysqli_num_rows($result1) > 0) {
            while($row1=mysqli_fetch_assoc($result1)):
                 ?>
           <?php      $query="SELECT * FROM creche WHERE id='{$row1['id']}'";
                 $result2=mysqli_query($con,$query);
                 $row2=mysqli_fetch_assoc($result2);
                 ?>
                 <div class="demander" style="margin:5px 50px 5px 5px;border-bottom:1px solid white;padding:10px;">
                    <a href="../creche/crechepage.php?id=<?php echo $row2['id']; ?>"><img src="../includes/getimage.php?id=<?php echo $row2['id'].'&type=creche'; ?>" alt="Avatar" style="width:60px"></a>
                    <p><span>روضة : <a href="../creche/crechepage.php?id=<?php echo $row2['id']; ?>"><?php echo $row2['nom']; ?></a></span></p>
                    <p>العنوان : <?php echo $row2['adr']; ?></p>
                    <p><?php echo $row1['content']; ?></p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <?php if($row1['status']=="en attent de reponse"){?>
                      
                        <input type='hidden' name='type' value='demander' />
                        <input type='hidden' name='value1' value='<?php echo $row['id']; ?>' />
                        <button type='submit' name='accepte1' value='<?php echo $row1['id']; ?>' class='btn btn-default btn-sm'>accepte</button>
                        <button type='submit' name='annuler1' value='<?php echo $row1['id']; ?>' class='btn btn-default btn-sm'>annuler</button>
                        
                          <div class='col-lg-3'>
                            <div class='input-group'>
                              <input type='text' name='day' class='form-control' placeholder='اليوم'>
                              <span class='input-group-btn'>
                                <button type='submit' name='change1' value='<?php echo $row1['id']; ?>' class='btn btn-default btn-sm'>change the day</button>
                              </span>
                            </div>
                          </div>
                        
                   <?php }else{
                        echo "<p><strong>{$row1['status']}</strong></p>";
                    } 
                    
                    ?>
                    </form>
                    
                    
                    
                   </div> 
                 <?php 
                
            endwhile;
         }

    echo "</div>";
    endwhile;
}




?>
                </div>
<?php //include 'footer.php'; ?>
