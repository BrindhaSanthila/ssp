<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
session_start();
$action = $_GET['action'];
/************************************* INSERT ********************************************/

switch($action)
{ 	
case "SUBMIT":

		$sql = "INSERT INTO `party_creation`(`party_name`, `mobile_no`, `address`, `accounts_no`, `partytype`, `comp_name`, `person_name`, `contact_mob_no`, `gst_no`, `paymenttype`, `credit_days`, `auto_sms`, `active_status`, `created_employee_id`, `area_name`, `city_name`) VALUES (:party_name, :mobile_no, :address, :accounts_no, :partytype, :comp_name, :person_name, :contact_mob_no, :gst_no, :paymenttype, :credit_days, :auto_sms, :active_status, :employee_id, :area_name, :city_name)";		
		$pdo_statement = $pdo_conn->prepare($sql);					
		$result = $pdo_statement->execute(array(
				':party_name'=>$_POST['party_name'],':mobile_no'=>$_POST['mobile_no'], ':address'=>$_POST['address'], ':accounts_no'=>$_POST['accounts_no'], ':partytype'=>$_POST['partytype'], ':comp_name'=>$_POST['comp_name'], ':person_name'=>$_POST['person_name'], ':contact_mob_no'=>$_POST['contact_mob_no'], ':gst_no'=>$_POST['gst_no'], ':paymenttype'=>$_POST['paymenttype'], ':credit_days'=>$_POST['credit_days'], ':auto_sms'=>$_POST['auto_sms'], ':active_status'=>$_POST['active_status'], ':employee_id'=>$_SESSION['employee_id'], ':area_name'=>$_POST['area_name'], ':city_name'=>$_POST['city_name']));
 	
	if (!empty($result) ){
		echo "Successfully Created";
	}else { 
		print_r($pdo_statement->errorinfo());
	}

break;



case "UPDATE":

	$staff_statement =$pdo_conn->prepare("UPDATE `party_creation` SET `party_name`='".$_POST['party_name']."', `mobile_no`='".$_POST['mobile_no']."', `address`='".$_POST['address']."', `accounts_no`='".$_POST['accounts_no']."', `partytype`='".$_POST['partytype']."', `comp_name`='".$_POST['comp_name']."', `person_name`='".$_POST['person_name']."', `contact_mob_no`='".$_POST['contact_mob_no']."', `gst_no`='".$_POST['gst_no']."', `paymenttype`='".$_POST['paymenttype']."', `credit_days`='".$_POST['credit_days']."', `auto_sms`='".$_POST['auto_sms']."', `active_status`='".$_POST['active_status']."', `updated_employee_id`='".$_SESSION['employee_id']."', `area_name`='".$_POST['area_name']."', `city_name`='".$_POST['city_name']."' WHERE `party_id`='".$_GET['party_id']."'");
	$staff_up =$staff_statement->execute();
		
	if($staff_up) {		
		echo "Successfully Updated";
	}

break;

case "DELETE":
	
	$pdo_statement="DELETE FROM party_creation where party_id='".$_POST['party_id']."' ";
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

if($_GET['action']=='get_partytype_details'){
	$get_partytype_details = $pdo_conn->prepare("SELECT * FROM partytype_creation where partytype_id='".$_POST['partytype_id']."' ");
    $get_partytype_details->execute();
    $partytype_details = $get_partytype_details->fetchAll();

	$partytype = '';

	if($partytype_details[0]['req_comp_name']=='Yes'){
	$partytype .= '<div class="col-md-12 col-lg-8 ">
	 	<div class="form-group">
				<h5>Company Name</h5>
				<div class="controls">
					<input type="text" name="comp_name" id="comp_name" value="';
					if($partytype_details[0]['req_comp_name']!=''){$partytype_details[0]['req_comp_name'];}
					$partytype .=	'" class="form-control" onchange="validation(this.id)"  >
	 			</div>
			</div>
	</div>';
	}

	if($partytype_details[0]['req_person_name']=='Yes'){
		$partytype .= '<div class="col-md-12 col-lg-8 ">
		<div class="form-group">
				<h5>Contact Person Name</h5>
				<div class="controls">
					<input type="text" name="person_name" id="person_name" value="';
					if($partytype_details[0]['req_person_name']!=''){$partytype_details[0]['req_person_name'];}
					$partytype .=	'" class="form-control" onchange="validation(this.id)"  >
				</div>
			</div>
	</div>';
	}

	if($partytype_details[0]['req_mobile_no']=='Yes'){
		$partytype .= '<div class="col-md-12 col-lg-8 ">
		<div class="form-group">
				<h5>Contact Person Mobile No</h5>
				<div class="controls">
					<input type="text" name="contact_mob_no" id="contact_mob_no" value="';
					if($partytype_details[0]['req_mobile_no']!=''){$partytype_details[0]['req_mobile_no'];}
					$partytype .=	'" class="form-control" onchange="validation(this.id)"  >
				</div>
			</div>
	</div>';
	}

	if($partytype_details[0]['req_gst']=='Yes'){
		$partytype .= '<div class="col-md-12 col-lg-8 ">
		<div class="form-group">
				<h5>GST No</h5>
				<div class="controls">
					<input type="text" name="gst_no" id="gst_no" value="';
					if($partytype_details[0]['req_gst']!=''){$partytype_details[0]['req_gst'];}
					$partytype .=	'" class="form-control" onchange="validation(this.id)"  >
				</div>
			</div>
	</div>';
	}

	echo $partytype;
}

?>