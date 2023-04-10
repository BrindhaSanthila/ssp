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
		
		if(empty($updateresult)){
			$customer_id=1;
		}else{ 
			$customer_id = $updateresult[0]['customer_id']+1;
		}
		$state_id = $updateresult[0]['state_id'];
		$ste_id = $updateresult[0]['state_name'];
		$dis_id = $updateresult[0]['district_id'];
		$updateresult[0]['city_id'];
			
		
	/**************************************district list*************************************************************/
	
	$state_list = $pdo_conn->prepare("SELECT * FROM district WHERE state_id = $ste_id ORDER BY district_id ASC");
	$state_list->execute();
	$dislist = $state_list->fetchAll();
	
	$dist = '';
	$dist .='<select class="form-control numeric" name="district_id" id="district_id" required>
			<option value="">Select Your District</option>'; 
	foreach($dislist as $value){
		$dist .= '<option value="'.$value['district_id'].'">'.$value['district_name'].'</option>'; 
	}
	$dist .='</select>';
	
	/********************************************city list ********************************************************************/
	
	
	$dist_list = $pdo_conn->prepare("SELECT * FROM city WHERE state_id = $ste_id AND district_id=$dis_id  ORDER BY district_id ASC");
	$dist_list->execute();
	$citylist = $dist_list->fetchAll();
	
	$cty = '';
	$cty .='<select class="form-control numeric" name="city_id" id="city_id" required>
			<option value="">Select city</option>'; 
	foreach($citylist as $value){
		$cty .= '<option value="'.$value['city_id'].'">'.$value['city_name'].'</option>'; 
	}
	$cty .='</select>';
	
	/***************************************************************************************************************************/
	
?>
<script language="javascript" type="text/javascript" src="customer/customer.js"></script>
    <!-- Main content -->
    <section class="" id="my-form">
		
		<div class="col">
            <div class="box">
       
				<!-- /.box-header -->
				<div class="box-body">
        
				<form class="was-validated" name="customer"  autocomplete="off">
                    <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $_GET['customer_id']; ?>" />
						<div class="row">
        
							<div class="col-lg-3 col-md-6 ">
								<div class="form-group">
									   <h5>Customer Name</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="customer_name" id="customer_name"  value="<?php echo $updateresult[0]['customer_name'];?>" >
										</div>
								 </div>
							</div>
							
							<div class="col-lg-3 col-md-6 ">
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
						<option value="<?php echo $value2['religion_id'];?>"  <?php if($value2['religion_id']==$updateresult[0]['religion_name']){ echo "selected"; } ?> ><?php echo $value2['religion_name'] ?>
						</option>
			<?php   } ?>
									</select>
									  </div>
									  </div>
									</div>

							<div class="col-lg-3 col-md-6 ">
								<div class="form-group">
									   <h5>Mobile Number</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="mobile_no" id="mobile_no" value="<?php echo $updateresult[0]['mobile_no'];?>" >
										</div>
								  </div>
							</div> 

							<div class="col-lg-3 col-md-6 ">
								<div class="form-group">
									   <h5>Email</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="email" id="email" value="<?php echo $updateresult[0]['email'];?>" >
										</div>
								  </div>
							</div>
							
							<div class="col-lg-3 col-md-6 ">
								<div class="form-group">
									   <h5> Address</h5>
									   <div class="controls">
											<textarea class="form-control" name="address" id="address" ><?php echo $updateresult[0]['address'];?></textarea>
										</div>
								  </div>
								</div>
								
								<div class="col-lg-3 col-md-6 ">
								  <div class="form-group">
										   <h5>DOB </h5>
										   <div class="controls">
												<input type="date" name="date" id="date"  class="form-control" onchange="" value="<?php if($updateresult[0]['date']!='') { echo $updateresult[0]['date']; } else { echo $date; } ?>" >
										   </div>
									  </div>
							</div>
										 
							<div class="col-lg-3 col-md-6 ">
								 <div class="form-group">
									   <h5>Number of Members</h5>
									   <div class="controls">
											<textarea class="form-control" name="no_of_members" id="no_of_members" ><?php echo $updateresult[0]['no_of_members'];?></textarea>
										</div>
								  </div>
							</div>
							
							<div class="col-lg-3 col-md-6 ">
								<div class="form-group">
									   <h5>State</h5>
									   <div class="controls">
											<select class="form-control select2 item_name" name="state_id" id="state_id" onchange="district_list(state_id.value)" >
												<option value="">Select Your State</option>
												<?php foreach($pdostate as $value){
                                                if ($_GET['customer_id']==''){ ?>
													<option value="<?php echo $value['state_id']?>"><?php echo $value['state_name']?></option>
                                                    <?php } else{
														 ?>
                                                    	<option value="<?php echo $value['state_id']?>" <?php if($updateresult[0]['state_id'] == $value['state_id']){ echo "selected";} ?>><?php echo $value['state_name'];?></option>
														<?php
													}?>
												<?php } ?>
											</select>
											
										</div>
								  </div>
							</div>
                            
                            <div class="col-lg-3 col-md-6 ">
								<div class="form-group">
									   <h5>District</h5>
									   <div class="controls">
											<select class="form-control select2 item_name" name="district_id" id="district_id" onchange="city_list()" >
									<?php if ($_GET['customer_id']==''){  ?>
												<option value="">Select Your District</option>
                                                <?php } else {
                                                $district_by_state = $pdo_conn->prepare("SELECT * FROM district WHERE state_id = $state_id ORDER BY district_id ASC");
	                                           $district_by_state->execute();
	                                           $districtbystate = $district_by_state->fetchAll();
	                                    foreach($districtbystate as $value){?>
                         <option value="<?php echo $value['district_id']?>" <?php if($updateresult[0]['district_id'] == $value['district_id']){ echo "selected";} ?>><?php echo $value['district_name'];?></option>

												<?php } } ?>
											</select>
											
										</div>
								  </div>
							</div>
							
							
							<div class="col-lg-3 col-md-6 ">
								<div class="form-group">
								 <h5>City</h5>
								  <div class="controls">
										<select class="form-control select2 item_name" name="city_id" id="city_id">
                                            	<?php if ($_GET['customer_id']==''){  ?>
												<option value="">Select Your City</option>
											<?php } else {
												$city_by_district = $pdo_conn->prepare("SELECT * FROM city WHERE state_id = $state_id AND district_id = $dis_id ORDER BY district_id ASC");
												$city_by_district->execute();
												$citybydistrict = $city_by_district->fetchAll();
												foreach($citybydistrict as $value){?>
                                     <option value="<?php echo $value['city_id']?>" <?php if($updateresult[0]['city_id'] == $value['city_id']){ echo "selected";} ?>><?php echo $value['city_name'];?></option>

											<?php } }?>
											</select>											
										</div>
								  </div>
							</div>
		
							<div class="col-lg-3 col-md-6 ">
									<div class="form-group">
										   <h5>Description</h5>
										   <div class="controls">
												<textarea  name="description" id="description"  class="form-control" onkeyup="validation(this.id)" ></textarea>
											</div>
									  </div>
								</div>	 
		
							
							<div class="col-lg-3 col-md-6 ">
									<h5>Status</h5>
										<select name="status" id="status"  class="form-control" onchange="validation(this.id)"  >
										<option value="1">Active</option>
										<option value="0">Inactive</option>
										</select>
							</div>
						
					
						<div class="col-md-12"><br><br>
									<a href="index.php?file=customer/list" class="float-left btn btn-primary">Cancel</a>
									<?php if($updateresult==''){?>
									<button type="button" id="add" name="add" class="float-right btn btn-success" onclick="customer_cu('','Add')">Save</button>
									<?php }else{?>
									<button type="button" id="add" name="add" class="float-right btn btn-success" onclick="customer_cu('<?php echo $updateresult[0]['customer_id']?>','Update')">Update</button>
									<?php }?>                          
							</div>
				</div>
				<!-- /.box-body -->
        	
        </form>
		
			</div>
	</section>
   
<?php if($updateresult!=''){?>
<script>
document.getElementById("customer_name").value ="<?php echo $updateresult[0]['customer_name'];?>";
document.getElementById("religion_id").value ="<?php echo $updateresult[0]['religion_id'];?>";
document.getElementById("mobile_no").value ="<?php echo $updateresult[0]['mobile_no'];?>";
document.getElementById("email").value ="<?php echo $updateresult[0]['email'];?>";
document.getElementById("address").value ="<?php echo $updateresult[0]['address'];?>";
document.getElementById("date").value ="<?php echo $updateresult[0]['dob'];?>";
document.getElementById("no_of_members").value ="<?php echo $updateresult[0]['no_of_members'];?>";
document.getElementById("state_id").value ="<?php echo $updateresult[0]['state_id'];?>";
document.getElementById("district_id").value ="<?php echo $updateresult[0]['district_id'];?>";
document.getElementById("city_id").value ="<?php echo $updateresult[0]['city_id'];?>";
document.getElementById("description").value ="<?php echo $updateresult[0]['description'];?>";
document.getElementById("status").value ="<?php echo $updateresult[0]['status'];?>";
</script>
<?php }?>
<style>
span.select2.select2-container.select2-container--default.select2-container--focus {
    width: 100% !important;
}
span.select2.select2-container.select2-container--default.select2-container--below.select2-container--open {
    width: 100% !important;
}
span.select2.select2-container.select2-container--default.select2-container--below {
    width: 100% !important;
}
span.select2.select2-container.select2-container--default {
    width: 100% !important;
}

</style>
