
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
		$labour_name		    = '';
		$mobile_no			    = '';
		$address	    		= '';
		$labour_dob  			= '';
		$working_place			= '';
		$crusher_place		    = '';
		$active_status			= '';
		
	if(isset($_GET['labour_id'])){
	$main_list = $pdo_conn->prepare("SELECT * FROM labour_creation WHERE labour_id ='".$_GET['labour_id']."'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	
		$labour_name		    = $mainlist[0]['labour_name'];
		$mobile_no			    = $mainlist[0]['mobile_no'];
		$address	    		= $mainlist[0]['address'];
		$labour_dob	    		= $mainlist[0]['labour_dob'];
		$working_place			= $mainlist[0]['working_place'];
		$crusher_place		    = $mainlist[0]['crusher_place'];
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
<script language="javascript" type="text/javascript" src="labour/labour.js"></script>

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
									   <h5>Labour Name</h5>
									   <div class="controls">
											<input type="text" name="labour_name" id="labour_name" value="<?php echo $labour_name ?>" class="form-control" onchange="validation(this.id)" >
										</div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Mobile No</h5>
									   <div class="controls">
											<input type="text"  name="mobile_no" id="mobile_no"  class="form-control"  value="<?php echo $mobile_no ?>" onchange="validation(this.id)"  >
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
									   <h5>Date of Birth</h5>
									   <div class="controls">
										 <input type="date" name="labour_dob" id="labour_dob" value="<?php if($labour_dob=='') echo date('d-m-Y'); else echo $labour_dob ?>"  class="form-control" onchange="validation(this.id)" >
										</div>
								</div>
							</div>							

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Working Place</h5>
									   <div class="controls">
									   <?php
											$select_quary=$pdo_conn->prepare("SELECT * FROM quary_creation WHERE working_place = 'Yes' AND active_status='Active'");
											$select_quary->execute();
											$quary = $select_quary->fetchAll();
										?>	
									   <select name="working_place" id="working_place"  class="form-control select2 working_place" multiple required>
										<option value="">Select Working Place</option>
										<?php 
										foreach($quary as $value)
										{											
											if($updateresult == ''){?>
												<option value="<?php echo $value['quary_id']?>"><?php echo $value['quary_name'];?></option>
											<?php }else{ 
												$quary_options = explode(',',$updateresult[0]['working_place']);
											?>
											<option value="<?php echo $value['quary_id']?>" <?php if (in_array($value['quary_id'], $quary_options)){ echo "selected";} ?>><?php echo $value['quary_name'];?></option>
											
											<?php 
										}}
										?>
										</select>
										</div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Crusher Place</h5>
									   <div class="controls">
											<input type="text" name="crusher_place" id="crusher_place" value="<?php echo $crusher_place ?>" class="form-control" onchange="validation(this.id)" >
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
									<a href="index.php?file=labour/list" class="float-left btn btn-primary">Cancel</a>
									<?php if(isset($_GET['labour_id'])){?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="labourcreation_cu('<?php echo $_GET['labour_id']?>','Update')">Update</button>
									<?php }else{?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="labourcreation_cu('','Add')"> Save</button>
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
			url: "labour/curd.php",
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