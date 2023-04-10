
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

<script language="javascript" type="text/javascript" src="expensetype/expensetype.js"></script>

		<section class="content">
		
			<div class="col">
                <div class="box">
					<div class="box-body">
        
						<form class="was-validated" name="expense" autocomplete="off">
							<div class="row">
 
        
								<div class="col-md-12 ">
									<div class="col-lg-6">
									  <div class="form-group">
										   <h5>Expense Name </h5>
										   <div class="controls">
												<input type="text"  name="expense_name" id="expense_name"  class="form-control"  required>
											</div>
									  </div>
									 </div>
								
								</div>
								
								<div class="col-md-12 ">
									<div class="col-lg-6">
									  <div class="form-group">
										   <h5>Amount </h5>
										   <div class="controls">
												<input type="text"  name="amount" id="amount"  class="form-control"  required>
											</div>
									  </div>
									 </div>
								
								</div>
         
								<div class="col-md-12">
									<div class="col-lg-6">
										<h5>Status</h5>
										<select name="status" id="status"  class="form-control"  required>
										<!--<option value="">Select Your Status</option>-->
										<option value="1">Active</option>
										<option value="0">Inactive</option>
										</select>
									</div>
								</div>

         
								<div class="col-md-12"><br><br>
									<a href="index.php?file=expensetype/list" class="float-left btn btn-primary">Cancel</a>
									<?php if($updateresult==''){?>
									<button type="button" class="float-right btn btn-success" onclick="add_expense('','Add')">Save</button>
									<?php }else{?>
									<button type="button" class="float-right btn btn-success" onclick="add_expense('<?php echo $updateresult[0]['expense_id']?>','Update')">Update</button>
									<?php }?>
								</div>
         

							</div>
						</form>
                
					</div>
                
				</div>

			</div>
			 
		
		</section>
    
<?php if($updateresult!=''){?>
<script>
document.getElementById("expense_name").value ="<?php echo $updateresult[0]['expense_name'];?>";
document.getElementById("amount").value ="<?php echo $updateresult[0]['amount'];?>";
document.getElementById("status").value ="<?php echo $updateresult[0]['status'];?>";
</script>
<?php }?>