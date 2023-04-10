          <?php

require_once('../inc/dbConnect.php');

/************************************* INSERT ********************************************/

if($_POST['action']=="Add")
{ 
    $select_state=$pdo_conn->prepare("SELECT COUNT(state_id) FROM state WHERE state_name LIKE '".$_POST['state_name']."' AND status LIKE '".$_POST['status']."' ");
    $select_state->execute();
    $state = $select_state->fetchAll();
	if($state[0]['COUNT(state_id)']==0)
	{
		$sql = "INSERT INTO state (state_name,status) VALUES (:state_name,:status)";
		$pdo_statement = $pdo_conn->prepare($sql);
			
		$result = $pdo_statement->execute(array(':state_name'=>$_POST['state_name'],':status'=>$_POST['status']));
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
	$select_state=$pdo_conn->prepare("SELECT COUNT(state_id) FROM state WHERE state_name LIKE '".$_POST['state_name']."' AND status LIKE '".$_POST['status']."' AND state_id!='".$_POST['state_id']."' ");
    $select_state->execute();
    $state = $select_state->fetchAll();
	if($state[0]['COUNT(state_id)']==0)
	{
	   $pdo_statement=$pdo_conn->prepare("update state set state_name='".$_POST['state_name']."',status='".$_POST['status']."' where state_id=".$_POST['state_id']);
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
	
		
		$customer = $pdo_conn->prepare("SELECT COUNT(customer_state) FROM customer_profile WHERE state_id = '".$_POST['state_id']."' ");
		$customer->execute();
		$customerlist = $customer->fetchAll();

		$staff = $pdo_conn->prepare("SELECT COUNT(staff_state) FROM staffcreation WHERE state = '".$_POST['state_id']."' "	);
		$staff->execute();
		$stafflist = $staff->fetchAll();

		$concern = $pdo_conn->prepare("SELECT COUNT(concern_state) FROM ourconcerns WHERE state = '".$_POST['state_id']."' "	);
		$concern->execute();
		$concernlist = $concern->fetchAll();

		
if($customerlist!==0 && $stafflist!==0 && $concernlist!==0){
		echo "State Can't able delete";
}else{
	$pdo_statement="DELETE FROM state where state_id='".$_POST['state_id']."' ";
	$result=$pdo_conn->exec($pdo_statement);
	if(!empty($result)) {
		echo $msg = "Successfully Deleted";
	}
	//else { print_r($pdo_statement->errorinfo()); }

	//District
	$dis_del="DELETE FROM district where state_id='".$_POST['state_id']."' ";
	$result=$pdo_conn->exec($dis_del);
	if(!empty($result)) {
		echo $msg = "Successfully Deleted DISTRICT";
	}

	//City
	$city_del="DELETE FROM city where state_id='".$_POST['state_id']."' ";
	$result=$pdo_conn->exec($city_del);
	if(!empty($result)) {
		echo $msg = "Successfully Deleted CITY";
	}
	}
}

?> 