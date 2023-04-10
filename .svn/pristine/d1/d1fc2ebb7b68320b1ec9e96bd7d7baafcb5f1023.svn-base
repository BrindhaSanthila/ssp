<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');

$action = $_GET['action'];
 
/************************************* INSERT ********************************************/
switch($action)
{ 	
case "SUBMIT":

  if(isset($_FILES['file']['name']))
  {
  	
    $name = $_FILES['file']['name'];
	$target_dir = '../upload/staff/';
    $target_file = $target_dir.basename($_FILES["file"]["name"]);


  }
  else
  {
	$name = '';  
  }
  if(isset($_FILES['file1']['name']))
  {
    $name1 = $_FILES['file1']['name'];
	$target_dir1 = '../upload/staff/';
    $target_file1 = $target_dir1 . basename($_FILES["file1"]["name"]);
  }
  else
  {
	$name1 = '';  
  }
  

   if($name!='')
	{
 	    move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
	}
	if($name1!='')
		{
		move_uploaded_file($_FILES['file1']['tmp_name'],$target_dir1.$name1);
      }
		$sql = "INSERT INTO staffcreation(staff_type, staff_name, gender, comm_address, perm_address, staff_id, mobile_no, license_no, dob, doj, blood_group, old_company_esi, old_company_pfno, nature_of_work, bank_acc_details, id_proofno, email_id, image,image1, adhar_no, state_id, district_id, city_id, user_name, password, delete_status,staff_designation) VALUES (:staff_type, :staff_name, :gender, :comm_address, :perm_address, :staff_id, :mobile_no, :license_no, :dob, :doj, :blood_group, :old_company_esi, :old_company_pfno, :nature_of_work, :bank_acc_details, :id_proofno, :email_id, :image, :image1, :adhar_no, :state_id, :district_id, :city_id, :user_name, :password, :delete_status,:staff_designation)";
		
		$pdo_statement = $pdo_conn->prepare($sql);			
		
		$result = $pdo_statement->execute(array(
				':staff_type'=>$_POST['staff_type'],':staff_name'=>$_POST['staff_name'], ':gender'=>$_POST['staff_gender'], ':comm_address'=>$_POST['staff_comnict_adrs'], ':perm_address'=>$_POST['staff_parmnt_adrs'], ':staff_id'=>$_POST['staff_id'], ':mobile_no'=>$_POST['staff_mbl_num'], ':license_no'=>$_POST['staff_licence_num'], ':dob'=>$_POST['staff_dob'], ':doj'=>$_POST['staff_doj'], ':blood_group'=>$_POST['staff_bld_grp'], ':old_company_esi'=>$_POST['staff_old_esi'], ':old_company_pfno'=>$_POST['staff_old_pf'], ':nature_of_work'=>$_POST['staff_nature_work'], ':bank_acc_details'=>$_POST['staff_bank_ac'], ':id_proofno'=>$_POST['staff_id_proof'], ':email_id'=>$_POST['staff_email'], ':image'=>$name,':image1'=>$name1, ':adhar_no'=>$_POST['staff_adharnumber'], ':state_id'=>$_POST['state_id'], ':district_id'=>$_POST['district_id'], ':city_id'=>$_POST['city_id'], ':user_name'=>$_POST['user_name'], ':password'=>$_POST['password'], ':delete_status'=>0,':staff_designation'=>$_POST['staff_designation']));
 
	
	if (!empty($result) ){
		echo "Successfully Created";
	}else { 
		print_r($pdo_statement->errorinfo());
	}

break;



case "UPDATE":
 
    if(isset($_FILES['file']['name']))
  {
    $name = $_FILES['file']['name'];
	$target_dir = '../upload/staff/';
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
  }
  else
  {
	$name = '';  
  }
 if(isset($_FILES['file1']['name']))
  {
    $name1 = $_FILES['file1']['name'];
	$target_dir1 = '../upload/staff/';
    $target_file1 = $target_dir1 . basename($_FILES["file1"]["name"]);
  }
  else
  {
	$name1 = '';  
  }
	
	if($name != '')
	{
			 
 
move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
}
	if($name1 != '')
	{
move_uploaded_file($_FILES['file1']['tmp_name'],$target_dir1.$name1);

}


	$staff_statement =$pdo_conn->prepare("UPDATE staffcreation SET staff_type='".$_POST['staff_type']."',user_name='".$_POST['user_name']."',password='".$_POST['password']."',staff_name='".$_POST['staff_name']."',gender='".$_POST['staff_gender']."',comm_address='".$_POST['staff_comnict_adrs']."',perm_address='".$_POST['staff_parmnt_adrs']."',staff_id='".$_POST['staff_id']."',mobile_no='".$_POST['staff_mbl_num']."',license_no='".$_POST['staff_licence_num']."',dob='".$_POST['staff_dob']."',doj='".$_POST['staff_doj']."',blood_group='".$_POST['staff_bld_grp']."',old_company_esi='".$_POST['staff_old_esi']."',old_company_pfno='".$_POST['staff_old_pf']."',nature_of_work='".$_POST['staff_nature_work']."',bank_acc_details='".$_POST['staff_bank_ac']."',id_proofno='".$_POST['staff_id_proof']."',email_id='".$_POST['staff_email']."',image='$name',image1='$name1',adhar_no='".$_POST['staff_adharnumber']."',state_id='".$_POST['state_id']."',district_id='".$_POST['district_id']."',city_id='".$_POST['city_id']."',staff_designation='".$_POST['staff_designation']."' WHERE staffcreation_id='".$_POST['staff_creation_id']."' ");
	$staff_up =$staff_statement->execute();
	
	
	if($staff_up) {
		

		echo "Successfully Updated";
	}
	
	


 
break;



case "DELETE":
	
	$pdo_statement="DELETE FROM staffcreation where staffcreation_id='".$_POST['staffcreation_id']."' ";
	$result=$pdo_conn->exec($pdo_statement);
	
		if(!empty($result)) 
		{
		echo $msg = "Successfully Deleted";
	    }

break;
}


if($_GET['action']=='city_select'){
	
	  $city_select_name = $pdo_conn->prepare("SELECT * FROM city where state_id='".$_POST['state_id']."' AND district_id='".$_POST['district_id']."' ");
      $city_select_name->execute();
      $city_select = $city_select_name->fetchAll();
	  
	$city_val = '';
	$city_val .='<select class="form-control select2 item_name" name="city" id="city" required>
					<option value="">Select Your City</option>'; 
	foreach($city_select as $value){
		$city_val .= '<option value="'.$value['city_id'].'">'.$value['city_name'].'</option>'; 
	}
	$city_val .='</select>';
	
	echo $city_val;
	
}



?>