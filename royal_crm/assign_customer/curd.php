<?php

require_once('../inc/dbConnect.php');

/************************************* INSERT ********************************************/

if($_POST['action']=="Add")
{ 

    
		$sql = "INSERT INTO assign_customer (customer_id,staffcreation_id,status) VALUES (:customer_id,:staffcreation_id,:status)";
		$pdo_cityment = $pdo_conn->prepare($sql);
			
		$result = $pdo_cityment->execute(array(':customer_id'=>$_POST['customer_id'],':staffcreation_id'=>$_POST['staffcreation_id'],':status'=>$_POST['status']));
	
	
	if (!empty($result) ){
	  echo $msg = "Successfully Created";
	}
	//else { print_r($pdo_cityment->errorinfo()); }
}

/************************************* UPDATE ********************************************/
if($_POST['action']=="Update")
{
	
		$pdo_cityment=$pdo_conn->prepare("update assign_customer set customer_id='".$_POST['customer_id']."',staffcreation_id='".$_POST['staffcreation_id']."',status='".$_POST['status']."' where assign_customer_id=".$_POST['assign_customer_id']);
		$result = $pdo_cityment->execute();
	
	if(!empty($result)) {
		echo $msg = "Successfully Updated";
	}
	//else { print_r($pdo_cityment->errorinfo()); }
	
}

/************************************* DELETE ********************************************/

if($_POST['action']=="Delete")
{
	
	$pdo_cityment="DELETE FROM assign_customer where assign_customer_id=".$_POST['assign_customer_id'];
	$result=$pdo_conn->exec($pdo_cityment);
	if(!empty($result)) {
		echo $msg = "Successfully Deleted";
	}
	//else { print_r($pdo_cityment->errorinfo()); }
	
}



/********************************* District List ******************************************************/

if($_POST['action'] == 'district_list'){
	
	$district_by_state = $pdo_conn->prepare("SELECT * FROM district WHERE state_id = $_POST[state_id] ORDER BY district_id ASC");
	$district_by_state->execute();
	$districtbystate = $district_by_state->fetchAll();
	
	$state_val = '';
	
	//$state_val .='<select class="form-control select2 item_name" name="district_id" id="district_id" required>
	  $state_val .='<option value="">Select Your District</option>'; 
	foreach($districtbystate as $value){
		$state_val .= '<option value="'.$value['district_id'].'">'.$value['district_name'].'</option>'; 
	}
	//$state_val .='</select>';
	
	echo $state_val;	
}	 


?>