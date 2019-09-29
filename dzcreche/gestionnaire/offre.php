<?php 
    session_start();
        if(!isset($_SESSION) or $_SESSION['type']!="entreprise"){
        header("Location: gestionnaire.php");
    }

require_once '../includes/bd.php';
        $id=$_SESSION['id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!empty($_POST['title']) and !empty($_POST['description'])){
        $title=$_POST['title'];
        $description=$_POST['description'];
        $prix=$_POST['prix'];
        $type=$_POST['type'];
        $query="INSERT INTO `service`( `titre`, `description`, `prix`, `id_entreprise`,type) VALUES ('$title','$description','$prix','$id','$type')";
        $result=mysqli_query($con,$query);
    }
    if(isset($_POST) and !empty($_POST['delete'])){
        $query="DELETE FROM demander1 WHERE id_service='{$_POST['delete']}'";
        $result=mysqli_query($con,$query);
        $query="DELETE FROM service WHERE id='{$_POST['delete']}'";
        $result=mysqli_query($con,$query);
    }
}
include 'header.php';
?>
<div class="contentn">
<div class="container">
<h1><center>اضف خدمة</center></h1>
<form class="form-horizontal ho" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table width="100%">
        <tr>
            <td><label class="control-label" for="title">الخدمة</label></td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control" id="title" name="title"  required />
                </div>
            </td>
        </tr>
        <tr>
            <td><label class="control-label" for="description">وصف الخدمة</label></td>
            <td>
                <div class="form-group">
                    <textarea name="description" class="form-control" id="description"></textarea>
                </div>
            </td>
        </tr>
        <tr>
            <td><label class="control-label" for="prix">السعر</label></td>
            <td>
                <div class="form-group">  
                    <input type="numbre" class="form-control" id="prix" name="prix"  required />
                </div>
            </td>
        </tr>
        <tr>
            <td><label class="control-label" for="type">نوع الخدمة</label></td>
            <td>
                <div class="form-group">  
                    <div class="form-group">
                         <select class="form-control" id="type" name="type" required>
                            <option value="produit">بيع</option>
                            <option value="service">خدمة</option>
                    </select>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group">
                    <button type="submit" class="btn btn-default btn-lg">اعرض الخدمة</button>
                </div>
            </td>
        </tr>
    </table>
</form>
</div>
<hr />
<div class="container">
<h1><center>خدماتي</center></h1>
<?php 
$query="SELECT * FROM service WHERE id_entreprise='$id'";
        $result=mysqli_query($con,$query);
        if (mysqli_num_rows($result) > 0) {
            while($row=mysqli_fetch_assoc($result)): 
             $id=$row['id_entreprise'];
             $query1="SELECT nom,service FROM entreprise WHERE id='$id'";
             $result1=mysqli_query($con,$query1);
             $row1=mysqli_fetch_assoc($result1); ?>
            <div class="offre">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <button type="submit" name="delete" class="btn btn-default btn-sm" value="<?php echo $row['id']; ?>">&times;</button>
            </form>
            <img src="../includes/getimage.php?id=<?php echo $id.'&type=entreprise'; ?>" alt="Avatar" style="width:100px">
            <p><span><a href="#"><?php echo $row1['nom']; ?></a></span></p>
            <p>الوظيفة : <?php echo $row1['service']; ?></p>
            <p>الخدمة : <?php echo $row['titre']; ?></p>
            <p>وصف : <?php echo $row['description']; ?></p>
            <p>السعر: <strong><?php echo $row['prix']; ?>DZ</strong></p>
            </div>
 <?php endwhile; 
        }else{
            echo "<p>ليس هناك اي نتائج</p>";
        }
     ?>
</div>
<?php //include 'footer.php'; ?>