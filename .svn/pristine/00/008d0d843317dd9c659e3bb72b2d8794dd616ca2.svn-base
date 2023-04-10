<?php 

	require_once('../inc/dbConnect.php');
	session_start();
	session_id();
	$login_name = $_POST['login_name'];
	$login_password = $_POST['login_password'];
	$user_type = $_POST['user_type'];

	$select_usercreation=$pdo_conn->prepare("SELECT * FROM staffcreation WHERE staff_type='2' AND password='$login_password'");
		$select_usercreation->execute();
		$checklogin = $select_usercreation->fetchAll();
	
if($user_type == 'admin') 
	{
		$select_usercreation=$pdo_conn->prepare("SELECT * FROM usercreation WHERE user_name='$login_name' AND password='$login_password' AND active_status='1'");
		$select_usercreation->execute();
		$checklogin = $select_usercreation->fetchAll();
		if(!empty($checklogin)) 
		{
			foreach($checklogin as $value) 
			{
				$_SESSION['usercreation_id'] = $value['usercreation_id'];
				$_SESSION['full_name'] = $value['full_name'];
				$_SESSION['user_roll'] = $value['user_roll'];			
			} 
			echo "Success";
		}
		else
		{
			echo "Check Login Details";
		}	
	}
	
	if($user_type == 'staff') 
	{
		$select_staffcreation=$pdo_conn->prepare("SELECT * FROM staffcreation WHERE user_name='$login_name' AND password='$login_password' AND staff_type!='2' AND delete_status !='1'");
		$select_staffcreation->execute();
		$checklogin1 = $select_staffcreation->fetchAll();
		if(!empty($checklogin1)) 
		{
			foreach($checklogin1 as $value) 
			{
				$_SESSION['usercreation_id'] = $value['staffcreation_id'];
				
				$_SESSION['full_name'] = $value['staff_name'];
				$_SESSION['user_roll'] = $value['staff_type'];
				
			} 
			echo "Success";
		}
		else
		{
			echo "Check Login Details";
		}	
	}
?>