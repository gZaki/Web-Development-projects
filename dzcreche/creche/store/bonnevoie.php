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
$title="creche ".$row1['nom']." : sorties";
?>

<!DOCTYPE html>
<html lang="ar">

    <head>
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/flexslider.css" media="screen" />
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

        <script language="javascript" type="text/javascript" src="js/jquery.min-1.11.3.js"></script>
        <script language="javascript" type="text/javascript" src="js/jquery.slidingGallery-1.2.js"></script>
        <script language="javascript" type="text/javascript">
            $(function () {
                $('div.gallery img').slidingGallery({useCaptions: true, container: $('div.gallery')});
                $('.flexslider').flexslider({animation: "slide",controlNav: false});
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
                        <area shape="rect" coords="71,546,107,582" href="<?php echo $row1['facebook']; ?>" target="_blank" />
                        <area shape="rect" coords="124,546,159,582" href="<?php echo $row1['google']; ?>" rel="publisher" target="_blank" />
                    </map>
                </div>
                <div class="clear"></div>
                <div id="nom"> </div>
            </div>
            <!--Content -->
            <div id="contenu">
                <img id="bonnevoie" src="img/" alt="" title=""/>
                <div id="texteenseigner"> <!--backgroundrectange blanc-->
                    <div class="contenubonnevoie"> <!-- contenu texte du rectangle-->
                        <p id="titreenseigner"></p>
                        <p></p>
                        <p class="soustitrebonnevoie"></p>
                        <ul>
                            <li></li>
                        </ul>
                        <p class="soustitrebonnevoie"></p>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <p class="soustitrebonnevoie">&nbsp;</p>
                        <ul>
                          <li>&nbsp;</li>
                      </ul>
                        <p class="soustitrebonnevoie">&nbsp;</p>
                      <ul>
                        <li>&nbsp;</li>
                      </ul>
                    </div> <!--fin contenu texte du rectangle-->
                </div> <!--fin backgroundrectangleblanc-->
                <div class="clear"></div>
                <div id="textebonnevoiedroite"> <!--backgroundrectange blancdroite-->
                    <div class="contenuenseigner"> <!-- contenu texte du rectangle droite-->
                      <p class="soustitrebonnevoie">&nbsp;</p>
                      <ul>
                        <li>&nbsp;</li>
                          <li>&nbsp;</li>
                          <li>&nbsp;</li>
                        </ul>
                        <p class="soustitrebonnevoie">&nbsp;</p>
                        <ul>
                          <li>&nbsp;</li>
                          <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                            <li>&nbsp;</li>
                        </ul>
                        <p class="soustitrebonnevoie">&nbsp;</p>
                        <ul>
                          <li>&nbsp;</li>
                        </ul>
                      <p class="soustitrebonnevoie">&nbsp;</p>
                        <ul>
                          <li>&nbsp;</li>
                          <li>&nbsp;</li>
                        </ul>
                    </div> <!--fin contenu texte du rectangle de droite-->
                </div> <!--fin backgroundrectangleblanc-->
                <!-- Galerie photo -->
                <div class="gallery" id="gal_creche">
                    <img class="imgs_creche start" src="img/bonnevoie/1.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/2.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/3.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/4.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/5.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/6.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/7.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/8.jpg" alt="" />   
                    <img class="imgs_creche" src="img/bonnevoie/9.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/10.jpg" alt="" /> 
                    <img class="imgs_creche" src="img/bonnevoie/11.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/12.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/13.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/14.jpg" alt="" /> 
                    <img class="imgs_creche" src="img/bonnevoie/15.jpg" alt="" /> 
                    <img class="imgs_creche" src="img/bonnevoie/16.jpg" alt="" /> 
                    <img class="imgs_creche" src="img/bonnevoie/17.jpg" alt="" /> 
                    <img class="imgs_creche" src="img/bonnevoie/18.jpg" alt="" /> 
                    <img class="imgs_creche" src="img/bonnevoie/19.jpg" alt="" /> 
                    <img class="imgs_creche" src="img/bonnevoie/20.jpg" alt="" /> 
                    <img class="imgs_creche" src="img/bonnevoie/21.jpg" alt="" /> 
                    <img class="imgs_creche" src="img/bonnevoie/22.jpg" alt="" /> 
                    <img class="imgs_creche" src="img/bonnevoie/23.jpg" alt="" /> 
                    <img class="imgs_creche" src="img/bonnevoie/24.jpg" alt="" /> 
                    <img class="imgs_creche" src="img/bonnevoie/25.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/26.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/27.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/28.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/29.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/30.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/31.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/32.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/33.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/34.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/35.jpg" alt="" />
                    <img class="imgs_creche" src="img/bonnevoie/36.jpg" alt="" />  
                </div>
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <img src="img/bonnevoie/1.jpg" alt="" />
                        </li>
                        <li>
                            <img  src="img/bonnevoie/2.jpg" alt="" />
                        </li>
                        <li>
                            <img  src="img/bonnevoie/3.jpg" alt="" />
                        </li>
                        <li>
                            <img  src="img/bonnevoie/4.jpg" alt="" />
                        </li>
                        <li>
                            <img  src="img/bonnevoie/5.jpg" alt="" />
                        </li>
                        <li>
                            <img  src="img/bonnevoie/6.jpg" alt="" />
                        </li>
                        <li>
                            <img  src="img/bonnevoie/7.jpg" alt="" />
                        </li>
                        <li>
                            <img  src="img/bonnevoie/8.jpg" alt="" /> 
                        </li>
                        <li>  
                            <img  src="img/bonnevoie/9.jpg" alt="" />
                        </li>
                        <li>
                            <img  src="img/bonnevoie/10.jpg" alt="" /> 
                        </li>
                        <li>
                            <img  src="img/bonnevoie/11.jpg" alt="" />
                        </li>
                        <li>
                            <img  src="img/bonnevoie/12.jpg" alt="" />
                        </li>
                        <li>
                            <img  src="img/bonnevoie/13.jpg" alt="" />
                        </li>
                        <li>
                            <img  src="img/bonnevoie/14.jpg" alt="" /> 
                        </li>
                        <li>
                            <img  src="img/bonnevoie/15.jpg" alt="" /> 
                        </li>
                        <li>
                            <img  src="img/bonnevoie/16.jpg" alt="" /> 
                        </li>
                        <li>
                            <img  src="img/bonnevoie/17.jpg" alt="" /> 
                        </li>
                        <li>
                            <img  src="img/bonnevoie/18.jpg" alt="" /> 
                        </li>
                        <li>
                            <img  src="img/bonnevoie/19.jpg" alt="" /> 
                        </li>
                        <li>
                            <img  src="img/bonnevoie/20.jpg" alt="" /> 
                        </li>
                        <li>
                            <img  src="img/bonnevoie/21.jpg" alt="" /> 
                        </li>
                        <li>
                            <img  src="img/bonnevoie/22.jpg" alt="" /> 
                        </li>
                        <li>
                            <img  src="img/bonnevoie/23.jpg" alt="" /> 
                        </li>
                        <li>
                            <img  src="img/bonnevoie/24.jpg" alt="" /> 
                        </li>
                        <li>
                            <img  src="img/bonnevoie/25.jpg" alt="" />
                        </li> 
                        <li>
                            <img  src="img/bonnevoie/26.jpg" alt="" />
                        </li> 
                        <li>
                            <img  src="img/bonnevoie/27.jpg" alt="" />
                        </li> 
                        <li>
                            <img  src="img/bonnevoie/28.jpg" alt="" />
                        </li> 
                        <li>
                            <img  src="img/bonnevoie/29.jpg" alt="" />
                        </li> 
                        <li>
                            <img  src="img/bonnevoie/30.jpg" alt="" />
                        </li> 
                        <li>
                            <img  src="img/bonnevoie/31.jpg" alt="" />
                        </li> 
                        <li>
                            <img  src="img/bonnevoie/32.jpg" alt="" />
                        </li> 
                        <li>
                            <img  src="img/bonnevoie/33.jpg" alt="" />
                        </li> 
                        <li>
                            <img  src="img/bonnevoie/34.jpg" alt="" />
                        </li> 
                        <li>
                            <img  src="img/bonnevoie/35.jpg" alt="" />
                        </li> 
                        <li>
                            <img  src="img/bonnevoie/36.jpg" alt="" />
                        </li> 
                    </ul>
                </div>
                <!--footer avec poussins-->
                <img id="poussinstep1" src="img/poussinstep1.png" alt="" title=""/>
                <img id="poussinstep2" src="img/poussinstep2.png" alt="" title=""/>
            </div><!--fin contenu -->
        </div> <!--balisefinale-->  
        

               <script language="javascript" type="text/javascript" src="js/jquery.flexslider-min.js"></script>
        <script language="javascript" type="text/javascript" src="js/ekk-script.js"></script>	
    </body>
</html>