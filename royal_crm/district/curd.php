<?php

require_once('../inc/dbConnect.php');

/************************************* INSERT ********************************************/

if($_POST['action']=="Add")
{ 

    $select_district=$pdo_conn->prepare("SELECT COUNT(district_id) FROM district WHERE state_id LIKE '".$_POST['state_id']."' AND district_name LIKE '".$_POST['district_name']."' ");
    $select_district->execute();
    $district = $select_district->fetchAll();
	if($district[0]['COUNT(district_id)']==0)
	{
		$sql = "INSERT INTO district (state_id,district_name,status) VALUES (:state_id,:district_name,:status)";
		$pdo_districtment = $pdo_conn->prepare($sql);
			
		$result = $pdo_districtment->execute(array(':state_id'=>$_POST['state_id'],':district_name'=>$_POST['district_name'],':status'=>$_POST['status']));
	}
	else
	{
		echo "error";
	}
	
	if (!empty($result) )
	{
	  echo $msg = "Successfully Created";
	}
	}

/************************************* UPDATE ********************************************/
if($_POST['action']=="Update")
{
	$select_district=$pdo_conn->prepare("SELECT COUNT(district_id) FROM district WHERE state_id LIKE '".$_POST['state_id']."' AND district_name LIKE '".$_POST['district_name']."' AND district_id!='".$_POST['district_id']."' ");
    $select_district->execute();
    $district = $select_district->fetchAll();
	if($district[0]['COUNT(district_id)']==0)
	{
		$pdo_districtment=$pdo_conn->prepare("update district set state_id='".$_POST['state_id']."',district_name='".$_POST['district_name']."',status='".$_POST['status']."' where district_id=".$_POST['district_id']);
		$result = $pdo_districtment->execute();
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
	
	$pdo_cityment="DELETE FROM district where district_id=".$_POST['district_id'];
	$result=$pdo_conn->exec($pdo_cityment);
	if(!empty($result)) {
		echo $msg = "Successfully Deleted";
	}
	
	
}

?>