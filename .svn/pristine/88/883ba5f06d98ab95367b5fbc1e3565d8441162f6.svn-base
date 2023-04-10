<?php
date_default_timezone_set("Asia/Kolkata");
error_reporting(0);
ob_start();
session_start();
$sess_user_type_id=$_SESSION['sess_user_type_id'];
$sess_staff_id=$_SESSION['sess_staff_id'];
include("../include/common_function.php");
require("../model/config.inc.php");
require("../model/Database.class.php");
$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
  $customer_id=$_GET[customer_id];
$customer_type = $_GET[customer_type];
$district_name=$_GET[district_name];
$city_name=$_GET[city_name];



 
 if($customer_id!=''){ $customer_id_fil=get_supplier_customer_name($customer_id);} else { $customer_id_fil="ALL";}
 if($customer_type!=''){ $customer_type_fil=get_customer_type ($customer_type);}else { $customer_type_fil="ALL";}
 /*if($sess_user_type_id==1){if($staff_id_fil!=''){ $staff_id_fil=get_staff_name($staff_id_fil);} else{ $staff_id_fil="ALL";} }else{ $staff_id_fil=get_staff_name($sess_staff_id);}*/
if($district_name!=''){ $district_fil=get_district_name($district_name); } else { $district_fil="";}
if($city_name!=''){ $city_fil=get_city_name($city_name); } else { $city_fil="ALL";}




/*if($_GET['customer_id']!=''){$customer_id=$_GET['customer_id'];}else{$customer_id=$_POST['customer_id'];}
if($_GET['customer_type']!=''){$customer_type=$_GET['customer_type'];}else{$customer_type=$_POST['customer_type'];}
if($_GET['district_name']!=''){$district_name=$_GET['district_name'];}else{$district_name=$_POST['district_name'];}
if($_GET['city_name']!=''){$city_name=$_GET['city_name'];}else{$city_name=$_POST['city_name'];}*/

/*if($_GET['staff_id']!=''){$staff_id=$_GET['staff_id'];}else{$staff_id=$_POST['staff_id'];}*/

if($customer_id!=""){ $customer_id1 = "customer_id='$customer_id'";}else{$customer_id1='';}
if($customer_type!=""){ $customer_type1 ="customer_type='$customer_type'";} else{ $customer_type1="";}
/*if($staff_id!=""){ $staff_id1 = "staff_id='$staff_id'"; }else{ if($sess_user_type_id==1){$staff_id1='';}elseif($sess_user_type_id==7){$staff_id1="staff_id='$sess_staff_id'";} }*/

if($district_name!=""){ $district_name1 ="district='$district_name'";} else{ $district_name1="";}

if($city_name!=""){ $city_name1 = "city_name='$city_name'";}else{$city_name1="";}

$all_value10 = $customer_id1.",".$customer_type1.",".$district_name1.",".$city_name1;
$all_array10 = explode(',',$all_value10);
foreach($all_array10 as $value10)
{ 
    if($value10!='')
    {
         $get_query5555.= $value10." AND ";
    }
}
////////////////////////////////////////////////////////////////
                
            

//echo $sql_query;

$output			= "";
 


$blog=array('','','','Customer   Report','','');

foreach($blog as $icon)
{
$output		.= '"'.$icon.'",';
}
$output .="\n";

$output .= '"Customer Name"'.",".$customer_id_fil.","."Customer Type".",".$customer_type_fil.","."District Name".",".$district_fil.","."City Name".",".$city_fil."\n"; 
$output .="\n"; 

$output .='"S.No","Customer Type","Customer Name","Mobile No","Reffered Person","City Name"'."\n";


$table_values=array(SNo,CustomerType,CustomerName,MobileNo,RefferedPerson,CityName);
// Get Records from the table
 
/////////////////////////////////////////////////////////////

$sno=0;
////////////////////////////////////////////////////////////s

        if($_SESSION['sess_user_type_id']==1)
            { 

                 $sql = "SELECT * FROM customer_creation where $get_query5555 customer_id!= '' and delete_status!='1'   order by customer_id  DESC";
            
             }
             else
             {
                 $sql = "SELECT * FROM customer_creation where $get_query5555 customer_id!= '' and staff_id='$sess_staff_id' and delete_status!='1'  order by customer_id  DESC";
             }
$rows = $db->fetch_all_array($sql);
foreach($rows as $record) 
{
	 
    $refer = mysql_fetch_array(mysql_query("SELECT * FROM referred_person where refer_id='$record[referred_person]' "));

    $customer_name=$record['customer_name'];

    
    $customer_type=get_customer_type($record['customer_type']);
   $district_name=get_district_name($record['district']);
    $city_name=get_city_name($record['city_name']);
    $contact_no=$record['contact_no'];
$referred_person=$refer['referred_person'];

  
$sno=$sno+1;
$output.='"'.$sno.'",';
$output.='"'.$customer_type.'",';
$output.='"'.$customer_name.'",';

 

$output.='"'.$contact_no.'",';
$output.='"'.$referred_person.'",';
$output.='"'.$city_name.'",';

$output .="\n";
} 







$date=date('d-m-Y H:i:s');
$filename =  "Customer Details".$date.".csv";
header('Content-type: application/xls');
header('Content-Disposition: attachment; filename='.$filename);

echo $output;
exit;

?>
