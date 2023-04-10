<?php 
    session_start();
	session_id();
	
	unset($_SESSION['user_id']);
	unset($_SESSION['employee_name']);
	unset($_SESSION['user_roll']);
	
	session_destroy();

			
?>