<?php 
 require_once("../dz-adminpanl/Include/DB.php");

include'header.php'; ?>

    <div class="col-md-12"style="padding-top:60px;">
        <div style="/*background:white;*/">
            <img src="../images/CrechesDZLogo.png" style="width: 20%;height: 150px;float:left;"  />
               <div id="pub" style="width:60%;display: inline-block;"></div>
               <div id="sponsor" style="display: inline-block;"><img src="logo.png" width="100%" /></div>
                    <div style="clear:both"></div>

        </div>
<!--
<div style="background:url(images/20986459_127614434449815_255473107_n.png);height: 150px;width:100%;"></div>
    </div>-->
        
        <main role="main" id="content">
            <div id="listing-actus">
    
   
    <div class="container listing-creches listing-actus">

        <div class="nopadding intro">
            <h1><center>المواضيع الابوية</center></h1>
            <div>
                <center><p>ستجد هنا كل الجديد في المجال التربوي و النفسي لما يخدم مصلحة طفلكم و  بنمي قدراته الفكرية و الادراكية</p></center>
            </div>
        </div>
        <div style="clear:both"></div>
        <div>
            <form action="" method="get">
                <div class="row">
                    <center>
                        <div class="col-lg-6 pull-right">
                            <div class="input-group">
                            <input type="text" class="form-control" name="q"  placeholder="ابحث عن" aria-label="ابحث عن">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" name="qButton" type="submit">بحث</button>
                            </span>
                            </div>
                        </div>
                
                    </center>
                </div>
            </form>
        </div>
        <?php
		// Query when q Button is Active
		if(isset($_GET["q"])){
			$q=$_GET["q"];
			
		$query="SELECT * FROM admin_panel
		WHERE datetime LIKE '%$q%' OR title LIKE '%$q%'
		OR category LIKE '%$q%' OR post LIKE '%$q%' ORDER BY id desc";
		}
		// QUery When Category is active URL Tab
		elseif(isset($_GET["Category"])){
		$q=$_GET["Category"];
	$query="SELECT * FROM admin_panel WHERE category='$q' ORDER BY id desc";	
		}
		// Query When Pagination is Active i.e Blog.php?page=1
		elseif(isset($_GET["page"])){
		$page=$_GET["page"];
		if($page==0||$page<1){
			$showarticle=0;
		}else{
		$showarticle=($page*8)-8;}
	$query="SELECT * FROM admin_panel ORDER BY id desc LIMIT $showarticle,8";
		}
		// The Default Query for Blog.php page
		else{
			
		$query="SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,8";}
		$result=mysqli_query($DB,$query);
		while($row=mysqli_fetch_array($result)):
			$id=$row["id"];
			$date_ec=$row["datetime"];
			$title=$row["title"];
			$cat=$row["category"];
			$admin=$row["author"];
			$image=$row["image"];
			$post=$row["post"];
            
		
		?>

        <div id="ias-items-list" class="liste tips nopadding" style="margin-top:20px;">
                <div class="ias-item shadow actualites" style="margin-right:8px;">
                    <div class="illustration" style="width:558px;height:330px;" >
                        <a href="FullPost.php?id=<?php echo $id; ?>">
                            <img alt="<?php echo htmlspecialchars($title); ?>" style="width:558px;height:330px;" title="<?php echo htmlspecialchars($title); ?>" src="../dz-adminpanl/Upload/<?php echo $image;  ?>"  /></a>
                    </div>

                    <div class="contenu desc-conseils">
                        <div class="sub-actualites"><?php echo htmlspecialchars($date_ec); ?></div>
                        <h3><a href="FullPost.php?id=<?php echo $id; ?>" title="<?php echo $title; ?>"><?php echo htmlspecialchars($title); ?></a></h3>
                        <div class="content-max"><?php echo $post; ?></div>
                        <a href="FullPost.php?id=<?php echo $id; ?>" title="<?php echo htmlspecialchars($title); ?>"><div class="suite proxima-bold"><div class="arrow"><img src="images/ui-fleche-suite.svg" alt="Suite"></div><span>Lire la suite</span></div></a>
                    </div>
                    
                </div> 
                   
        </div> 
                   <?php endwhile; ?>    
                 
                   
    </div>
</div>
<?php 
if(isset($_GET["Category"]) or isset($_GET["q"])){
    $query="SELECT COUNT(*) FROM admin_panel
		WHERE datetime LIKE '%$q%' OR title LIKE '%$q%'
		OR category LIKE '%$q%' OR post LIKE '%$q%'";
}
else{
$query="SELECT COUNT(*) FROM admin_panel";
}
      $result=mysqli_query($DB,$query);
      $row=mysqli_fetch_array($result);
      $total=array_shift($row);
      $tpage=$total/7;
      $tpage=ceil($tpage);

?>
      <nav aria-label="Page navigation example" style="text-align:center">
        <ul class="pagination justify-content-center">
          <li class="page-item <?php if($page==0 or $page==1) echo 'hidden'; ?>">
            <a class="page-link" href="blog.php?page=<?php $previous=$page-1;echo $previous; ?>" tabindex="-1">Previous</a>
          </li>
      <?php 
      for($i=1;$i<=$tpage;$i++){?>
          <li class="page-item <?php if($i==$page) echo 'active'; ?>"><a class="page-link" href="blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php
      }?>
          <li class="page-item <?php if($page==$tpage) echo 'hidden'; ?>">
      <a class="page-link" href="blog.php?page=<?php $next=$page+1;echo $next; ?>">Next</a>
    </li>
  </ul>
</nav>



<script>
    $(document).ready(function(){
        /* Height block article */
        var initDotdotdot = function() {
            $(".desc-conseils .content-max").dotdotdot({
                ellipsis	: '... ',
                height		: null
            });
        }
        initDotdotdot();});
</script>        </main>

            </body>
</html>