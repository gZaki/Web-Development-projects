    <?php 
        session_start();

require_once '../includes/bd.php'; 

        $query="SELECT * FROM service ORDER BY id DESC";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result) > 0) {
            while($row=mysqli_fetch_assoc($result)): 
             $id=$row['id_entreprise'];
             $query1="SELECT nom,service FROM entreprise WHERE id='$id'";
             $result1=mysqli_query($con,$query1);
             $row1=mysqli_fetch_assoc($result1); ?>
            <div class="offre">
                <a href="../gestionnaire/getentrepage.php?id=<?php echo $id; ?>"><img src="../includes/getimage.php?id=<?php echo $id; ?>&type=<?php echo 'entreprise'; ?>" alt="Avatar" style="width:100px"></a>
                <p><span><a href="../gestionnaire/getentrepage.php?id=<?php echo $id; ?>"><?php echo $row1['nom']; ?></a></span></p>
                <p>الوظيفة : <?php echo $row1['service']; ?></p>
                <p>الخدمة : <?php echo $row['titre']; ?></p>
                <p>وصف : <?php echo $row['description']; ?></p>
                <p>السعر: <strong><?php echo $row['prix']; ?>DZ</strong></p>
                
                <form action="insert.php" method="post">
                    <?php 
                        $ide=$_SESSION['id'];
                        
                        $ids=$row['id'];
                        $query1="SELECT * FROM demander WHERE id='$ide' and id_service='$ids'";
                        $result1=mysqli_query($con,$query1);
                        //$row1=mysqli_fetch_assoc($result1);
                    ?>
                    <div class="form-group">
                        <?php if(!$row1=mysqli_fetch_assoc($result1)){ 
                            $mes= "طلب الخدمة";
                            /*if($ide==$id){ 
                               $des="disabled";
                            }else{*/
                              $des="";              
                            //}
                        }else{
                               if(date("Y-m-d")>=$row1['content'] and $row1['content']!="0000-00-00"){                   
                                $mes= "طلب الخدمة";
                                $des="";              

                               }else{
                                    $mes= $row1['status'];
                                    $des="disabled";
                               }
                            
                        } ?>
                        <div class="col-md-3 pull-right">
                             <input type="text" name="content" class="form-control col-md-3" <?php if(!empty($des)) echo 'style="display:none;"'; ?> />
                        </div>
                        <button type="submit"  name="submit" value="<?php echo $row['id']; ?>" class="btn btn-primary btn-sm <?php echo $des; ?>">
                        <?php echo $mes; ?>
                        </button>
                    </div>
                </form>
            </div>
 <?php endwhile; 
        }else{
            echo "<p>ليس هناك اي نتائج</p>";
        }
     ?>
