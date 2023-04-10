<?php

require_once('../inc/dbConnect.php');

/************************************* INSERT ********************************************/

if($_POST['action']=="Add")
{ 
   $select_category=$pdo_conn->prepare("SELECT COUNT(category_id) FROM category WHERE category_name LIKE '".$_POST['category_name']."'AND description LIKE '".$_POST['description']."' AND status LIKE '".$_POST['status']."' ");
    $select_category->execute();
    $category = $select_category->fetchAll();
	if($category[0]['COUNT(category_id)']==0)
	{
		$sql = "INSERT INTO category (category_name,description,status) VALUES (:category_name,:description,:status)";
		$pdo_statement = $pdo_conn->prepare($sql);
			
		$result = $pdo_statement->execute(array(':category_name'=>$_POST['category_name'],':description'=>$_POST['description'],':status'=>$_POST['status']));
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
	$select_state=$pdo_conn->prepare("SELECT COUNT(category_id) FROM category WHERE category_name LIKE '".$_POST['category_name']."'AND description LIKE '".$_POST['description']."' AND status LIKE '".$_POST['status']."' AND category_id!='".$_POST['category_id']."' ");
    $select_state->execute();
    $state = $select_state->fetchAll();
	if($state[0]['COUNT(category_id)']==0)
	{
	   $pdo_statement=$pdo_conn->prepare("update category set category_name='".$_POST['category_name']."',description='".$_POST['description']."',status='".$_POST['status']."' where category_id=".$_POST['category_id']);
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
	
	$pdo_statement="update category set delete_status='1' where category_id=".$_POST['category_id'];
	$result=$pdo_conn->exec($pdo_statement);
	if(!empty($result)) 
	{
		echo $msg = "Successfully Deleted";
	}
$pdo_subcategory = $pdo_conn->prepare("SELECT * FROM subcategory where category_id='".$_POST['category_id']."' ORDER BY category_id DESC");
$pdo_subcategory->execute();
$pdosubcategory = $pdo_subcategory->fetch(); 
$pdo_statement1="update subcategory set delete_status='1' where category_id=".$pdosubcategory['category_id'];
$result1=$pdo_conn->exec($pdo_statement1);

$pdo_itemcreation = $pdo_conn->prepare("SELECT * FROM subcategory where category_id='".$_POST['category_id']."' ORDER BY category_id DESC");
$pdo_itemcreation->execute();
$pdoitemcreation = $pdo_itemcreation->fetch(); 
$pdo_statement2="update itemcreation set delete_status='1' where category_id=".$pdoitemcreation['category_id'];
$result1=$pdo_conn->exec($pdo_statement2);


	
}

?> 