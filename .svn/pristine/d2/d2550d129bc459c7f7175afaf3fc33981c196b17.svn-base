<style>
h5.view_mode{
	font-weight:bold;
}
</style>
<script language="javascript" type="text/javascript" src="regularvisits/regularvisits.js"></script>
<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');

 $regularvisit_id =$_POST['regularvisit_id'];
			$regularvisits = $pdo_conn->prepare("SELECT * FROM regular_visits  WHERE delete_status='0' AND regular_visit_id='".$_POST['regularvisit_id']."'");
            $regularvisits->execute();
            $regular_visits = $regularvisits->fetchAll();
?>
<table class="table2 bdr-clr" border="1" width="100%">
<?php foreach($regular_visits as $value){ ?>
<tr>
<td class="style1 " width="30%">Customer Name</td>

<?php

 $select_cmpny_nm=$pdo_conn->prepare("SELECT * FROM customer_profile WHERE delete_status = '0' and customer_id='".$value['company_id']."'");
$select_cmpny_nm->execute();
$cmpny_nm =$select_cmpny_nm->fetchAll(); ?>
<td class="style3" width="70%"><?php echo $cmpny_nm[0]['company_name']; ?></td>
</tr>

<tr>
<td class="style1 " width="30%" >Contact Person</td>
<?php $val = $value['contact_type'];
		$hh=explode(",",$val);
		
		
	?>
<td class="style3 " width="70%"><?php 
$len = count($hh);
foreach($hh as $vau){ 
		
		//echo "SELECT * FROM contact_type WHERE contact_type_id='".$vau."' ";
		$sl_cont_ty = $pdo_conn->prepare("SELECT * FROM contact WHERE contact_id='".$vau."' ");
		$sl_cont_ty->execute();
		$cstmr2 = $sl_cont_ty->fetchAll();  echo $cstmr2[0]['contact_name'];if(($len-1) != 0) echo " and "; 
		$len--;}?></td>

</tr>

<tr>
<td class="style1" width="30%" >Visit Date</td>
<td class="style3"><?php echo date("d-m-Y",strtotime($value['date']))?></td>
</tr>

<tr>
<td class="style1 " width="30%">Discussion Details</td>
<td class="style3 " ><?php echo $value['dis_details']?></td>
</tr>

<tr>
<td class="style1" width="30%">Project</td>

<?php
if($value['project_name'] !=''){
$pr_cstmr = $pdo_conn->prepare("SELECT * FROM project_creation WHERE project_creation_id='".$value['project_name']."' ");
$pr_cstmr->execute();
$pr1 = $pr_cstmr->fetchAll(); ?>
<td class="style3" width="70%" ><?php echo $pr1[0]['project_name']; ?></td>
<?php } else { ?>
<td class="style3" width="70%" ><?php echo '-'; ?></td>
<?php } ?>
</tr>

<tr>
<td class="style1" width="30%">Project Position</td>
<?php
if($value['project_position_id'] !=0){
$project_pos=$pdo_conn->prepare("SELECT * FROM project_position WHERE project_position_id ='".$value['project_position_id']."'");
$project_pos->execute();
$followups =$project_pos->fetchAll();

?>
<td class="style3"width="70%" ><?php echo $followups[0]['project_position']; ?></td>
<?php } else { ?>
<td class="style3" width="70%" ><?php echo '-'; ?></td>
<?php } ?>

</tr>



<tr>
<td class="style1 " width="30%" >Next Followups Date</td>
<?php
if($value['next_date'] !=0){ ?>

<td class="style3 " width="70%"><?php echo date("d-m-Y",strtotime($value['next_date']))?></td>
<?php } else { ?>
<td class="style3" width="70%" ><?php echo '-'; ?></td>
<?php } ?>

</tr>
<tr>
<td class="style1" width="30%">Followups Discription</td>
<?php if($value['follow_description'] !=0){ ?>

<td class="style3 " width="70%"><?php echo $value['follow_description'] ?></td>
<?php } else { ?>
<td class="style3" width="70%" ><?php echo '-'; ?></td>
<?php } ?>

</tr>
<tr>
<td class="style1" width="30%">File</td>
<?php
if(!empty($value['regularvisit_file']))
{
$temp = explode(".",$value['regularvisit_file'] );
$filetype = $temp[1];
}
else
{
	$filetype ='';
}
?>
<td class="style3 " width="70%"><?php if((strcasecmp($filetype,"jpg")==0) || (strcasecmp($filetype,"png") ==0)) {?><img src="upload/regularvisits_file/<?php echo $value['regularvisit_file']?>" width="100" height="100"><?php } elseif(strcasecmp($filetype,"pdf")==0) {?><a href="upload/regularvisits_file/<?php echo $value['regularvisit_file']?>"  target="_blank" ><img src="upload/regularvisits_file/pdf.jpg" width="100" height="100"></a><?php } elseif(strcasecmp($filetype,"csv")==0) {?><a href="upload/regularvisits_file/<?php echo $value['regularvisit_file']?>"  target="_blank" ><img src="upload/regularvisits_file/xl.png" width="100" height="100"></a><?php } else { echo "No File"; }?></td>
</tr>
<?php } ?>
</table>
<style>
.table2{
	border-collapse:collapse;
	background-color:  ;
	font-family: century gothic !important;
}
.style1{
	font-family:century gothic;
	font-size:16px;
	font-weight:bold;
	padding:5px;
}
.style2{
	font-family:century gothic;
	font-size:16px;
	padding: 5px;
}
.style3{
	font-family:century gothic;
	font-size:16px;
	padding:3px;
}
.padng{
	padding: 5px;
	font-family: century gothic;
}
.bdr-clr{
	border: 1px solid #ccc;
}
.tr-bg{
}
</style>