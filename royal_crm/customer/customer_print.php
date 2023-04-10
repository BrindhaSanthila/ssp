<script>
</script>
<?php 
include("../inc/dbConnect.php");
include '../inc/header.php';

 $sales_id =$_GET['salesentry_id'];
 
			//echo $sql ="SELECT * FROM customer_profile WHERE delete_status='0' AND customer_id='$sales_id'";
			$select_customer_profile = $pdo_conn->prepare("SELECT * FROM customer_profile WHERE delete_status='0' AND customer_id='$sales_id'");
            $select_customer_profile->execute();
            $customer_profile = $select_customer_profile->fetchAll();




?>
<center>
<table class="table2 bdr-clr" width="850px" border="1">
<tr class="tr-bg">
<td  class="style2 " align="center" colspan="4"><b>Customer Profile</b></td>

</tr>

<tr style="background-color: #ccc;"  >
<td class="style1"  align="right" colspan="1"  width="413"><b>Company Name:</b></td>

<td class="style3" colspan="3" ><?php echo $customer_profile[0]['company_name']; ?></td>

</tr>

<table class="table2 bdr-clr" width="850px" border="" style="border-top: none;">
<tr class="padng">
<td class="style1 " width="203">Billing Address</td>
<td class="style1 " width="203" colspan="">Delivery Address</td>
</tr>
<tr>

<td class="style3" style="height:150px" width="203"><?php echo $customer_profile[0]['billing_address']; ?></td>
<td class="style3" width="203" style="height:150px"><?php echo $customer_profile[0]['delivery_address']; ?></td>
</tr>
</table>
<table class="table2 bdr-clr" style="border-top: none;" width="850px" border="1">
<tr class="padng">
<td class="style1" width="203">Pan Number</td>
<td class="style1" width="203">GST Number</td>
<td class="style1" width="203">Adhar Number</td>
<td class="style1" width="203">Landline Number</td>
</tr>


<tr >
<td class="style3" width="203"><?php echo $customer_profile[0]['pan_num']; ?></td>
<td class="style3" width="203"><?php echo $customer_profile[0]['gst_num']; ?></td>
<td class="style3" width="203"><?php echo $customer_profile[0]['adhar_num']; ?></td>
<td class="style3" width="203"><?php echo $customer_profile[0]['landline_num']; ?></td>
</tr>

<tr class="padng">
<td class="style1">State</td>
<td class="style1">District</td>
<td class="style1">city</td>
<td class="style1">Email</td>
</tr>
<?php 
		$st_id =$customer_profile[0]['state_id'];
		//echo $sq ="SELECT * FROM state WHERE delete_status='0' AND state_id='$st_id'";
		$select_sts = $pdo_conn->prepare("SELECT * FROM state WHERE state_id='$st_id'");
        $select_sts->execute();
        $ste = $select_sts->fetchAll();
?>




<?php 
		$dis_id =$customer_profile[0]['state_id'];
		//echo $sq ="SELECT * FROM district WHERE state_id='$st_id' AND district_id='$dis_id'";
		$select_dis = $pdo_conn->prepare("SELECT * FROM district WHERE state_id='$st_id' AND district_id='$dis_id'");
        $select_dis->execute();
        $dit = $select_dis->fetchAll();
		
?>


<?php 
		$ct_id =$customer_profile[0]['city_id'];
		//echo $sq ="SELECT * FROM city WHERE state_id='$st_id' AND district_id='$dis_id' AND city_id='$ct_id'";
		$select_cty = $pdo_conn->prepare("SELECT * FROM city WHERE state_id='$st_id' AND district_id='$dis_id' AND city_id='$ct_id'");
        $select_cty->execute();
        $cty = $select_cty->fetchAll();
		
?>


<tr>
<td class="style3"><?php echo $ste[0]['state_name']; ?></td>
<td class="style3"><?php echo $dit[0]['district_name']; ?></td>
<td class="style3"><?php echo $cty[0]['city_name']; ?></td>
<td class="style3"><?php echo $customer_profile[0]['email']; ?></td>
</tr>




<tr>

<td class="style2 tr-bg" align="center" colspan="4"><b>Contact</b></td>
</tr>

<tr class="padng">
<td class="style1">Contact Name</td>
<td class="style1">Contact Type</td>
<td class="style1" colspan="">Mobile Number</td>
<td class="style1" colspan="">Email</td>
</tr>

<?php 
		
		//echo $sq ="SELECT * FROM city WHERE state_id='$st_id' AND district_id='$dis_id' AND city_id='$ct_id'";
		$select_contact_type = $pdo_conn->prepare("SELECT * FROM contact WHERE customer_id='$sales_id'");
        $select_contact_type->execute();
        $cntct = $select_contact_type->fetchAll();
		
		foreach($cntct as $cnt_type){
		
		
?>
		
<tr>
<td class="style3"><?php echo $cnt_type['contact_name']; ?></td>
<?php 
		$cnt_typ_id =$cnt_type['contact_type'];
		//echo $sq ="SELECT * FROM contact_type WHERE contact_type_id='$cnt_typ_id' ";
		$select_cn_ty = $pdo_conn->prepare("SELECT * FROM contact_type WHERE contact_type_id='$cnt_typ_id' ");
        $select_cn_ty->execute();
        $cnt_typ_name = $select_cn_ty->fetchAll();
		
?>

<td class="style3"><?php echo $cnt_typ_name[0]['contact_type_name']; ?></td>
<td class="style3" colspan=""><?php echo $cnt_type['mobile_number']; ?></td>
<td class="style3" colspan=""><?php echo $cnt_type['contact_email']; ?></td>
</tr>

<?php } ?>






<tr>

<td class="style2 tr-bg" align="center" colspan="4"><b>Bank Account Details</b></td>
</tr>

<tr class="padng">
<td class="style1">Account Holder Name</td>
<td class="style1">Bank Name</td>
<td class="style1">Account Number</td>
<td class="style1">IFSC Code</td>
</tr>

<tr>
<td class="style3"><?php echo $customer_profile[0]['account_holder_name']; ?></td>
<td class="style3"><?php echo $customer_profile[0]['bank_name']; ?></td>
<td class="style3" ><?php echo $customer_profile[0]['account_number']; ?></td>
<td class="style3"><?php echo $customer_profile[0]['ifsc_code']; ?></td>
</tr>



<tr>
<td class="style2 tr-bg" align="center" colspan="4"><b>Production Facilities</b></td>
</tr>

<?php 
        //echo $sql ="SELECT * FROM production_facilities WHERE customer_id='$sales_id'";
		$select_prdctn_facility = $pdo_conn->prepare("SELECT * FROM production_facilities WHERE customer_id='$sales_id'");
        $select_prdctn_facility->execute();
        $prdct_facility = $select_prdctn_facility->fetchAll();

?>


<tr>
<table width="850" class="table2 bdr-clr"   border="1">
<tr class="padng">
<td class="style1">Yarn</td>
<td class="style1">Knits</td>
<td class="style1">Woven</td>
<td class="style1">Printing</td>
<td class="style1">Sizing</td>

</tr>

<tr>
<td class="style3"><?php echo $prdct_facility[0]['yarn_type']; ?></td>
<td><?php echo $prdct_facility[0]['knits_type']; ?></td>
<td><?php echo $prdct_facility[0]['woven_type']; ?></td>
<td><?php echo $prdct_facility[0]['printing_type']; ?></td>
<td><?php echo $prdct_facility[0]['sizing_type']; ?></td>
</tr>
<tr>
<td class="style1" colspan="5">Tons Per Day</td>
</tr>
<tr>
<td class="style3"><?php echo $prdct_facility[0]['yarn_tons']; ?></td>
<td><?php echo $prdct_facility[0]['knits_tons']; ?></td>
<td><?php echo $prdct_facility[0]['woven_tons']; ?></td>
<td><?php echo $prdct_facility[0]['printing_tons']; ?></td>
<td><?php echo $prdct_facility[0]['sizing_tons']; ?></td>
</tr>
<tr>
<td class="style1" colspan="5">Machine Description</td>
</tr>

<tr>
<td class="style3"><?php echo $prdct_facility[0]['yarn_machine_dscrpt']; ?></td>
<td><?php echo $prdct_facility[0]['knits_machine_dscrpt']; ?></td>
<td><?php echo $prdct_facility[0]['woven_machine_dscrpt']; ?></td>
<td><?php echo $prdct_facility[0]['printing_machine_dscrpt']; ?></td>
<td><?php echo $prdct_facility[0]['sizing_machine_dscrpt']; ?></td>
</tr>



<tr>
<td class="style1" colspan="5">Production Facilities Description</td>
</tr>

<tr>
<td class="style3" colspan="5"><?php echo $prdct_facility[0]['production_dscrpt']; ?></td>
</tr>

</tr>

<tr>
<td class="style2 tr-bg" align="center" colspan="5"><b>Chemical Using Details</b></td>

</tr>

	


<tr>
<table width="850" class="table2 bdr-clr" border="1">
<tr class="padng">
<td class="style1">S.No</td>
<td class="style1">Category *</td>
<td class="style1">Brand *</td>
<td class="style1">Segment*</td>
<td class="style1">Product Name *	</td>
<td class="style1">Dosage *</td>
<td class="style1">GPI % *</td>
<td class="style1">Rate *</td>
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
<td class="style3"><?php echo $sr_no; ?></td>
	<?php
		$ct_name = $cm_us['category_id'];
		//echo $sql="SELECT * FROM category WHERE category_id='$ct_name'";
		$select_ct_name = $pdo_conn->prepare("SELECT * FROM category WHERE category_id='$ct_name'");
        $select_ct_name->execute();
        $cat_nm = $select_ct_name->fetchAll();
		
	?>
<td class="style3"><?php echo $cat_nm[0]['category_name']; ?></td>
	<?php
		$brnd_id = $cm_us['brand_id'];
		//echo $sql="SELECT * FROM brand WHERE brand_id='$brnd_id'";
		$select_br_name = $pdo_conn->prepare("SELECT * FROM brand WHERE brand_id='$brnd_id'");
        $select_br_name->execute();
        $brnd_nm = $select_br_name->fetchAll();
		//echo $brnd_id
	?>
<td class="style3"><?php echo $brnd_nm[0]['brand_name']; ?></td>
	<?php
		//echo $seg_id.',';
		//echo $sql="SELECT * FROM segment WHERE segment_id='$seg_id' AND category_id='$ct_name'";
		$select_seg_name = $pdo_conn->prepare("SELECT * FROM segment WHERE segment_id='$seg_id'");
        $select_seg_name->execute();
        $seg_nm = $select_seg_name->fetchAll();
		
	?>
<td class="style3"><?php echo $seg_nm[0]['segment_name']; ?></td>
<td class="style3"><?php echo $cm_us['product_name']; ?></td>
<td class="style3"><?php echo $cm_us['dosage']; ?></td>
<td class="style3"><?php echo $cm_us['gpi']; ?></td>
<td class="style3"><?php echo $cm_us['rate']; ?></td>
</tr>

		<?php  $sr_no++; }  ?>
		
<tr>
<td class="style1" colspan="9">Description</td>
</tr>

<tr>
<td class="style3" colspan="9"><?php echo $customer_profile[0]['description']; ?></td>
</tr>
</table>
</tr>



</table>
</center>
<style>
.table2{
	border-collapse:collapse;
	background-color:  ;
	font-family: calibri !important;
}
.style1{
	font-family:calibri;
	font-size:16px;
	font-weight:bold;
	padding:5px;
}
.style2{
	font-family:calibri;
	font-size:16px;
	padding: 5px;
}
.style3{
	font-family:calibri;
	font-size:16px;
	padding:3px;
}
.padng{
	padding: 5px;
	background-color: #ab8ce4;
	font-family: calibri;
	color: #fff;
}
.bdr-clr{
	border: 1px solid #ccc;
}
.tr-bg{

	background-color: #666 !important;
	color: #fff;
}
</style>