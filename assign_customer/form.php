
<style>
.dt-buttons{
	display:none;
}
.dataTables_paginate{
	display:none;
}
.dataTables_info{
	display:none;
}
</style>

<?php


	$select_customer_name=$pdo_conn->prepare("SELECT * FROM customer_creation WHERE delete_status='0'");
    $select_customer_name->execute();
    $customer_name = $select_customer_name->fetchAll();
		/*$select_userroll=$pdo_conn->prepare("SELECT userroll_id FROM userroll WHERE roll_name LIKE '%executive%' and active_status='Active'");
		$select_userroll->execute();
		$selectuserroll = $select_userroll->fetchAll();
		for($i=0;$i<count($selectuserroll);$i++)
		{
		  $userroll_id.=$selectuserroll[$i]['userroll_id']."','";
	    } 
	     $roll_id=substr($userroll_id,0,-3);
		$select_executive=$pdo_conn->prepare("SELECT * FROM staffcreation WHERE staff_type IN ('$roll_id') and delete_status!='1'");
		$select_executive->execute();
		$selectexecutive = $select_executive->fetchAll();*/
	
	$select_staff_name=$pdo_conn->prepare("SELECT * FROM staffcreation WHERE delete_status='0' AND staff_type='2' ");
    $select_staff_name->execute();
    $staf_name = $select_staff_name->fetchAll();



?>





<script language="javascript" type="text/javascript" src="assign_customer/assigncustomer.js"></script>

    <section class="content">
		
		<div class="col">
            <div class="box">
       
       
			<!-- /.box-header -->
			<div class="box-body">
        
       
        
				<form class="was-validated" name="purchaseentry" autocomplete="off">
					<div class="row">
        
         

						<div class="col-md-12">
							<div class="col-lg-6">
								<div class="form-group">
								<h5>Customer Name</h5>
									<select class="form-control select2 item_name" name="customer_id" id="customer_id"  required >
										<option value="">Select Customer</option>
										<?php foreach($customer_name as $value){?>
										<option value="<?php echo $value['customer_id']?>"><?php echo $value['customer_name']?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
		 
						<div class="col-md-12">
							<div class="col-lg-6">
								<div class="form-group">
								<h5>Staff Name</h5>
									<div id="dist_name_list" name="dist_name_list">
									<select class="form-control select2 item_name" name="staffcreation_id" id="staffcreation_id"  required>
										<option value="">Select Your Staff</option>
										<?php foreach($staf_name as $value1){?>
										<option value="<?php echo $value1['staffcreation_id']?>"><?php echo $value1['staff_name']?></option>
										<?php } ?>
									</select>
									</div>
								</div>
							</div>
						</div>
        
						
         
						<div class="col-md-12">
							<div class="col-lg-6">
                            <div class="form-group">
								<h5>Status</h5>
								<select class="form-control item_name" name="status" id="status" onkeyup="validation(this.id)" required>
								<option value="1">Active</option>
								<option value="0">Inactive</option>
								</select>
							</div>
						</div>
		 			</div>
		 
						<div class="col-md-12"><br><br>
							<a href="index.php?file=assign_customer/list" class="float-left btn btn-primary">Cancel</a>
							<?php if($updateresult==''){?>
							<button type="button" class="float-right btn btn-success" id="add" onclick="assgn_cus('','Add')">Save</button>
							<?php }else{?>
							<button type="button" class="float-right btn btn-success" id="add" onclick="assgn_cus('<?php echo $updateresult[0]['assign_customer_id']?>','Update')">Update</button>
							<?php }?>
						</div>


					</div>
				</form>
         
          
			</div>
        <!-- /.box-body -->
        
			</div>


		</div>
			 
		
	</section>
    
<?php if($updateresult!=''){?>


<script>





document.getElementById("customer_id").value ="<?php echo $updateresult[0]['customer_id'];?>";
document.getElementById("staffcreation_id").value ="<?php echo $updateresult[0]['staffcreation_id'];?>";

document.getElementById("status").value ="<?php echo $updateresult[0]['status'];?>";




</script>
<?php }?>