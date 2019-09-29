<?php 
    session_start();
    

if(!isset($_GET['id']) and !is_int($_GET['id']) ){
    header("Location: ../../index.php");
}
require_once "../../includes/bd.php";
$id=$_GET['id'];
if($id==1){
        header("Location: ../../index.php");
    header("Location: ../../index.php");

}
$query="SELECT * FROM store WHERE id='$id'";
$query_run=mysqli_query($con,$query);
if(mysqli_num_rows($query_run)>0){
    $row=mysqli_fetch_assoc($query_run);
    $query="SELECT * FROM creche WHERE id_store='{$row['id']}'";
    $query_run=mysqli_query($con,$query);
    if(mysqli_num_rows($query_run)>0){
        $row1=mysqli_fetch_assoc($query_run);
    }
}else{
    header("Location: ../../index.php");
}

include "fonction.php";
$title="creche ".htmlspecialchars(stripslashes($row1['nom']))." : sorties";
?>

<!DOCTYPE html>
<html lang="ar">
    <head>
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
        <!-- Styles IE -->
        <!--[if IE 6]>
    <style type="text/css">
    	#ie6{
        visibility:visible;
        }
    </style>
<![endif]-->

<!--[if IE]>
    <style type="text/css">
    	@import url("css/ie.css");
    </style>
<![endif]-->        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />  
                <title><?php gettitle(); ?></title>
    </head>

    <body>
        <div id="toutcontenu">
            <!-- Header -->
            <div id="content_header">
                <button class='ekk-menu-collapse'>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div id="menu">
                    <img src="img/menu.png" alt="Menu" border="0" usemap="#Map" title="Menu" />
                    <map name="Map" id="Map">
                        <area shape="poly" coords="51,25,177,40,180,77,97,96,52,92,52,25" href="index.php?id=<?php echo $id; ?>" alt="" />
                        <area shape="poly" coords="76,112,193,79,224,139,150,161,90,155" href="ecoles.php?id=<?php echo $id; ?>" alt="" />
                        <area shape="poly" coords="44,157,170,168,172,244,151,243,147,228,43,228" href="enseigner.php?id=<?php echo $id; ?>" alt="" />
                        <area shape="poly" coords="7,236,143,231,162,307,22,311,7,235" href="sorties.php?id=<?php echo $id; ?>" alt="" />
                        <area shape="poly" coords="61,316,163,312,208,327,203,373,143,384,57,354,61,316" href="animations.php?id=<?php echo $id; ?>" alt="" />
                        <area shape="poly" coords="82,400,202,379,228,446,175,459,97,454,82,399" href="bonnevoie.php?id=<?php echo $id; ?>" alt="" />
                        <area shape="poly" coords="55,456,205,467,210,528,55,520,55,456" href="inscription.php?id=<?php echo $id; ?>" alt="" />
                        <area shape="rect" coords="71,546,107,582" href="<?php echo htmlspecialchars($row1['facebook']); ?>" target="_blank" />
                        <area shape="rect" coords="124,546,159,582" href="<?php echo htmlspecialchars($row1['google']); ?>" rel="publisher" target="_blank" />
                    </map>
                </div>
                <div class="clear"></div>
                <div id="nom"><img src="../../includes/getimage.php?id=<?php echo $row1['id']; ?>&type=creche" width="600" height="240" alt=""/> </div>
            </div>
            <!--Content -->
            <div id="contenunosecoles">
                <img id="nosecoles" src="img/nosecoles.png" alt="Nos écoles" title="Nos écoles"/>
                <div id="textenosecoles"> 
                    <div id="situationcreche">
                        <div class="photocreche"> 	
                            <img src="../../includes/getimage.php?id=<?php echo $row1['id']; ?>&type=creche" width="300" height="240" alt="Ecole Maternelle Les Poussins" title="Ecole Maternelle Les Poussins"/>
                        </div>
                        <div class="adresse">
                          <p class="nomdescreches"><?php echo htmlspecialchars(stripslashes($row1['nom'])); ?></p>
                          <br />
                          <adr>
                              <?php echo htmlspecialchars(stripslashes($row1['adr'])); ?>
                          </adr>
                            <a href="<?php echo htmlspecialchars($row['map']); ?>"><img src="img/bttlocalisation.png" alt="Localisation" title="Localisation"/></a>
                            <p><?php echo htmlspecialchars(stripslashes($row1['tel'])); ?></p>
                            <br/>
                            <p><a class="email" href='mailto:<?php echo htmlspecialchars(stripslashes($row1['email'])); ?>'><?php echo htmlspecialchars(stripslashes($row1['email'])); ?></a></p>
                            <p><?php echo htmlspecialchars(stripslashes($row1['horaires'])); ?></p>
                        </div>
                        <div class="clear"></div>
                                        </div>
                <div class="clear"></div>
            </div>
            <!--footer avec poussins-->
            <div id="footer">
                <div id="poussinballonrouge"> 
                    <img src="img/poussinballonrouge.png" alt="" title=""/>
                </div>  
            </div>
        </div> <!--balisefinale-->       <script language="javascript" type="text/javascript" src="js/jquery.min-1.11.3.js"></script>
        <script language="javascript" type="text/javascript" src="js/ekk-script.js"></script>
    </body>
</html>