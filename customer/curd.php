<?php

require_once('../inc/dbConnect.php');

/************************************* INSERT ********************************************/
if($_POST['action']=="Add")
	
{ 
$sql = "INSERT INTO customer_creation (customer_name,religion_id,mobile_no,email,address,dob,no_of_members,state_id,district_id,city_id,description,status) VALUES(:customer_name,:religion_id,:mobile_no,:email,:address,:dob,:no_of_members,:state_id,:district_id,:city_id,:description,:status)";
		$pdo_statement = $pdo_conn->prepare($sql);
			
		$result = $pdo_statement->execute(array(':customer_name'=>$_POST['customer_name'],':religion_id'=>$_POST['religion_id'],':mobile_no'=>$_POST['mobile_no'],':email'=>$_POST['email'],':address'=>$_POST['address'],':dob'=>$_POST['date'],':no_of_members'=>$_POST['no_of_members'],':state_id'=>$_POST['state_id'],':district_id'=>$_POST['district_id'],':city_id'=>$_POST['city_id'],':description'=>$_POST['description'],':status'=>$_POST['status']));
		 $last_id  = $pdo_conn->lastInsertId(); 
	if (!empty($result) ){
	  echo $msg = "Successfully Created";
	}

}

/************************************* UPDATE ********************************************/


if($_POST['action']=="Update")
{
	$ct = ''; $err=''; $contactsql=''; $sql=''; $c1=''; $c2='';
	if(isset($_POST['state_id'])){ $state_id=$_POST['state_id'];} else {$state_id=""; }
	if(isset($_POST['district_id'])){ $district_id=$_POST['district_id'];} else {$district_id=""; }
		if(isset($_POST['city_id'])){ $city_id=$_POST['city_id'];} else {$city_id=""; }
		  $pdo_statement=$pdo_conn->prepare("update customer_creation set customer_name='".$_POST['customer_name']."',religion_id='".$_POST['religion_id']."',mobile_no='".$_POST['mobile_no']."',email='".$_POST['email']."',address='".$_POST['address']."',dob='".$_POST['date']."',no_of_members='".$_POST['no_of_members']."',state_id='".$_POST['state_id']."',district_id='".$_POST['district_id']."',city_id='".$_POST['city_id']."',description='".$_POST['description']."',status='".$_POST['status']."' where customer_id='".$_POST['customer_id']."' ");
	   $result = $pdo_statement->execute();
	
	if(!empty($result)) {
	echo	$msg = "Successfully Updated";
	}
	else { print_r($pdo_statement->errorinfo()); }
		
} 

/************************************* DELETE ********************************************/

if($_POST['action']=="Delete")
{
	
	$pdo_statement="DELETE FROM customer_creation where customer_id='".$_POST['customer_id']."' ";
	$result=$pdo_conn->exec($pdo_statement);
	
		if(!empty($result)) 
		{
		echo $msg = "Successfully Deleted";
	    }
		
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


if($_POST['action'] == 'city_list'){
	$city_by_district = $pdo_conn->prepare("SELECT * FROM city WHERE state_id = $_POST[stat_id] AND district_id = $_POST[dis_id] ORDER BY district_id ASC");
	$city_by_district->execute();
	$citybydistrict = $city_by_district->fetchAll();
	$city_val = '';
	
	$city_val .='<option value="">Select Your City</option>'; 
	foreach($citybydistrict as $value){
		$city_val .= '<option value="'.$value['city_id'].'">'.$value['city_name'].'</option>'; 
	}
	
	echo $city_val;	
}	

?> 