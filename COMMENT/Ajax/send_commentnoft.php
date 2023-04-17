<?php
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

require_once '../Config/Functions.php';
$Fun_call = new Functions();
global $post_no;


if(!isset($_SESSION['user_name']) && !isset($_SESSION['user_uni_no'])){
    header('Location:index.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['post_uni_no']) && is_numeric($_POST['post_uni_no'])){

        $post_no = $Fun_call->validate($_POST['post_uni_no']);

        $conn = mysqli_connect('localhost', 'root', '', 'btwev');
        $p_user = "SELECT p_user FROM poster WHERE p_uni_no='$post_no'";
        $p_user_query = mysqli_query($conn,$p_user);
        if( $p_user_fetchdata = mysqli_fetch_array($p_user_query))
        {
        $p_user_data = $p_user_fetchdata['p_user'];
    
        $get_email = "SELECT email FROM users WHERE verify_token = '$p_user_data'";
        $get_email_run =  mysqli_query($conn,$get_email);
        if($row=mysqli_fetch_array($get_email_run))
        {
            $email = $row['email'];
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
                $mail->Body    = '<p>Someone Have give you the suggest for your idea in the comment fields</p>';
    
                $mail->send();
                echo 'Message has been sent';
                // echo "<meta http-equiv='refresh' content='0'>";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "</div>";
            $json_data['msg'] = "We have send a nofitication on your email address.";
    }
    else{
        echo "Invalid Data";
    }
}
}

}
else{
    echo "Invalid Method";
}
