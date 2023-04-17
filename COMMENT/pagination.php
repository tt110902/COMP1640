<?php

$conn = mysqli_connect('localhost', 'root', '', 'btwev') or die("Can not connect database" . mysqli_connect_error());

require_once './Config/Functions.php';
$Fun_call = new Functions();

// if (!isset($_SESSION['user_name']) && !isset($_SESSION['user_uni_no'])) {
//     header('Location:../login/login.php');
// }

// $select_post = $Fun_call->select_order('poster', 'p_id');


$field['verify_token'] = $_SESSION['user_uni_no'];
$sel_user_img = $Fun_call->select_assoc('users', $field);

$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 4;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$select_post = $conn->query("SELECT * FROM poster LIMIT $start, $limit");
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
    <title>View</title>
    <link rel="icon" type="image/jpg" href="../images/favicon.jpg" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/jpg" href="../image/favicon.jpg" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f124118c9b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../COMMENT/CSS/Stylesheet.css">
    <link rel="stylesheet" href="../css/footer.css">
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
</style>

<body>
    ?>

    <div class="row">
        <div class="col-md-10">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="pagination.php?page=<?= $Previous; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo; Previous</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $pages; $i++): ?>
                        <li><a href="pagination.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                    <?php endfor; ?>
                    <li>
                        <a href="pagination.php?page=<?= $Next; ?>" aria-label="Next">
                            <span aria-hidden="true">Next &raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="text-center" style="margin-top: 20px; " class="col-md-2">
            <form method="post" action="#">
                <!-- <select name="limit-records" id="limit-records"> -->
                <!-- <option disabled="disabled" selected="selected" style="display: none"></option> -->
                <?php foreach ([4] as $limit):
                    4 ?>
                    <!-- <option <?php if (isset($_POST["limit-records"]) && $_POST["limit-records"] == $limit)
                        echo "selected" ?> value="<?= $limit; ?>"><?= $limit; ?></option> -->
                <?php endforeach; ?>
                <!-- </select> -->
            </form>
        </div>
    </div>


    <div class="cintainer-fluid">
        <div class="container">
            <div class="row">
                <?php if ($select_post) {
                    foreach ($select_post as $select_post_data) { ?>
                        <div class="col-sm-6 mt-2 mb-2">
                            <div class="card">
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
                                        <?php echo substr($select_post_data['p_text'], 0, 200) . '&nbsp;.......'; ?>
                                    </p>
                                    <a href="post_view.php?post_uni_no=<?php echo $select_post_data['p_uni_no']; ?>"
                                        class="btn btn-sm btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#limit-records").change(function () {
                $('form').submit();
            })
        })
    </script>

</body>


</html>