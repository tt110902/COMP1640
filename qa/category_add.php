<?php
require_once ('connection.php');
?>
<br>
<div id="main-content" class="container allContent-section py-6" style="margin-left:20%; width:70%;">
    <h2>Add New Category</h4>
    <hr>
    <form id="update-Items" method="post" enctype='multipart/form-data'>
        <div class="form-group">
        <label for="InputName">Name</label>
        <input required type="text" class="form-control" name="inputName" placeholder="Name" value="<?php echo "" . isset($cat_name) ? $cat_name : ""; ?>"></br>
        </div>
        <div class="form-group">
            <div class="from-group col md-12">
            <input type="submit" class="btn btn-success" name="btn_Submit" value="Submit"/>
        <input type="button" class="btn btn-danger" name="btnIgnore" value="Ignore" onclick="window.location='<?php echo '?page=' . $categories; ?>'"/>
            </div>
        </div>
    </form>
</div>
<?php
$err="";
$name="";
    if (isset($_POST['btn_Submit'])) {
        $cat_name = $_POST["inputName"];
        $sql = "INSERT INTO categories (cat_name) VALUES ('$cat_name')";
        $sql_run = mysqli_query($conn, $sql);
    }
    if($name==""){
        $err .="<li> Enter Category Name";
    }
    if(empty($err)){
        $sql="SELECT * FROM categories WHERE cat_name = '$cat_name'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==0){
            $sql="INSERT INTO categories(cat_name) VALUE($cat_name')";
            mysqli_query($conn,$sql);
            header("Location: $urladmin?page=$categories");           
        }else{
            $err .="<li>Duplicate</li>";
        }
    }
?>

