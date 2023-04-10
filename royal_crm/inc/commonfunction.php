<?php
require_once('dbConnect.php');

$select_itemcategory=$pdo_conn->prepare("SELECT * FROM itemcategory");
$select_itemcategory->execute();
$itemcategory = $select_itemcategory->fetchAll();
	  
  

 

$select_userrole=$pdo_conn->prepare("SELECT * FROM userroll WHERE active_status='1'");
$select_userrole->execute();
$userrole = $select_userrole->fetchAll();

$select_itemmaster=$pdo_conn->prepare("SELECT * FROM itemmaster");
$select_itemmaster->execute();
$itemmaster = $select_itemmaster->fetchAll();

 

  
$pdo_city = $pdo_conn->prepare("SELECT * FROM city ORDER BY city_id DESC");
$pdo_city->execute();
$pdocity = $pdo_city->fetchAll();

 
		
$pdo_itembase = $pdo_conn->prepare("SELECT * FROM itembase ORDER BY itembase_id DESC");
$pdo_itembase->execute();
$pdoitembase = $pdo_itembase->fetchAll();

$pdo_itemcategory = $pdo_conn->prepare("SELECT * FROM itemcategory ORDER BY itemcategory_id DESC");
$pdo_itemcategory->execute();
$pdoitemcategory = $pdo_itemcategory->fetchAll();

$pdo_itemmaster = $pdo_conn->prepare("SELECT * FROM itemmaster ORDER BY itemmaster_id DESC");
$pdo_itemmaster->execute();
$pdoitemmaster = $pdo_itemmaster->fetchAll();

$pdo_ratefixing = $pdo_conn->prepare("SELECT * FROM ratefixing ORDER BY ratefixing_id DESC");
$pdo_ratefixing->execute();
$pdoratefixing = $pdo_ratefixing->fetchAll();

$pdo_expense = $pdo_conn->prepare("SELECT * FROM expense ORDER BY expense_id DESC");
$pdo_expense->execute();
$pdoexpense = $pdo_expense->fetchAll();

$pdo_state = $pdo_conn->prepare("SELECT * FROM state where delete_status='0' and status='1' ORDER BY state_id DESC");
$pdo_state->execute();
$pdostate = $pdo_state->fetchAll();

$pdo_religion = $pdo_conn->prepare("SELECT * FROM religion ORDER BY religion_id DESC");
$pdo_religion->execute();
$pdoreligion = $pdo_religion->fetchAll();

$pdo_special_days = $pdo_conn->prepare("SELECT * FROM special_days ORDER BY special_id DESC");
$pdo_special_days->execute();
$pdospecialdays = $pdo_special_days->fetchAll();
 

$pdo_district = $pdo_conn->prepare("SELECT * FROM district where delete_status='0' and status='1' ORDER BY district_id DESC");
$pdo_district->execute();
$pdodistrict = $pdo_district->fetchAll();

  

$pdo_category = $pdo_conn->prepare("SELECT * FROM category where delete_status='0' ORDER BY category_id DESC");
$pdo_category->execute();
$pdocategory = $pdo_category->fetchAll(); 

$pdo_subcategory = $pdo_conn->prepare("SELECT * FROM subcategory where delete_status='0' ORDER BY subcategory_id DESC");
$pdo_subcategory->execute();
$pdosubcategory = $pdo_subcategory->fetchAll(); 

$pdo_itemcreation = $pdo_conn->prepare("SELECT * FROM itemcreation where delete_status='0' ORDER BY item_id DESC");
$pdo_itemcreation->execute();
$pdoitemcreation = $pdo_itemcreation->fetchAll();

$pdo_ratefixing = $pdo_conn->prepare("SELECT * FROM ratefixing ORDER BY rate_id DESC");
$pdo_ratefixing->execute();
$pdoratefixing = $pdo_ratefixing->fetchAll();

$pdo_enquiry = $pdo_conn->prepare("SELECT * FROM enquiry ORDER BY enquiry_id ASC");
$pdo_enquiry->execute();
$pdoenquiry = $pdo_enquiry->fetchAll();

$pdo_enquiry_item = $pdo_conn->prepare("SELECT * FROM enquiry_item ORDER BY order_id ASC");
$pdo_enquiry_item->execute();
$pdoenquiryitem = $pdo_enquiry_item->fetchAll();

// $pdo_order = $pdo_conn->prepare("SELECT * FROM enquiry_item ORDER BY order_id ASC");
// $pdo_order->execute();
// $pdoorder = $pdo_order->fetchAll();

$pdo_order_confirm = $pdo_conn->prepare("SELECT * FROM order_confirm group by enquiry_id ORDER BY order_id desc");
$pdo_order_confirm->execute();
$pdoorder_confirm = $pdo_order_confirm->fetchAll();

 
 
 
$pdo_usercreation = $pdo_conn->prepare("SELECT * FROM usercreation ORDER BY usercreation_id DESC");
$pdo_usercreation->execute();
$pdousercreation = $pdo_usercreation->fetchAll();

$pdo_userroll = $pdo_conn->prepare("SELECT * FROM userroll ORDER BY userroll_id DESC");
$pdo_userroll->execute();
$pdouserroll = $pdo_userroll->fetchAll();

 
$roll_id=1;
   
// TASK EST TIME

function get_status_name($enquiry_followups_sid)
{
	global $pdo_conn;
	$pdo_status = $pdo_conn->prepare("SELECT followups_sname  FROM enquiry_followups_status where enquiry_followups_sid='".$enquiry_followups_sid."'");
	$pdo_status->execute();
	$pdostatus = $pdo_status->fetch();
	return $pdostatus['followups_sname'];
}

function get_followup_date($enquiry_id)
{
	global $pdo_conn;
	$followup = $pdo_conn->prepare("SELECT * FROM enquiry_followups WHERE  enquiry_id='".$enquiry_id."'  ");
	$followup->execute();
	$followup_date = $followup->fetch();
	return $followup_date['next_date'];		
}
function get_enquiry_creation()
{
    global $pdo_conn;
    $pdo_enquiry = $pdo_conn->prepare("SELECT * FROM enquiry ORDER BY enquiry_id DESC");
    $pdo_enquiry->execute();
    $pdoenquiry = $pdo_enquiry->fetchAll();
    $enquiry_no=$pdoenquiry[0]['enquiry_no'];
    
    return $enquiry_no+1;
}
function get_enquiry_number($enquiry_id)
{
    global $pdo_conn;
    $pdo_enquiry = $pdo_conn->prepare("SELECT * FROM enquiry where enquiry_id='$enquiry_id'");
    $pdo_enquiry->execute();
    $pdoenquiry = $pdo_enquiry->fetch();
    $enquiry_no=$pdoenquiry['enquiry_no'];
    
    return $enquiry_no;
}
function get_customer_name($customer_id)
{
	global $pdo_conn;
	$select_customer = $pdo_conn->prepare("SELECT customer_name FROM customer_creation WHERE customer_id='".$customer_id."' ");
	$select_customer->execute();
	$customer = $select_customer->fetch();
	return $customer['customer_name'];
}
function get_customer_mobileno($customer_id)
{
	global $pdo_conn;
	$select_customer = $pdo_conn->prepare("SELECT mobile_no FROM customer_creation WHERE customer_id='".$customer_id."' ");
	$select_customer->execute();
	$customer = $select_customer->fetch();
	return $customer['mobile_no'];
}
function get_category_name($category_id)
{
	global $pdo_conn;
	$pdo_category = $pdo_conn->prepare("SELECT category_name FROM category where category_id='".$category_id."'");
	$pdo_category->execute();
	$pdocategory = $pdo_category->fetch();
	return $pdocategory['category_name'];
}

function get_subcategory_name($subcategory_id)
{
	global $pdo_conn;
	$pdo_subcategory = $pdo_conn->prepare("SELECT subcategory_name FROM subcategory where subcategory_id='".$subcategory_id."'");
	$pdo_subcategory->execute();
	$pdosubcategory = $pdo_subcategory->fetch();  
	return $pdosubcategory['subcategory_name'];
}
function get_item_name($item_id)
{
	global $pdo_conn;
	 $pdo_itemcreation = $pdo_conn->prepare("SELECT item_name FROM itemcreation where item_id='".$item_id."'");
$pdo_itemcreation->execute();
$pdoitemcreation= $pdo_itemcreation->fetch();
	return $pdoitemcreation['item_name'];
}

 
function get_religion($religion_id)
{
	$pdo_religion = $pdo_conn->prepare("SELECT * FROM religion where religion_id=".$religion_id);
	$pdo_religion->execute();
	$result = $pdo_religion->fetchAll();

	return $result[0]['religion_name'];
}

 

 

function item_name($itembase_id = ''){ //Purchase entry
	global $pdo_conn;
	$condition = '';
	if(!empty($itembase_id)){
		$condition = " WHERE itembase_id = ".$itembase_id;
	}
	$select_itemname=$pdo_conn->prepare("SELECT itembase_id, (SELECT item_name FROM itemmaster im WHERE im.itemmaster_id = ib.item_name) as item_name, item_base, item_code FROM itembase ib".$condition);
	$select_itemname->execute();
	$itemname = $select_itemname->fetchAll();
	return $itemname;
}
 
/*************************************Gets Units Name***************************************************/
function purchaseentry_units_name($units_id)
{
	global $pdo_conn;
	$select_units_name= $pdo_conn->prepare("SELECT units_name FROM unitcreation WHERE unitcreation_id = '".$units_id."'");
	$select_units_name->execute();
	$unitsname = $select_units_name->fetchAll();
	return $unitsname;
}
function get_staff_type($staff_type)
{
	global $pdo_conn;
	$select_units_name= $pdo_conn->prepare("SELECT roll_name FROM userroll WHERE userroll_id = '".$staff_type."'");
	$select_units_name->execute();
	$unitsname = $select_units_name->fetchAll();
	return $unitsname[0]['roll_name'];
}
function get_state_name($state_id)
{
	global $pdo_conn;
	$select_state_name= $pdo_conn->prepare("SELECT state_name FROM state WHERE state_id = '".$state_id."'");
	$select_state_name->execute();
	$statename = $select_state_name->fetchAll();
	return $statename[0]['state_name'];
}
function get_district_name($district_id)
{
	global $pdo_conn;
	$select_district_name= $pdo_conn->prepare("SELECT district_name FROM district WHERE district_id = '".$district_id."'");
	$select_district_name->execute();
	$districtname = $select_district_name->fetchAll();
	return $districtname[0]['district_name'];
}
function get_city_name($city_id)
{
	global $pdo_conn;
	$select_city_name= $pdo_conn->prepare("SELECT city_name FROM city WHERE city_id = '".$city_id."'");
	$select_city_name->execute();
	$cityname = $select_city_name->fetchAll();
	return $cityname[0]['city_name'];
} 

function get_staff_name($staffcreation_id)
{
	global $pdo_conn;
	$select_staff_name= $pdo_conn->prepare("SELECT 	staff_name FROM staffcreation WHERE staffcreation_id = '".$staffcreation_id."'");
	$select_staff_name->execute();
	$staffname = $select_staff_name->fetch();
	return $staffname['staff_name'];
}
 

function get_expense_type($expense_id)
{
	global $pdo_conn;
		$pdo_project_pos = $pdo_conn->prepare("SELECT expense_name FROM  expense WHERE expense_id = '".$expense_id."'");
		$pdo_project_pos->execute();
		$pdoproject_name = $pdo_project_pos->fetch();
		return $pdoproject_name['expense_name'];
}


?>