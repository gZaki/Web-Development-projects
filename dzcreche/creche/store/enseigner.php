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
$title="creche ".htmlspecialchars(stripslashes($row1['nom']))." : enseigner";
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
        <!-- Slider -->
        <script language="javascript" type="text/javascript" src="js/jquery.min-1.11.3.js"></script>
        <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
        <script type="text/javascript" src="js/slides.min.jquery.js"></script>
        <script type="text/javascript">
            $(function () {
                $('#slides').slides({
                    play: 3500,
                    pause: 1000,
                    effect: 'fade',
                    crossfade: true,
                    hoverPause: true
                });
            });
        </script>
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
                <div id="nom"><img src="../../includes/getimage.php?id=<?php echo $row1['id']; ?>&type=creche" width="600" height="240" alt=""/>
                    &nbsp;
                </div>
            </div>
            <!--Content -->
            <div id="contenu">
                <img id="enseigner" src="img/enseigner.png" alt="Enseigner" title="Enseigner"/>
                <div id="texteenseigner"> <!--backgroundrectange blanc-->
                    <img id="tacheviolet" src="img/tacheviolet.png" alt="" title=""/>
                    <div class="contenuenseigner"> <!-- contenu texte du rectangle-->
                        <p><?php echo htmlspecialchars(stripslashes($row['enseigner1']));
                         ?></p>
                    </div> <!--fin contenu texte du rectangle-->
                </div> <!--fin backgroundrectangleblanc-->
                <div class="clear"></div>
                <div id="texteenseignerdroite"> <!--backgroundrectange blancdroite-->
                    <img id="tacherouge" src="img/tacherouge.png" alt="" title=""/>
                    <div class="contenuenseigner"> <!-- contenu texte du rectangle droite-->
                          <!--<img id="photogalerieenseigner" src="img/galerieenseigner.jpg" alt="" title="" />-->
                        <div id="slides">
                            <div class="slides_container">                                
  <?php 
                $query="SELECT * FROM store_enseigner WHERE id_store='$id'";
                $result=mysqli_query($con,$query);
                if (mysqli_num_rows($result) > 0) {
                    while($row=mysqli_fetch_assoc($result)){?>
                                <a href="#"><img src="img/enseignement/<?php echo $row['nom']; ?>" style="width:100%" alt="" /></a>
                                                <?php
                    }
                }
                ?>
                            </div>
                        </div>
                        <?php echo $row['enseigner2']; ?>
                    </div> <!--fin contenu texte du rectangle de droite-->
                </div> <!--fin backgroundrectangleblanc-->
                <img id="poussinpinceauenseigner" src="img/poussinpinceau.png" alt="" title=""/>
            </div><!--fin contenu -->
            <!--footer avec poussins-->
        </div> <!--balisefinale--><script language="javascript" type="text/javascript" src="js/ekk-script.js"></script>
    </body>
</html>