<?php
include("dbcon.php");

if(!isset($_GET["code"])){
	exit("Can't find page");
}

$code = $_GET["code"];

$getEmailQuery = mysqli_query($con, "SELECT email FROM resetPasswords WHERE code='$code'");
if(mysqli_num_rows($getEmailQuery) == 0){
	exit("Can't find page");
}

if(isset($_POST["password"])){
	$pw = $_POST["password"];
	$pw = md5($pw);

	$row = mysqli_fetch_array($getEmailQuery);
	$email = $row["email"];

	$query = mysqli_query($con, "UPDATE student SET password='$pw' WHERE email='$email'" );

	if($query){
		$query = mysqli_query($con, "DELETE FROM resetPasswords WHERE code='code'");
		exit("password updated");
	}
	else{
		exit("Something went wrong");
	}
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
	<input type="password" name="password" placeholder="New password">
	<br>
	<input type="submit" name="submit" value="Update password">
</form>
</div>
</body>
</html>
