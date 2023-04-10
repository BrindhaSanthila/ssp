<script>


    $(function()
    {
        var yarn_chk="<?php echo $production_result[0]['yarn']; ?>";
        if(yarn_chk=="on")
        {
            $('#yarn_check').attr('checked', true); 
            yarncheck();
        }
        var knits_chk="<?php echo $production_result[0]['knits']; ?>";
        if(knits_chk=="on")
        {
            $('#knits_check').attr('checked', true); 
            knitscheck();
        }
        var woven_chk="<?php echo $production_result[0]['woven']; ?>";
        if(woven_chk=="on")
        {
            $('#woven_check').attr('checked', true); 
            wovencheck();
        }
        var printing_chk="<?php echo $production_result[0]['printing']; ?>";
        if(printing_chk=="on")
        {
            $('#printing_check').attr('checked', true); 
            printingcheck();
        }
        var sizing_chk="<?php echo $production_result[0]['sizing']; ?>";
        if(sizing_chk=="on")
        {
            $('#sizing_check').attr('checked', true); 
            sizingcheck();
        }
    });
</script>
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
</style>

<?php  
$date =date("Y-m-d");
		//$pdo_cus_num = $pdo_conn->prepare("SELECT customer_number FROM chemical_using  ORDER BY customer_number DESC LIMIT 1");
		//$pdo_cus_num->execute();
		//$cus_number = $pdo_cus_num->fetchAll();			
		//$customr_number=parseInt($customer_number);
		if(empty($cus_number)){
			$customer_number=1;
		}else{ 
			$customer_number = $cus_number[0]['customer_number']+1;
		}
		//$customer_number="CUS-".$customer_number;
		$state_id = $updateresult[0]['state_id'];
		$ste_id = $updateresult[0]['state_name'];
		$dis_id = $updateresult[0]['district_id'];
		$updateresult[0]['city_id'];
		//echo $sql1="SELECT * FROM district WHERE state_id = $ste_id ORDER BY district_id ASC";
	
		
	/**************************************district list*************************************************************/
	
	$state_list = $pdo_conn->prepare("SELECT * FROM district WHERE state_id = $ste_id ORDER BY district_id ASC");
	$state_list->execute();
	$dislist = $state_list->fetchAll();
	
	$dist = '';
	$dist .='<select class="form-control numeric" name="district_id" id="district_id" required>
			<option value="">Select Your District</option>'; 
	foreach($dislist as $value){
		$dist .= '<option value="'.$value['district_id'].'">'.$value['district_name'].'</option>'; 
	}
	$dist .='</select>';
	
	/********************************************city list ********************************************************************/
	
	
	$dist_list = $pdo_conn->prepare("SELECT * FROM city WHERE state_id = $ste_id AND district_id=$dis_id  ORDER BY district_id ASC");
	$dist_list->execute();
	$citylist = $dist_list->fetchAll();
	
	$cty = '';
	$cty .='<select class="form-control numeric" name="city_id" id="city_id" required>
			<option value="">Select city</option>'; 
	foreach($citylist as $value){
		$cty .= '<option value="'.$value['city_id'].'">'.$value['city_name'].'</option>'; 
	}
	$cty .='</select>';
	
	/***********************************************************************************************************************/
	
?>
<script language="javascript" type="text/javascript" src="customer/customer.js"></script>
    <!-- Main content -->
    <section class="" id="my-form">
		
		<div class="col">
            <div class="box">
       
       
				<!-- /.box-header -->
				<div class="box-body">
        
				
        
					<form class="was-validated" name="customer"  autocomplete="off">
                    <input type="hidden" id="curr_usr_id" name="curr_usr_id" value="<?php echo $_GET['customer_id']; ?>" />
						<div class="row">
        
							<div class="col-md-12">
								<h3>Customer Profile</h3><br>
							</div>
							
							
							 
							 
							<div  hidden class="col-lg-3 col-md-6 ">
								<div class="form-group">
									   <h5>Customer Number</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="customer_number" id="customer_number"  value="<?php if(empty($_GET['customer_id'])){echo $customer_number++; } else { echo $updateresult[0]['customer_number']; } ?>" >
										</div>
								 </div>
							</div>
							
							<div class="col-lg-3 col-md-6 ">
								<div class="form-group">
									   <h5>Customer Name</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="customer_name" id="customer_name"  value="<?php echo $updateresult[0]['customer_name'];?>" >
										</div>
								 </div>
							</div>
							<div class="col-sm-4">
					 		<div class="form-group">
								<h5>Religion Name </h5>
								<div class="controls">
								
								
									<select name="religion_id" id="religion_id"  class="form-control select2 item_name"  onChange="assign_religion(religion_id.value)" required>
										
										<option value="">Select religion</option>
				<?php 
					$select_religion=$pdo_conn->prepare("SELECT * FROM religion ");
					$select_religion->execute();
					$selectreligion = $select_religion->fetchAll();
			
					foreach($selectreligion as $value2){ ?>
					<?php
					

?>						<option value="<?php echo $value2['religion_id'];?>"  <?php if($value2['religion_id']==$updateresult[0]['religion_name']){ echo "selected"; } ?> ><?php echo $value2['religion_name'] ?></option>
			<?php   } ?>
									</select>
												
											</div>
									  </div>

									
								
								</div>
							<div class="col-lg-3 col-md-6 ">
								<div class="form-group">
									   <h5>Mobile Number</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="mobile_no" id="mobile_no" value="<?php echo $updateresult[0]['mobile_no'];?>" >
										</div>
								  </div>
							</div> 
							<div class="col-lg-3 col-md-6 ">
								<div class="form-group">
									   <h5>Email</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="email" id="email" value="<?php echo $updateresult[0]['email'];?>" >
										</div>
								  </div>
							</div>
							
							<div class="col-lg-3 col-md-6 ">
								
								  <div class="form-group">
									   <h5> Address</h5>
									   <div class="controls">
											<textarea class="form-control" name="address" id="address" ><?php echo $updateresult[0]['address'];?></textarea>
										</div>
								  </div>
								  <div class="form-group">
										   <h5>Date </h5>
										   <div class="controls">
												<input type="date" name="date" id="date"  class="form-control" onchange="" value="<?php if($updateresult[0]['date']!='') { echo $updateresult[0]['date']; } else { echo $date; } ?>" >
										   </div>
									  </div>
							
							</div>
							 
							<div class="col-lg-3 col-md-6 ">
								 <div class="form-group">
									   <h5>Number of Members</h5>
									   <div class="controls">
											<textarea class="form-control" name="no_of_members" id="no_of_members" ><?php echo $updateresult[0]['no_of_members'];?></textarea>
										</div>
								  </div>
							</div>
		 
							
							<div class="col-lg-3 col-md-6 ">
								<div class="form-group">
									   <h5>State</h5>
									   <div class="controls">
											<select class="form-control select2 item_name" name="state_id" id="state_id" onchange="district_list(state_id.value)" >
												<option value="">Select Your State</option>
												<?php foreach($state as $value){
                                                if ($_GET['customer_id']==''){ ?>
													<option value="<?php echo $value['state_id']?>"><?php echo $value['state_name']?></option>
                                                    <?php } else{
														 ?>
                                                    	<option value="<?php echo $value['state_id']?>" <?php if($updateresult[0]['state_id'] == $value['state_id']){ echo "selected";} ?>><?php echo $value['state_name'];?></option>
														<?php
													}?>
												<?php } ?>
											</select>
											
										</div>
								  </div>
							</div>

                            <div class="col-lg-3 col-md-6 ">
								<div class="form-group">
									   <h5>District</h5>
									   <div class="controls">
											<select class="form-control select2 item_name" name="district_id" id="district_id" onchange="city_list()" >
									<?php if ($_GET['customer_id']==''){  ?>
												<option value="">Select Your District</option>
                                                <?php } else {
                                                $district_by_state = $pdo_conn->prepare("SELECT * FROM district WHERE state_id = $state_id ORDER BY district_id ASC");
	$district_by_state->execute();
	$districtbystate = $district_by_state->fetchAll();
	foreach($districtbystate as $value){?>
                         <option value="<?php echo $value['district_id']?>" <?php if($updateresult[0]['district_id'] == $value['district_id']){ echo "selected";} ?>><?php echo $value['district_name'];?></option>

												<?php } } ?>
											</select>
											
										</div>
								  </div>
							</div>
							<!--
							<div class="col-md-3 ">
								<div class="form-group">
									   <h5>District</h5>
									  
											
											
                                       		<div class="district_name_list" id="district_name_list"> 
                                             <div class="controls">
											<?php if ($_GET['customer_id']==''){  ?>
											<select class=" select2 form-control item_name" name="district_id" id="district_id" onchange="city_list()" >
												<option value="">Select Your District</option>
											<?php } else { echo $dist; } ?>
											</select>											
											</div>
										</div>
								  </div>
							</div>-->
							
							<div class="col-lg-3 col-md-6 ">
								<div class="form-group">
											
											
                                       <!----		<div class="city_name_list" id="city_name_list"> ---->
									   <h5>City</h5>
								  <div class="controls">
										
											<select class="form-control select2 item_name" name="city_id" id="city_id">
                                            	<?php if ($_GET['customer_id']==''){  ?>
												<option value="">Select Your City</option>
											<?php } else {
												$city_by_district = $pdo_conn->prepare("SELECT * FROM city WHERE state_id = $state_id AND district_id = $dis_id ORDER BY district_id ASC");
												$city_by_district->execute();
												$citybydistrict = $city_by_district->fetchAll();
												foreach($citybydistrict as $value){?>
                                     <option value="<?php echo $value['city_id']?>" <?php if($updateresult[0]['city_id'] == $value['city_id']){ echo "selected";} ?>><?php echo $value['city_name'];?></option>

											<?php } }?>
											</select>											
										<!----		</div>---->
										</div>
								  </div>
							</div>
							 <div class="col-md-6">
									
									  <div class="form-group">
										   <h5>Description</h5>
										   <div class="controls">
												<textarea  name="description" id="description"  class="form-control" onkeyup="validation(this.id)" ></textarea>
											</div>
									  </div>
								</div>	 
		
							<div class="col-md-12">
									<div class="col-lg-6">
										<h5>Status</h5>
										<select name="status" id="status"  class="form-control" onchange="validation(this.id)"  required>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
										</select>
									</div>
								</div>
		
							
						<div class="col-md-12" id="">
								<?php// include "sub_form.php" ?>
						</div>
						<div class="col-md-12"><br><br>
									<a href="index.php?file=customer/list" class="float-left btn btn-primary">Cancel</a>
									<?php if($updateresult==''){?>
									<button type="button" class="float-right btn btn-success" onclick="customer_cu('','Add')">Save</button>
									<?php }else{?>
									<button type="button" class="float-right btn btn-success" onclick="customer_cu('<?php echo $updateresult[0]['customer_id']?>','Update')">Update</button>
									<?php }?>                                    
							</div>
				</div>
				<!-- /.box-body -->
        	</div>
		</div>
			
	</section>
    
    


<script>


//document.getElementById("customer_number").value ="<?php echo $updateresult[0]['customer_number'];?>"; 
document.getElementById("company_name").value ="<?php echo $updateresult[0]['company_name'];?>";
document.getElementById("tons").value ="<?php echo $updateresult[0]['tons'];?>";
document.getElementById("mobile_num").value ="<?php echo $updateresult[0]['mobile_num'];?>";
document.getElementById("personal_num").value ="<?php echo $updateresult[0]['personal_num'];?>"; 
document.getElementById("billing_address").value ="<?php echo $updateresult[0]['billing_address'];?>";
document.getElementById("delivery_address").value ="<?php echo $updateresult[0]['delivery_address'];?>";
document.getElementById("pan_num").value ="<?php echo $updateresult[0]['pan_num'];?>";
document.getElementById("gst_num").value ="<?php echo $updateresult[0]['gst_num'];?>";
document.getElementById("adhar_num").value ="<?php echo $updateresult[0]['adhar_num'];?>";
document.getElementById("landline_num").value ="<?php echo $updateresult[0]['landline_num'];?>";

document.getElementById("state_id").value ="<?php echo $updateresult[0]['state_id'];?>";

document.getElementById("district_id").value ="<?php echo $updateresult[0]['district_id'];?>";
document.getElementById("city_id").value ="<?php echo $updateresult[0]['city_id'];?>";

document.getElementById("account_holder_name").value ="<?php echo $updateresult[0]['account_holder_name'];?>";
document.getElementById("bank_name").value ="<?php echo $updateresult[0]['bank_name'];?>";
document.getElementById("account_number").value ="<?php echo $updateresult[0]['account_number'];?>";
document.getElementById("ifsc_code").value ="<?php echo $updateresult[0]['ifsc_code'];?>";
document.getElementById("description").value ="<?php echo $updateresult[0]['description'];?>";


/*document.getElementById("contact_type").value ="<?php echo $contact[0]['contact_type'];?>";
document.getElementById("contact_name").value ="<?php echo $contact[0]['contact_name'];?>";
document.getElementById("mobile_number").value ="<?php echo $contact[0]['mobile_number'];?>"; */


var yarn_chk="<?php echo $production_result[0]['yarn']; ?>";
//alert(yarn_chk);
if(yarn_chk=="on"){ $('#yarn_check').attr('checked', true); yarncheck();}
document.getElementById("yarn_type").value ="<?php echo $production_result[0]['yarn_type'];?>";
document.getElementById("yarn_machine_dscrpt").value ="<?php echo $production_result[0]['yarn_machine_dscrpt'];?>";


var knits_chk="<?php echo $production_result[0]['knits']; ?>";
if(knits_chk=="on"){ $('#knits_check').attr('checked', true); knitscheck();}
document.getElementById("knits_type").value ="<?php echo $production_result[0]['knits_type'];?>";
document.getElementById("knits_machine_dscrpt").value ="<?php echo $production_result[0]['knits_machine_dscrpt'];?>";

var woven_chk="<?php echo $production_result[0]['woven']; ?>";
if(woven_chk=="on"){ $('#woven_check').attr('checked', true); wovencheck();}
document.getElementById("woven_type").value ="<?php echo $production_result[0]['woven_type'];?>";
document.getElementById("woven_machine_dscrpt").value ="<?php echo $production_result[0]['woven_machine_dscrpt'];?>";

var print_chk="<?php echo $production_result[0]['printing']; ?>";
if(print_chk=="on"){ $('#printing_check').attr('checked', true); printingcheck();} 
document.getElementById("printing_type").value ="<?php echo $production_result[0]['printing_type'];?>";
document.getElementById("printing_machine_dscrpt").value ="<?php echo $production_result[0]['printing_machine_dscrpt'];?>";

document.getElementById("production_dscrpt").value ="<?php echo $production_result[0]['production_dscrpt'];?>";


</script>
<style>
span.select2.select2-container.select2-container--default.select2-container--focus {
    width: 100% !important;
}
span.select2.select2-container.select2-container--default.select2-container--below.select2-container--open {
    width: 100% !important;
}
span.select2.select2-container.select2-container--default.select2-container--below {
    width: 100% !important;
}
span.select2.select2-container.select2-container--default {
    width: 100% !important;
}

</style>
