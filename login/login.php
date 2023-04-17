<!-- Code by Brave Coder - https://youtube.com/BraveCoder -->

<?php
    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: welcome.php");
        die();
    }

    $msg = "";
	$conn = mysqli_connect('localhost', 'root', '', 'btwev');

    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE verify_token='{$_GET['verification']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE users SET verified_status = '1' WHERE verify_token='{$_GET['verification']}'");
            
            if ($query) {
                $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
            }
        } else {
            header("Location: login.php");
        }
    }

    require_once '../COMMENT/Config/Functions.php';
$Fun_call = new Functions();

if (isset($_SESSION['user_name']) && isset($_SESSION['user_uni_no'])) {
	header('Location:../index.php');
}

$u_error = $p_error = $error_msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if (isset($_POST['submit'])) {

		$username = $Fun_call->validate($_POST['username']);
		$password = $Fun_call->validate(md5($_POST['password']));

		$save_cookie = (isset($_POST['savepass'])) ? ($Fun_call->validate($_POST['savepass'])) : '';

		if ((!preg_match('/^[ ]*$/', $username)) && (!preg_match('/^[ ]*$/', $password))) {

			$verify_fields['email'] = $username;
			$verify_fields['u_pass'] = $password;
			$verify_user = $Fun_call->user_verify("users", $verify_fields);

			if ($verify_user) {

				$sql = "SELECT * FROM users WHERE email = '$username'";
				
				$status =  mysqli_fetch_assoc(mysqli_query($conn,$sql));
				if($status['verified_status'] == 1)
				{
					$fetch_user_info = $Fun_call->select_assoc('users', $verify_fields);

					if (!empty(trim($save_cookie))) {
	
						setcookie('username', $username, time() + (365 * 24 * 60), "/");
						setcookie('userpass', $password, time() + (365 * 24 * 60), "/");
					}
	
					$_SESSION['user_name'] = $fetch_user_info['u_name'];
					$_SESSION['user_uni_no'] = $fetch_user_info['verify_token'];
					$_SESSION['Roles'] = $fetch_user_info['roles'];

					if($fetch_user_info['roles'] ==  0)
					{
						header('Location:../index.php');
					}
					elseif($fetch_user_info['roles'] ==  1)
					{
						header('Location:http://localhost/1640/qa/');
					}
					elseif($fetch_user_info['roles'] ==  2)
					{
						header('Location:http://localhost/1640/admin/');
					}
	
					
				}
				else
				{
					$error_msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
				}


			} else {
				$error_msg = "Username and Passwword are Invalid";
			}
		} else {

			if (preg_match('/^[ ]*$/', $username)) {
				$u_error = "Please Enter Username";
			}
			if (preg_match('/^[ ]*$/', $password)) {
				$p_error = "Please Enter Password";
			}
		}
	} else {
		$error_msg = "Invalid Request Not Allow";
	}
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sign In</title>
	<link rel="icon" type="image/jpg" href="../image/favicon.jpg" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/f124118c9b.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="Stylesheet.css">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">

</head>

<body>
	<div class="container-fluid login-bg">
		<div class="container ">
			<div class="row">
				<div class="box-container">
					<div class="card w-400">
						<div class="card-body">
							<h2 class="card-title text-center pt-3 pb-3 ">Sign In</h2>
							<hr>
							<form class="login-box" method="post">
								<div class="form-label-group">
									<label for="username"><b>Email</b></label>
									<input type="email" id="username" name="username" class="form-control mb-2" placeholder="Email" value="<?php echo @$_COOKIE['username']; ?>" autofocus>
									<span class="error-msg"><?php echo @$u_error; ?></span>
								</div>

								<div class="form-label-group">
									<label for="password"><b>Password</b></label>
									<input type="password" id="password" name="password" class="form-control mb-2" placeholder="Password" value="<?php echo @$_COOKIE['userpass']; ?>">
									<span class="error-msg"><?php echo @$p_error; ?></span>
								</div>

								<div class="custom-control custom-checkbox mb-3">
									<input type="checkbox" class="custom-control-input" id="savepass" name="savepass" value="savepass">
									<label class="custom-control-label" for="savepass">Remember password</label>
								</div>
								<span class="error-msg"><?php echo @$error_msg; ?></span>
								<hr>
								<input class="btn btn-primary btn-block " name="submit" value="Submit" type="submit">
							</form>
							<div class="reminder">
								<p class="member">Not a member? <a href="signup.php" >Sign up now</a></p>
								<p class="member">Forgot Your password? <a href="password_reset.php" >Forgot password</a></p>
								<p class="member">Did not Recived a verify email? <a href="resend_email.php" >Resend verify email</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</body>

</html>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>