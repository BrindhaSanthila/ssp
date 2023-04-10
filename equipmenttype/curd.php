<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
session_start();
$action = $_GET['action'];

/************************************* INSERT ********************************************/
switch($action)
{ 	

// case "SUBADD":

// 	$sql = "INSERT INTO `equipmentnature_creation`(`equipmentnature_name`, `outturn`) VALUES (:work_name, :outturn)";		
// 	$pdo_statement = $pdo_conn->prepare($sql);					
// 	$result = $pdo_statement->execute(array(':work_name'=>$_POST['work_name'], 	':outturn'=>$_POST['outturn']));
// print_r($result);
	
	

// break;

case "SUBMIT":

		$sql = "INSERT INTO `equipmenttype_creation`(`equipmenttype_name`, `equipment_load`, `mileage_km`, `mileage_hr`, `reading_km`, `reading_hr`, `equipmentnature`, `designation`, `active_status`, `created_employee_id`) VALUES (:equipmenttype_name, :equipment_load, :mileage_km, :mileage_hr, :reading_km, :reading_hr, :equipmentnature, :designation, :active_status, :employee_id)";		
		$pdo_statement = $pdo_conn->prepare($sql);					
		$result = $pdo_statement->execute(array(':equipmenttype_name'=>$_POST['equipmenttype_name'], ':equipment_load'=>$_POST['equipment_load'], ':mileage_km'=>$_POST['mileage_km'], ':mileage_hr'=>$_POST['mileage_hr'], ':reading_km'=>$_POST['reading_km'], ':reading_hr'=>$_POST['reading_hr'], ':equipmentnature'=>$_POST['equipmentnature'], ':designation'=>$_POST['designation'], ':active_status'=>$_POST['active_status'], ':employee_id'=>$_SESSION['employee_id']));
 	
	if (!empty($result) ){
		echo "Successfully Created";
	}else { 
		print_r($pdo_statement->errorinfo());
	}

break;



case "UPDATE":
 
	$staff_statement =$pdo_conn->prepare("UPDATE equipmenttype_creation SET equipmenttype_name='".$_POST['equipmenttype_name']."',equipment_load='".$_POST['equipment_load']."',mileage_km='".$_POST['mileage_km']."',mileage_hr='".$_POST['mileage_hr']."',reading_km='".$_POST['reading_km']."',reading_hr='".$_POST['reading_hr']."',equipmentnature='".$_POST['equipmentnature']."',designation='".$_POST['designation']."',active_status='".$_POST['active_status']."',updated_employee_id='".$_SESSION['employee_id']."' WHERE equipmenttype_id='".$_POST['equipmenttype_id']."' ");
	$staff_up =$staff_statement->execute();
		
	if($staff_up) {		
		echo "Successfully Updated";
	}

break;

case "DELETE":
	
	$pdo_statement="DELETE FROM equipmenttype_creation where equipmenttype_id='".$_POST['equipmenttype_id']."' ";
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