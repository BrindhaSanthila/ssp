<?php
ob_start();
session_start(); 
$user_id = $_SESSION['user_id'];
if($user_id!='')
{
	if(($_GET['file']!='')&&($_GET['view']!='')) 
	{ 
		$file =$_GET['file'];
		$view = $_GET['view'];
		if(file_exists("controller/".$_GET['file'].".php"))
		{
		include("controller/".$_GET['file'].".php");
		$cclass = new $file;
		$cclass->$view();
		}
		else
		{
		echo "<script>window.location.href='error.php'</script>";
		}
	}
	else { include("main.php"); }
}
else
{
	echo "<script>window.location.href='index.php'</script>";
}
?>