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

if($_SERVER["REQUEST_METHOD"] == "POST"){
   $creche=$nom_enf=$prenom_enf=$date_nais=$nationalite=$adr=$tel=$email=$nom_mere=$nom_pere=$prof_pere=$prof_mere=$email_mere=$email_pere=$tel_pere=$tel_mere=$date_entree="";
   if(!empty($_POST['creche'])){
       $creche=addslashes($_POST['creche']);
   }
   if(!empty($_POST['nom_enf'])){
       $nom_enf=addslashes($_POST['nom_enf']);
   }
   if(!empty($_POST['prenom_enf'])){
       $prenom_enf=addslashes($_POST['prenom_enf']);
   }
   if(!empty($_POST['date_nais'])){
       $date_nais=addslashes($_POST['date_nais']);
   }
   if(!empty($_POST['nationalite'])){
       $nationalite=addslashes($_POST['nationalite']);
   }
   if(!empty($_POST['adr'])){
       $adr=addslashes($_POST['adr']);
   }
   if(!empty($_POST['tel'])){
       $tel=addslashes($_POST['tel']);
   }
   if(!empty($_POST['email'])){
       $email=addslashes($_POST['email']);
   }
   if(!empty($_POST['nom_mere'])){
       $nom_mere=addslashes($_POST['nom_mere']);
   }
   if(!empty($_POST['nom_pere'])){
       $nom_pere=addslashes($_POST['nom_pere']);
   }
   if(!empty($_POST['prof_mere'])){
       $prof_mere=addslashes($_POST['prof_mere']);
   }
   if(!empty($_POST['prof_pere'])){
       $prof_pere=addslashes($_POST['prof_pere']);
   }
   if(!empty($_POST['email_mere'])){
       $email_mere=addslashes($_POST['email_mere']);
   }
   if(!empty($_POST['email_pere'])){
       $email_pere=addslashes($_POST['email_pere']);
   }
   if(!empty($_POST['tel_mere'])){
       $tel_mere=addslashes($_POST['tel_mere']);
   }
   if(!empty($_POST['tel_pere'])){
       $tel_pere=addslashes($_POST['tel_pere']);
   }
   if(!empty($_POST['date_entree'])){
       $date_entree=addslashes($_POST['date_entree']);
   }
   if(!empty($_POST['jourSa'])){
       $jour=addslashes($_POST['jourSa']);
   }
   if(!empty($_POST['jourDi'])){
       $jour=$jour." ".addslashes($_POST['jourDi']);
   }
   if(!empty($_POST['jourLu'])){
       $jour=$jour." ".addslashes($_POST['jourLu']);
   }
   if(!empty($_POST['jourMa'])){
       $jour=$jour." ".addslashes($_POST['jourMa']);
   }
   if(!empty($_POST['jourMe'])){
       $jour=$jour." ".addslashes($_POST['jourMe']);
   }
   if(!empty($_POST['jourJe'])){
       $jour=$jour." ".addslashes($_POST['jourJe']);
   }
   $query="INSERT INTO inscription( `id_creche`, `type`, `nom_enfant`, `prenom_enfant`, `date_naiss`, `adr`, `tel`, `email`, `nationalite`, `nom_mere`, `nom_pere`, `prof_pere`, `prof_mere`, `email_pere`, `email_mere`, `tel_mere`, `tel_pere`, `date_entre`, `joure`) VALUES ('{$row1['id']}','$creche','$nom_enf','$prenom_enf','$date_nais','$adr','$tel','$email','$nationalite','$nom_mere','$nom_pere','$prof_pere','$prof_mere','$email_pere','$email_mere','$tel_mere','$tel_pere','$date_entree','$jour')";
   $result=mysqli_query($con,$query);
   if($result){
       $insc= "<p class='bg-success text-center'>Bien Inscri</p>";
   }else{
       $insc= "<p class='bg-danger text-center'>Il ya un erreur</p>";
   }
}

include "fonction.php";
$title="creche ".htmlspecialchars(stripslashes($row1['nom']))." : inscription";
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
                <div>
                    <button class='ekk-menu-collapse'>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                    
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
                <img id="inscriptions" src="img/inscriptions.png" alt="Formulaire d'inscription" title="Formulaire d'inscription"/>
                
                <div id="textenosecoles"> 
                    <div id="positionformulaire">
                    <?php echo $insc; ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <table id="formulaire">
                                <tr>
                                      <td colspan="2">Veuillez choisir votre établissement :</td>
                                </tr>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>
                                            <span>&nbsp;Les Poussins</span><br />&nbsp;<span class="infos2">de 18 mois é 6 ans<br /></span></label>
                                    </td>

                                    <td>
                                        <input type="radio" name="creche" value="Les poussins"  />

                                    </td>
                                    <td>
                                        <label>
                                            <span>Mini collége</span><br /> <span class="infos2">de 3 é 6 ans<br /> </span></label>
                                    </td>
                                    <td>
                                        <input type="radio" name="creche" value="Mini-collége"  />
                                    </td>
                                </tr>
                                <tr><td class="ligne" colspan="4">&nbsp;</td></tr>
                                <tr><td colspan="4">&nbsp;</td></tr>
                                <tr>
                                    <td class="titre"><label for="nom_enf">Nom de l'enfant <em>*</em></label></td>
                                    <td>
                                        <input type="text" name="nom_enf" id="nom_enf" value="" required/>                                    </td>
                                    <td class="titre"><label for="prenom_enf">Prénom <em>*</em></label></td>
                                    <td><input type="text" name="prenom_enf" id="prenom_enf" value="" required/></td>
                                </tr>
                                <tr>
                                    <td class="titre"><label for="date_nais">Date de naissance <em>*</em></label></td>
                                    <td>
                                        <input type="text" name="date_nais" id="date_nais" value="" required/>                                    </td>

                                    <td class="titre"><label for="nationalite">Nationalité</label></td>
                                    <td><input type="text" name="nationalite" id="nationalite" value="" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="titre"><label for="adr">Adresse <em>*</em></label></td>
                                    <td>
                                        <input type="text" name="adr" id="adr" value="" required/> 
                                </tr>
                                <tr>
                                    <td class="titre"><label for="tel">Tél.<em>*</em></label></td>
                                    <td><input type="tel" name="tel" id="tel" value="" required/></td>
                                </tr>
                                <tr>
                                    <td class="titre"><label for="email">E-mail <em>*</em></label></td>
                                    <td>
                                        <input type="email" name="email" id="email" value="" required/>                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr><td class="ligne" colspan="4">&nbsp;</td></tr>
                                <tr><td colspan="4">&nbsp;</td></tr>
                                <tr>
                                    <td class="titre"><label for="nom_mere">Nom de la mére</label></td>
                                    <td><input type="text" name="nom_mere" id="nom_mere" value="" /></td>

                                    <td class="titre"><label for="nom_pere">Nom du pére</label></td>
                                    <td><input type="text" name="nom_pere" id="nom_pere" value="" /></td>
                                </tr>
                                <tr>
                                    <td class="titre"><label for="prof_mere">Profession</label></td>
                                    <td><input type="text" name="prof_mere" id="prof_mere" value="" /></td>

                                    <td class="titre"><label for="prof_pere">Profession</label></td>
                                    <td><input type="text" name="prof_pere" id="prof_pere" value="" /></td>
                                </tr>
                                <tr>
                                    <td class="titre"><label for="email_mere">E-mail</label></td>
                                    <td><input type="text" name="email_mere" id="email_mere" value="" /></td>

                                    <td class="titre"><label for="email_pere">E-mail</label></td>
                                    <td><input type="text" name="email_pere" id="email_pere" value="" /></td>
                                </tr>
                                <tr>
                                    <td class="titre"><label for="tel_mere">Tél.</label></td>
                                    <td><input type="text" name="tel_mere" id="tel_mere" value="" /></td>

                                    <td class="titre"><label for="tel_pere">Tél.</label></td>
                                    <td><input type="text" name="tel_pere" id="tel_pere" value="" /></td>
                                </tr>
                                <tr>
                                    <td class="titre"><label for="date_entree">Date d'entrée<br />&nbsp;souhaitée </label></td>
                                    <td><input type="text" name="date_entree" id="date_entree" value="" /></td>

                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr><td class="ligne" colspan="4">&nbsp;</td></tr>
                                <tr><td colspan="4">&nbsp;</td></tr>
                                <tr>
                                    <td class="titre"><label>Jours</label></td>
                                    <td class="day" colspan="3">
                                        <input type="checkbox" name="jourSa" id="jourSa" value="Samedi"  /><span>Samedi</span>
                                        <input type="checkbox" name="jourDi" id="jourDi" value="Dimanche"  /><span>Dimanche</span>
                                        <input type="checkbox" name="jourLu" id="jourLu" value="Lundi"  /><span>Lundi</span>
                                        <input type="checkbox" name="jourMa" id="jourMa" value="Mardi"  /><span>Mardi</span>
                                        <input type="checkbox" name="jourMe" id="jourMe" value="Mercredi"  /><span>Mercredi</span>
                                        <input type="checkbox" name="jourJe" id="jourJe" value="Jeudi"  /><span>Jeudi</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="infos" colspan="4">&nbsp;Tous les champs marqués <em>*</em> sont obligatoires.</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td></td>   
                                    <td colspan="2"><input type="submit" value="Envoyer" /><input type="reset" value="Réinitialiser" /></td>   
                                    <td></td>   
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <!--footer avec poussins-->
            <div id="footer">
                <div id="poussinballonrouge"> 
                    <img src="img/poussinballonrouge.png" alt="" title=""/>

                </div>
            </div>
        </div> <!--balisefinale-->
        <script language="javascript" type="text/javascript" src="js/jquery.min-1.11.3.js"></script>
        <script language="javascript" type="text/javascript" src="js/ekk-script.js"></script>	
    </body>
</html>