<?php
session_start();
if(isset($_SESSION['uid'])){
	
	unset($_SESSION['uid']);
	header("location:adminLogin.php");
}else{
	header("location:adminLogin.php");
}
	
?>