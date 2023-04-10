<?php

require_once('../inc/dbConnect.php');

/************************************* INSERT ********************************************/

if($_POST['action']=="Add")
{ 

		$sql = "INSERT INTO special_days (special_id,special_day_name,date,sms_content,religion_id,description,email_status,sms_status,email_content) VALUES (:special_id,:special_day_name,:date,:sms_content,:religion_id,:description,:email_status,:sms_status,:email_content)";
		$pdo_statement = $pdo_conn->prepare($sql);
			
		$result = $pdo_statement->execute(array(':special_id'=>$_POST['special_id'],':date'=>$_POST['date'],':special_day_name'=>$_POST['special_day_name'],':date'=>$_POST['date'],':sms_content'=>$_POST['sms_content'],':religion_id'=>$_POST['religion_id'],':description'=>$_POST['description'],':email_status'=>$_POST['email_status'],':sms_status'=>$_POST['sms_status'],':email_content'=>$_POST['email_content']));
	    $last_id  = $pdo_conn->lastInsertId(); 
	 if ($result == TRUE)	
		{ 
			 echo "Sucessfully Created";
		}
		else 
		{ 
			$array = array('error'=> $pdo_statement->errorinfo());
			echo json_encode($array);			
		}	
 
	
}

/************************************* UPDATE ********************************************/
if($_POST['action']=="Update")
{
		
	   $pdo_statement=$pdo_conn->prepare("update special_days set special_id='".$_POST['special_id']."',special_day_name='".$_POST['special_day_name']."',date='".$_POST['date']."',sms_content='".$_POST['sms_content']."',religion_id='".$_POST['religion_id']."',description='".$_POST['description']."',email_status='".$_POST['email_status']."',sms_status='".$_POST['sms_status']."',email_content='".$_POST['email_content']."' where special_id='".$_POST['special_id']."' ");
	   $result = $pdo_statement->execute();
	
	
	if(!empty($result)) {
		echo $msg = "Successfully Updated";
	}
	
	
} 
/************************************* DELETE ********************************************/

if($_POST['action']=="Delete")
{
	
		
		
	$pdo_statement="DELETE FROM special_days where special_id='".$_POST['special_id']."' ";
	$result=$pdo_conn->exec($pdo_statement);
	if(!empty($result)) {
		echo $msg = "Successfully Deleted";
	}
	//else { print_r($pdo_statement->errorinfo()); }

	//District
	}


?> 