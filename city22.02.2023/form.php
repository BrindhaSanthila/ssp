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

<script language="javascript" type="text/javascript" src="city/city.js"></script>
<section class="content">
	<div class="box">
	<!-- /.box-header -->
		<div class="box-body">	
			<form class="was-validated" name="purchaseentry" autocomplete="off">
				<div class="row">
					<div class="col-md-12">
						
						<div class="col-lg-6">
							<div class="form-group">
							<h5>State</h5>
								<select class="form-control select2 item_name" name="state_id" id="state_id" onchange="district_list(state_id.value)" >
									<option value="">Select Your State</option>
									<?php foreach($pdostate as $value)
									{
										if ($_GET['city_id']=='')
										{ 
										?>
											<option value="<?php echo $value['state_id']?>"><?php echo $value['state_name']?></option>
										<?php 
										} 
										else
										{
										?>
											<option value="<?php echo $value['state_id']?>" <?php if($updateresult[0]['state_id'] == $value['state_id']){ echo "selected";} ?>><?php echo $value['state_name'];?></option>
										<?php
										}
										?>
									<?php 
									} ?>
								</select>
							</div>
						</div>

						<div class="col-md-12">
							<div class="col-lg-6">
								<div class="form-group">
									<h5>District Name</h5>
									<div id="dist_name_list" name="dist_name_list">
									<select class="form-control select2 item_name" name="district_id" id="district_id" required>
										<option value="">Select Your District</option>
										<?php 
										if( $_GET['city_id']!='')
										{ 
											foreach($updateresult1 as $result)
											{
											?>
												<option value="<?php echo $result['district_id']?>" <?php if($result['district_id'] == $updateresult[0]['district_id']){ echo "selected";} ?>><?php echo $result['district_name'];?></option>
											<?php 
											} 
										}?>
									</select>
									</div>
								</div>
							</div>
						</div>
                            
                            <div class="col-md-12 ">
							<div class="col-lg-6">
								<div class="form-group">
									<h5>City Name </h5>
									<div class="controls">
										<input type="text" class="form-control" name="city_name" id="city_name" onkeyup="validation(this.id)" required>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="col-lg-6">
							<h5>Status</h5>
								<select class="form-control" name="status" id="status" onkeyup="validation(this.id)" required>
									<option value="1">Active</option>
									<option value="0">Inactive</option>
								</select>
							</div>
						</div>

						<div class="col-md-12"><br><br>
							<a href="index.php?file=city/list" class="float-left btn btn-primary">Cancel</a>
							<?php 
							if($updateresult=='')
							{?>
								<button type="button" class="float-right btn btn-success" onclick="city_cu('','Add')">Save</button>
							<?php 
							}
							else
							{?>
								<button type="button" class="float-right btn btn-success" onclick="city_cu('<?php echo $updateresult[0]['city_id']?>','Update')">Update</button>
							<?php 
							}?>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
    
<?php 
if($updateresult!='')
{?>
<script>
	document.getElementById("state_id").value ="<?php echo $updateresult[0]['state_id'];?>";
	document.getElementById("district_id").value ="<?php echo $updateresult[0]['district_id'];?>";
	document.getElementById("city_name").value ="<?php echo $updateresult[0]['city_name'];?>";
	document.getElementById("status").value ="<?php echo $updateresult[0]['status'];?>";
</script>
<?php 
}?>