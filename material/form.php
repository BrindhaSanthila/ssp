

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
		$material_name		    = '';
		$unit		    		= '';
		$alt_unit			    = '';
		$production_from	    = '';
		$active_status			= '';
		
	if(isset($_GET['material_id'])){
	$main_list = $pdo_conn->prepare("SELECT * FROM material_creation WHERE material_id ='".$_GET['material_id']."'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	
		$material_name		    = $mainlist[0]['material_name'];
		$unit		   			= $mainlist[0]['unit'];
		$alt_unit			    = $mainlist[0]['alt_unit'];
		$production_from	    = $mainlist[0]['production_from'];
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
<script language="javascript" type="text/javascript" src="material/material.js"></script>

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
									   <h5>Material Name</h5>
									   <div class="controls">
											<input type="text" name="material_name" id="material_name" value="<?php echo $material_name ?>" class="form-control" onchange="validation(this.id)" >
										</div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Measurement of Unit</h5>
									   <div class="controls">
									   <?php
											$select_unit=$pdo_conn->prepare("SELECT * FROM unit_creation");
											$select_unit->execute();
											$unit = $select_unit->fetchAll();
										?>	
									   <select name="unit" id="unit"  class="form-control select2 item_name" required>
										<option value="">Select Measurement of Unit</option>
										<?php 
										foreach($unit as $value)
										{
											
											if($updateresult == ''){?>
												<option value="<?php echo $value['unit_id']?>"><?php echo $value['unit_name'];?></option>
											<?php }else{ ?>
											<option value="<?php echo $value['unit_id']?>" <?php if($updateresult[0]['unit'] == $value['unit_id']){ echo "selected";} ?>><?php echo $value['unit_name'];?></option>
											
											<?php 
										}}
										?>
										</select>
										</div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Alternative of Units</h5>
									   <div class="controls">
									   	 <?php
											$select_unit_1=$pdo_conn->prepare("SELECT * FROM unit_creation");
											$select_unit_1->execute();
											$unit_1 = $select_unit_1->fetchAll();
										?>	
										<select name="alt_unit" id="alt_unit"  class="form-control select2 item_name" required>
										<option value="">Select Measurement of Unit</option>
										<?php 
										foreach($unit_1 as $value_1)
										{
											
											
											?>
											<option value="<?php echo $value_1['unit_id']?>" <?php if($alt_unit == $value_1['unit_id']){ echo "selected";} ?>><?php echo $value_1['unit_name'];?></option>
											
											<?php 
										}
										?>
										</select>
										</div>
								</div>
							</div>

						
							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Material Production From</h5><?php 
									   $select_quary_1=$pdo_conn->prepare("SELECT * FROM quary_creation where active_status='Active'");
											$select_quary_1->execute();
											$quary_1 = $select_quary_1->fetchAll(); ?>
									   <div class="controls">
									 	<select name="production_from" id="production_from"  class="form-control"  >
									 		<option value="">Select</option>
									   <?php 
										foreach($quary_1 as $value_1)
										{
											
											
											?>
											<option value="<?php echo $value_1['quary_id']?>" <?php if($production_from == $value_1['quary_id']){ echo "selected";} ?>><?php echo $value_1['quary_name'];?></option>
											
											<?php 
										}
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
									<a href="index.php?file=material/list" class="float-left btn btn-primary">Cancel</a>
									<?php if(isset($_GET['material_id'])){?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="materialcreation_cu('<?php echo $_GET['material_id']?>','Update')">Update</button>
									<?php }else{?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="materialcreation_cu('','Add')"> Save</button>
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
			url: "material/curd.php",
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