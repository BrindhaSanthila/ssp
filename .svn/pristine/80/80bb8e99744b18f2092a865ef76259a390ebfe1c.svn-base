<?php 
include 'inc/header.php';
//echo "SELECT * FROM usercreation WHERE usercreation_id='$usercreationid' AND active_status='1'";


if($usercreationid) 

{ 

	?>
	<div class="wrapper">
	<?php include 'inc/menu.php'; ?>	
	<?php include 'inc/left-menu.php'; ?>	
	<div class="content-wrapper">
	<?php 	 
	$fileroot = $_GET['file'];
	$filepath = explode('/',$fileroot);
	$foldername = $filepath[0];
	$filename = $filepath[1];
	if($fileroot)
	{ 
   
	$select_type=$pdo_conn->prepare("SELECT * FROM userroll WHERE userroll_id='$userroll'");
	$select_type->execute();
	$type_name = $select_type->fetch();
	$user_type = $type_name['roll_name'];
	if($user_type=='Admin') 
	{	
		$select_usercreation=$pdo_conn->prepare("SELECT * FROM usercreation WHERE usercreation_id='$usercreationid' AND active_status='1'");
		$select_usercreation->execute();
		$fetch_details = $select_usercreation->fetch();
		$user_type_id=$fetch_details['usercreation_id'];
		$usercreation_id=$fetch_details['usercreation_id'];
}
if($user_type=='staff') 
	{	
		
		$select_usercreation=$pdo_conn->prepare("SELECT * FROM staffcreation WHERE staffcreation_id='$usercreationid'");
		$select_usercreation->execute();
		$fetch_details = $select_usercreation->fetch();
		
		$usercreation_id=$fetch_details['staffcreation_id'];
        $user_type_id=$fetch_details['staff_type'];
}
		include $foldername.'/'.$filename.'.php';
	}
	else
	{ 
		include 'dashboard.php';
	}
	?>
	</div>  
	<?php include 'inc/footer.php'; ?>
	</div>
	<?php 
}
else
{ 
	include 'login.php'; 
}
include 'inc/footer-bottom.php'; 
?>
