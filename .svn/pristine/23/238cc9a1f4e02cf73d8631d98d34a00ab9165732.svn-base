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

	$main_list = $pdo_conn->prepare("SELECT * FROM staffcreation WHERE staffcreation_id ='".$_GET['staffcreation_id']."' AND  delete_status != '1'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	
		$state_name		= $mainlist[0]['state_id'];
		$district_name	= $mainlist[0]['district_id'];
		$city			= $mainlist[0]['city_id'];
//echo "imagename".$mainlist[0]['image'];

$state_list = $pdo_conn->prepare("SELECT * FROM state WHERE state_id = $state_name AND status = '1' ");
$state_list->execute();
$statelist = $state_list->fetchAll();

$state_list = $pdo_conn->prepare("SELECT * FROM district WHERE state_id = $state_name AND district_id = $district_name ");
$state_list->execute();
$dislist = $state_list->fetchAll();

$dist_list = $pdo_conn->prepare("SELECT * FROM city WHERE district_id = $district_name AND state_id = $state_name AND city_id = $city ");
$dist_list->execute();
$citylist = $dist_list->fetchAll();
	
	if($mainlist){
?>
<!-- Content -->


<div class="col-md-12 header">
    <h3>Staff Details</h3>
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
    <td>Staff Type</td>
    <td style="font-weight: 100;"> <?php 
                 if($mainlist[0]['staff_type']=="")
                 echo "-";
                 else
                 echo get_staff_type(ucwords($mainlist[0]['staff_type'])) ?></td>
    </tr>

    <tr>
    <td>Staff Name</td>
    <td style="font-weight: 100;"> <?php echo $mainlist[0]['staff_name']; ?></td>
    </tr>
<tr>
    <td>Gender</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['gender'];; ?></td>
    </tr>
    <tr>
    <td>Commnication Address</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['comm_address']; ?></td>
    </tr>
    <tr>
    <td>Permanent Address</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['perm_address']; ?></td>
    </tr>
    <tr>
    <td>Staff id</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['staff_id']; ?></td>
    </tr>





    <tr>
    <td>Mobile Number</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['mobile_no']; ?></td>
</tr>
    <tr>
    <td>License Number</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['license_no'];; ?></td>
   </tr>
   <tr>
   <td>DOB</td>
    <td style="font-weight: 100;"><?php $dob = date_create($mainlist[0]['dob']); $dob = date_format($dob, 'd-m-Y');?>
                <label name="staff_dob" id="staff_dob"><?php  if($mainlist[0]['dob']=="0000-00-00")
                echo "-";
                else
                echo $dob;  ?></td>
    </tr>
    <tr>
    <td>DOJ</td>
    <td style="font-weight: 100;"><?php $doj = date_create($mainlist[0]['doj']); $doj = date_format($doj, 'd-m-Y');?>
                <label name="staff_doj" id="staff_doj"><?php if($mainlist[0]['doj']=="0000-00-00")
                echo "-";
                else
                echo $doj;  ?></td>
    </tr>
    <tr>
    <td>Blood Group</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['blood_group']; ?></td>
    
    </tr>
<tr>
    <td>Old Company ESI</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['old_company_esi']; ?></td>
    
    </tr><tr>
    <td>Old Company PF No</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['old_company_pfno'];  ?></td>
    
    </tr><tr>
    <td>Nature Of Work</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['nature_of_work']; ?></td>
    
    </tr><tr>
    <td>Bank Accounts Details</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['bank_acc_details']; ?></td>
    
    </tr><tr>
    <td>Id Proof Number</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['id_proofno']; ?></td>
    
    </tr>
<tr>
    <td>Email Id</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['email_id']; ?></td>
    
    </tr><tr>
    <td>Upload Image</td>
    <td style="font-weight: 100;"><?php if(($mainlist[0]['image']!='') ||($mainlist[0]['image']!=NULL)){ ?>   <a href="javascript:pdf_view('<?php echo $image_path_back."staff/".$mainlist[0]['image']; ?>');" title="View Material" ><img  src="<?php echo $image_path_back."staff/".$mainlist[0]['image']; ?>" style="height:60px; width:60px;"  ></a><?php } else { echo "No Image"; } ?></td>
    
    </tr><tr>
    <td>Staff Image</td>
    <td style="font-weight: 100;"><?php  if(($mainlist[0]['image1']!='') ||($mainlist[0]['image1']!=NULL)) {?><a href="javascript:pdf_view('<?php echo $image_path_back."staff/".$mainlist[0]['image1']; ?>');" title="View Material" ><img  src="<?php echo $image_path_back."staff/".$mainlist[0]['image1']; ?>" style="height:60px; width:60px;"  ></a><?php } else {  echo "No Image"; } ?></td>
    
    </tr><tr>
    <td>Adhar Number</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['adhar_no']; ?></td>
    
    </tr><tr>
    <td>State</td>
    <td style="font-weight: 100;"><?php foreach($statelist as $value) { ?>
                <label name="staff_email" id="staff_email"><?php echo $value['state_name']; }?></label></td>
    
    </tr><tr>
    <td>District</td>
    <td style="font-weight: 100;"><?php foreach($dislist as $value1) { ?>
                <label name="staff_email" id="staff_email"><?php echo $value1['district_name'];} ?></label></td>
    
    </tr><tr>
    <td>User Name</td>
    <td style="font-weight: 100;"><?php echo $mainlist[0]['user_name']; ?></td>
    
    </tr><tr>
    <td>Password</td>
    <td style="font-weight: 100;"><?php echo  $mainlist[0]['password'];?></td>
    
    </tr><tr>
    <td>Staff Designation</td>
    <td style="font-weight: 100;"><?php echo  $mainlist[0]['staff_designation']; ?></td>
    
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



