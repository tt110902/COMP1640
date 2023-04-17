

<div class="sidebar" id="mySidebar" style="width: 250px;">
    <a class="logo" href=" ?page=home.php">
        <img src="../image/Logo.png" class="center">
    </a>
    <br>
    <div class="side-header">
        <h4 class="center" style="margin-top:10px;">Hello, QA</h4>
    </div>

    <hr>
    <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a> -->
    <a href="<?php echo $urladmin."?page=chart.php"; ?>"><i class="fa fa-home"></i> Dashboard</a>
    <a href="<?php echo $urladmin."?page=statistic.php"; ?>"><i class="fa fa-th"></i> Statistic</a>
    <a href="<?php echo $urladmin."?page=category.php"; ?>"><i class="fa fa-th-large"></i> Category</a>
    <a href="<?php echo $urladmin."?page=post.php";?>"><i class="fa fa-th-large"></i> Idea</a>
    <hr>
    <a href="<?php echo "http://localhost:8080/1640/COMMENT/post.php?page=1" ?>" target="_blank"><i class="fa fa-th-list"></i> View Posts</a>
    <hr>
</div>