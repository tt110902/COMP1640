<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: welcome.php");
    die();
}

//Load Composer's autoloader
require 'vendor/autoload.php';

include 'dbcon.php';
$msg = "";

    if (isset($_POST['submit'])) {
        $id = rand();
        $uimg = "0.png";
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
        $code = mysqli_real_escape_string($conn, md5(rand()));

        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";
        } else {    
            if ($password === $confirm_password) {
                $sql = "INSERT INTO users (u_id, u_name, email, u_pass, verify_token, u_img) VALUES ('{$id}','{$name}', '{$email}', '{$password}', '{$code}' ,'{$uimg}')";
                $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<div style='display: none;'>";
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'hoangpnhtesting@gmail.com';                     //SMTP username
                    $mail->Password   = 'gvhhrdgktqqzewti';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('hoangpnhtesting@gmail.com');
                    $mail->addAddress($email);

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'no reply';
                    $mail->Body    = 'Here is the verification link <b><a href="http://localhost/1640/login/login.php/?verification=' . $code . '">http://localhost/1640/login/login.php/?verification=' . $code . '</a></b>';

                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                echo "</div>";
                $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Something went wrong .</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Sign Up</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />
    <!-- //Meta tag Keywords -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f124118c9b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Stylesheet.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <!--/Style-CSS -->
    <link rel="stylesheet" href="Stylesheet.css" type="text/css" media="all" />
    <!--//Style-CSS -->
    <link rel="icon" type="image/jpg" href="../image/favicon.jpg" />
    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>

    <!-- form section start -->
    <div class="container-fluid login-bg">
        <div class="container ">
            <div class="row">
                <div class="box-container">
                    <div class="card w-400">
                        <div class="card-body">
                            <h2 class="card-title text-center pt-3 pb-3 ">Register Now</h2>
                            <hr>
                            <form class="login-box" method="post">
                                <?php
                                echo $msg;
                                ?>

                                <div class="form-label-group">
                                    <label for="name"><b>Fullname</b></label>
                                    <input type="text" id="name" name="name" class="form-control mb-2" placeholder="Enter Your Name" value="<?php echo @$_COOKIE['username']; ?>" autofocus>
                                </div>
                                <div class="form-label-group">
                                    <label for="username"><b>Email</b></label>
                                    <input type="email" class="form-control mb-2" name="email" placeholder="Enter Your Email" value="<?php if (isset($_POST['submit'])) {
                                                                                                                                echo $email;
                                                                                                                            } ?>" required>
                                </div>
                                <div class="form-label-group">
                                    <label for="password"><b>Password</b></label>
                                    <input type="password" class="form-control mb-2" name="password" placeholder="Enter Your Password" required>
                                </div>
                                <div class="form-label-group">
                                    <label for="password"><b>Confirm Password</b></label>
                                    <input type="password" class="form-control mb-2" name="confirm-password" placeholder="Enter Your Confirm Password" required>
                                </div>
                                <span class="error-msg"><?php echo @$error_msg; ?></span>
                                <hr>                                
                                <input class="btn btn-primary btn-block" name="submit" value="Register" type="submit">
                            </form>
                            <div class="reminder">
                                <p class="member">Have an account! <a href="login.php">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //form section start -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function(c) {
            $('.alert-close').on('click', function(c) {
                $('.main-mockup').fadeOut('slow', function(c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>