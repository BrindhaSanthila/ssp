<?php

require_once('../inc/dbConnect.php');

/************************************* INSERT ********************************************/

if($_POST['action']=="Add")
{
    $sms = $pdo_conn->prepare("SELECT * FROM sms WHERE sms_type='".$_POST['sms_type']."' ");
    $sms->execute();
    $sms_list = $sms->fetchAll();
    $mobile_no=str_replace(' ', '', $_POST['mobile_no']);
    if(count($sms_list)==0)
    {
		$sql = "INSERT INTO sms (sms_type,mobile_no,message,active_status) VALUES (:sms_type,:mobile_no,:message,:active_status)";
		$pdo_statement = $pdo_conn->prepare($sql);
		$result = $pdo_statement->execute(array(':sms_type'=>$_POST['sms_type'],':mobile_no'=>$mobile_no,':message'=>$_POST['message'],':active_status'=>$_POST['active_status']));
        if (!empty($result) )
    	{
    	  echo $msg = "Successfully Created";
    	}
        
    }
    else
    {
        $pdo_statement=$pdo_conn->prepare("update sms set mobile_no='".$mobile_no."',active_status='".$_POST['active_status']."',message='".$_POST['message']."' where sms_type='".$_POST['sms_type']."'");
    	$result = $pdo_statement->execute();
    	if (!empty($result) )
    	{
    	  echo $msg = "Successfully Updated";
    	}
    }
		
}

/************************************* UPDATE ********************************************/
if($_POST['action']=="Update")
{
	 $mobile_no=str_replace(' ', '', $_POST['mobile_no']);
		$pdo_statement=$pdo_conn->prepare("update sms set sms_type='".$_POST['sms_type']."',mobile_no='".$mobile_no."',active_status='".$_POST['active_status']."',message='".$_POST['message']."' where sms_id=".$_POST['sms_id']);
		$result = $pdo_statement->execute();
	
	
	if(!empty($result)) {
		echo $msg = "Successfully Updated";
	}
}

/************************************* DELETE ********************************************/

if($_POST['action']=="Delete")
{	
	$pdo_statement="DELETE FROM sms where sms_id=".$_POST['sms_id'];
	$result=$pdo_conn->exec($pdo_statement);
	if(!empty($result)) 
	{
		echo $msg = "Successfully Deleted";
	}	
}

?>