
  <?PHP
  session_start();
  include('dbcon.php');
  if(isset($_POST["Login"])){
	  if(empty($_POST["username"]) && empty($_POST["password"])){


	  }else{
		  $username =$_POST['username'];
		   $password =$_POST['password'];

		   //$password = md5($password);

		  $query = "SELECT * FROM `student` WHERE student_id = '$username' AND password = '$password'";
		  //echo''.$query;
		  $result = mysqli_query($con, $query);
		  $check = mysqli_fetch_array($result);
		  if(isset($check))
		  {


			  echo 'Succesfull!!';
			  header("location:home.php");

		  }
		  else
		  {
			  echo 'Wrong User Details';
		  }


	  }
  }




  ?>





  <!DOCTYPE HTML>
<html>
<head>

	<link href="css/Login.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
	<title> Login Form </title>

</head>

<body>


		<form method="POST" class="logincontainer">
		<h1> Schedule Planner </h1>
			<p> Username </p>
			<input type="text" name="username" placeholder="Enter Username">
			<p> Password </p>
			<input type="password" name="password" placeholder="Enter Password">
			<input type="submit" name="Login" value="Login">
      <a href = "#">Forget Password? </a><br />
      <a href = "registration.php">Don't have an account? Sign up </a><br />
      <a href = "adminLogin.php">Are you an Administrator?</a><br />
			</form>

</body>

</html>
