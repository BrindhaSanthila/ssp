
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
		$vehicle_code		    = '';
		$registration_no		= '';
		$equipmenttype			= '';
		$max_units	    		= '';
		$max_tonnes	   			= '';
		$mileage_tolerance		= '';
		$active_status			= '';
		
	if(isset($_GET['vehicle_id'])){
	$main_list = $pdo_conn->prepare("SELECT * FROM vehicle_creation WHERE vehicle_id ='".$_GET['vehicle_id']."'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	
		$vehicle_code		    = $mainlist[0]['vehicle_code'];
		$registration_no		= $mainlist[0]['registration_no'];
		$equipmenttype			= $mainlist[0]['equipmenttype'];
		$max_units	    		= $mainlist[0]['max_units'];
		$max_tonnes	    		= $mainlist[0]['max_tonnes'];
		$mileage_tolerance		= $mainlist[0]['mileage_tolerance'];
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
<script language="javascript" type="text/javascript" src="vehicle/vehicle.js"></script>

    <!-- Main content -->
    <section class="">
		
		<div class="col">
            <div class="box">
				<!-- /.box-header -->
				<div class="box-body">
					<form class="was-validated" name="staffentry" autocomplete="off">
						<div class="row">						

						<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Vechicle Code</h5>
									   <div class="controls">
											<input type="text" name="vehicle_code" id="vehicle_code" value="<?php echo $vehicle_code ?>" class="form-control" onchange="validation(this.id)" >
										</div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Registration No</h5>
									   <div class="controls">
											<input type="text"  name="registration_no" id="registration_no"  class="form-control"  value="<?php echo $registration_no ?>" onchange="validation(this.id)"  >
										</div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Equipment Type</h5>
									   <?php
											$select_equipmenttype=$pdo_conn->prepare("SELECT * FROM equipmenttype_creation WHERE active_status='Active'");
											$select_equipmenttype->execute();
											$equipmenttype = $select_equipmenttype->fetchAll();
										?>	
									   <div class="controls">
									   <select name="equipmenttype" id="equipmenttype"  class="form-control select2 item_name" required>
										<option value="">Select Equipment Type</option>
										<?php 
										foreach($equipmenttype as $value)
										{
											
											if($updateresult == ''){?>
												<option value="<?php echo $value['equipmenttype_id']?>"><?php echo $value['equipmenttype_name'];?></option>
											<?php }else{ ?>
											<option value="<?php echo $value['equipmenttype_id']?>" <?php if($updateresult[0]['equipmenttype'] == $value['equipmenttype_id']){ echo "selected";} ?>><?php echo $value['equipmenttype_name'];?></option>
											
											<?php 
										}}
										?>
										</select>
										</div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Maximum Load Capacity</h5>
									   <div class="input-group mb-3">
										<input type="text" class="form-control" name="max_units" id="max_units" value="<?php echo $max_units ?>" onchange="validation(this.id)">
										<span class="input-group-text">units</span>
										<input type="text" class="form-control" name="max_tonnes" id="max_tonnes" value="<?php echo $max_tonnes ?>" class="form-control" onchange="validation(this.id)">
										<span class="input-group-text">tonnes</span>
										</div>
									   
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Mileage Tolerance</h5>
									   <div class="controls">
										 <input type="text" name="mileage_tolerance" id="mileage_tolerance" value="<?php echo $mileage_tolerance ?>"  class="form-control" onchange="validation(this.id)" >
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
									<a href="index.php?file=vehicle/list" class="float-left btn btn-primary">Cancel</a>
									<?php if(isset($_GET['vehicle_id'])){?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="vehiclecreation_cu('<?php echo $_GET['vehicle_id']?>','Update')">Update</button>
									<?php }else{?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="vehiclecreation_cu('','Add')"> Save</button>
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
			url: "vehicle/curd.php",
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