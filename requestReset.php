<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'dbcon.php';

// Load Composer's autoloader
//require 'vendor/autoload.php';


//check if form was submitted
if(isset($_POST["email"])){

    $emailTo = $_POST["email"];

    $code = uniqid(true);
    $query = mysqli_query($con, "INSERT INTO resetPasswords(code, email) VALUES('$code', '$emailTo')");

    if(!$query){
        exit("Could not generate code");
    }

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {
    //Server settings
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'studentscheduleplanner@gmail.com';                     // SMTP username
    $mail->Password   = 'UCMMules';                               // SMTP password
    $mail->SMTPSecure = 'tls';     // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('studentscheduleplanner@gmail.com', 'Student Planner');
    $mail->addAddress($emailTo);
    $mail->addReplyTo('studentscheduleplanner@gmail.com', 'No reply'); 

    $mail->CharSet = "UTF-8";

    // Content
    $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetPassword.php?code=$code";
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Student Schedule Planner';
    $mail->Body    = "<h1> You requested a password reset</h1>
                        Click <a href='$url'> this link</a> to reset password";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Reset password link has been sent to your email';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
exit();

}
?>


<html>
<head> 

    <link href="requestReset.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
    <title> Login Form </title>
</head>
<body>
<div class="reset-container">
<form method="POST">
    <input type="text" name="email" placeholder="Email" autocomplete="off">
    <br>
    <input type="submit" name="submit" value="Reset password">
</form>
</div>
</body>
</html>