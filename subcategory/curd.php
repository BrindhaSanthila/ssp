<?php

require_once('../inc/dbConnect.php');

/************************************* INSERT ********************************************/

if($_POST['action']=="Add")
{ 

    $select_subcategory=$pdo_conn->prepare("SELECT COUNT(subcategory_id) FROM subcategory WHERE category_id LIKE '".$_POST['category_id']."' AND subcategory_name LIKE '".$_POST['subcategory_name']."' ");
    $select_subcategory->execute();
    $subcategory = $select_subcategory->fetchAll();
	
	if($subcategory[0]['COUNT(subcategory_id)']==0)
	{
		$sql = "INSERT INTO subcategory (category_id,subcategory_name, description, status)
			 VALUES (:category_id,:subcategory_name, :description, :status)";
		$pdo_subcate = $pdo_conn->prepare($sql);
			
		$result = $pdo_subcate->execute(array(
		':category_id'=>$_POST['category_id'],
		':subcategory_name'=>$_POST['subcategory_name'],
		':description'=>$_POST['description'],
		':status'=>$_POST['status']));
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
	$select_subcat=$pdo_conn->prepare("SELECT COUNT(subcategory_id) FROM subcategory WHERE category_id LIKE '".$_POST['category_id']."' AND subcategory_name LIKE '".$_POST['subcategory_name']."' AND subcategory_id!='".$_POST['subcategory_id']."' ");
    $select_subcat->execute();
    $subcat = $select_subcat->fetchAll();
	if($subcat[0]['COUNT(subcategory_id)']==0)
	{
		$pdo_subcat=$pdo_conn->prepare("update subcategory set 
		category_id='".$_POST['category_id']."',
		subcategory_name='".$_POST['subcategory_name']."',
		description='".$_POST['description']."',
		status='".$_POST['status']."' where subcategory_id=".$_POST['subcategory_id']);
		$result = $pdo_subcat->execute();
	}
	else
	{
		echo "error";
	}
	if(!empty($result)) 
	{
		echo $msg = "Successfully Updated";
	}
}

/************************************* DELETE ********************************************/

if($_POST['action']=="Delete")
{
   
	/////Sub category Delete
	$pdo_subcat="Update   subcategory  set delete_status=1 where subcategory_id=".$_POST['subcategory_id'];
	$result=$pdo_conn->exec($pdo_subcat);
	
	////Item Creation Delete
	$pdo_subcat="Update   itemcreation set delete_status=1 where subcategory_id=".$_POST['subcategory_id'];
	$result=$pdo_conn->exec($pdo_subcat);
	if(!empty($result)) {
		echo $msg = "Successfully Deleted";
	}
	//else { print_r($pdo_cityment->errorinfo()); }
	
}

?>
