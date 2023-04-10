
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
		$staff_type		    = '';
		$staff_name		    = '';
		$gender			    = '';
		$comm_address	    = '';
		$perm_address	    = '';
		$staff_id		    = '';
		$mobile_no		    = '';
		$license_no		    = '';
		$dob			    = '';
		$doj			    = '';
		$blood_group	    = '';
		$old_company_esi	= '';
		$old_company_pfno	= '';
		$nature_of_work		= '';
		$bank_acc_details	= '';
		$id_proofno		    = '';
		$email_id		    = '';
		$image			    = '';
		$adhar_no		    = '';
		$state_name		    = '';
		$staff_designation  ='';
		
	if(isset($_GET['staffcreation_id'])){
	$main_list = $pdo_conn->prepare("SELECT * FROM staffcreation WHERE staffcreation_id ='".$_GET['staffcreation_id']."' AND  delete_status != '1'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	
		$staff_type		    = $mainlist[0]['staff_type'];
		$staff_name		    = $mainlist[0]['staff_name'];
		$gender			    = $mainlist[0]['gender'];
		$comm_address	    = $mainlist[0]['comm_address'];
		$perm_address	    = $mainlist[0]['perm_address'];
		$staff_id		    = $mainlist[0]['staff_id'];
		$mobile_no		    = $mainlist[0]['mobile_no'];
		$license_no		    = $mainlist[0]['license_no'];
		$dob			    = $mainlist[0]['dob'];
		$doj			    = $mainlist[0]['doj'];
		$blood_group	    = $mainlist[0]['blood_group'];
		$old_company_esi	= $mainlist[0]['old_company_esi'];
		$old_company_pfno	= $mainlist[0]['old_company_pfno'];
		$nature_of_work		= $mainlist[0]['nature_of_work'];
		$bank_acc_details	= $mainlist[0]['bank_acc_details'];
		$id_proofno		    = $mainlist[0]['id_proofno'];
		$email_id		    = $mainlist[0]['email_id'];
		$image			    = $mainlist[0]['image'];
		$image1			    = $mainlist[0]['image1'];
		$adhar_no		    = $mainlist[0]['adhar_no'];
		$state_name		    = $mainlist[0]['state_id'];
		$district_name	    = $mainlist[0]['district_id'];
		$city			    = $mainlist[0]['city_id'];
		$user_name		    = $mainlist[0]['user_name'];
		$password		    = $mainlist[0]['password'];
		$staff_designation  = $mainlist[0]['staff_designation'];
	}

$stafftype_list = $pdo_conn->prepare("SELECT * FROM userroll WHERE active_status = '1' ");
$stafftype_list->execute();
$stafftypelist = $stafftype_list->fetchAll();

$state_list = $pdo_conn->prepare("SELECT * FROM state WHERE status = '1' ");
$state_list->execute();
$statelist = $state_list->fetchAll();

/**************************************district list*************************************************************/
	
	$state_list = $pdo_conn->prepare("SELECT * FROM district WHERE state_id = $state_name");
	$state_list->execute();
	$dislist = $state_list->fetchAll();
	
	
	/********************************************city list ********************************************************************/
	
	
	$dist_list = $pdo_conn->prepare("SELECT * FROM city WHERE district_id = $district_name AND state_id = $state_name ");
	$dist_list->execute();
	$citylist = $dist_list->fetchAll();
	

	
	/***************************************************************************************************************************/
	


?>
<script language="javascript" type="text/javascript" src="staff/staff.js"></script>

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
											<input type="text" name="img_name" id="img_name" value="<?php echo $image ?>" class="form-control" onchange="validation(this.id)">
										</div>

								</div>
						</div>
						<div hidden class="col-md-3 ">
								<div class="form-group">
									   <h5>Image Name</h5>

									   <div class="controls">
											<input type="text" name="img_name1" id="img_name1" value="<?php echo $image1 ?>" class="form-control" onchange="validation(this.id)">
										</div>

								</div>
						</div>
						
						
						
							<div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>Staff Type</h5>
										<select class="form-control select2 item_name" name="staff_type" id="staff_type" >
                        <option value="">Select Your Staff</option>
                       <?php foreach($stafftypelist as $value){ 
						   if($value['userroll_id'] == $staff_type){
					   ?>
						<option value="<?php echo $value['userroll_id'] ; ?>" selected><?php echo $value['roll_name']; ?></option>
						<?php }else{ ?> 
						<option value="<?php echo $value['userroll_id'] ; ?>"><?php echo $value['roll_name']; ?></option>										 						<?php } 
								}?>
								</select>
								</div>
							</div>							
							
		 
							<div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>Staff Name</h5>
									   <div class="controls">
											<input type="text" name="staff_name" id="staff_name" value="<?php echo $staff_name ?>" class="form-control" onchange="validation(this.id)" >
										</div>
								</div>
							</div>
							 
							
							 
							<div class="col-md-6 col-lg-2 ">
								<div class="form-group">
									<h5>Gender</h5>
										<select class="form-control select2 item_name" name="staff_gender" id="staff_gender" >
											<option value="">Select Gender</option>
                                            <?php if($gender == 'Male'){?>
											<option value="Male" selected>Male</option>
                                            <?php }else{ ?>
                                            <option value="Male">Male</option>
                                            <?php } if($gender == 'Female'){?>
											<option value="Female" selected>Female</option>
                                            <?php }else{?>
                                            <option value="Female">Female</option>
                                            <?php }?>
										</select>
									
								</div>
							</div> 
							
							 
							<div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>Commnication Address</h5>
									   <div class="controls">
											<textarea class="form-control" name="staff_comnict_adrs" id="staff_comnict_adrs"   onchange="validation(this.id)" ><?php echo $comm_address ?></textarea>
										</div>
								  </div>
							</div>
							 
							<div class="col-md-6 col-lg-1">
								<div class="form-group">
									<h5>Same </h5>
									<input type="checkbox" name="same_address" id="same_address"onclick="filladd()">
									
								</div>
							</div> 
							 
							<div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>Permanent Address</h5>
									   <div class="controls">
											<textarea class="form-control" name="staff_parmnt_adrs" id="staff_parmnt_adrs"   onchange="validation(this.id)" ><?php echo $perm_address ?></textarea>
										</div>
								</div>
							</div>
							 
							<div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>Staff id</h5>
									   <div class="controls">
											<input type="text"  name="staff_id" id="staff_id"  class="form-control"  value="<?php echo $staff_id ?>" onchange="validation(this.id)"  >
										</div>
								</div>
							</div>
							 
							<div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>Mobile Number</h5>
									   <div class="controls">
										 <input type="text" name="staff_mbl_num" id="staff_mbl_num" value="<?php echo $mobile_no ?>" class="form-control" onchange="validation(this.id)"  >
										</div>
								</div>
							</div>

					 
							<div class="col-md-6 col-lg-3 ">
								
								  <div class="form-group">
									   <h5>License Number</h5>
									   <div class="controls">
										 <input type="text" name="staff_licence_num" id="staff_licence_num" value="<?php echo $license_no ?>"  class="form-control" onchange="validation(this.id)"  >
										</div>
								  </div>
								 
							
							</div>
							 
							<div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>DOB</h5>
									   <div class="controls">
										 <input type="date" name="staff_dob" id="staff_dob"  class="form-control" value="<?php echo $dob ?>" onchange="validation(this.id)"  >
										</div>
								</div>
							</div>
							 
							<div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>DOJ</h5>
									   <div class="controls">
										 <input type="date" name="staff_doj" id="staff_doj"  class="form-control" value="<?php echo $doj ?>" onchange="validation(this.id)"  >
										</div>
								</div>
							</div>
							 
							<div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>Blood Group</h5>
									   <div class="controls">
                                         <select name="staff_bld_grp" id="staff_bld_grp"  class="form-control select2 item_name">	
                                         <option value="">Select Blood Group</option>
                                         <?php if($blood_group == 'A+'){?>
                                         <option value="A+" selected>A+</option>
                                         <?php } else{ ?>
                                         <option value="A+">A+</option>
                                         <?php } if($blood_group == 'A-'){?>
                                         <option value="A-" selected>A-</option>
                                         <?php } else{ ?>
                                         <option value="A-">A-</option>
                                         <?php } if($blood_group == 'B+'){?>
                                         <option value="B+" selected>B+</option>
                                         <?php } else{ ?>
                                         <option value="B+">B+</option>
                                         <?php } if($blood_group == 'B-'){?>
                                         <option value="B-" selected>B-</option>
                                         <?php } else{ ?>
                                         <option value="B-">B-</option>
                                         <?php } if($blood_group == 'O+'){?>
                                         <option value="O+" selected>O+</option>
                                         <?php } else{ ?>
                                         <option value="O+">O+</option>
                                         <?php } if($blood_group == 'O-'){?>
                                         <option value="O-" selected>O-</option>
                                         <?php } else{ ?>
                                         <option value="O-">O-</option>
                                         <?php } if($blood_group == 'AB+'){?>
                                         <option value="AB+" selected>AB+</option>
                                         <?php } else{ ?>
                                         <option value="AB+">AB+</option>
                                         <?php }?>
                                         </select>
										</div>
								</div>
							</div>
							 
							<div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>Old Company ESI</h5>
									   <div class="controls">
										 <input type="text" name="staff_old_esi" id="staff_old_esi"  class="form-control" value="<?php echo $old_company_esi ?>" onchange="validation(this.id)"  >
										</div>
								</div>
							</div>
							 
							<div class="col-md-6 col-lg-3">
								<div class="form-group">
									   <h5>Old Company PF No</h5>
									   <div class="controls">
										 <input type="text" name="staff_old_pf" id="staff_old_pf"  class="form-control" value="<?php echo $old_company_pfno ?>" onchange="validation(this.id)"  >
										</div>
								</div>
							</div>
							 
							<div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>Nature Of Work</h5>
									   <div class="controls">
										 <input type="text" name="staff_nature_work" id="staff_nature_work" value="<?php echo $nature_of_work ?>"  class="form-control" onchange="validation(this.id)" >
										</div>
								</div>
							</div>
							 
							<div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>Bank Accounts Details</h5>
									   <div class="controls">
											<textarea class="form-control" name="staff_bank_ac" id="staff_bank_ac"  onchange="validation(this.id)" ><?php echo $bank_acc_details ?></textarea>
										</div>
								</div>
							</div>
							 
							<div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>Id Proof Number</h5>
									   <div class="controls">
											<textarea class="form-control" name="staff_id_proof" id="staff_id_proof"  onchange="validation(this.id)" ><?php echo $id_proofno ?></textarea>
										</div>
								</div>
							</div>
							 
							<div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>Email Id</h5>
									   <div class="controls">
										 <input type="text" name="staff_email" id="staff_email"  class="form-control" value="<?php echo $email_id ?>" onchange="validation(this.id)"  >
										</div>
								</div>
							</div>
							 
							<div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>Upload Image</h5>
									   <div class="controls">
										 <input type="file" name="staff_image" id="staff_image" value="<?php echo $image; ?>" class="form-control">
										 								</div>
								</div>
							</div>
							 
							<div class="col-md-6 col-lg-3 ">
								  <div class="form-group">
									   <h5>Adhar Number</h5>
									   <div class="controls">
										 <input type="text" name="staff_adharnumber" id="staff_adharnumber" value="<?php echo $adhar_no ?>"   onchange="validation(this.id)" class="form-control" >
										</div>
								</div>
							</div>
							
         					<div class="col-md-6 col-lg-3">
								<div class="form-group">
									   <h5>State</h5>
									   <div class="controls">
                                     
											<select class="form-control select2 item_name" name="state_id" id="state_id" onchange="district_list(state_id.value)" >
												<option value="">Select Your State</option>
																							
											 <?php foreach($statelist as $value1){ 
						   					 if($value1['state_id'] == $state_name){
					  						 ?>
											 <option value="<?php echo $value1['state_id'] ; ?>" selected><?php echo $value1['state_name']; ?></option>
											 <?php }else{ ?> 
											 <option value="<?php echo $value1['state_id'] ; ?>"><?php echo $value1['state_name']; ?></option>										 						       				
											  <?php } 
											 }?>
                                            </select>
										</div>
								  </div>
							</div>
							
                            <div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>District</h5>
									   <div class="controls">
											
											
                                       		<div class="district_name_list" id="district_name_list"> 
											
											<select class="form-control select2 item_name" name="district_id" id="district_id" onchange="city_list()" >
												<option value="">Select Your District</option>
											
											   <?php foreach($dislist as $value2){ 
						   					 if($value2['district_id'] == $district_name){
					  						 ?>
											 <option value="<?php echo $value2['district_id'] ; ?>" selected><?php echo $value2['district_name']; ?></option>
											 <?php }else{ ?> 
											 <option value="<?php echo $value2['district_id'] ; ?>"><?php echo $value2['district_name']; ?></option>										 						       				 <?php } 
											 }?>
                                            </select>
										
                                           								
											</div>
										</div>
								  </div>
							</div>
							
							
							
							<div class="col-md-6 col-lg-3">
								<div class="form-group">
									   <h5>City</h5>
									   <div class="controls">
											
											
                                       		<div class="city_name_list" id="city_name_list"> 
											<select class="form-control select2 item_name" name="city_id" id="city_id" required>
												<option value="">Select Your City</option>
											 <?php foreach($citylist as $value3){ 
						   					 if($value3['city_id'] == $city){
					  						 ?>
											 <option value="<?php echo $value3['city_id'] ; ?>" selected><?php echo $value3['city_name']; ?></option>
											 <?php }else{ ?> 
											 <option value="<?php echo $value3['city_id'] ; ?>"><?php echo $value3['city_name']; ?></option>										 						       				 <?php } 
											 }?>									
                                            </select>										
											</div>
										</div>
								  </div>
							</div>
							
							<div class="col-md-6 col-lg-3">
								  <div class="form-group">
									   <h5>User Name</h5>
									   <div class="controls">
										 <input type="text" name="user_name" id="user_name" value="<?php echo $user_name ?>"  class="form-control" onchange="validation(this.id)" >
										</div>
								</div>
							</div>
							
							
							<div class="col-md-6 col-lg-3 ">
								  <div class="form-group">
									   <h5>Password</h5>
									   <div class="controls">
										 <input type="text" name="password" id="password" value="<?php echo $password ?>"  class="form-control" onchange="validation(this.id)" >
										</div>
								</div>
							</div>
                            <div class="col-md-6 col-lg-3 ">
								<div class="form-group">
									   <h5>Staff Designation</h5>
									   <div class="controls">
										 <input type="text" name="staff_designation" id="staff_designation" value="<?php echo $staff_designation ?>"  class="form-control" onchange="validation(this.id)" >
										</div>
								</div>
							</div>
							
							<div class="col-md-6 col-lg-3 ">
								  <div class="form-group">
									  <label><h5>Staff Image</h5></label>  
									   <div class="controls">
                                       <input type="file" name="staff_image1" id="staff_image1" value="<?php echo $img; ?>" class="form-control">
										</div>
										</div>
								</div>
										<!-- <div class="col-md-6 col-lg-3 ">
											<div class="form-group">
												<div class="controls">
										 

										<?php if($_GET['staffcreation_id']!=""){ ?> <div class="staff_img"><img class="img_staff" id="image"src="upload/staff/<?php echo $image1; ?>"/> <?php } else {?><img class="img_staff" id="image"/> <?php }?> 		
								
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-3 ">
				<div class="form-group">
				 <div class="controls">
					<?php if($_GET['staffcreation_id']!=""){ ?> <div class="staff_img"><img class="img_staff" id="image"src="upload/staff/<?php echo $image; ?>"/> <?php } else {?><img class="img_staff" id="image"/> <?php }?> 
                </div>
            </div>
        </div> -->
                           <!--  <script type="text/javascript">
   								 function readURL(input) 
								 {
     						     if (input.files && input.files[0]) 
								 {
                                 var reader = new FileReader();
            
        					    reader.onload = function (e) 
								{
             				    $('#image').attr('src', e.target.result);
           						 }
        					    reader.readAsDataURL(input.files[0]);
      						    }
    							}
   							  $("#staff_image").change(function(
							  {
       						 readURL(this);
  							  });

   								
						      </script>
							 -->
							
							<div class="col-md-12"><br><br>
									<a href="index.php?file=staff/list" class="float-left btn btn-primary">Cancel</a>
									<?php if(isset($_GET['staffcreation_id'])){?>
									<button type="button" class="float-right btn btn-success" onclick="staffcreation_cu('<?php echo $_GET['staffcreation_id']?>','Update')">Update</button>
									<?php }else{?>
									<button type="button" class="float-right btn btn-success" onclick="staffcreation_cu('','Add')">Save</button>
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
			url: "staff/curd.php",
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