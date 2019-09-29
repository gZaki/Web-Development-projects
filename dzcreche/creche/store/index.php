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
$title="creche ".htmlspecialchars(stripslashes($row1['nom']))." : index";
?>

<!DOCTYPE html>
<html lang="ar">
    <head>
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />  
       <title><?php gettitle(); ?></title>
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
<![endif]-->    </head>

    <body>
         <div class="col-md-12">
        <div style="/*background:white;*/">
            <img src="img/CrechesDZLogo.png" style="width: 20%;height: 150px;float:left;"  />
               <div id="pub" style="width:60%;display: inline-block;"></div>
               <div id="sponsor" style="display: inline-block;"></div>
                    <div style="clear:both"></div>

        </div>
            </div>
        <div >
        <div id="ie6">Ce site n'est pas optimisé pour votre navigateur! Nous vous recommandons de le mettre à niveau pour naviguer correctement en <a target="_blank" href="http://www.dotcom.lu/navigateurs/index.php">cliquant ici</a></div>
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
                <div id="nom"><img src="../../includes/getimage.php?id=<?php echo $row1['id']; ?>&type=creche" width="500" height="240" alt=""/> </div>
            </div>
            <!--Content -->
            <div id="contenu">
                <img id="rubrique" src="img/presentation.png" alt="Présentation" title="Présentation" />
                <div id="texte"> 
                    <img id="tachebordeau" src="img/tachebordeau.png" alt="" title=""/>
                    <img id="tacherose" src="img/tacherose.png" alt="" title=""/>
                    <div id="contenttexte" style="text-align: center;">
                      <p>&nbsp;</p>
                      <p><?php echo htmlspecialchars(stripslashes($row['presentation'])); ?></p>
                      <p style="font-weight: 900; font-size: 1.2em; color: #a1005d;">نحن دزدكرش</p>
                      <p style="font-weight: 900; font-size: 1.2em; color: #77ca38;"><?php echo htmlspecialchars($row1['nom']); ?></p>
                      <p><?php echo htmlspecialchars(stripslashes($row['equipe'])); ?></p>
                      <p><?php echo htmlspecialchars(stripslashes($row1['horaires'])); ?></p>
                      <p id="chequeservice">نحن نقبل (<span><?php echo htmlspecialchars(stripslashes($row['payment'])); ?></span>.)</p>
                      <div id="felsea">
                          <img src="img/12234.png" alt="" height="100" />
                          <p style="font-size: 1.1em;"><?php echo htmlspecialchars(stripslashes($row1['status'])); ?></p>
                      </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div id="video">
                    <img id="tacheverte" src="img/tacheverte.png" alt="" title=""/>
                    <div id="lienvideo">
                        <?php echo $row['video']; ?>
                    </div>
                    <div id="contentvideo">
                      <p><?php echo htmlspecialchars(stripslashes($row['description'])); ?></p>
                      <p><?php echo htmlspecialchars(stripslashes($row['intro'])); ?></p>
                    </div>
                </div>
            </div>
            <!--footer avec poussins-->
            <div id="footer">
                <img id= "petiteherbe" src="img/petiteherbe.png" alt="" title=""/>
                <img id="poussinchiffre" src="img/poussinchiffre.png" alt="" title=""/>
                <img id="poussinpinceau" src="img/poussinpinceau.png" alt="" title=""/>
            </div>
        </div>
        </div>
               <script language="javascript" type="text/javascript" src="js/jquery.min-1.11.3.js"></script>
        <script language="javascript" type="text/javascript" src="js/ekk-script.js"></script>	
    </body>
</html>