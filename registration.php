<!-- This is the student registeration page -->

<?php
session_start();
include('dbcon.php');
if(isset($_POST["register"])){
if(empty($_POST["num"]) && empty($_POST["password"])){

	echo '<script> alert("Both fields are required")</script>';


}
	else{
		   $username =$_POST["num"];
		   $password=$POST["password"];
		   $fName =$_POST["fName"];
		   $lName =$_POST["lName"];
		   $email =$_POST["email"];
		   //Security reason encrypt password
		   
		  $query = "INSERT INTO `student`(`student_id`, `f_name`, `l_name`, `password`, `email`) VALUES ('$username','$fName', '$lName','$password','$email')";

		  $run = mysqli_query($con,$query);
		  if($run){
				?>
				<script>
			  alert("Registration is Succesfull");

				</script>
				<?php
			  header('location:login.php');


		  }else{
			  echo'Error!!';

		  }
}

}



?>




<html>
<head>
	<link href="css/registration.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
		<title> Registeration </title>
		</head>

<body>

<!-- Form -->
		<form class="register" method="POST">
		<h1> Registeration </h1>
		<p style="color: darkgrey; font-size: 15px">
		Create an account to access your Schedule Planner
		</p>
		<br>
			<p>700# (This will be your username)</p>
			<input type="text" name="num" placeholder="Enter your 700#">
			<p> First Name </p>
			<input type="text" name="fName" placeholder="First name">
			<p> Last Name </p>
			<input type="text" name="lName" placeholder="Last name">
			<p> Password </p>
			<input type="password" name="password" placeholder="Enter a password">
			<p> Email </p>
			<input type="email" name="email" placeholder="Enter an email">
			<p> Major </p>
			<input type="text" name="major_name" placeholder="Enter your Major">
			<input type="submit" name="register" value="Register Now">

		</form>
</body>

</html>
