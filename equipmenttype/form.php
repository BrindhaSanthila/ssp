
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
		$equipmenttype_name		    = '';
		$equipment_load		    	= '';
		$mileage_km			    	= '';
		$mileage_hr	    			= '';
		$reading_km	   				= '';
		$reading_hr					= '';
		$equipmentnature		    = '';
		$designation		    	= '';
		$active_status				= '';
		
	if(isset($_GET['equipmenttype_id'])){
	$main_list = $pdo_conn->prepare("SELECT * FROM equipmenttype_creation WHERE equipmenttype_id ='".$_GET['equipmenttype_id']."'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	
		$equipmenttype_name		    = $mainlist[0]['equipmenttype_name'];
		$equipment_load		    	= $mainlist[0]['equipment_load'];
		$mileage_km			    	= $mainlist[0]['mileage_km'];
		$mileage_hr	    			= $mainlist[0]['mileage_hr'];
		$reading_km	    			= $mainlist[0]['reading_km'];
		$reading_hr					= $mainlist[0]['reading_hr'];
		$equipmentnature		    = $mainlist[0]['equipmentnature'];
		$designation		    	= $mainlist[0]['designation'];
		$active_status				= $mainlist[0]['active_status'];
		
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
<script language="javascript" type="text/javascript" src="equipmenttype/equipmenttype.js"></script>

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
									   <h5>Equipment Type</h5>
									   <div class="controls">
											<input type="text" name="equipmenttype_name" id="equipmenttype_name" value="<?php echo $equipmenttype_name ?>" class="form-control" onchange="validation(this.id)" >
										</div>
								</div>
							</div>

							<div class="col-lg-8 col-md-12 ">
                            <div class="form-group">
                                <h5>Equipment can Carry Load</h5>
                                <div class="controls">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="equipment_load" id="equipment_load_yes" value="Yes" <?php if($equipment_load == 'Yes') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="equipment_load_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="equipment_load" id="equipment_load_no" value="No" <?php if($equipment_load == 'No') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="equipment_load_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>

						<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Mileage Calculation</h5>
									   <div class="input-group mb-3">
										<input type="text" class="form-control" name="mileage_km" id="mileage_km" value="<?php echo $mileage_km ?>" onchange="validation(this.id)">
										<span class="input-group-text">km</span>
										<input type="text" class="form-control" name="mileage_hr" id="mileage_hr" value="<?php echo $mileage_hr ?>" class="form-control" onchange="validation(this.id)">
										<span class="input-group-text">hr</span>
										</div>
									   
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Reading Type</h5>
									   <div class="input-group mb-3">
										<input type="text" class="form-control" name="reading_km" id="reading_km" value="<?php echo $reading_km ?>" onchange="validation(this.id)">
										<span class="input-group-text">km</span>
										<input type="text" class="form-control" name="reading_hr" id="reading_hr" value="<?php echo $reading_hr ?>" class="form-control" onchange="validation(this.id)">
										<span class="input-group-text">hr</span>
										</div>
									   
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Nature of Work</h5>
									   <?php
											$select_equipmentnature=$pdo_conn->prepare("SELECT * FROM equipmentnature_creation WHERE active_status='Active'");
											$select_equipmentnature->execute();
											$equipmentnature = $select_equipmentnature->fetchAll();
										?>
									   <div class="controls">
									   <select name="equipmentnature" id="equipmentnature"  class="form-control select2 item_name" required>
										<option value="">Select Equipment Nature</option>
										<?php 
										foreach($equipmentnature as $value)
										{
											
											if($updateresult == ''){?>
												<option value="<?php echo $value['equipmentnature_id']?>"><?php echo $value['equipmentnature_name'];?></option>
											<?php }else{ ?>
											<option value="<?php echo $value['equipmentnature_id']?>" <?php if($updateresult[0]['equipmentnature'] == $value['equipmentnature_id']){ echo "selected";} ?>><?php echo $value['equipmentnature_name'];?></option>
											
											<?php 
										}}
										?>
										</select>
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
										<option value="">Select Designation</option>
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
						
							<div class="col-lg-8 col-md-12 ">
									<h5>Status</h5>
										<select name="active_status" id="active_status"  class="form-control"  >
										<option value="Active" <?php if($active_status == 'Active') { echo 'selected'; } ?> >Active</option>
										<option value="Inactive" <?php if($active_status == 'Inactive') { echo 'selected'; } ?> >Inactive</option>
										</select>
							</div>

							
							<div class="col-md-12"><br><br>
									<a href="index.php?file=equipmenttype/list" class="float-left btn btn-primary">Cancel</a>
									<?php if(isset($_GET['equipmenttype_id'])){?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="equipmenttypecreation_cu('<?php echo $_GET['equipmenttype_id']?>','Update')">Update</button>
									<?php }else{?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="equipmenttypecreation_cu('','Add')"> Save</button>
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
			url: "equipmenttype/curd.php",
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