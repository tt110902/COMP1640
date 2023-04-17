<?php

session_start();
$conn = mysqli_connect('localhost', 'root', '', 'btwev')
    or die("Can not connect database" . mysqli_connect_error());

require_once './function.php';
$Fun_call = new Functions();


$field['verify_token'] = $_SESSION['user_uni_no'];
$sel_user_img = $Fun_call->select_assoc('users', $field);

$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 4;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$select_post = $conn->query("SELECT * FROM poster ORDER BY like_count DESC LIMIT 4;");

$poster = $select_post->fetch_all(MYSQLI_ASSOC);

$result1 = $conn->query("SELECT count(p_id) AS id FROM poster");
$custCount = $result1->fetch_all(MYSQLI_ASSOC);
$total = $custCount[0]['id'];
$pages = ceil($total / $limit);

$Previous = $page - 1;
$Next = $page + 1;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="icon" type="image/jpg" href="./image/favicon.jpg" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f124118c9b.js" crossorigin="anonymous"></script>
</head>

<style>
    .pagination {
        margin-left: 10%;

    }

    .pagi {
        text-align: center;
        padding: 5px;
        border: solid 0.5px;
    }

    .cardSize {
        width: 80%;
        margin-left: 0;
        margin-right: 0;
        padding-right: 0;
    }

    .post-content {
        position: relative;
        width: 45%;
    }

    .top-row {
        display: flex;
    }

    .row-post {
        display: flex;
    }

    .container-post {
        margin-left: 8%;
    }

    .rand-post {
        width: 65%;
        margin-left: 0;
        margin-right: 0;
        padding-right: 0;
    }

    .top-post {
        margin-left: 15%;
    }

    .top-content {
        width: 65%;
        position: relative;
        margin-right: -200px;

    }

    .front {
        position: absolute;
        object-fit: cover;
    }

    .overlay {
        position: absolute;
        top: 90px;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #f8f9fa;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .overlay:hover {
        opacity: 1;
        background-color: #f8f9fa;
        width: 100%;
        height: 200%;
    }

    .text-over {
        background-color: rgba(242, 244, 252);


        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.5em;
        font-weight: bold;
        text-align: center;
        text-transform: uppercase;
    }
</style>

<body>
    <?php include('./nav.php'); ?>





    <div class="text-center" style="margin-top: 20px; " class="col-md-2">
        <form method="post" action="#">
            <?php foreach ([4] as $limit) :
                4 ?>
                <!-- <option <?php if (isset($_POST["limit-records"]) && $_POST["limit-records"] == $limit)
                                    echo "selected" ?> value="<?= $limit; ?>"><?= $limit; ?></option> -->
            <?php endforeach; ?>
            <!-- </select> -->
        </form>
    </div>
    </div>

    <?php
    $select_post = $conn->query("SELECT * FROM poster ORDER BY RAND() LIMIT 2;");
    ?>
    <div class="cintainer-fluid" style="position: relative;  top: 20px;">
        <div class="top-post">
            <div class="top-row">
                <?php if ($select_post) {
                    foreach ($select_post as $select_post_data) { ?>
                        <div class="top-content">
                            <div class="card rand-post">
                                <div class="front">
                                    <img src="/1640/image/<?php echo $select_post_data['p_image']; ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="overlay">
                                    <div class="card-body text-over">
                                        <h5 class="card-title">
                                            <?php echo $select_post_data['p_name']; ?> #
                                            <?php
                                            $cat_id = $select_post_data['p_cat'];
                                            $catName = "SELECT cat_name FROM categories WHERE cat_id= '$cat_id'";
                                            $catName_run = $conn->query($catName);
                                            while ($row = mysqli_fetch_array($catName_run)) {
                                                echo $row['cat_name'];
                                            }

                                            ?>
                                        </h5>
                                        <p class="card-text">
                                        </p>
                                        <a href="./COMMENT/post_view.php?post_uni_no=<?php echo $select_post_data['p_uni_no']; ?>" class="btn btn-sm btn-primary">Read
                                            More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>

        <?php
        $select_post = $conn->query("SELECT * FROM poster ORDER BY view DESC LIMIT 4;");
        ?>
        <h3 class=""
            style="    position: relative; margin-top: 325px; border-bottom: solid 0.5px; margin-left: 12%; width: 80%;">
            Top view</h3></br>
        <div class="cintainer-fluid like" style="position: relative;  top: 50px;">
            <div class="container-post">
                <div class="row-post">
                    <?php if ($select_post) {
                        foreach ($select_post as $select_post_data) { ?>
                            <div class="post-content">
                                <div class="card cardSize">
                                    <img src="/1640/image/<?php echo $select_post_data['p_image']; ?>" class="card-img-top"
                                        alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $select_post_data['p_name']; ?> #
                                            <?php
                                            $cat_id = $select_post_data['p_cat'];
                                            $catName = "SELECT cat_name FROM categories WHERE cat_id= '$cat_id'";
                                            $catName_run = $conn->query($catName);
                                            while ($row = mysqli_fetch_array($catName_run)) {
                                                echo $row['cat_name'];
                                            }

                                            ?>
                                        </h5>
                                        <p class="card-text">
                                        </p>
                                        <a href="./COMMENT/post_view.php?post_uni_no=<?php echo $select_post_data['p_uni_no']; ?>"
                                            class="btn btn-sm btn-primary">Read More</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>


        <?php
        $select_post = $conn->query("SELECT * FROM poster ORDER BY view DESC LIMIT 4;");
        ?>
        <h3 class="" style="    position: relative; margin-top: 325px; border-bottom: solid 0.5px; margin-left: 12%; width: 80%;">
            Top view</h3></br>
        <div class="cintainer-fluid like" style="position: relative;  top: 50px;">
            <div class="container-post">
                <div class="row-post">
                    <?php if ($select_post) {
                        foreach ($select_post as $select_post_data) { ?>
                            <div class="post-content">
                                <div class="card cardSize">
                                    <img src="/1640/image/<?php echo $select_post_data['p_image']; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $select_post_data['p_name']; ?> #
                                            <?php
                                            $cat_id = $select_post_data['p_cat'];
                                            $catName = "SELECT cat_name FROM categories WHERE cat_id= '$cat_id'";
                                            $catName_run = $conn->query($catName);
                                            while ($row = mysqli_fetch_array($catName_run)) {
                                                echo $row['cat_name'];
                                            }

                                            ?>
                                        </h5>
                                        <p class="card-text">
                                        </p>
                                        <a href="./COMMENT/post_view.php?post_uni_no=<?php echo $select_post_data['p_uni_no']; ?>" class="btn btn-sm btn-primary">Read More</a>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>


        <?php
        $select_post = $conn->query("SELECT * FROM poster ORDER BY view DESC LIMIT 4;");
        ?>
        <h3 class=""
            style="    position: relative; margin-top: 325px; border-bottom: solid 0.5px; margin-left: 12%; width: 80%;">
            Top view</h3></br>
        <div class="cintainer-fluid like" style="position: relative;  top: 50px;">
            <div class="container-post">
                <div class="row-post">
                    <?php if ($select_post) {
                        foreach ($select_post as $select_post_data) { ?>
                            <div class="post-content">
                                <div class="card cardSize">
                                    <img src="/1640/image/<?php echo $select_post_data['p_image']; ?>" class="card-img-top"
                                        alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $select_post_data['p_name']; ?> #
                                            <?php
                                            $cat_id = $select_post_data['p_cat'];
                                            $catName = "SELECT cat_name FROM categories WHERE cat_id= '$cat_id'";
                                            $catName_run = $conn->query($catName);
                                            while ($row = mysqli_fetch_array($catName_run)) {
                                                echo $row['cat_name'];
                                            }

                                            ?>
                                        </h5>
                                        <p class="card-text">
                                        </p>
                                        <a href="./COMMENT/post_view.php?post_uni_no=<?php echo $select_post_data['p_uni_no']; ?>"
                                            class="btn btn-sm btn-primary">Read More</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>


        <?php
        $select_post = $conn->query("SELECT * FROM poster ORDER BY like_count DESC LIMIT 4;");
        ?>
        <h3 class=""
            style="position: relative; margin-top: 80px; border-bottom: solid 0.5px; margin-left: 12%; width: 80%;">
            Top likest</h3></br>
        <div class="cintainer-fluid like" style="position: relative;  top: 50px;">
            <div class="container-post">
                <div class="row-post">
                    <?php if ($select_post) {
                        foreach ($select_post as $select_post_data) { ?>
                            <div class="post-content">
                                <div class="card cardSize">
                                    <img src="/1640/image/<?php echo $select_post_data['p_image']; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $select_post_data['p_name']; ?> #
                                            <?php
                                            $cat_id = $select_post_data['p_cat'];
                                            $catName = "SELECT cat_name FROM categories WHERE cat_id= '$cat_id'";
                                            $catName_run = $conn->query($catName);
                                            while ($row = mysqli_fetch_array($catName_run)) {
                                                echo $row['cat_name'];
                                            }

                                            ?>
                                        </h5>
                                        <p class="card-text">
                                        </p>
                                        <a href="./COMMENT/post_view.php?post_uni_no=<?php echo $select_post_data['p_uni_no']; ?>" class="btn btn-sm btn-primary">Read More</a>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>

        <?php
        $select_post = $conn->query("SELECT * FROM poster ORDER BY Added_date DESC LIMIT 4;");
        ?>
        <h3 style="    position: relative; margin-top: 80px; border-bottom: solid 0.5px; margin-left: 12%; width: 80%;">
            Top newest</h3></br>
        <div class="cintainer-fluid">
            <div class="container-post">
                <div class="row-post">
                    <?php if ($select_post) {
                        foreach ($select_post as $select_post_data) { ?>
                            <div class="post-content">
                                <div class="card cardSize">
                                    <img src="/1640/image/<?php echo $select_post_data['p_image']; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?php echo $select_post_data['p_name']; ?> #
                                            <?php
                                            $cat_id = $select_post_data['p_cat'];
                                            $catName = "SELECT cat_name FROM categories WHERE cat_id= '$cat_id'";
                                            $catName_run = $conn->query($catName);
                                            while ($row = mysqli_fetch_array($catName_run)) {
                                                echo $row['cat_name'];
                                            }

                                            ?>
                                        </h5>
                                        <p class="card-text">
                                        </p>
                                        <a href="./COMMENT/post_view.php?post_uni_no=<?php echo $select_post_data['p_uni_no']; ?>" class="btn btn-sm btn-primary">Read More</a>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

            <script type="text/javascript">
                $(document).ready(function() {
                    $("#limit-records").change(function() {
                        $(' form').submit();
                    })
                })
            </script>

</body>
<?php include('./footer.php');


?>


</html>