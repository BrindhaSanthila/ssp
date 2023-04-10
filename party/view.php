
 <style>
h5.view_mode{
	font-weight:bold;
}
</style>
<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
error_reporting(0);


/************************************* VIEW ********************************************/

	$main_list = $pdo_conn->prepare("SELECT * FROM party_creation WHERE party_id ='".$_GET['party_id']."'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	
		// $state_name		= $mainlist[0]['state_id'];
		// $district_name	= $mainlist[0]['district_id'];
		// $city			= $mainlist[0]['city_id'];
//echo "imagename".$mainlist[0]['image'];

// $state_list = $pdo_conn->prepare("SELECT * FROM state WHERE state_id = $state_name AND status = '1' ");
// $state_list->execute();
// $statelist = $state_list->fetchAll();

// $state_list = $pdo_conn->prepare("SELECT * FROM district WHERE state_id = $state_name AND district_id = $district_name ");
// $state_list->execute();
// $dislist = $state_list->fetchAll();

// $dist_list = $pdo_conn->prepare("SELECT * FROM city WHERE district_id = $district_name AND state_id = $state_name AND city_id = $city ");
// $dist_list->execute();
// $citylist = $dist_list->fetchAll();
	
	if($mainlist){
?>
<!-- Content -->


<div class="col-md-12 header">
    <h3>Party Details</h3>
</div>
<div class="padd_div">
<table width="100%" id="table1">
    
</table>
</div>
<div class="padd_div">
<div class="table-responsive">

</div>


</div>
<div class="padd_div">
<div class="table-responsive">
<table width="100%" id="table3">
    
    <tr>
    <td>Party Name</td>
    <td style="font-weight: 100;"> <?php echo $mainlist[0]['party_name']; ?></td>
    </tr>
    <tr>
    <td>Mobile No</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['mobile_no'];; ?></td>
    </tr>
    <tr>
    <td>Address</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['address']; ?></td>
    </tr><tr>
    <td>Area Name</td>
    <td style="font-weight: 100;"><?php  $party_area=explode(',',$mainlist[0]['area_name']);
    foreach ($party_area as $value) {echo get_area_name($value[area_name])." ";
     	# code...
     } ?></td>
    </tr>
    <tr>
    <td>City Name</td>
    <td style="font-weight: 100;"><?php  $party_city=explode(',',$mainlist[0]['city_name']);
    foreach ($party_city as $value) {echo get_city_name($value[city_name])." ";
     	# code...
     } ?></td>
    </tr>
    <tr>
    <td>Party Type</td>
    <td style="font-weight: 100;"><?php echo get_partytype($mainlist[0]['partytype']); ?></td>
    </tr>
    <tr>
    <td>Company Name</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['comp_name']; ?></td>
    </tr>
    <tr>
    <td>Contact Person Name</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['person_name']; ?></td>
    </tr>
    <tr>
    <td>Contact Person Mobile No</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['contact_mob_no']; ?></td>
    </tr>
    <td>GST No</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['gst_no']; ?></td>
    </tr>
    <tr>
    <td>Payment Type</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['paymenttype']; ?></td>
    </tr>
    <tr>
    <td>Credit Days</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['credit_days']; ?></td>
    </tr>
    <tr>
    <td>Auto SMS</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['auto_sms']; ?></td>
    </tr>
    <tr>
    <td>Active Status</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['active_status']; ?></td>
    </tr>
    
    
</table>
</div>
</div>
<?php 
}
?>
<script>
    function pdf_view(url)
  {
  onmouseover55= window.open(url,'onmouseover55','height=450px,width=650px,scrollbars=yes,resizable=no,left=420,top=190,toolbar=no,location=no,directories=no,status=no,menubar=no');
  }
</script>
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



