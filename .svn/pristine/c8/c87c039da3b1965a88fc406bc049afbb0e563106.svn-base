
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
		$runningstatus_name		    = '';
		$openclose_req		    	= '';
		$workremarks_req			= '';
		$active_status				= '';
		
	if(isset($_GET['runningstatus_id'])){
	$main_list = $pdo_conn->prepare("SELECT * FROM runningstatus WHERE runningstatus_id ='".$_GET['runningstatus_id']."'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	
		$runningstatus_name		    = $mainlist[0]['runningstatus_name'];
		$openclose_req		    	= $mainlist[0]['openclose_req'];
		$workremarks_req			= $mainlist[0]['workremarks_req'];
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
<script language="javascript" type="text/javascript" src="runningstatus/runningstatus.js"></script>

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
									   <h5>Status Name</h5>
									   <div class="controls">
											<input type="text" name="runningstatus_name" id="runningstatus_name" value="<?php echo $runningstatus_name ?>" class="form-control" onchange="validation(this.id)" >
										</div>
								</div>
							</div>

							<div class="col-lg-8 col-md-12 ">
                            <div class="form-group">
                                <h5>Opening & Closing Required</h5>
                                <div class="controls">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="openclose_req" id="openclose_req_yes" value="Yes" <?php if($openclose_req == 'Yes') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="openclose_req_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="openclose_req" id="openclose_req_no" value="No" <?php if($openclose_req == 'No') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="openclose_req_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>

						<div class="col-lg-8 col-md-12 ">
                            <div class="form-group">
                                <h5>Required Work Remarks</h5>
                                <div class="controls">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="workremarks_req" id="workremarks_req_yes" value="Yes" <?php if($workremarks_req == 'Yes') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="workremarks_req_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="workremarks_req" id="workremarks_req_no" value="No" <?php if($workremarks_req == 'No') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="workremarks_req_no">No</label>
                                    </div>
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
									<a href="index.php?file=runningstatus/list" class="float-left btn btn-primary">Cancel</a>
									<?php if(isset($_GET['runningstatus_id'])){?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="runningstatuscreation_cu('<?php echo $_GET['runningstatus_id']?>','Update')">Update</button>
									<?php }else{?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="runningstatuscreation_cu('','Add')"> Save</button>
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
			url: "runningstatus/curd.php",
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