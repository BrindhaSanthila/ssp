
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
		$designation_name		    = '';
		$reporting_to		    = '';
		
	if(isset($_GET['designation_id'])){
	$main_list = $pdo_conn->prepare("SELECT * FROM designation_creation WHERE designation_id ='".$_GET['designation_id']."'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	
		$designation_name		    = $mainlist[0]['designation_name'];
		$reporting_to		    = $mainlist[0]['reporting_to'];
		
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
<script language="javascript" type="text/javascript" src="designation/designation.js"></script>

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
									   <h5>Designation Name</h5>
									   <div class="controls">
											<input type="text" name="designation_name" id="designation_name" value="<?php echo $designation_name ?>" class="form-control" onchange="validation(this.id)" >
										</div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Reporting To</h5><div class="controls">
									   <select name="reporting_to" id="reporting_to"  class="form-control select2 " >
										<option value="">Select</option>
										<?php 
											$select_desig=$pdo_conn->prepare("SELECT * FROM designation_creation");
											$select_desig->execute();
											$designation_type = $select_desig->fetchAll();
	
										foreach($designation_type as $value)
										{
											?>
											<option value="<?php echo $value['designation_name']?>" <?php if($reporting_to== $value['designation_name']){ echo "selected";} ?>><?php echo $value['designation_name'];?></option>
											
											<?php 
										}
										?>
										</select>
									   
											
										</div>
								</div>
							</div>

					
							
							<div class="col-md-12"><br><br>
									<a href="index.php?file=designation/list" class="float-left btn btn-primary">Cancel</a>
									<?php if(isset($_GET['designation_id'])){?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="designationcreation_cu('<?php echo $_GET['designation_id']?>','Update')">Update</button>
									<?php }else{?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="designationcreation_cu('','Add')"> Save</button>
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