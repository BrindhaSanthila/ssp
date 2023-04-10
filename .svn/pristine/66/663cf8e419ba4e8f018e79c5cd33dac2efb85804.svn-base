
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

<script language="javascript" type="text/javascript" src="special_days/special_days.js"></script>
<?php

$date =date("Y-m-d");


        					  ?>
		<section class="content">
			<div class="col">
            <div class="box">
				<div class="box-body">
				<form class="was-validated" name="special_days" autocomplete="off">
					<div class="row">
						<div class="col-sm-4">
									
									  <div class="form-group">
										   <h5>Date </h5>
										   <div class="controls">
												<input type="date" name="date" id="date"  class="form-control" onchange="" value="<?php if($updateresult[0]['date']!='') { echo $updateresult[0]['date']; } else { echo $date; } ?>" >
										   </div>
									  </div>
								
								
								</div>
								<div class="col-sm-4">
					 		<div class="form-group">
								<h5>Religion Name </h5>
								<div class="controls">
								
								
									<select name="religion_id" id="religion_id"  class="form-control select2 item_name"  onChange="assign_religion(religion_id.value)" required>
										
										<option value="">Select religion</option>
				<?php 
					$select_religion=$pdo_conn->prepare("SELECT * FROM religion ");
					$select_religion->execute();
					$selectreligion = $select_religion->fetchAll();
			
					foreach($selectreligion as $value2){ ?>
					<?php
					

?>						<option value="<?php echo $value2['religion_id'];?>"  <?php if($value2['religion_id']==$updateresult[0]['religion_name']){ echo "selected"; } ?> ><?php echo $value2['religion_name'] ?></option>
			<?php   } ?>
									</select>
												
											</div>
									  </div>

									
								
								</div>
						<div class="col-sm-4">
					 		<div class="form-group">
								 <h5>Special Days Name </h5>
									   <div class="controls">
											<input type="text" class="form-control" name="special_day_name" id="special_day_name"   required>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									
									  <div class="form-group">
										   <h5>SMS content</h5>
										   <div class="controls">
												<textarea  name="sms_content" id="sms_content"  class="form-control"  ></textarea>
											</div>
									  </div>
								</div>	 	
								<div class="col-sm-4">
									
									  <div class="form-group">
										   <h5>Email content</h5>
										   <div class="controls">
												<textarea  name="email_content" id="email_content"  class="form-control"   ></textarea>
											</div>
									  </div>
								</div>	 
								
								<div class="col-sm-4">
									
									  <div class="form-group">
										   <h5>Description</h5>
										   <div class="controls">
												<textarea  name="description" id="description"  class="form-control"  ></textarea>
											</div>
									  </div>
								</div>	 
								<div class="col-sm-4">
									<h5>Email Status</h5>
									<select class="form-control" name="email_status" id="email_status"   required>
									<option value="1">Active</option>
									<option value="0">Inactive</option>
									</select>
								</div>
								<div class="col-sm-4">
									<h5>SMS Status</h5>
									<select class="form-control" name="sms_status" id="sms_status"   required>
									<option value="1">Active</option>
									<option value="0">Inactive</option>
									</select>
								</div>
								
								

         
								<div class="col-md-12"><br><br>
									<a href="index.php?file=special_days/list" class="float-left btn btn-primary">Cancel</a>
									<?php if($updateresult==''){?>
									<button type="button" class="float-right btn btn-success" id="add" onclick="special_days_cu('','Add')">Save</button>
									<?php }else{?>
									<button type="button" class="float-right btn btn-success" id="add" onclick="special_days_cu('<?php echo $updateresult[0]['special_id']?>','Update')">Update</button>
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


document.getElementById("email_content").value ="<?php echo $updateresult[0]['email_content'];?>";
document.getElementById("special_day_name").value ="<?php echo $updateresult[0]['special_day_name'];?>";
document.getElementById("religion_id").value ="<?php echo $updateresult[0]['religion_id'];?>";
document.getElementById("sms_content").value ="<?php echo $updateresult[0]['sms_content'];?>";
document.getElementById("description").value ="<?php echo $updateresult[0]['description'];?>";
document.getElementById("email_status").value ="<?php echo $updateresult[0]['email_status'];?>";
document.getElementById("sms_status").value ="<?php echo $updateresult[0]['sms_status'];?>";
</script>
<?php }?>
<style>
span.select2.select2-container.select2-container--default.select2-container--focus {
    width: 100% !important;
}
span.select2.select2-container.select2-container--default {
    width: 100% !important;
}
</style>