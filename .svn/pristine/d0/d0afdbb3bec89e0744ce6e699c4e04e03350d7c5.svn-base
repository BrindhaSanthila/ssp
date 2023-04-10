<?php
require_once('dbConnect.php');

$select_itemcategory=$pdo_conn->prepare("SELECT * FROM itemcategory");
$select_itemcategory->execute();
$itemcategory = $select_itemcategory->fetchAll();
	  
$select_units=$pdo_conn->prepare("SELECT * FROM unitcreation");
$select_units->execute();
$units = $select_units->fetchAll();
	  
$select_brandmaster=$pdo_conn->prepare("SELECT * FROM brandmaster");
$select_brandmaster->execute();
$brandmaster = $select_brandmaster->fetchAll();

$select_state=$pdo_conn->prepare("SELECT * FROM state where status='1'");
$select_state->execute();
$state = $select_state->fetchAll();

$select_district=$pdo_conn->prepare("SELECT * FROM district where status='1'");
$select_district->execute();
$district = $select_district->fetchAll();

$select_category=$pdo_conn->prepare("SELECT * FROM category where status='1'");
$select_category->execute();
$category = $select_category->fetchAll();

$select_reason_category=$pdo_conn->prepare("SELECT * FROM reason_category where status='1'");
$select_reason_category->execute();
$reason_category = $select_reason_category->fetchAll();

$select_contact_type=$pdo_conn->prepare("SELECT * FROM contact_type where status='1'");
$select_contact_type->execute();
$contact_type = $select_contact_type->fetchAll();

$select_bankmaster=$pdo_conn->prepare("SELECT * FROM bankmaster ");
$select_bankmaster->execute();
$bankmaster = $select_bankmaster->fetchAll();


	 
$select_groupmaster=$pdo_conn->prepare("SELECT * FROM groupmaster WHERE main_group='1' AND sub_group!='PRIMARY' AND active_status='1'");
$select_groupmaster->execute();
$groupmaster = $select_groupmaster->fetchAll(); 

$select_userrole=$pdo_conn->prepare("SELECT * FROM userroll WHERE active_status='1'");
$select_userrole->execute();
$userrole = $select_userrole->fetchAll();

$select_itemmaster=$pdo_conn->prepare("SELECT * FROM itemmaster");
$select_itemmaster->execute();
$itemmaster = $select_itemmaster->fetchAll();

$select_taxmaster=$pdo_conn->prepare("SELECT * FROM taxmaster");
$select_taxmaster->execute();
$taxmaster = $select_taxmaster->fetchAll();

$pdo_ledgercreation = $pdo_conn->prepare("SELECT * FROM ledgercreation ORDER BY ledgercreation_id DESC");
$pdo_ledgercreation->execute();
$pdoledgercreation = $pdo_ledgercreation->fetchAll();

$pdo_accountyear = $pdo_conn->prepare("SELECT * FROM accountyear ORDER BY accountyear_id DESC");
$pdo_accountyear->execute();
$pdoaccountyear = $pdo_accountyear->fetchAll();

$pdo_bankmaster = $pdo_conn->prepare("SELECT * FROM bankmaster where delete_status !='1' ORDER BY bank_id DESC");
$pdo_bankmaster->execute();
$pdobankmaster = $pdo_bankmaster->fetchAll();

$pdo_brandmaster = $pdo_conn->prepare("SELECT * FROM brandmaster ORDER BY brandmaster_id DESC");
$pdo_brandmaster->execute();
$pdobrandmaster = $pdo_brandmaster->fetchAll();

$pdo_city = $pdo_conn->prepare("SELECT * FROM city ORDER BY city_id DESC");
$pdo_city->execute();
$pdocity = $pdo_city->fetchAll();

$pdo_company = $pdo_conn->prepare("SELECT * FROM company ORDER BY company_id DESC");
$pdo_company->execute();
$pdocompany = $pdo_company->fetchAll(); 
			
$pdo_groupmaster = $pdo_conn->prepare("SELECT * FROM groupmaster ORDER BY groupmaster_id DESC");
$pdo_groupmaster->execute();
$pdogroupmaster = $pdo_groupmaster->fetchAll();
		
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

$pdo_state = $pdo_conn->prepare("SELECT * FROM state ORDER BY state_id DESC");
$pdo_state->execute();
$pdostate = $pdo_state->fetchAll();

$pdo_religion = $pdo_conn->prepare("SELECT * FROM religion ORDER BY religion_id DESC");
$pdo_religion->execute();
$pdoreligion = $pdo_religion->fetchAll();

$pdo_special_days = $pdo_conn->prepare("SELECT * FROM special_days ORDER BY special_id DESC");
$pdo_special_days->execute();
$pdospecialdays = $pdo_special_days->fetchAll();

$pdo_project_pos = $pdo_conn->prepare("SELECT * FROM project_position ORDER BY project_position_id DESC");
$pdo_project_pos->execute();
$pdoproject_position = $pdo_project_pos->fetchAll();

$pdo_district = $pdo_conn->prepare("SELECT * FROM district ORDER BY district_id DESC");
$pdo_district->execute();
$pdodistrict = $pdo_district->fetchAll();

$pdo_district = $pdo_conn->prepare("SELECT * FROM district ORDER BY district_id DESC");
$pdo_district->execute();
$pdodistrict = $pdo_district->fetchAll();

/*$pdo_city = $pdo_conn->prepare("SELECT * FROM city ORDER BY city_id DESC");
$pdo_city->execute();
$pdocity = $pdo_city->fetchAll */

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

$pdo_segment = $pdo_conn->prepare("SELECT * FROM segment ORDER BY segment_id DESC");
$pdo_segment->execute();
$pdosegment = $pdo_segment->fetchAll();

$pdo_project_tracking = $pdo_conn->prepare("SELECT * FROM project_tracking ORDER BY project_tracking_id DESC");
$pdo_project_tracking->execute();
$pdoproject_tracking = $pdo_project_tracking->fetchAll();

$pdo_reason_category = $pdo_conn->prepare("SELECT * FROM reason_category ORDER BY reason_category_id DESC");
$pdo_reason_category->execute();
$pdoreason_category = $pdo_reason_category->fetchAll();

$pdo_reason_creation = $pdo_conn->prepare("SELECT * FROM reason_creation ORDER BY reason_creation_id DESC");
$pdo_reason_creation->execute();
$pdoreason_creation = $pdo_reason_creation->fetchAll();

$pdo_contact_type = $pdo_conn->prepare("SELECT * FROM contact_type ORDER BY contact_type_id DESC");
$pdo_contact_type->execute();
$pdocontact_type = $pdo_contact_type->fetchAll();

$pdo_brand = $pdo_conn->prepare("SELECT * FROM brand ORDER BY brand_id DESC");
$pdo_brand->execute();
$pdobrand = $pdo_brand->fetchAll();

$pdo_taxmaster = $pdo_conn->prepare("SELECT * FROM taxmaster ORDER BY taxmaster_id DESC");
$pdo_taxmaster->execute();
$pdotaxmaster = $pdo_taxmaster->fetchAll();

$pdo_unitcreation = $pdo_conn->prepare("SELECT * FROM unitcreation ORDER BY unitcreation_id DESC");
$pdo_unitcreation->execute();
$pdounitcreation = $pdo_unitcreation->fetchAll();

$pdo_usercreation = $pdo_conn->prepare("SELECT * FROM usercreation ORDER BY usercreation_id DESC");
$pdo_usercreation->execute();
$pdousercreation = $pdo_usercreation->fetchAll();

$pdo_userroll = $pdo_conn->prepare("SELECT * FROM userroll ORDER BY userroll_id DESC");
$pdo_userroll->execute();
$pdouserroll = $pdo_userroll->fetchAll();

$pdo_salesentry=$pdo_conn->prepare("SELECT invoice_no FROM salesentrymain ORDER BY salesentrymain_id DESC LIMIT 1");
$pdo_salesentry->execute();
$pdosalesentry = $pdo_salesentry->fetchAll();

$pdo_salesentrymain=$pdo_conn->prepare("SELECT * FROM salesentrymain WHERE active_status='1' ORDER BY salesentrymain_id DESC");
$pdo_salesentrymain->execute();
$pdosalesentrymain = $pdo_salesentrymain->fetchAll();
						
$roll_id=1;
   
// TASK EST TIME

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

function find_projecttask_est($pdo_conn,$projecttask_id)
{
	$pdo_statement = $pdo_conn->prepare("SELECT * FROM projecttask where projecttask_id=".$projecttask_id);
	$pdo_statement->execute();
	$result = $pdo_statement->fetchAll();

	return $result[0]['estimated_hours'];
}

function get_religion($religion_id)
{
	$pdo_religion = $pdo_conn->prepare("SELECT * FROM religion where religion_id=".$religion_id);
	$pdo_religion->execute();
	$result = $pdo_religion->fetchAll();

	return $result[0]['religion_name'];
}

function current_date()
{
     $timezone  = +5.30; //(GMT -5:00) EST (U.S. & Canada) 
     return gmdate("Y-m-d", time() + 3600*($timezone+date("I")));  

}
function current_time()
{
    $timezone  = +5.30; //(GMT -5:00) EST (U.S. & Canada) 
   return gmdate("H:i", time() + 3600*($timezone+date("I")));  
}
function paginate($reload, $page, $tpages) {
    $adjacents = 2;
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $out = "";
    // previous
    if ($page == 1) {
        $out.= "<span>".$prevlabel."</span>\n";
    } elseif ($page == 2) {
        $out.="<li><a href=\"".$reload."\">".$prevlabel."</a>\n</li>";
    } else {
        $out.="<li><a href=\"".$reload."&amp;page=".($page - 1)."\">".$prevlabel."</a>\n</li>";
    }
    $pmin=($page>$adjacents)?($page - $adjacents):1;
    $pmax=($page<($tpages - $adjacents))?($page + $adjacents):$tpages;
    for ($i = $pmin; $i <= $pmax; $i++) {
        if ($i == $page) {
            $out.= "<li class=\"active\"><a href=''>".$i."</a></li>\n";
        } elseif ($i == 1) {
            $out.= "<li><a href=\"".$reload."\">".$i."</a>\n</li>";
        } else {
            $out.= "<li><a href=\"".$reload. "&amp;page=".$i."\">".$i. "</a>\n</li>";
        }
    }
    
    if ($page<($tpages - $adjacents)) {
        $out.= "<a style='font-size:11px' href=\"" . $reload."&amp;page=".$tpages."\">" .$tpages."</a>\n";
    }
    // next
    if ($page < $tpages) {
        $out.= "<li><a href=\"".$reload."&amp;page=".($page + 1)."\">".$nextlabel."</a>\n</li>";
    } else {
        $out.= "<span style='font-size:11px'>".$nextlabel."</span>\n";
    }
    $out.= "";
    return $out;
}

function find_menu($user,$menu,$field)
{
	$query="SELECT $field FROM rights where user_id='$user' AND $field='$menu'";
	$rs=mysql_query($query);
	$rscount=mysql_num_rows($rs);
	return $rscount;
}
function convertCurrency($amount, $from, $to){
    $url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
    $data = file_get_contents($url);
    preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
    $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
    return round($converted, 3);
}
function current_date_input(){  //Purchase entry
	$month = date('m');
	$day = date('d');
	$year = date('Y');
	$today =  $year . '-' . $month . '-' . $day;
	return $today;
}
function save_status_value(){ //Purchase entry
	global $pdo_conn;
	$save_status = $pdo_conn->prepare("SELECT save_status FROM purchasemain ORDER BY save_status DESC limit 0,1");
	$save_status->execute();
	$savestatus = $save_status->fetchAll();
	return $savestatus;
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
function ledger_name($groupmaster_id = ''){
	global $pdo_conn;
	$condition = '';
	if(!empty($groupmaster_id)){
		$condition = " AND groupmaster_id = ".$groupmaster_id;
	}
	$select_ledgername=$pdo_conn->prepare("SELECT * FROM groupmaster WHERE main_group!='1' AND sub_group!='PRIMARY' AND active_status='1'".$condition);
	$select_ledgername->execute();
    $ledgername = $select_ledgername->fetchAll();
	return $ledgername;
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
function get_concern_name($concern_id)
{
	global $pdo_conn;
	$select_concern_name= $pdo_conn->prepare("SELECT concern_name FROM ourconcerns WHERE concern_id = '".$concern_id."'");
	$select_concern_name->execute();
	$concernname = $select_concern_name->fetchAll();
	return $concernname[0]['concern_name'];
}

function get_staff_name($staffcreation_id)
{
	global $pdo_conn;
	$select_staff_name= $pdo_conn->prepare("SELECT 	staff_name FROM staffcreation WHERE staffcreation_id = '".$staffcreation_id."'");
	$select_staff_name->execute();
	$staffname = $select_staff_name->fetch();
	return $staffname['staff_name'];
}
function get_project_name($project_id)
{
		global $pdo_conn;
		$pdo_project_pos = $pdo_conn->prepare("SELECT project_name FROM  project_creation WHERE project_creation_id = '".$project_id."'");
		$pdo_project_pos->execute();
		$pdoproject_name = $pdo_project_pos->fetchAll();
		return $pdoproject_name;
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