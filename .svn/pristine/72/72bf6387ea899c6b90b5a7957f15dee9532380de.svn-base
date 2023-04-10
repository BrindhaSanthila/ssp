<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
error_reporting(0);
 $sales_id =$_GET['customer_id'];
 
			//echo $sql ="SELECT * FROM customer_profile WHERE delete_status='0' AND customer_id='$sales_id'";
			$select_customer_profile = $pdo_conn->prepare("SELECT * FROM customer_creation WHERE delete_status='0' AND customer_id='$sales_id'");
            $select_customer_profile->execute();
            $customer_profile = $select_customer_profile->fetchAll();




?>
<div class="col-md-12 header">
	<h3>Customer Profile</h3>
</div>
<div class="padd_div">
<table width="100%" id="table1">
	<!-- <tr>
	<td style="width:28%;font-weight: 600;font-size: 17px;">Customer Name</td>
	<td style="text-align: unset;"><span class="comp_name"><?php echo $customer_profile[0]['customer_name']; ?><span></td>
	</tr> -->
</table>
</div>
<div class="padd_div">
<div class="table-responsive">
<!-- <table width="100%" id="table2">
	<tr>
	<td class="th_div">Billing Address</td>
	<td class="th_div">Delivary Address</td>
	</tr>
	<tr class="address_td">
	<td> <?php echo $customer_profile[0]['billing_address']; ?></td>
	<td><?php echo $customer_profile[0]['delivery_address']; ?></td>
	</tr>
</table> -->
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
		//	echo "SELECT * FROM city WHERE state_id='$st_id' AND district_id='$dis_id' AND city_id='$ct_id'";
		$select_cty = $pdo_conn->prepare("SELECT * FROM city WHERE state_id='$st_id' AND district_id='$dis_id' AND city_id='$ct_id'");
        $select_cty->execute();
        $cty1 = $select_cty->fetchAll();
		foreach ($cty1 as $cty) {
		
?>

<?php } } } ?>

	<?php 
	
 $select_religion = $pdo_conn->prepare("SELECT * FROM religion WHERE religion_id='".$customer_profile[0]['religion_id']."' ");
              $select_religion->execute();
              $religion = $select_religion->fetchAll();






		
?>

</div>
<div class="padd_div">
<div class="table-responsive">
<table width="100%" id="table3">
	<tr>
	<td>Customer Name</td>
	<td style="font-weight: 100;"> <?php echo $customer_profile[0]['customer_name']; ?></td>
	</tr>

	<tr>
	<td>Religion</td>
	<td style="font-weight: 100;"> <?php echo $religion[0]['religion_name']; ?></td>
	</tr>
<tr>
	<td>Mobile Number</td>
	<td style="font-weight: 100;"><?php echo $customer_profile[0]['mobile_no']; ?></td>
	</tr>
	<tr>
	<td>Email Address</td>
	<td style="font-weight: 100;"><?php echo $customer_profile[0]['email']; ?></td>
	</tr>
	<tr>
	<td>Address</td>
	<td style="font-weight: 100;"><?php echo $customer_profile[0]['address']; ?></td>
	</tr>
	<tr>
	<td>DOB</td>
	<td style="font-weight: 100;"><?php echo $customer_profile[0]['dob']; ?></td>
	</tr>





	<tr>
	<td>Number of members</td>
	<td style="font-weight: 100;"><?php echo $customer_profile[0]['no_of_members']; ?></td>
</tr>
	<tr>
	<td>City</td>
	<td style="font-weight: 100;"><?php echo $cty['city_name']; ?></td>
   </tr>
   <tr>
   <td>District</td>
	<td style="font-weight: 100;"><?php echo $dit['district_name']; ?></td>
	</tr>
	<tr>
	<td>State</td>
	<td style="font-weight: 100;"><?php echo $ste['state_name']; ?></td>
	</tr>
	<tr>
	<td>Description:</td>
	<td style="font-weight: 100;"><?php echo $customer_profile[0]['description']; ?></td>
	
	</tr>



	
</table>
</div>
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




	

