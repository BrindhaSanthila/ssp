
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
.staff_img { text-align:center;}
.img_staff { height:80px; border-radius:10px;}
</style>
<?php
		$employee_name		    = '';
		$employee_id		    = '';
		$mobile_no			    = '';
		$address	    		= '';
		$designation	   		= '';
		$userroll				= '';
		$employee_mobile		= '';
		$employee_web		    = '';
		$id_proof		    	= '';
		$active_status			= '';
		
	if(isset($_GET['emp_id'])){
	$main_list = $pdo_conn->prepare("SELECT * FROM employee_creation WHERE emp_id ='".$_GET['emp_id']."'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	
		$employee_name		    = $mainlist[0]['employee_name'];
		$employee_id		    = $mainlist[0]['employee_id'];
		$mobile_no			    = $mainlist[0]['mobile_no'];
		$address	    		= $mainlist[0]['address'];
		$designation	    	= $mainlist[0]['designation'];
		$userroll				= $mainlist[0]['userroll'];
		$employee_mobile		= $mainlist[0]['employee_mobile'];
		$employee_web		    = $mainlist[0]['employee_web'];
		$id_proof		    	= $mainlist[0]['id_proof'];
		$active_status			= $mainlist[0]['active_status'];
		
	}

// $stafftype_list = $pdo_conn->prepare("SELECT * FROM userroll WHERE active_status = '1' ");
// $stafftype_list->execute();
// $stafftypelist = $stafftype_list->fetchAll();

// $state_list = $pdo_conn->prepare("SELECT * FROM state WHERE status = '1' ");
// $state_list->execute();
// $statelist = $state_list->fetchAll();

/**************************************district list*************************************************************/
	
	// $state_list = $pdo_conn->prepare("SELECT * FROM district WHERE state_id = $state_name");
	// $state_list->execute();
	// $dislist = $state_list->fetchAll();
	
	
	/********************************************city list ********************************************************************/
	
	
	// $dist_list = $pdo_conn->prepare("SELECT * FROM city WHERE district_id = $district_name AND state_id = $state_name ");
	// $dist_list->execute();
	// $citylist = $dist_list->fetchAll();
	

	
	/***************************************************************************************************************************/
	


?>
<script language="javascript" type="text/javascript" src="employee/employee.js"></script>

    <!-- Main content -->
    <section class="">
		
		<div class="col">
            <div class="box">
				<!-- /.box-header -->
				<div class="box-body">
					<form class="was-validated" name="staffentry" autocomplete="off">
						<div class="row">
						
						<div hidden class="col-md-3 ">
								<div class="form-group">
									   <h5>Image Name</h5>

									   <div class="controls">
											<input type="text" name="img_name" id="img_name" value="<?php echo $id_proof ?>" class="form-control" onchange="validation(this.id)">
										</div>

								</div>
						</div>

						<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Employee Name</h5>
									   <div class="controls">
											<input type="text" name="employee_name" id="employee_name" value="<?php echo $employee_name ?>" class="form-control" onchange="validation(this.id)" >
										</div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Employee ID No</h5>
									   <?php
											$select_emp_id=$pdo_conn->prepare("SELECT * FROM employee_creation ORDER BY emp_id DESC limit 0,1");
											$select_emp_id->execute();
											$emp_id = $select_emp_id->fetchAll();
											if($emp_id[0]['employee_id']==''){
												$employeeid = 'SSP0001';
											}else{
												$empid = sprintf("%04d", substr($emp_id[0]['employee_id'], 3)+1);
												$employeeid = 'SSP'.$empid;
											}
										?>
									   <div class="controls">
											<input type="text"  name="employee_id" id="employee_id"  class="form-control"  value="<?php echo $employeeid ?>" onchange="validation(this.id)"  disabled>
										</div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Mobile Number</h5>
									   <div class="controls">
										 <input type="text" name="mobile_no" id="mobile_no" value="<?php echo $mobile_no ?>" class="form-control" onchange="validation(this.id)"  >
										</div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Address</h5>
									   <div class="controls">
											<textarea class="form-control" name="address" id="address"   onchange="validation(this.id)" ><?php echo $address ?></textarea>
										</div>
								  </div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Designation</h5>
									   <?php
											$select_designation=$pdo_conn->prepare("SELECT * FROM designation_creation");
											$select_designation->execute();
											$designation = $select_designation->fetchAll();
										?>	
									   <div class="controls">
									   <select name="designation" id="designation"  class="form-control select2 item_name" required>
										<option value="">Select designation</option>
										<?php 
										foreach($designation as $value)
										{
											
											if($updateresult == ''){?>
												<option value="<?php echo $value['designation_id']?>"><?php echo $value['designation_name'];?></option>
											<?php }else{ ?>
											<option value="<?php echo $value['designation_id']?>" <?php if($updateresult[0]['designation'] == $value['designation_id']){ echo "selected";} ?>><?php echo $value['designation_name'];?></option>
											
											<?php 
										}}
										?>
										</select>										
										</div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>User Roll</h5>
									   <?php
											$select_userroll=$pdo_conn->prepare("SELECT * FROM userroll");
											$select_userroll->execute();
											$userroll = $select_userroll->fetchAll();
										?>	
									   <div class="controls">
									   <select name="userroll" id="userroll"  class="form-control select2 item_name" required>
										<option value="">Select User Roll</option>
										<?php 
										foreach($userroll as $value)
										{
											
											if($updateresult == ''){?>
												<option value="<?php echo $value['userroll_id']?>"><?php echo $value['roll_name'];?></option>
											<?php }else{ ?>
											<option value="<?php echo $value['userroll_id']?>" <?php if($updateresult[0]['userroll'] == $value['userroll_id']){ echo "selected";} ?>><?php echo $value['roll_name'];?></option>
											
											<?php 
										}}
										?>
										</select>												
										</div>
								</div>
							</div>

							<div class="col-lg-8 col-md-12 ">
                            <div class="form-group">
                                <h5>Employee Required Mobile App</h5>
                                <div class="controls">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="employee_mobile" id="emp_mob_yes" value="Yes" <?php if($employee_mobile == 'Yes') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="emp_mob_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="employee_mobile" id="emp_mob_no" value="No" <?php if($employee_mobile == 'No') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="emp_mob_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>

						<div class="col-lg-8 col-md-12 ">
                            <div class="form-group">
                                <h5>Employee Required Web Access</h5>
                                <div class="controls">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="employee_web" id="emp_web_yes" value="Yes" <?php if($employee_web == 'Yes') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="emp_web_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="employee_web" id="emp_web_no" value="No" <?php if($employee_web == 'No') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="emp_web_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Attached ID proof</h5>
									   <div class="controls">
										 <input type="file" name="id_proof" id="id_proof" value="<?php echo $id_proof; ?>" class="form-control">
										 								</div>
								</div>
							</div>

							<div class="col-lg-8 col-md-12 ">
									<h5>Status</h5>
										<select name="active_status" id="active_status"  class="form-control"  >
										<option value="Active" <?php if($active_status == 'Active') { echo 'selected'; } ?> >Active</option>
										<option value="Inactive" <?php if($active_status == 'Inactive') { echo 'selected'; } ?> >Inactive</option>
										</select>
							</div>

							
							<div class="col-md-12"><br><br>
									<a href="index.php?file=employee/list" class="float-left btn btn-primary">Cancel</a>
									<?php if(isset($_GET['emp_id'])){?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="employeecreation_cu('<?php echo $_GET['employee_id']?>','Update')">Update</button>
									<?php }else{?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="employeecreation_cu('','Add')"> Save</button>
									<?php }?>
							</div>

						</div>
					</form>
         
				</div>
				<!-- /.box-body -->
        
			</div>


		</div>
			 
		
	</section>

<script>


 $('#district').on('change',function(){
	 
	 
	 var state_id=$('#state').val();
	 var dist_id=$('#state').val();
	 var city_select="city_select";
	 alert(state_id);
	 alert(state_id);
	 alert(city_select);
	 
	 
		jQuery.ajax({
			type: "POST",
			url: "employee/curd.php",
			data:"state_id="+state_id+"&district_id="+district_id+"&action="+city_select,
			success: function(msg){
				alert(msg);
				$('#city_list_div').html(msg);
				//window.location="index.php?file=staff/list";
			}
		});
	 
	
 });
	
	
function filladd()
{
	 if(same_address.checked == true) 
     {
             var tal11 =document.getElementById("staff_comnict_adrs").value;
		
            document.getElementById("staff_parmnt_adrs").value = tal11;
	 }
	 else if(same_address.checked == false)
	 {
		 document.getElementById("staff_parmnt_adrs").value='';
		
	 }
}
</script>
<style>
span.select2.select2-container.select2-container--default.select2-container--focus {
    width: 100% !important;
}
span.select2.select2-container.select2-container--default {
    width: 100% !important;
}
</style>