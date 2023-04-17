<?php
session_start();
$err = "";

$conn = mysqli_connect('localhost', 'root', '', 'btwev')
    or die("Can not connect database" . mysqli_connect_error());

$time = date("Y-m-d");
$year = date("y");
$closetime = "SELECT * FROM closesuredate WHERE Year = $year";
$closetime_run = $conn->query($closetime);
while ($row = mysqli_fetch_array($closetime_run)) {
    if ($row['Closesure_date'] > $time) {

?>


        <?php
        $err = "";

        if (isset($_POST["btnSubmit"])) {
            $p_name = $_POST["p_name"];
            $p_text = $_POST["p_text"];
            $p_cat = $_POST["p_cat"];

            $p_user = $_SESSION['user_uni_no'];

            $imgName = $_FILES['img']['name'];
            $imgTmpName = $_FILES['img']['tmp_name'];


            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $path = "upload/" . $fileName;
            $imgpath = "image/" . $fileName;


            if ($p_name == "") {
                $err .= "<li> Enter post name";
            }
            if ($p_text == "") {
                $err .= "<li> Enter post description";
            }
            if ($imgName == "") {
                $err .= "<li> Choose images";
            }

            if (empty($err)) {
                $p_unino = rand();

                $sql = "INSERT INTO poster( p_name,p_user, p_image, p_text, p_uni_no, p_file, p_cat) VALUES ('$p_name','$p_user', '$imgName', '$p_text','$p_unino', '$fileName' , '$p_cat')";
                $sql_run = mysqli_query($conn, $sql);

                if ($sql_run) {
                    move_uploaded_file($imgTmpName, $imgpath);
                    move_uploaded_file($fileTmpName, $path);
                    header("Location: http://localhost/1640/COMMENT/post.php?page=1");
                } else {
                    $error = "Error uploading";
                }
            }
        }

        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <title>Add New Idea</title>
            <link rel="icon" type="image/jpg" href="./image/favicon.jpg" />
            <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        </head>

        <body>
            <?php include './nav.php'; ?>

            </div>
            <div style="margin: 3% 24% 5% 26%; width: 50%; font-family: 'Ubuntu';">
                <form action="post_add.php" method="post" enctype="multipart/form-data">
                    <h2 style = "text-align:center">Add New post</h2>
                    <hr>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="p_name" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>

                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea rows="8" class="form-control" type="text" name="p_text" id=""  placeholder="" aria-describedby="helpId"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" class="form-control" name="img">
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control" name="file">
                    </div>

                    <div class="form-group">
                        <label for="">Where you want to tag for</label>
                        <br>
                        <select class="select" name="p_cat" id="p_cat">
                            <?php
                            $sql = "SELECT * from categories";
                            $results = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($results)) {
                            ?>
                                <option value="<?php echo $row['cat_id'] ?>"><?php echo $row['cat_name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>
                    <!-- Checkbox Term and Condition -->
                    <div class="form-group">
                        <p>
                            <input id="field_terms" onchange="this.setCustomValidity(validity.valueMissing ? 'Please indicate that you accept the Terms and Conditions' : '');" type="checkbox" required name="terms">
                            I have read and agree to the
                            <a href="<?php echo "http://localhost/1640/policy.php" ?>" target="_blank">Policy</a>
                        </p>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="btnSubmit" value="Submit">
                        <input type="button" class="btn btn-danger" name="btnIgnore" value="Ignore" onclick="window.location='<?php echo "http://localhost/1640/COMMENT/post.php?page=1" ?>'">
                    </div>

                </form>
            </div>
            </div>
            <?php include './footer.php'; ?>
        </body>

        </html>
    <?php
    } else {
    ?> <h3>The time of add post have ended please wait for the next year</h3>
<?php
    }
}
?>