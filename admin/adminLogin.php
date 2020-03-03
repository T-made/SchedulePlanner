<!-- this is the admin login -->
<?php
//if you are going to open a new terminal and you already login
//then it should redirect you to the admin dash
//session will set when user login so use isset
session_start();
if(isset($_SESSION['uid'])){
  header('location:admindash.php');
}
?>
<html>
<head>

	<link href="../css/Login.css" rel="stylesheet" type="text/css"
	<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
	<title> Login Form </title>



<body>
	<div class="logincontainer">
		<h1> Schedule Planner </h1>
		<form method="POST" action="adminLogin.php">

			<p> Username </p>
			<input type="text" name="uname" placeholder="Enter Username">
			<p> Password </p>
			<input type="password" name="pass" placeholder="Enter Password">
			<input type="submit" name="login" value="Login">
			<a href="#"> Forgot password? </a><br>
			<a href="../registration.php"> Don't have an account? Sign up </a><br>
			<a href="../index.php"> Are you a Student?</a>

		</form>
	</div>


</body>
</head>
</html>
<!-- now we need to add php code -->
<?php
//add database connection first
include('dbcon.php');
//when submit button click then process otherwise not
//so use if (isset) method
if(isset($_POST['login'])){
     //store username and password into a variables
     $username = $_POST['uname'];
     $password = $_POST['pass'];

     //now check whether they are match or not
     $qry = "SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password';";
     //now execute
     $run = mysqli_query($con,$qry);
     //if there is no data in the database then this one will give you zero row
     //so check the number of rows
     //it will return the number of rows in output
     //if there is no row then we dont need to login the admin
     $row = mysqli_num_rows($run);
     if($row < 1){
       ?>

       <script>alert('Username or Password not match');
       //redirect to the same page
       //_self means this page will referesh on this page only
       window.open('adminLogin.php','_self');
       </script>
       <?php
     }else{
       //if more than one then we will fetch the username and password
      $data = mysqli_fetch_assoc($run);
      //first we need the id of the admin
      //if the result is true then
      //it means whatever the result will come in data that will come in the associative
      //array so in data array there will be a key with name id
      $id = $data['id'];
      session_start();
      $_SESSION['uid'] = $id;
      //redirect
     header('location:admindash.php');
     }

}


 ?>
