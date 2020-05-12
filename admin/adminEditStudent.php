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
    <h1 align = "center" style="color:black" > Student Editing Page </h1> 

    <br>
    <br>
	<button type="button" style="background-color: black" class="btn btn-danger btn-lg mt-auto" name="goHome" onclick="location.href='admindash.php'">Go Back to Homepage</button>
	<br>
	<br>
	<br>
<?php
include('../dbcon.php');

if(isset($_POST['update'])){
  $password = $_POST["password"];
  $password = md5($password);  
$UpdateQuery = "UPDATE student SET student_id='$_POST[student_id]', f_name='$_POST[f_name]', l_name='$_POST[l_name]', password='$_POST[password]', email='$_POST[email]', major_name='$_POST[major_name]' WHERE id='$_POST[hidden]'";               
mysqli_query($con, $UpdateQuery);
};

if(isset($_POST['delete'])){
$DeleteQuery = "DELETE FROM student WHERE id='$_POST[hidden]'";          
mysqli_query($con, $DeleteQuery);
};

if(isset($_POST['add'])){
$AddQuery = "INSERT INTO student (student_id, f_name, l_name, password, email, major_name) VALUES ('$_POST[uStudent_id]','$_POST[uF_name]','$_POST[uL_name]','$_POST[uPassword]','$_POST[uEmail]', '$_POST[uMajor_name]')";         
mysqli_query($con, $AddQuery);
};



$sql = "SELECT * FROM student";
$myData = mysqli_query($con, $sql);
echo "<div style='margin:auto'>
<table border=1 style='border-collapse:collapse padding-left:100px padding-right:100px' class='table table-hover table-sm table-bordered table-dark table-striped'>
<tr>
<th>Student ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Password</th>
<th>Email</th>
<th>Major</th>
</tr>";
while($record = mysqli_fetch_array($myData)){
echo "<form action=adminEditStudent.php method=post>";
echo "<tr>";

echo "<td>" . "<input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=student_id value='".$record['student_id']."' </td>";
echo "<td>" . "<input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=f_name value='".$record['f_name']."' </td>";
echo "<td>" . "<input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=l_name value='".$record['l_name']."' </td>";
echo "<td>" . "<input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=password value='".$record['password']."' </td>";
echo "<td>" . "<input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=email value='".$record['email']."' </td>";
echo "<td>" . "<input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=major_name value='".$record['major_name']."' </td>";
echo "<td>" . "<input type=hidden name=hidden value='".$record['id']."' </td>";
echo "<td>" . "<input type=submit style='background-color: black' class='btn btn-danger btn-sm mt-auto' name=update value=update"." </td>";
echo "<td>" . "<input type=submit style='background-color: black' class='btn btn-danger btn-sm mt-auto' name=delete value=delete"." </td>";
echo "</tr>";
echo "</form>";
}
echo "<form action=adminEditStudent.php method=post>";
echo "<tr>";

echo "<td><input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=uStudent_id></td>";
echo "<td><input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=uF_name></td>";
echo "<td><input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=uL_name></td>";
echo "<td><input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=uPassword></td>";
echo "<td><input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=uEmail></td>";
echo "<td><input type=text style='color:white; background-color:#2c3339; border-color:transparent' name=uMajor_name></td>";
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