<?php

require_once('../inc/dbConnect.php');

/************************************* INSERT ********************************************/

if($_POST['action']=="Add")
{ 
    $select_religion=$pdo_conn->prepare("SELECT COUNT(religion_id) FROM religion WHERE religion_name LIKE '".$_POST['religion_name']."' AND status LIKE '".$_POST['status']."' ");
    $select_religion->execute();
    $religion = $select_religion->fetchAll();
	if($religion[0]['COUNT(religion_id)']==0)
	{
		$sql = "INSERT INTO religion (religion_name,status) VALUES (:religion_name,:status)";
		$pdo_statement = $pdo_conn->prepare($sql);
			
		$result = $pdo_statement->execute(array(':religion_name'=>$_POST['religion_name'],':status'=>$_POST['status']));
	}
	else
	{
		echo "error";
	}
	if (!empty($result) ){
	  echo $msg = "Successfully Created";
	}
	//else { print_r($pdo_statement->errorinfo()); }
}

/************************************* UPDATE ********************************************/
if($_POST['action']=="Update")
{
	$select_religion=$pdo_conn->prepare("SELECT COUNT(religion_id) FROM religion WHERE religion_name LIKE '".$_POST['religion_name']."' AND status LIKE '".$_POST['status']."' AND religion_id!='".$_POST['religion_id']."' ");
    $select_religion->execute();
    $religion = $select_religion->fetchAll();
	if($religion[0]['COUNT(religion_id)']==0)
	{
	   $pdo_statement=$pdo_conn->prepare("update religion set religion_name='".$_POST['religion_name']."',status='".$_POST['status']."' where religion_id=".$_POST['religion_id']);
	   $result = $pdo_statement->execute();
	}
	else
	{
		echo "error";
	}
	if(!empty($result)) {
		echo $msg = "Successfully Updated";
	}
	//else { print_r($pdo_statement->errorinfo()); }
	
} 

/************************************* DELETE ********************************************/

if($_POST['action']=="Delete")
{
	
		
		
	$pdo_statement="DELETE FROM religion where religion_id='".$_POST['religion_id']."' ";
	$result=$pdo_conn->exec($pdo_statement);
	if(!empty($result)) {
		echo $msg = "Successfully Deleted";
	}
	//else { print_r($pdo_statement->errorinfo()); }

	//District
	}


?> 