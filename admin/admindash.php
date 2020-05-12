<?php
session_start();
 //now here we need to check whether it is accessing or not
if(isset($_SESSION['uid'])){

}//if not then we will redirect it to login page.
else{
  //../ means if the session destroy and you are again accessing the
//admindash then it will redirect you to the login page to login first
  header('location:adminlogin.php');
}

?>
<?php
 //in order to use header file
 //we don't need to write in every file the basic code for html
include('header.php');
?>
<html>
<head>

  <meta charset="utf-8">
  <title>Student Management System</title>
  <link href = "../css/style.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
    <nav class="admintitle">
    <h1 align = "center" >Welcome to Schedule Planner </h1>
    <h4><a href="adminLogout.php" style="float:right; padding-right: 60px; color:#fff; font-size:20px;">Logout</a></h4>
    </nav>

   	<br>
   	<br>
   	<br>

   	<div style="text-align: center">
   		<button style="background-color: black" class="btn btn-danger btn-lg mt-auto" type="button" name="students" onclick="location.href='adminEditStudent.php'">Add/Edit Student</button>
      <br>
      <br>
      <br>
   		<button style="background-color: black" class="btn btn-danger btn-lg mt-auto" type="button" name="courses" onclick="location.href='adminEditCourses.php'">Add/Edit Courses</button>	
   	</div>


 </body>
 </html>
