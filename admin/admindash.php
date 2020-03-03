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
     <div class="admintitle" align="center">
     <h1>Welcome to Admin Dashboard</h1>
   </div>

 </body>
 </html>
