
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
		$partytype_name		    = '';
		$req_comp_name		    = '';
		$req_person_name		= '';
		$req_mobile_no	    	= '';
		$req_gst	   			= '';
		
	if(isset($_GET['partytype_id'])){
	$main_list = $pdo_conn->prepare("SELECT * FROM partytype_creation WHERE partytype_id ='".$_GET['partytype_id']."'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	
		$partytype_name		    = $mainlist[0]['partytype_name'];
		$req_comp_name		    = $mainlist[0]['req_comp_name'];
		$req_person_name		= $mainlist[0]['req_person_name'];
		$req_mobile_no	    	= $mainlist[0]['req_mobile_no'];
		$req_gst	    		= $mainlist[0]['req_gst'];
		
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
<script language="javascript" type="text/javascript" src="partytype/partytype.js"></script>

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
									   <h5>Party Type Name</h5>
									   <div class="controls">
											<input type="text" name="partytype_name" id="partytype_name" value="<?php echo $partytype_name ?>" class="form-control" onchange="validation(this.id)" >
										</div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Required Company Name</h5>
										<div class="controls">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="req_comp_name" id="comp_name_yes" value="Yes" <?php if($req_comp_name == 'Yes') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="comp_name_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="req_comp_name" id="comp_name_no" value="No" <?php if($req_comp_name == 'No') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="comp_name_no">No</label>
                                    </div>
                                </div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Contact Person Name</h5>
									   <div class="controls">
									   <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="req_person_name" id="person_name_yes" value="Yes" <?php if($req_person_name == 'Yes') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="person_name_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="req_person_name" id="person_name_no" value="No" <?php if($req_person_name == 'No') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="person_name_no">No</label>
                                    </div>
										</div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Contact Person Mobile No</h5>
									   <div class="controls">
									   <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="req_mobile_no" id="mobile_no_yes" value="Yes" <?php if($req_mobile_no == 'Yes') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="mobile_no_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="req_mobile_no" id="mobile_no_no" value="No" <?php if($req_mobile_no == 'No') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="mobile_no_no">No</label>
                                    </div>
										</div>
								  </div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>GST No</h5>
									   <div class="controls">
									   <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="req_gst" id="gst_yes" value="Yes" <?php if($req_gst == 'Yes') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="gst_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="req_gst" id="gst_no" value="No" <?php if($req_gst == 'No') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="gst_no">No</label>
                                    </div>
										</div>
								</div>
							</div>

							
							<div class="col-md-12"><br><br>
									<a href="index.php?file=partytype/list" class="float-left btn btn-primary">Cancel</a>
									<?php if(isset($_GET['partytype_id'])){?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="partytype_cu('<?php echo $_GET['partytype_id']?>','Update')">Update</button>
									<?php }else{?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="partytype_cu('','Add')"> Save</button>
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
			url: "partytype/curd.php",
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