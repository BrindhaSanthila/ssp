<?php
date_default_timezone_set('Asia/Kolkata');
header('Access-Control-Allow-Origin: *'); 
error_reporting(0);
include("../dbConnect.php");
include("../common_function.php");

$usercreation_id = $_GET['usercreation_id'];
$user_type_id = $_GET['user_type_id'];
$customer_id=$_GET['customer_id'];
?>
<div class="container-fluid" style="padding:0px;">
	<div class="row">
	<div class="col-xs-12 top_header">
	<div class="col-xs-10 top_left" style="padding-left:6px;">


	</div>
	 <div class="col-xs-2 top_left">
	<i class="fa fa-arrow-circle-left arrow_back" onClick="gotoPage('customer_creation/list','<?php echo $usercreation_id?>','<?php echo $user_type_id?>')"></i>    </div> 
	</div>                                         
	</div>
</div>
<div class="container">
 <div class="cover-page-content-dash" align="center" style="background-color:#fff;">
<form  class="was-validated" name="category" autocomplete="off" style="padding:10px;">
<table  class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">
	
	 <?php 
	$i=0;

	//echo "SELECT * FROM customer_creation  WHERE customer_id='".$customer_id."'";
	$enquiry = $pdo_conn->prepare("SELECT * FROM customer_creation  WHERE customer_id='".$customer_id."'");
	$enquiry->execute();
	$customer = $enquiry->fetchAll(); 

	
$i=1;

	foreach ($customer as $record) {
	
//echo $custome_name=$record[0]['customer_name'];

	 ?>
		<tr>
	
<td align="left"><b>Customer Name</b></td>
			<td align="left"><?php echo $record['customer_name'] ;  ?></td>
	</tr>		
<tr>
	
<td align="left"><b>DOB</b></td>
			<td align="left"><?php echo $record['dob'] ;  ?></td>
	</tr>		
		<tr>
<td align="left"><b>Mobile Number</b></td>
			<td align="left"><?php echo $record['mobile_no'] ;  ?></td>
			</tr>

	<tr>
			<?php
			//echo "SELECT * FROM religion WHERE   religion_id='".$record['customer_id']."'";
$enquiry_list = $pdo_conn->prepare("SELECT * FROM religion WHERE   religion_id='".$record[0]['customer_id']."'");
	$enquiry_list->execute();
	$lists = $enquiry_list->fetchAll(); 
	?>

<td align="left"><b>Religion Name</b></td>

			<td align="left"><?php echo $lists[0]['religion_name'] ;  ?></td>
		</tr>

		<tr>
			<!-- <td><?php echo $i;?></td>
			
			<td><?php echo $record['customer_name'] ;  ?></td>
			
			<?php
			//echo "SELECT * FROM religion WHERE   religion_id='".$record['customer_id']."'";
$enquiry_list = $pdo_conn->prepare("SELECT * FROM religion WHERE   religion_id='".$record[0]['customer_id']."'");
	$enquiry_list->execute();
	$lists = $enquiry_list->fetchAll(); 
	?>
			<td><?php echo $lists[0]['religion_name'] ;  ?></td>
			<td><?php echo $record['mobile_no'] ;  ?></td>
			<td><?php echo $record['email'] ;  ?></td>
			<td><?php echo $record['address'] ;  ?></td>
			<td><?php echo $record['dob'] ;  ?></td>
			<td><?php echo $record['no_of_members'] ;  ?></td>
			<?php
$city_list = $pdo_conn->prepare("SELECT * FROM city WHERE   city_id='".$record[0]['city_id']."'");
	$city_list->execute();
	$lists1 = $city_list->fetchAll(); 

			?>
			<td><?php echo $lists1[0]['city_name'] ;  ?></td>

			<?php
$district_list = $pdo_conn->prepare("SELECT * FROM district WHERE   district_id='".$record[0]['district_id']."'");
	$district_list->execute();
	$lists2 = $district_list->fetchAll(); 

			?>
			<td><?php echo $lists2[0]['district_name'] ;  ?></td>
<?php
$state_list = $pdo_conn->prepare("SELECT * FROM state WHERE   state_id='".$record[0]['state_id']."'");
	$state_list->execute();
	$lists3 = $state_list->fetchAll(); 

			?>
			<td><?php echo $lists3[0]['state_name'] ;  ?></td> -->
			<td align="left"><b>Description</b></td>
			<td align="left"><?php echo $record['description'] ;  ?></td>

		</tr>

		<?php

		$i++;

}

		?>
  <input type="hidden" name="usercreation_id" id="usercreation_id" value="<?php echo $usercreation_id; ?>">
 
</table>


</form>
<div class="row">
<div class="col-md-12">
	
</div>
	 	</div>
		
		
		</div>
		</div>
<script type="text/javascript">
 
function gotoPage(link,usercreation_id,user_type_id) {

    $("#page_replace_div").load(FILE_PATH+'/'+link+'.php?usercreation_id='+usercreation_id+'&user_type_id='+user_type_id);
}

</script>


<style type="text/css">

	

.input_type
{
		width: 100%;
	margin: 0px auto;
	margin-bottom: 10px;
	border-bottom: 1px solid;
	border-color: #d2d2d2;
	padding: 0px 0px;
	-webkit-transition: 0.5s;
	transition: 0.5s;
	outline: none;
	text-align: left !important;
	 background-color: transparent !important;
}
.button1 {
    background-color: #f9f1ee !important;
    width: 120px;
    box-shadow: 0px 2px 5px #adabab;
    height: 30px;
    border: 0px;
    border-radius: 10px;
    color: #0c0c0c;
    font-size: 14px;
    border: 2px solid #6f4130;
}
.total_amount {
    /* margin-left: 189px; */
    font-size: 14px;
    float: right;
    padding-right: 19px;
}
tr th {
    text-align: center;
}
table.table.table-bordered.table-hover.table-striped.display.nowrap.margin-top-10.w-p100 tr td input {
    text-align: center !important;
}
table.table.table-bordered.table-hover.table-striped.display.nowrap.margin-top-10.w-p100 tr td {
    text-align: center !important;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 6px;
}
</style>