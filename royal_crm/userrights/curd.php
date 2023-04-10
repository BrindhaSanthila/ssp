<?php

require_once('../inc/dbConnect.php');

/************************************* INSERT ********************************************/

if($_POST['action']=="Add")
{
	$active_menu = $_POST['checkboxesChecked'];
	$activemenu = explode(',',$active_menu);
	$result ='';
	$select_userroll=$pdo_conn->prepare("SELECT COUNT(userroll_id) FROM userroll WHERE roll_name LIKE '".$_POST['roll_name']."' ");
    $select_userroll->execute();
    $userroll = $select_userroll->fetchAll();
	$sql = "SELECT * FROM userform WHERE delete_status !='1'";
	$prepare = $pdo_conn->prepare($sql);
	$exc = $prepare->execute();
	if($exc == TRUE)
	{
		$list = $prepare->fetchAll();
		foreach($list as $value)
		{
			if (in_array($value['userform_id'], $activemenu))
			{
			$status = '1';
			}
			else
			{
			$status = '0';
			}
			$sql = "INSERT INTO userformrights (roll_id, userform_id, status) VALUES (:roll_id, :form_id, :status)";
			$pdo_statement = $pdo_conn->prepare($sql);
			$result = $pdo_statement->execute(array(':roll_id'=>$_POST['roll_name'], ':form_id'=>$value['userform_id'], ':status'=>$status));
		}
	}
	echo '1';	
}

/************************************* UPDATE ********************************************/
if($_POST['action']=="Update")
{
	$result ='';
	$active_menu = $_POST['checkboxesChecked'];
	$activemenu = explode(',',$active_menu);

	$select_userroll=$pdo_conn->prepare("SELECT COUNT(userroll_id) FROM userroll WHERE roll_name LIKE '".$_POST['roll_name']."' AND userroll_id!='".$_POST['userroll_id']."'");
	$select_userroll->execute();
	$userroll = $select_userroll->fetchAll();

	$pdo_statement1="update userformrights set status='0' where roll_id='".$_POST['userroll_id']."' ";
	$result1=$pdo_conn->exec($pdo_statement1);
	foreach($activemenu as $formid){
	$pdo_statement2="update userformrights set status='1' where roll_id='".$_POST['userroll_id']."' AND userform_id='".$formid."' AND delete_status!='1' ";
	$result2=$pdo_conn->exec($pdo_statement2);
	}
	echo "1";	
}

/************************************* DELETE ********************************************/

if($_POST['action']=="Delete")
{	
	$pdo_statement1="update userformrights set delete_status='1' where roll_id=".$_POST['userroll_id'];
	$result1=$pdo_conn->exec($pdo_statement1);
	if(!empty($result)) 
	{
		echo $msg = "Successfully Deleted";
	}
	else 
	{ 
		echo $_POST['userroll_id']; 
	}
}
?>