<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
session_start();
$action = $_GET['action'];
 
 
/************************************* INSERT ********************************************/
switch($action)
{ 	
case "SUBMIT":

	$sql = "INSERT INTO `labour_creation`(`labour_name`, `mobile_no`, `address`, `labour_dob`, `working_place`, `crusher_place`, `active_status`, `created_employee_id`) VALUES (:labour_name, :mobile_no, :address, :labour_dob, :working_place, :crusher_place, :active_status, :employee_id)";		
	$pdo_statement = $pdo_conn->prepare($sql);					
	$result = $pdo_statement->execute(array(
				':labour_name'=>$_POST['labour_name'],':mobile_no'=>$_POST['mobile_no'], ':address'=>$_POST['address'], ':labour_dob'=>$_POST['labour_dob'], ':working_place'=>$_POST['working_place'], ':crusher_place'=>$_POST['crusher_place'], ':active_status'=>$_POST['active_status'], ':employee_id'=>$_SESSION['employee_id']));
 	
	if (!empty($result) ){
		echo "Successfully Created";
	}else { 
		print_r($pdo_statement->errorinfo());
	}

break;



case "UPDATE":
 
	$staff_statement =$pdo_conn->prepare("UPDATE labour_creation SET labour_name='".$_POST['labour_name']."',mobile_no='".$_POST['mobile_no']."',address='".$_POST['address']."',labour_dob='".$_POST['labour_dob']."',working_place='".$_POST['working_place']."',crusher_place='".$_POST['crusher_place']."',active_status='".$_POST['active_status']."',updated_employee_id='".$_SESSION['employee_id']."' WHERE labour_id='".$_POST['labour_id']."' ");
	$staff_up =$staff_statement->execute();
		
	if($staff_up) {		
		echo "Successfully Updated";
	}

break;

case "DELETE":
	
	$pdo_statement="DELETE FROM labour_creation where labour_id='".$_POST['labour_id']."' ";
	$result=$pdo_conn->exec($pdo_statement);
	
		if(!empty($result)) 
		{
		echo $msg = "Successfully Deleted";
	    }

break;
}


if($_GET['action']=='city_select'){
	
	  $city_select_name = $pdo_conn->prepare("SELECT * FROM city where state_id='".$_POST['state_id']."' AND district_id='".$_POST['district_id']."' ");
      $city_select_name->execute();
      $city_select = $city_select_name->fetchAll();
	  
	$city_val = '';
	$city_val .='<select class="form-control select2 item_name" name="city" id="city" required>
					<option value="">Select Your City</option>'; 
	foreach($city_select as $value){
		$city_val .= '<option value="'.$value['city_id'].'">'.$value['city_name'].'</option>'; 
	}
	$city_val .='</select>';
	
	echo $city_val;
	
}



?>