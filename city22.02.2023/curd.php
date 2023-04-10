<?php

require_once('../inc/dbConnect.php');

/************************************* INSERT ********************************************/

if($_POST['action']=="Add")
{ 

  $select_city=$pdo_conn->prepare("SELECT COUNT(city_id) FROM city WHERE state_id LIKE '".$_POST['state_id']."' AND district_id LIKE '".$_POST['district_id']."' AND city_name LIKE '".$_POST['city_name']."' ");
    $select_city->execute();
    $city = $select_city->fetchAll();
	if($city[0]['COUNT(city_id)']==0)
	{
		$sql = "INSERT INTO city (state_id,district_id,city_name,status) VALUES (:state_id,:district_id,:city_name,:status)";
		$pdo_cityment = $pdo_conn->prepare($sql);
			
		$result = $pdo_cityment->execute(array(':state_id'=>$_POST['state_id'],':district_id'=>$_POST['district_id'],':city_name'=>$_POST['city_name'],':status'=>$_POST['status']));
	}
	else
	{
		echo "error";
	}
	
	if (!empty($result) ){
	  echo $msg = "Successfully Created";
	}
}

/************************************* UPDATE ********************************************/
if($_POST['action']=="Update")
{
	$select_city=$pdo_conn->prepare("SELECT COUNT(city_id) FROM city WHERE state_id LIKE '".$_POST['state_id']."' AND district_id LIKE '".$_POST['district_id']."' AND city_name LIKE '".$_POST['city_name']."' AND city_id!='".$_POST['city_id']."' ");
    $select_city->execute();
    $city = $select_city->fetchAll();
	if($city[0]['COUNT(city_id)']==0)
	{
		$pdo_cityment=$pdo_conn->prepare("update city set state_id='".$_POST['state_id']."',district_id='".$_POST['district_id']."',city_name='".$_POST['city_name']."',status='".$_POST['status']."' where city_id=".$_POST['city_id']);
		$result = $pdo_cityment->execute();
	}
	else
	{
		echo "error";
	}
	if(!empty($result)) {
		echo $msg = "Successfully Updated";
	}
		
}

/************************************* DELETE ********************************************/

if($_POST['action']=="Delete")
{
	
	$pdo_cityment="DELETE FROM city where city_id=".$_POST['city_id'];
	$result=$pdo_conn->exec($pdo_cityment);
	if(!empty($result)) {
		echo $msg = "Successfully Deleted";
	}
	
	
}



/********************************* District List ******************************************************/

if($_POST['action'] == 'district_list'){
	
	$district_by_state = $pdo_conn->prepare("SELECT * FROM district WHERE state_id = $_POST[state_id] ORDER BY district_id ASC");
	$district_by_state->execute();
	$districtbystate = $district_by_state->fetchAll();
	
	$state_val = '';
	$state_val .='<option value="">Select Your District</option>'; 
	foreach($districtbystate as $value){
		$state_val .= '<option value="'.$value['district_id'].'">'.$value['district_name'].'</option>'; 
	}
		
	echo $state_val;	
}	 


?>