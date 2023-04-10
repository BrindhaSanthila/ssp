<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');

$action = $_GET['action'];
 
/************************************* INSERT ********************************************/
switch($action)
{ 	
case "SUBMIT":

  if(isset($_FILES['file']['name']))
  {  	
    $name = $_FILES['file']['name'];
	$target_dir = '../upload/staff/';
    $target_file = $target_dir.basename($_FILES["file"]["name"]);
  }
  else
  {
	$name = '';  
  }
  
   if($name!='')
	{
 	    move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
	}

	if($_POST['employee_mobile'] == 'Yes' || $_POST['employee_web'] == 'Yes'){
		$user = "INSERT INTO `user_creation`(`employee_name`, `user_name`, `password`, `token_id`, `active_status`) VALUES (:employee_name, :user_name, :password, :token_id, :active_status)";		
		$user_pdo_statement = $pdo_conn->prepare($user);					
		$user_result = $user_pdo_statement->execute(array(':employee_name'=>$_POST['employee_name'],':user_name'=>$_POST['mobile_no'], ':password'=>$_POST['employee_id'], ':token_id'=>$_POST['token_id'], ':active_status'=>$_POST['active_status']));
	}
		$sql = "INSERT INTO `employee_creation`(`employee_name`, `mobile_no`, `address`, `designation`, `employee_mobile`, `employee_web`, `id_proof`, `active_status`) VALUES (:employee_name, :mobile_no, :address, :designation, :employee_mobile, :employee_web, :id_proof, :active_status)";		
		$pdo_statement = $pdo_conn->prepare($sql);					
		$result = $pdo_statement->execute(array(
				':employee_name'=>$_POST['employee_name'],':mobile_no'=>$_POST['mobile_no'], ':address'=>$_POST['address'], ':designation'=>$_POST['designation'], ':employee_mobile'=>$_POST['employee_mobile'], ':employee_web'=>$_POST['employee_web'], ':id_proof'=>$name, ':active_status'=>$_POST['active_status']));
 	
	if (!empty($result) ){
		echo "Successfully Created";
	}else { 
		print_r($pdo_statement->errorinfo());
	}

break;



case "UPDATE":
 
    if(isset($_FILES['file']['name']))
  {
    $name = $_FILES['file']['name'];
	$target_dir = '../upload/staff/';
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
  }
  else
  {
	$name = '';  
  }
 	
	if($name != '')
	{			 
move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
}

	$staff_statement =$pdo_conn->prepare("UPDATE employee_creation SET employee_name='".$_POST['employee_name']."',mobile_no='".$_POST['mobile_no']."',address='".$_POST['address']."',designation='".$_POST['designation']."',employee_mobile='".$_POST['employee_mobile']."',employee_web='".$_POST['employee_web']."',id_proof='".$_POST['id_proof']."',active_status='".$_POST['active_status']."' WHERE employee_id='".$_POST['employee_id']."' ");
	$staff_up =$staff_statement->execute();
		
	if($staff_up) {		
		echo "Successfully Updated";
	}

break;

case "DELETE":
	
	$pdo_statement="DELETE FROM employee_creation where employee_id='".$_POST['employee_id']."' ";
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