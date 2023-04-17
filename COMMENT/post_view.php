<?php

session_start();

require_once 'Config/Functions.php';
$Fun_call = new Functions();
global $post_no;

$field['verify_token'] = $_SESSION['user_uni_no'];
$sel_user_img = $Fun_call->select_assoc('users', $field);

if (!isset($_SESSION['user_name']) && !isset($_SESSION['user_uni_no'])) {
    header('Location:../login/login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['post_uni_no']) && is_numeric($_GET['post_uni_no'])) {

        $post_no = $Fun_call->validate($_GET['post_uni_no']);



        $condition['p_uni_no'] = $post_no;
        $fetch_post = $Fun_call->select_assoc('poster', $condition);

        $view = $fetch_post['view'];
        $view_update = $view + 1;
        $viewupdate = "UPDATE poster SET view = $view_update WHERE p_uni_no = '$post_no'";
        $conn = mysqli_connect('localhost', 'root', '', 'btwev');
        mysqli_query($conn, $viewupdate);

        if (!$fetch_post) {
            header('Location:post.php');
        }

    } else {
        header('Location:post.php');
    }

} else {
    header('Location:post.php');
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Idea</title>
    <link rel="icon" type="image/jpg" href="../image/favicon.jpg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f124118c9b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/Stylesheet.css">
</head>

<body>

    <?php
    include('./nav.php');
    ?>
    <br>

    <div class="container-fluid">
        <div class="container plr-15">
            <div class="row ml-0 mr-0">
                <div class="card" style="margin-bottom: 25px;">
                    <div class="box-img-100">
                        <img src="/1640/image/<?php echo $fetch_post['p_image']; ?>"
                            class="card-img-top justify-content-center" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php
                            echo $fetch_post['p_name']; ?> #
                            <?php

                            $cat_id = $fetch_post['p_cat'];
                            $catName = "SELECT cat_name FROM categories WHERE cat_id= '$cat_id'";
                            $conn = mysqli_connect('localhost', 'root', '', 'btwev');
                            $catName_run = $conn->query($catName);
                            while ($row = mysqli_fetch_array($catName_run)) {
                                echo $row['cat_name'];
                            }
                            ?>
                        </h5>
                        <p class="card-text">
                            <?php echo $fetch_post['p_text']; ?>
                        </p>

                        <a href="download.php?file=<?php
                        if ($fetch_post['p_file'] > 0) {
                            echo $fetch_post['p_file'];
                        } else {
                            echo "";
                        }
                        ?>"><?php if ($fetch_post['p_file'] > 0) {
                            echo $fetch_post['p_file'];
                        } else {
                            echo "";
                        } ?></a><br>
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'btwev');

                        $post_no = $Fun_call->validate($_GET['post_uni_no']);
                        $res = mysqli_query($conn, "select * from poster where p_uni_no='$post_no'");
                        if (mysqli_num_rows($res) > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {

                                $likeClass = "far";
                                if (isset($_COOKIE['like_' . $row['p_id']])) {
                                    $likeClass = "fas";
                                }

                                $dislikeClass = "far";
                                if (isset($_COOKIE['dislike_' . $row['p_id']])) {
                                    $dislikeClass = "fas";
                                }
                                ?>

                                <span class="pull-right" style="display: flex;">
                                    <i class="<?php echo $likeClass ?> fa-thumbs-up"
                                        onclick="setLikeDislike('like','<?php echo $row['p_id'] ?>')"
                                        id="like_<?php echo $row['p_id'] ?>" style="margin-left: -30%;"></i>
                                    <div id="like" style="padding-left: 5px;">
                                        <?php echo $row['like_count'] ?>
                                    </div>
                                    &nbsp;&nbsp;<i class="<?php echo $dislikeClass ?> fa-thumbs-down"
                                        onclick="setLikeDislike('dislike','<?php echo $row['p_id'] ?>')" " id=" dislike_<?php echo $row['p_id'] ?>" style="margin-left: 30%;"></i>
                                    <div id="dislike" style="padding-left: 5px;">
                                        <?php echo $row['dislike_count'] ?>
                                    </div>
                                </span>
                            <?php }
                        } ?>
                    </div>
                    <hr>

                    <?php
                    $time = date("Y-m-d");
                    $year = date("y");
                    $closetime = "SELECT * FROM closesuredate WHERE Year = $year";
                    $closetime_run = $conn->query($closetime);
                    while ($row = mysqli_fetch_array($closetime_run)) {
                        if ($row['Final_Date'] > $time) {
                            ?>

                            <div class="title-comment">Write Comment</div>
                            <div class="card-body">
                                <form id="comment_post" method="post">
                                    <div class="comment-area">
                                        <div class="comment-area-user">
                                        </div>
                                        <div class="comment-area-text" style="margin-left: -10%">
                                            <textarea class="form-control" id="usercomment" cols="30" rows="3"
                                                placeholder="Share Your Story"></textarea>
                                        </div>
                                        <div class="comment-area-btn">
                                            <button type="submit" class="btn btn-sm btn-primary comment-btn">Comment</button>
                                        </div>
                                        <span id="comment_error" class="error-msg"></span>
                                    </div>
                                </form>
                            </div>
                            <hr>

                            <div class="load-comments">
                            </div>
                        <?php
                        } else {
                            ?>
                            <h5>Time to collect suggestion of this post is over!!</h5>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"> </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"> </script>

        <script type="text/javascript">

            $(document).ready(function () {

                var post_uni = "<?php echo $post_no; ?>";

                $('.load-comments').load('Ajax/load_comments.php', { 'post_uni_no': post_uni });

                $('#comment_post').on('submit', function (e) {
                    e.preventDefault();
                    var flag = '000';
                    var c_text = $('#usercomment').val().trim();
                    var post_no = "<?php echo $fetch_post['p_uni_no']; ?>";
                    var post_user = "<?php echo $fetch_post['p_user'];
                    $post_no = $fetch_post['p_user']; ?>";

                    if (c_text != '' && c_text.length <= 8000) {

                        $.ajax({
                            type: "POST",
                            url: "Ajax/comment.php",
                            data: {
                                'comment_text': encodeURIComponent(c_text),
                                'post_no': encodeURIComponent(post_no),
                                'flag': encodeURIComponent(flag),
                                'post_user': encodeURIComponent(post_user),
                            },
                            success: function (response) {
                                $('#comment_post').trigger('reset');
                                $('#comment_error').text('');
                                $('.load-comments').load('Ajax/load_comments.php', { 'post_uni_no': post_uni });
                                $('html, body').animate({ scrollTop: $(document).height() }, 'slow');


                                console.log(res_status.msg);
                            }
                        });

                    }
                    else {

                        if (c_text == '') {
                            $('#comment_error').text('Please Enter Something');
                        }
                        if (c_text.length > 8000) {
                            $('#comment_error').text('Text Length must be less than 8000 charater');
                        }

                    }

                });

                $(document).on('click', '.replay-btn', function () {

                    $('#comment_post_replay').trigger('reset');
                    $('#comment_rep_error').text('');
                    $('#comment_post_replay').insertAfter($(this).parent().parent().next());
                    $('#comment_post_replay').show();

                });

                $(document).on('click', '#close_rep', function () {
                    $('#comment_post_replay').hide();
                });

                $(document).on('submit', '#comment_post_replay', function (e) {
                    e.preventDefault();
                    var reuni_no = $(this).prev().prev().children().find('.replay-btn').data('dataid');
                    var R_flag = '111';
                    var cr_text = $('#usercommentreplay').val().trim();
                    var user_no = "<?php echo $_SESSION['user_uni_no']; ?>";

                    if (cr_text != '' && cr_text.length <= 8000) {

                        $.ajax({
                            type: "POST",
                            url: "Ajax/comment.php",
                            data: {
                                'replay_text': encodeURIComponent(cr_text),
                                'user_no': encodeURIComponent(user_no),
                                'replay_no': encodeURIComponent(reuni_no),
                                'R_flag': encodeURIComponent(R_flag),
                            },
                            success: function (response) {

                                var res_status = JSON.parse(response);
                                if (res_status.status == 201) {

                                    $('#usercommentreplay').hide();
                                    $('.load-comments').load('Ajax/load_comments.php', { 'post_uni_no': post_uni });
                                    console.log(res_status.msg);

                                }
                                else {
                                    console.log(res_status.msg);
                                }

                            }
                        });

                    }
                    else {

                        if (cr_text == '') {
                            $('#comment_rep_error').text('Please Enter Something');
                        }
                        if (cr_text.length > 8000) {
                            $('#comment_rep_error').text('Text Length must be less than 8000 charater');
                        }

                    }

                });

            });

        </script>

        <script>
            function setLikeDislike(type, id) {
                jQuery.ajax({
                    url: 'setLikeDislike.php',
                    type: 'post',
                    data: 'type=' + type + '&p_id=' + id,
                    success: function (result) {
                        result = jQuery.parseJSON(result);
                        if (result.opertion == 'like') {
                            jQuery('#like_' + id).removeClass('far');
                            jQuery('#like_' + id).addClass('fas');
                            jQuery('#dislike_' + id).addClass('far');
                            jQuery('#dislike_' + id).removeClass('fas');
                        }
                        if (result.opertion == 'unlike') {
                            jQuery('#like_' + id).addClass('far');
                            jQuery('#like_' + id).removeClass('fas');
                        }

                        if (result.opertion == 'dislike') {
                            jQuery('#dislike_' + id).removeClass('far');
                            jQuery('#dislike_' + id).addClass('fas');
                            jQuery('#like_' + id).addClass('far');
                            jQuery('#like_' + id).removeClass('fas');
                        }
                        if (result.opertion == 'undislike') {
                            jQuery('#dislike_' + id).addClass('far');
                            jQuery('#dislike_' + id).removeClass('fas');

                        }

                        jQuery('#post' + id + ' #like').html(result.like_count);
                        jQuery('#post' + id + ' #dislike').html(result.dislike_count);
                        location.reload(true);
                    }

                });
            }
        </script>

</body>

</html>