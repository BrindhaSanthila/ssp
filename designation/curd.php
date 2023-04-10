<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');

$action = $_GET['action'];
session_start();
/************************************* INSERT ********************************************/
switch($action)
{ 	
case "SUBMIT":
  
	$sql = "INSERT INTO `designation_creation`(`designation_name`, `reporting_to`, `created_employee_id`) VALUES (:designation_name, :reporting_to, :employee_id)";		
	$pdo_statement = $pdo_conn->prepare($sql);					
	$result = $pdo_statement->execute(array(':designation_name'=>$_POST['designation_name'], ':reporting_to'=>$_POST['reporting_to'], ':employee_id'=>$_SESSION['employee_id']));
 	
	if (!empty($result) ){
		echo "Successfully Created";
	}else { 
		print_r($pdo_statement->errorinfo());
	}

break;



case "UPDATE":
 
	$designation_statement =$pdo_conn->prepare("UPDATE designation_creation SET designation_name='".$_POST['designation_name']."',reporting_to='".$_POST['reporting_to']."',updated_employee_id='".$_SESSION['employee_id']."' WHERE designation_id='".$_GET['designation_id']."' ");
	$designation_up =$designation_statement->execute();
		
	if($designation_up) {		
		echo "Successfully Updated";
	}

break;

case "DELETE":
	
	$pdo_statement="DELETE FROM designation_creation where designation_id='".$_POST['designation_id']."' ";
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