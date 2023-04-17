<?php
    $sql = "delete from poster where p_id = '".$_GET['p_id']."'";
    $result = mysqli_query($conn,$sql);
    header("Location: $urladmin?page=$post");
?>

