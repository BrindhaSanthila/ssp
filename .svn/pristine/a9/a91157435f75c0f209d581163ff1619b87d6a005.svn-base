<style>
	.dt-buttons {
		display: none;
	}

	.dataTables_paginate {
		display: none;
	}

	.dataTables_info {
		display: none;
	}
</style>

<script language="javascript" type="text/javascript" src="enquiry/enquiry.js"></script>

 
<?php 

$update_user_id=$updateresult1['usercreation_id']."@@".$updateresult1['user_type_id'];
 //echo $updateresult1['usercreation_id']; 
     //echo $_GET["usercreation_id"];
    //echo $usercreation_id; 
 
if($_GET['enquiry_id']!='')

{   $status=$_GET["status"];
	$usercreation_id=$updateresult1['usercreation_id'];
	$user_type_id=$updateresult1['user_type_id'];
	  $random_no=$updateresult1['random_no'];
	  $random_sc=$updateresult1['random_sc'];

}
else
{	
 $random_no=rand(00000,99999);
 
 $random_sc = date('dmyhis');
 $date = date("Y-m-d");
}
?> 
<input type="hidden" name="usercreation_id" id="usercreation_id" value="<?php echo $usercreation_id; ?>">
<input type="hidden" name="user_type_id" id="user_type_id" value="<?php echo $user_type_id; ?>">
<input type="hidden" name="random_no" id="random_no" value="<?php echo $random_no; ?>">
<input type="hidden" name="random_sc" id="random_sc" value="<?php echo $random_sc; ?>">

<!-- Main content -->
<section class="content">

	<div class="col" style="padding: 0px;">
		<div class="box">
			<div class="box-body">
			<div id="form">
					<div class="row">
						<div class="col-md-12">
							<div class="col-lg-6">
								<div class="form-group">
									<div class="controls">
										<input type="hidden" id="enquiry_id"
											value="<?php echo $updateresult1['enquiry_id'];?>" class="form-control">
									</div>
								</div>
							</div>

						</div>

						<div class="col-md-4">
							 
								<div class="form-group">
									<h5>Date </h5>
									<div class="controls">
										<input type="date" name="date" id="date" class="form-control" onchange=""
											value="<?php if($updateresult1['date']!='') { echo $updateresult1['date']; } else { echo $date; } ?>">
									</div>
								</div>
							 
						</div>


						<div class="col-md-4">
						 
								<div class="form-group">
									<h5>Customer Name </h5>
									<div class="controls">
										<?php //echo $updateresult1[0]['customer_id'];?>
										<select name="customer_id" id="customer_id" 
											class="form-control select2 item_name" >
											<option value="">Select Customer</option>

											<?php 
									$select_customer=$pdo_conn->prepare("SELECT * FROM customer_creation");
									$select_customer->execute();
									$selectcustomer = $select_customer->fetchAll();
									foreach($selectcustomer as $value2){ ?>
											<?php
?>
									<option value="<?php echo $value2['customer_id'];?>"
									<?php if($value2['customer_id']==$updateresult1['customer_id']){ echo "selected"; } ?>>
									<?php echo $value2['customer_name'] ?></option>
									<?php   } ?>
										</select>
									</div>
								</div>
							 
						</div>

						<div class="col-md-4">
						 
								<div class="form-group">

						<h5 >Executive Name</h5>
				<div class="controls">
				
					<select class="form-control select2 item_name" name="staffcreation_id" id="staffcreation_id" >
						<option value="">Select Executive Name</option>
					<?php	
					$staffcreation = $pdo_conn->prepare("SELECT staff_name,staffcreation_id,staff_type FROM staffcreation  WHERE delete_status='0' ");
					$staffcreation->execute();
					$staff_list = $staffcreation->fetchAll();
						  	foreach($staff_list as $value)	{ 
					$id=$value['staffcreation_id']."@@".$value['staff_type'];
					 
					 ?>
						<option value="<?php echo $id; ?>"<?php if($update_user_id==$id) { echo "selected"; } ?>><?php echo $value['staff_name']?></option>
					<?php 	} ?>
					</select>	
</div>
</div>
</div>

					<div class="col-md-12">
						<h3>Sub Form</h3><br>
					</div>

					<div class="col-md-12">
						<div id="sublist_div">
							<?php include ("subform.php"); ?>
						</div>
					</div>
						<div class="col-md-6">						 
							<div class="form-group"> 
								
								<h5  >Description</h5>
								<div class="controls">
		  							<textarea class="form-control" id="description" name="description"><?php echo $updateresult1['description']; ?></textarea>
								</div>
							</div>							 
						</div>
  <div class="col-md-6">
						  <h5  >Followup Status</h5>
							<div class="controls"> 
						 
							 <select	class="form-control select2 item_name" name="enquiry_followups_sid" id="enquiry_followups_sid" >
				 
						<option value="Pending" <?php if($updateresult1['status']=='Pending') { echo  "Selected"; } ?>>Pending</option>
				        <option value="Quoted" <?php if($updateresult1['status']=='Quoted') { echo  "Selected"; } ?>>Quoted</option>
				        <option value="Confirmed" <?php if($updateresult1['status']=='Confirmed') { echo  "Selected"; } ?>>Confirmed</option>
				        <option value="Enquiry Cancelled" <?php if($updateresult1['status']=='Enquiry Cancelled') { echo  "Selected"; } ?>>Enquiry Cancelled</option>
				        <option value="Quotation Cancelled" <?php if($updateresult1['status']=='Quotation Cancelled') { echo  "Selected"; } ?>>Quotation Cancelled</option>
				        <option value="Delivered" <?php if($updateresult1['status']=='Delivered') { echo  "Selected"; } ?>>Quotation Delivered</option>
				        <option value="100% finished" <?php if($updateresult1['status']=='100% finished') { echo  "Selected"; } ?>>100% finished</option>
				        <option value="Approved" <?php if($updateresult1['status']=='Approved') { echo  "Selected"; } ?>>Approved </option>
				        </select>
						</div> 
					</div>

								 
						 

						 <div class="col-md-6">
						<h5    >Days</h5>
						<div class="form-group">
							 
							<input type="number" class="form-control" id="days" name="days" onkeyup="get_follow_up_date(this.value,this.id)"  value="<?php echo $update_followup['days']; ?>" >
						</div>
						 						 
					</div>
					<div class="col-md-6">
						<h5    >Next Follow Up Date</h5> 
							<div class="form-group">
								 
							<input type="text" id="next_date" name="next_date" class="form-control" value="<?php echo $update_followup['next_date']; ?>" readonly>
							</div>
						 						 
					</div>
					<div class="col-md-6">
						<h5    >Remarks</h5> 
							<div class="form-group">
								 
						<input type="text" class="form-control" id="remarks" name="remarks" value="<?php echo $update_followup['remarks']; ?>"   > 
							</div>
						 						 
					</div>


					<!-- row ends -->

					<div class="col-md-12"><br><br>
						<a href="index.php?file=enquiry/list" class="float-left btn btn-primary">Cancel</a>
						<?php if($_GET['enquiry_id']==''){?>
						<button type="button" id="main_add" class="float-right btn btn-success"
							onclick="enquiry_cu('<?php echo $_GET['enquiry_id']?>','<?php echo $usercreation_id; ?>','<?php echo $user_type_id; ?>', '<?php echo $random_no; ?>', '<?php echo $random_sc ?>', 'Add')">Save</button>
						<?php }else{?>
						<button type="button" id="main_add" class="float-right btn btn-success"
							onclick="enquiry_cu('<?php echo $_GET['enquiry_id']?>','<?php echo  $usercreation_id ?>','<?php echo $user_type_id; ?>','<?php echo $random_no; ?>','<?php echo $random_sc ?>' ,'Update')">Update</button>

						<?php }?>
					</div>
			</div>
			</div>
		</div>
	</div>

	</div>

</section>
 