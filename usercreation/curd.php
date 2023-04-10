<?php

require_once('../inc/dbConnect.php');

/************************************* INSERT ********************************************/

if($_POST['action']=="Add")
{
	$select_userroll1=$pdo_conn->prepare("SELECT userroll_id FROM userroll WHERE roll_name like 'admin' and active_status ='1'");
    $select_userroll1->execute();
    $userroll1 = $select_userroll1->fetch();
	$admin = $userroll1['userroll_id'];
	$select_usercreation=$pdo_conn->prepare("SELECT COUNT(usercreation_id) FROM usercreation WHERE  mobile_no='".$_POST['mobile_no']."' and user_name='".$_POST['user_name']."' and password='".$_POST['password']."' ");
    $select_usercreation->execute();
    $usercreation = $select_usercreation->fetchAll();

	if($usercreation[0]['COUNT(usercreation_id)']==0)
	{
		$sql = "INSERT INTO usercreation 
		(full_name,address,city,district,state,mobile_no,user_roll,user_name,password,active_status,userroll_id) VALUES (:full_name,:address,:city,:district,:state,:mobile_no,:user_roll,:user_name,:password,:active_status,:userroll_id)";
		$pdo_statement = $pdo_conn->prepare($sql);
			
		$result = $pdo_statement->execute(array(':full_name'=>$_POST['full_name'],':address'=>$_POST['address'],':city'=>$_POST['city'],':district'=>$_POST['district'],':state'=>$_POST['state'],':mobile_no'=>$_POST['mobile_no'],':user_roll'=>$admin,':user_name'=>$_POST['user_name'],':password'=>$_POST['password'],':active_status'=>$_POST['active_status'],':userroll_id'=>$admin));
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
    $msg='';
    echo "user".$_POST['user_name'];
    echo "pas".$_POST['password'];

    $select_userroll1=$pdo_conn->prepare("SELECT userroll_id FROM userroll WHERE roll_name like 'admin' and active_status ='1'");
    $select_userroll1->execute();
    $userroll1 = $select_userroll1->fetch();
	$admin = $userroll1['userroll_id'];
	$select_usercreation=$pdo_conn->prepare("SELECT COUNT(usercreation_id) FROM usercreation WHERE address LIKE '".$_POST['address']."' AND mobile_no LIKE '".$_POST['mobile_no']."' AND user_name LIKE '".$_POST['user_name']."' AND password LIKE '".$_POST['password']."' AND usercreation_id!='".$_POST['usercreation_id']."'");
    $select_usercreation->execute();
    $usercreation = $select_usercreation->fetchAll();
	if($usercreation[0]['COUNT(usercreation_id)']==0)
	{
		$pdo_statement=$pdo_conn->prepare("update usercreation set full_name='".$_POST['full_name']."',address='".$_POST['address']."',city='".$_POST['city']."',district='".$_POST['district']."',state='".$_POST['state']."',mobile_no='".$_POST['mobile_no']."',user_name='".$_POST['user_name']."',password='".$_POST['password']."',active_status='".$_POST['active_status']."',userroll_id='".$admin."' where usercreation_id=".$_POST['usercreation_id']);
		$result = $pdo_statement->execute();
	}
	else
	{
		echo "error";
	}
	if(!empty($result)) 
	{
		echo $msg = $_POST['user_name'];
	}	
}

/************************************* DELETE ********************************************/

if($_POST['action']=="Delete")
{
	$pdo_statement="DELETE FROM usercreation where usercreation_id=".$_POST['usercreation_id'];
	$result=$pdo_conn->exec($pdo_statement);
	if(!empty($result)) 
	{
		echo $msg = "Successfully Deleted";
	}
}

/************************************* State ********************************************/

if($_POST['action']=="State")
{
	$state_name=$_POST['state_name'];
    
	$select_city=$pdo_conn->prepare("SELECT * FROM city WHERE state_name='$state_name'");
	$select_city->execute();
	$result = $select_city->fetchAll();
	
	$returnvalue = "<option value=''>Select Your City</option>";
	foreach($result as $value) 
		{
			$city_id = $value['city_id'];
			$city_name = $value['city_name'];
			
			$returnvalue2 .= "<option value=".$city_id.">".$city_name."</option>";
			
		} 
		
		echo $returnvalue.$returnvalue2;
}


if($_POST['action'] == 'district_list')
{
	$district_by_state = $pdo_conn->prepare("SELECT * FROM district WHERE state_id = $_POST[state_id] ORDER BY district_id ASC");
	$district_by_state->execute();
	$districtbystate = $district_by_state->fetchAll();
	$state_val = '';	
	$state_val .='<option value="">Select Your District</option>'; 
	foreach($districtbystate as $value)
	{
		$state_val .= '<option value="'.$value['district_id'].'">'.$value['district_name'].'</option>'; 
	}	
	echo $state_val;	
}

if($_POST['action'] == 'city_list')
{	
	$city_by_district = $pdo_conn->prepare("SELECT * FROM city WHERE state_id = $_POST[stat_id] AND district_id = $_POST[dis_id] ORDER BY district_id ASC");
	$city_by_district->execute();
	$citybydistrict = $city_by_district->fetchAll();
	$city_val = '';	
	$city_val .='<option value="">Select Your City</option>'; 
	foreach($citybydistrict as $value)
	{
		$city_val .= '<option value="'.$value['city_id'].'">'.$value['city_name'].'</option>'; 
	}
	
	echo $city_val;	
}	

?>