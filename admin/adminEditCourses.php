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
<!DOCTYPE HTML>
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
    <h1 align = "center" style="color:black" > Course Editing Page </h1> 
    <br>
    <br>
	<button type="button" style="background-color: black" class="btn btn-danger btn-lg mt-auto" name="goHome" onclick="location.href='admindash.php'">Go Back to Homepage</button>
	<br>
	<br>
	<br>
<?php
include('../dbcon.php');

if(isset($_POST['update'])){
$UpdateQuery = "UPDATE major_classes SET courseAbrv='$_POST[courseAbrv]', courseName='$_POST[courseName]', creditHours='$_POST[creditHours]', fall='$_POST[fall]', spring='$_POST[spring]' WHERE courseID='$_POST[hidden]'";               
mysqli_query($con, $UpdateQuery);
};

if(isset($_POST['delete'])){
$DeleteQuery = "DELETE FROM major_classes WHERE courseID='$_POST[hidden]'";          
mysqli_query($con, $DeleteQuery);
};

if(isset($_POST['add'])){
$AddQuery = "INSERT INTO major_classes (courseAbrv, courseName, creditHours, fall, spring) VALUES ('$_POST[uCourseAbrv]','$_POST[uCourseName]','$_POST[uCreditHours]','$_POST[uFall]','$_POST[uSpring]')";         
mysqli_query($con, $AddQuery);
};



$sql = "SELECT * FROM major_classes";
$myData = mysqli_query($con, $sql);
echo "<div style='margin:auto'>
<table border=1 style='border-collapse:collapse padding-left:100px padding-right:100px' class='table table-hover table-sm table-bordered table-dark table-striped'>
<tr>
<th>Course Abrv</th>
<th>Course Name</th>
<th>Credit Hours</th>
<th>Fall Availability</th>
<th>Spring Availability</th>
</tr>";
while($record = mysqli_fetch_array($myData)){
echo "<form action=adminEditCourses.php method=post>";
echo "<tr>";
echo "<td>" . "<input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=courseAbrv value='".$record['courseAbrv']."' </td>";
echo "<td>" . "<input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=courseName value='".$record['courseName']."' </td>";
echo "<td>" . "<input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=creditHours value='".$record['creditHours']."' </td>";
echo "<td>" . "<input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=fall value='".$record['fall']."' </td>";
echo "<td>" . "<input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=spring value='".$record['spring']."' </td>";
echo "<td>" . "<input type=hidden name=hidden value='".$record['courseId']."' </td>";
echo "<td>" . "<input type=submit style='background-color: black' class='btn btn-danger btn-sm mt-auto' name=update value=update"." </td>";
echo "<td>" . "<input type=submit style='background-color: black' class='btn btn-danger btn-sm mt-auto' name=delete value=delete"." </td>";
echo "</tr>";
echo "</form>";
}
echo "<form action=adminEditCourses.php method=post>";
echo "<tr>";
echo "<td><input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=uCourseAbrv></td>";
echo "<td><input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=uCourseName></td>";
echo "<td><input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=uCreditHours></td>";
echo "<td><input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=uFall></td>";
echo "<td><input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=uSpring></td>";
echo "<td>"."<input type=submit style='background-color: black' class='btn btn-danger btn-sm mt-auto' name=add value=add"." </td>";
echo "</tr>";
echo "</form>";
echo "</table>";
echo "</div>";
mysqli_close($con);
?>
</div>
<?php
 //in order to use header file
 //we don't need to write in every file the basic code for html
include('header.php');
?>
</body>
</html>