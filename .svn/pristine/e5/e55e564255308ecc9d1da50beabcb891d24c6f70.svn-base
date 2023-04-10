<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
session_start();
$action = $_GET['action'];
 
/************************************* INSERT ********************************************/
switch($action)
{ 	
case "SUBMIT":

	$sql = "INSERT INTO `partytype_creation`(`partytype_name`, `req_comp_name`, `req_person_name`, `req_mobile_no`, `req_gst`, `created_employee_id`) VALUES (:partytype_name, :req_comp_name, :req_person_name, :req_mobile_no, :req_gst, :created_employee_id)";		
	$pdo_statement = $pdo_conn->prepare($sql);					
	$result = $pdo_statement->execute(array(':partytype_name'=>$_POST['partytype_name'],':req_comp_name'=>$_POST['req_comp_name'], ':req_person_name'=>$_POST['req_person_name'], ':req_mobile_no'=>$_POST['req_mobile_no'], ':req_gst'=>$_POST['req_gst'], ':created_employee_id'=>$_SESSION['employee_id']));
 	
	if (!empty($result) ){
		echo "Successfully Created";
	}else { 
		print_r($pdo_statement->errorinfo());
	}

break;



case "UPDATE":

	$staff_statement =$pdo_conn->prepare("UPDATE partytype_creation SET partytype_name='".$_POST['partytype_name']."',req_comp_name='".$_POST['req_comp_name']."',req_person_name='".$_POST['req_person_name']."',req_mobile_no='".$_POST['req_mobile_no']."',req_gst='".$_POST['req_gst']."',updated_employee_id='".$_SESSION['employee_id']."' WHERE partytype_id='".$_GET['partytype_id']."' ");
	$staff_up =$staff_statement->execute();
		
	if($staff_up) {		
		echo "Successfully Updated";
	}

break;

case "DELETE":
	
	$pdo_statement="DELETE FROM partytype_creation where partytype_id='".$_POST['partytype_id']."' ";
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