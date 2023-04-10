<?php

require_once('../inc/dbConnect.php');

/************************************* INSERT ********************************************/

if($_POST['action']=="Add")
{
	$select_userroll=$pdo_conn->prepare("SELECT COUNT(userroll_id) FROM userroll WHERE roll_name LIKE '".$_POST['roll_name']."' ");
    $select_userroll->execute();
    $userroll = $select_userroll->fetchAll();

	if($userroll[0]['COUNT(userroll_id)']==0)
	{
		$sql = "INSERT INTO userroll (roll_name,active_status) VALUES (:roll_name,:active_status)";
		$pdo_statement = $pdo_conn->prepare($sql);
			
		$result = $pdo_statement->execute(array(':roll_name'=>$_POST['roll_name'],':active_status'=>$_POST['active_status']));
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
	$select_userroll=$pdo_conn->prepare("SELECT COUNT(userroll_id) FROM userroll WHERE roll_name LIKE '".$_POST['roll_name']."' AND userroll_id!='".$_POST['userroll_id']."'");
    $select_userroll->execute();
    $userroll = $select_userroll->fetchAll();

	if($userroll[0]['COUNT(userroll_id)']==0)
	{
		$pdo_statement=$pdo_conn->prepare("update userroll set roll_name='".$_POST['roll_name']."',active_status='".$_POST['active_status']."' where userroll_id=".$_POST['userroll_id']);
		$result = $pdo_statement->execute();
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
	$pdo_statement="DELETE FROM userroll where userroll_id=".$_POST['userroll_id'];
	$result=$pdo_conn->exec($pdo_statement);
	if(!empty($result)) 
	{
		echo $msg = "Successfully Deleted";
	}	
}

?>