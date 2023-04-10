<?php
require_once('../inc/dbConnect.php');

/************************************* INSERT ********************************************/

if($_POST['action']=="Add")
{ 

    $select_itemcreation=$pdo_conn->prepare("SELECT COUNT(item_id) FROM itemcreation WHERE subcategory_id LIKE '".$_POST['subcategory_id']."' AND item_name LIKE '".$_POST['item_name']."' ");
    $select_itemcreation->execute();
    $itemcreation = $select_itemcreation->fetchAll();
	
	if($itemcreation[0]['COUNT(item_id)']==0)
	{
		$sql = "INSERT INTO itemcreation (category_id, subcategory_id, item_name, description, status) VALUES (:category_id, :subcategory_id, :item_name, :description, :status)";
		$pdo_item = $pdo_conn->prepare($sql);
			
		$result = $pdo_item->execute(array(
		':category_id'=>$_POST['category_id'],
		':subcategory_id'=>$_POST['subcategory_id'],
		':item_name'=>$_POST['item_name'],
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

	
		$pdo_item=$pdo_conn->prepare("update itemcreation set 
		category_id='".$_POST['category_id']."',
		subcategory_id='".$_POST['subcategory_id']."',
		item_name='".$_POST['item_name']."',
		description='".$_POST['description']."',
		status='".$_POST['status']."' 
		where item_id=".$_POST['item_id']);
		$result = $pdo_item->execute();
	
	
	if(!empty($result)) 
	{
		echo $msg = "Successfully Updated";
	}
}

/************************************* DELETE ********************************************/

if($_POST['action']=="Delete")
{
	
	$pdo_cityment="UPDATE   itemcreation SET delete_status='1' where item_id='".$_POST['item_id']."'";
	$result=$pdo_conn->exec($pdo_cityment);
	if(!empty($result)) {
		echo $msg = "Successfully Deleted";
	}
	//else { print_r($pdo_cityment->errorinfo()); 
}

if($_POST['action']=="categoryChange")
{
	$categorychange = $pdo_conn->prepare("SELECT * FROM subcategory WHERE category_id = $_POST[category_id] ORDER BY subcategory_id ASC");
	$categorychange->execute();
	$category = $categorychange->fetchAll();
	
	$category_value = '';
	$category_value .='<option value="">Select Your SubCategory</option>'; 
	foreach($category as $value)
	{
		$category_value .= '<option value="'.$value['subcategory_id'].'">'.$value['subcategory_name'].'</option>'; 
	}
	echo $category_value;	
}

?>