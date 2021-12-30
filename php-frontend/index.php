<?php
session_start();
if(isset($_SESSION['token']) && !empty($_SESSION['token'])){
	
		header("Location: home.php");
	}
	else{
		 header("Location: login.php");
	}
  

?>