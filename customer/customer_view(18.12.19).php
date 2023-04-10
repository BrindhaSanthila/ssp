<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');

 $sales_id =$_POST['customer_id'];
 
			//echo $sql ="SELECT * FROM customer_profile WHERE delete_status='0' AND customer_id='$sales_id'";
			$select_customer_profile = $pdo_conn->prepare("SELECT * FROM customer_profile WHERE delete_status='0' AND customer_id='$sales_id'");
            $select_customer_profile->execute();
            $customer_profile = $select_customer_profile->fetchAll();




?>
<div class="col-md-12 header">
	<h3>Customer Profile</h3>
</div>
<div class="padd_div">
<table width="100%" id="table1">
	<tr>
	<td style="width:28%;font-weight: 600;font-size: 17px;">Company Name:</td>
	<td style="text-align: unset;"><span class="comp_name"><?php echo $customer_profile[0]['company_name']; ?><span></td>
	</tr>
</table>
</div>
<div class="padd_div">
<div class="table-responsive">
<table width="100%" id="table2">
	<tr>
	<td class="th_div">Billing Address</td>
	<td class="th_div">Delivary Address</td>
	</tr>
	<tr class="address_td">
	<td> <?php echo $customer_profile[0]['billing_address']; ?></td>
	<td><?php echo $customer_profile[0]['delivery_address']; ?></td>
	</tr>
</table>
</div>

	<?php 
		$st_id =$customer_profile[0]['state_id'];
		$select_sts = $pdo_conn->prepare("SELECT * FROM state WHERE state_id='$st_id'");
        $select_sts->execute();
        $ste1 = $select_sts->fetchAll();
		foreach($ste1 as $ste) {
?>

<?php 
		$dis_id =$customer_profile[0]['district_id'];
		$select_dis = $pdo_conn->prepare("SELECT * FROM district WHERE state_id='$st_id' AND district_id='$dis_id'");
        $select_dis->execute();
        $dit1 = $select_dis->fetchAll();
		foreach($dit1 as $dit) {
		
?>


<?php 
		$ct_id =$customer_profile[0]['city_id'];
		$select_cty = $pdo_conn->prepare("SELECT * FROM city WHERE state_id='$st_id' AND district_id='$dis_id' AND city_id='$ct_id'");
        $select_cty->execute();
        $cty1 = $select_cty->fetchAll();
		foreach ($cty1 as $cty) {
		
?>

<?php } } } ?>


</div>
<div class="padd_div">
<div class="table-responsive">
<table width="100%" id="table3">
	<tr>
	<td>Pan Number:</td>
	<td style="font-weight: 100;"> <?php echo $customer_profile[0]['pan_num']; ?></td>
	<td>GST Number:</td>
	<td style="font-weight: 100;"><?php echo $customer_profile[0]['gst_num']; ?></td>
	</tr>
	<tr>
	<td>City:</td>
	<td style="font-weight: 100;"><?php echo $cty['city_name']; ?></td>
	<td>District:</td>
	<td style="font-weight: 100;"><?php echo $dit['district_name']; ?></td>
	<td>Email:</td>
	<td style="font-weight: 100;"><?php echo $customer_profile[0]['email']; ?></td>
	</tr>





	<tr>
	<td>Sate:</td>
	<td style="font-weight: 100;"><?php echo $ste['state_name']; ?></td>
	<td>Phone Numbers:</td>
	<td style="font-weight: 100;"><?php echo $customer_profile[0]['landline_num']; ?></td>
	<td  >Adhar Number:</td>
	<td style="font-weight: 100;"><?php echo $customer_profile[0]['adhar_num']; ?></td>
	</tr>



	
</table>
</div>
</div>
<div class="padd_div">
<div class="col-md-12 header">
	<h4>Contact Informations</h4>
</div>
<div class="table-responsive">
<table width="100%" id="table4">
	<tr>
	<td class="th_div">S.No</td>
	<td class="th_div">Contact Person</td>
	<td class="th_div">Designation</td>
	<td class="th_div">Mobile Number</td>
	<td class="th_div">Email</td>
	</tr>
	<?php 
		$k=0;
		//echo $sq ="SELECT * FROM city WHERE state_id='$st_id' AND district_id='$dis_id' AND city_id='$ct_id'";
		$select_contact_type = $pdo_conn->prepare("SELECT * FROM contact WHERE customer_id='$sales_id'");
        $select_contact_type->execute();
        $cntct = $select_contact_type->fetchAll();
		
		foreach($cntct as $cnt_type){
		
		
?>
	<tr>
	<td><?php echo $k=$k+1; ?></td>
	<td><?php echo $cnt_type['contact_name']; ?></td>

	<?php 
		$cnt_typ_id =$cnt_type['contact_type'];
		//echo $sq ="SELECT * FROM contact_type WHERE contact_type_id='$cnt_typ_id' ";
		$select_cn_ty = $pdo_conn->prepare("SELECT * FROM contact_type WHERE contact_type_id='$cnt_typ_id' ");
        $select_cn_ty->execute();
        $cnt_typ_nm = $select_cn_ty->fetch();		
?>
	<td><?php echo $cnt_typ_nm['contact_type_name']; ?></td>
	<td><?php echo $cnt_type['mobile_number']; ?></td>
	<td><?php echo $cnt_type['contact_email']; ?></td>
	</tr>
	<?php }  ?>
	
</table>
</div>
</div>
<div class="padd_div">
<div class="col-md-12 header">
	<h4>Bank Details</h4>
</div>
<div class="table-responsive">
<table width="100%" id="table5">
	<tr>
	<td class="th_div">Account Name</td>
	<td class="th_div">Bank Name</td>
	<td class="th_div">Account Number</td>
	<td class="th_div">IFSC Code</td>
	</tr>
	<tr>
	<td><?php echo $customer_profile[0]['account_holder_name']; ?></td>
	<td><?php echo $customer_profile[0]['bank_name']; ?></td>
	<td><?php echo $customer_profile[0]['account_number']; ?></td>
	<td><?php echo $customer_profile[0]['ifsc_code']; ?></td>
	</tr>
</table>
</div>
</div>
<div class="padd_div">
<div class="col-md-12 header">
	<h4>Production Facilities</h4>
</div>
<?php 
        //echo $sql ="SELECT * FROM production_facilities WHERE customer_id='$sales_id'";
		$select_prdctn_facility = $pdo_conn->prepare("SELECT * FROM production_facilities WHERE customer_id='$sales_id'");
        $select_prdctn_facility->execute();
        $prdct_facility = $select_prdctn_facility->fetchAll();

?>
<div class="table-responsive">
<table width="100%" id="table6">
	<tr>
	<td></td>
	<td class="th_div">Yarn</td>
	<td class="th_div">Knits</td>
	<td class="th_div">Woven</td>
	<td class="th_div">Printig</td>
	<td class="th_div">Sizing</td>
	</tr>
	<tr>
	<td></td>
	<td><?php echo $prdct_facility[0]['yarn_type']; ?></td>
	<td><?php echo $prdct_facility[0]['knits_type']; ?></td>
	<td><?php echo $prdct_facility[0]['woven_type']; ?></td>
	<td><?php echo $prdct_facility[0]['printing_type']; ?></td>
	<td><?php echo $prdct_facility[0]['sizing_type']; ?></td>
	</tr>
	<tr>
	<td>Production/<br>Day in tons</td>
	<td><?php echo $prdct_facility[0]['yarn_tons']; ?></td>
	<td><?php echo $prdct_facility[0]['knits_tons']; ?></td>
	<td><?php echo $prdct_facility[0]['woven_tons']; ?></td>
	<td><?php echo $prdct_facility[0]['printing_tons']; ?></td>
	<td><?php echo $prdct_facility[0]['sizing_tons']; ?></td>
	</tr>
	<tr>
	<td>M/C Details</td>
	<td><?php echo $prdct_facility[0]['yarn_machine_dscrpt']; ?></td>
	<td><?php echo $prdct_facility[0]['knits_machine_dscrpt']; ?></td>
	<td><?php echo $prdct_facility[0]['woven_machine_dscrpt']; ?></td>
	<td><?php echo $prdct_facility[0]['printing_machine_dscrpt']; ?></td>
	<td><?php echo $prdct_facility[0]['sizing_machine_dscrpt']; ?></td>
	</tr>
</table>
</div>
</div>


<?php
$select_customer_profiles = $pdo_conn->prepare("SELECT * FROM production_facilities WHERE customer_id='$sales_id' ORDER BY production_facilities_id DESC LIMIT 1");
$select_customer_profiles->execute();
$customer_profiles = $select_customer_profiles->fetch();
?>
<h4 style="color: black;font-size: 14px;margin: 0px;">Production Facilities Description</h4>
<div class="border_div" style="border:0px;">
<table width="100%" id="table9">
<tr>
<td style="text-align: left;"><p><?php echo $customer_profiles['production_dscrpt'];?></p></td>
</tr>
</table>
</div>











<div class="padd_div">
<div class="col-md-12 header">
	<h4>Chemical Usage Details</h4>
</div>
<div class="table-responsive">
<table width="100%" id="table7">
	<tr>
	<td class="th_div">S.No</td>
	<td class="th_div">Category</td>
	<td class="th_div">Brand</td>
	<td class="th_div">Segment</td>
	<td class="th_div">Produt Name</td>
	<td class="th_div">Dosage</td>
	<td class="th_div">GPI/%</td>
	<td class="th_div">Rate</td>
	</tr>
	<?php
		$select_chm_use = $pdo_conn->prepare("SELECT * FROM chemical_using WHERE customer_id='$sales_id' AND delete_status!='1'");
        $select_chm_use->execute();
        $chm_usng = $select_chm_use->fetchAll();
		$sr_no=1;
		foreach($chm_usng as $cm_us){
		$seg_id = $cm_us['segment_id'];
			
	?>
	<tr>
	<td><?php echo $sr_no; ?></td>
	<?php
		$ct_name = $cm_us['category_id'];
		//echo $sql="SELECT * FROM category WHERE category_id='$ct_name'";
		$select_ct_name = $pdo_conn->prepare("SELECT * FROM category WHERE category_id='$ct_name'");
        $select_ct_name->execute();
        $cat_nm = $select_ct_name->fetchAll();
		
	?>
	<td><?php echo $cat_nm[0]['category_name']; ?></td>
	<?php
		$brnd_id = $cm_us['brand_id'];
		//echo $sql="SELECT * FROM brand WHERE brand_id='$brnd_id'";
		$select_br_name = $pdo_conn->prepare("SELECT * FROM brand WHERE brand_id='$brnd_id'");
        $select_br_name->execute();
        $brnd_nm = $select_br_name->fetchAll();
		//echo $brnd_id
	?>
	<td><?php echo $brnd_nm[0]['brand_name']; ?></td>
	<?php
		//echo $seg_id.',';
		//echo $sql="SELECT * FROM segment WHERE segment_id='$seg_id' AND category_id='$ct_name'";
		$select_seg_name = $pdo_conn->prepare("SELECT * FROM segment WHERE segment_id='$seg_id'");
        $select_seg_name->execute();
        $seg_nm = $select_seg_name->fetchAll();
		
	?>
	<td><?php echo $seg_nm[0]['segment_name']; ?></td>
	<td><?php echo $cm_us['product_name']; ?></td>
	<td><?php echo $cm_us['dosage']; ?></td>
	<td><?php echo $cm_us['gpi']; ?></td>
	<td><?php echo $cm_us['rate']; ?></td>
	</tr>
	<?php  $sr_no++; }  ?>
</table>
</div>
</div>


<h4 style="color: black;font-size: 14px;margin: 0px;">Description</h4>
 <div class="border_div" style="border:0px;">
 <table width="100%" id="table9">
 <tr>
 <td style="text-align: left;"><p><?php echo $customer_profile[0]['description']; ?></p></td>
</tr>
</table>
</div>




<h4 style="color: black;font-size: 14px;margin: 0px;">Description /Payment Terms</h4>
<div class="border_div" style="border:0px;">
<table width="100%" id="table9">
<tr>
	<td style="text-align: left;"><p><?php echo $customer_profile[0]['term_condition']; ?></p></td>
</tr>
<tr>
	<td style="text-align: left;"><p style="margin-bottom: 0px;" ><input type="checkbox" name="payment_terms" id="payment_terms" onclick="" checked disabled > Agreed Payments Terms</p></td>
</tr>
</table>
</div>









<style>
.border_div {
    border: 1px solid#cccc;
    padding: 7px;
}
.col-md-12.header {
    text-align: center;
    background-color: #9c9c9c;
    color: white;
    font-weight: 900;
}
table#table7 tr td {
    border: 1px solid #ccc;
	color:black;
	height: 22px;
}
table#table6 tr td {
    border: 1px solid #ccc;
	color:black;
	height: 22px;
}
table#table5 tr td {
    border: 1px solid #ccc;
	color:black;
	height: 22px;
}
table#table4 tr td {
    border: 1px solid #ccc;
	color:black;
	height: 22px;
}
table#table2 tr td {
    border: 1px solid #ccc;
	color:black;
	height: 22px;
}
table#table9 tr td {
    border: 1px solid #ccc;
	color:black;
	height: 22px;
}



tr.address_td td {
    height: 104px;
}
.padd_div {
    padding: 4px;
}
span.comp_name {
    font-size: 21px;
    font-weight: 800;
	color: black;
}
table tr td {
    text-align: center;
}
table#table3 tr td {
    text-align: unset;
	

}
table#table3 {
    font-weight: 900;
    color: black;
	
}
td.th_div {
    font-weight: 600;
    color: black;
}
h3 {
    font-weight: 600;
}
h4 {
    font-weight: 600;
}
table#table3 tr td {
    padding: 6px;
}
hr {
    margin: 0px;
    border: 1px solid #ccc;
    width: 101%;
    margin-left: -5px;
}
</style>




	

