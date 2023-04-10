

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
		$party_name		    = '';
		$mobile_no		    = '';
		$address			= '';
		$accounts_no	    = '';
		$partytype	   		= '';
		$comp_name			= '';
		$person_name		= '';
		$contact_mob_no		= '';
		$gst_no				= '';
		$paymenttype		= '';
		$credit_days		= '';
		$auto_sms		    = '';
		$active_status		= '';
		
	if(isset($_GET['party_id'])){
	$main_list = $pdo_conn->prepare("SELECT * FROM party_creation WHERE party_id ='".$_GET['party_id']."'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	
		$party_name		    = $mainlist[0]['party_name'];
		$mobile_no		    = $mainlist[0]['mobile_no'];
		$address			= $mainlist[0]['address'];
		$accounts_no	    = $mainlist[0]['accounts_no'];
		$partytype	    	= $mainlist[0]['partytype'];
		$comp_name			= $mainlist[0]['comp_name'];
		$person_name		= $mainlist[0]['person_name'];
		$contact_mob_no		= $mainlist[0]['contact_mob_no'];
		$gst_no				= $mainlist[0]['gst_no']; 	
		$paymenttype		= $mainlist[0]['paymenttype'];
		$credit_days		= $mainlist[0]['credit_days'];
		$auto_sms		    = $mainlist[0]['auto_sms'];
		$active_status		= $mainlist[0]['active_status'];
		$area_name		= $mainlist[0]['area_name'];
		$city_name		= $mainlist[0]['city_name'];
		
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
<script language="javascript" type="text/javascript" src="party/party.js"></script>

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
									   <h5>Party Name</h5>
									   <div class="controls">
											<input type="text" name="party_name" id="party_name" value="<?php echo $party_name ?>" class="form-control" onchange="validation(this.id)" >
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
									   <h5>Area Name</h5>
									   <div class="controls">
										 <select class="form-control select2 area_name" multiple name="area_name" id="area_name"  onchange="get_city_name();"><?php 
										 $select_area=$pdo_conn->prepare("SELECT * FROM area_creation where active_status='Active'");
											$select_area->execute();
											$area_type = $select_area->fetchAll();?>
											<option>Select</option> 
											<?php foreach ($area_type as $value) {
												if($_GET['party_id']!=''){
											$area_name_options = explode(',',$area_name);
                                                  ?>
                                        <option value="<?php echo $value['area_id']?>" <?php if (in_array($value['area_id'], $area_name_options)){ echo "selected";} ?>><?php echo $value['area_name'];?></option> 											
											<?php } else {
                                                    ?>
                                        <option value="<?php echo $value['area_id']?>" ><?php echo $value['area_name'];?></option> 												
											<?php }
											} ?> 
                                             </select>
										</div>
								</div>
							</div> 
	<div class="col-md-12 col-lg-8 ">
								<div id="city_val_get">
								<div class="form-group">
									   <h5>City Name</h5>
									   <div class="controls">
										 <select class="form-control select2 city_name"  multiple name="city_name" id="city_name" ><?php 
										 $select_city=$pdo_conn->prepare("SELECT * FROM city_creation where active_status='Active'");
											$select_city->execute();
											$city_type = $select_city->fetchAll();?>
											<option>Select</option> 
											<?php foreach ($city_type as $value) {
												if($_GET['party_id']==''){  ?>
												<option value="<?php echo $value['city_id'];?>"><?php echo $value['city_name'];?></option>
												
											<?php } else{ $city_name_options = explode(',',$city_name); ?>
												<option value="<?php echo $value['city_id'];?>" <?php if (in_array($value['city_id'], $city_name_options)){ echo "selected";} ?>><?php echo $value['city_name'];?></option>
												
											<?php } 
										}?></select>
										</div>
								</div>

							</div> 
						</div>
							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Accounts No</h5>
									   <div class="controls">
											<input type="text" name="accounts_no" id="accounts_no" value="<?php echo $accounts_no ?>" class="form-control" onchange="validation(this.id)"  >
										</div>
								  </div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Party Type</h5>
									   <?php
											$select_partytype=$pdo_conn->prepare("SELECT * FROM partytype_creation");
											$select_partytype->execute();
											$partytype = $select_partytype->fetchAll();
										?>	
									   <div class="controls">
									   <select name="partytype" id="partytype"  class="form-control select2 item_name" onchange="get_partytype_details(partytype.value);" required>
										<option value="">Select Party Type</option>
										<?php 
										foreach($partytype as $value)
										{
											
											if($updateresult == ''){?>
												<option value="<?php echo $value['partytype_id']?>"><?php echo $value['partytype_name'];?></option>
											<?php }else{ ?>
											<option value="<?php echo $value['partytype_id']?>" <?php if($updateresult[0]['partytype'] == $value['partytype_id']){ echo "selected";} ?>><?php echo $value['partytype_name'];?></option>
											
											<?php 
										}}
										?>
										</select>
										</div>
								</div>
							</div>
							
							<div class="col-md-12 col-lg-12 " id="get_partytype"></div>
						<?php
						if($_GET['partytype_id']!=''){
							$get_partytype_details = $pdo_conn->prepare("SELECT * FROM partytype_creation where partytype_id='".$_GET['partytype_id']."' ");
							$get_partytype_details->execute();
							$partytype_details = $get_partytype_details->fetchAll();
						
							if($partytype_details[0]['req_comp_name']=='Yes'){
								?>
							<div class="col-md-12 col-lg-8 ">
								 <div class="form-group">
										<h5>Company Name</h5>
										<div class="controls">
											<input type="text" name="comp_name" id="comp_name" value="<?php echo $comp_name; ?>" class="form-control" onchange="validation(this.id)"  >
										 </div>
									</div>
							</div>
							<?php }
						
							if($partytype_details[0]['req_person_name']=='Yes'){?>
								<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
										<h5>Contact Person Name</h5>
										<div class="controls">
											<input type="text" name="person_name" id="person_name" value="<?php echo $person_name?>" class="form-control" onchange="validation(this.id)"  >
										</div>
									</div>
							</div>
							<?php
							}
						
							if($partytype_details[0]['req_mobile_no']=='Yes'){?>
								<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
										<h5>Contact Person Mobile No</h5>
										<div class="controls">
											<input type="text" name="contact_mob_no" id="contact_mob_no" value="<?php echo $contact_mob_no?>" class="form-control" onchange="validation(this.id)"  >
										</div>
									</div>
							</div>
							<?php }
						
							if($partytype_details[0]['req_gst']=='Yes'){?>
								<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
										<h5>GST No</h5>
										<div class="controls">
											<input type="text" name="gst_no" id="gst_no" value="<?php echo $gst_no; ?>" class="form-control" onchange="validation(this.id)"  >
										</div>
									</div>
							</div>
						<?php	}
						}
?>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Payment Type</h5>
									  
									 <div class="controls">
									   <select name="paymenttype" id="paymenttype"  class="form-control select2 item_name" required>
										<option value="">Select Party Type</option>		
									
										
											<option value="Credit" <?php if($paymenttype== 'Credit'){ echo "selected";} ?>>Credit</option>					
														<option value="Cash" <?php if($paymenttype== 'Cash'){ echo "selected";} ?>>Cash</option>	
										</select>
										</div>
								</div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Credit Days</h5>
									   <div class="controls">
											<input type="text" name="credit_days" id="credit_days" value="<?php echo $credit_days ?>" class="form-control" onchange="validation(this.id)"  >
										</div>
								  </div>
							</div>

							<div class="col-md-12 col-lg-8 ">
								<div class="form-group">
									   <h5>Send Auto SMS</h5>
									   <div class="controls">
									   <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="auto_sms" id="auto_sms_yes" value="Yes" <?php if($auto_sms == 'Yes') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="auto_sms_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="auto_sms" id="auto_sms_no" value="No" <?php if($auto_sms == 'No') { echo 'checked'; } ?>>
                                        <label class="form-check-label" for="auto_sms_no">No</label>
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
									<a href="index.php?file=party/list" class="float-left btn btn-primary">Cancel</a>
									<?php if(isset($_GET['party_id'])){?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="party_cu('<?php echo $_GET['party_id']?>','Update')">Update</button>
									<?php }else{?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="party_cu('','Add')"> Save</button>
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
			url: "party/curd.php",
			data:"state_id="+state_id+"&district_id="+district_id+"&action="+city_select,
			success: function(msg){
				alert(msg);
				$('#city_list_div').html(msg);
				//window.location="index.php?file=staff/list";
			}
		});
	 
	
 });
	
	function get_city_name(){
		var area_name = [];  
   	jQuery.each(jQuery('.area_name option:selected'), function() {
		area_name.push(jQuery(this).val()); 
    });
   
    var area_name=area_name.toString();
    //alert(area_name);
		jQuery.ajax({
			type: "POST",
			url: "party/city_name.php",
			data:"area_name="+area_name,
			success: function(msg){
				
				$('#city_val_get').html(msg);
				$('.city_name').select2();
				//window.location="index.php?file=staff/list";
			}
		});
	}
	
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