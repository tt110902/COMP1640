<?php
require_once ('connection.php');

?>
<br>
<div id="main-content" class="container allContent-section py-6" style="margin-left:20%; width:70%;">
    <h2>Edit Category</h4>
    <hr>

    <form id="update-Items" method="post" enctype='multipart/form-data'>
        <div class="form-group">
            <label for="InputName">Name</label>
            <input type="text" class="form-control" name="inputName" placeholder="" value="<?php echo "". isset($cat_name)?$cat_name:"";?>"></br>
        </div>
        <div class="form-group">
            <div class="from-group col md-12">
                <input type="submit" class="btn btn-primary" name="btnUpdate" value="Update">
                <input type="button" class="btn btn-danger" name="btnIgnore" value="Ignore" onclick="window.location='<?php echo '?page='.$categories; ?>'" />
            </div>
        </div>
    </form>
</div>


<?php
$err="";
$cat_name="";
$cat_id="";
if(isset($_POST["btnUpdate"])){
    $cat_name=isset($_POST["inputName"])?$_POST["inputName"]:"";

    if($cat_name==""){
        $err .="<li> Enter Category Name";
    }
    if(empty($err)){

            $sql="UPDATE categories SET cat_name='$cat_name' WHERE cat_id='$cat_id' ";
            mysqli_query($conn,$sql);
            header("Location: $urladmin?page=$categories");           

    }
}else{
    if(isset($_GET["cat_id"])){
        $cat_name="";
        $sql= "SELECT * FROM categories WHERE cat_id=".$_GET["cat_id"];
        $results = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_array($results)){
            $cat_name= $row['cat_name'];
        }
    }
}
?>