
<?php
    $sql = "DELETE FROM categories WHERE cat_id = ".$_GET['cat_id'];
    $result = mysqli_query($conn,$sql);
    header("Location: $urladmin?page=$categories");
?>

