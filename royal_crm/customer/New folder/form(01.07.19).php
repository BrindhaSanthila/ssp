
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
		$pdo_cus_num = $pdo_conn->prepare("SELECT * FROM chemical_using ORDER BY chemical_using_id DESC LIMIT 1");
		$pdo_cus_num->execute();
		$cus_number = $pdo_cus_num->fetchAll();			
		//$customr_number=parseInt($customer_number);
		if(empty($cus_number)){
			$customer_number=1;
		}else{ 
			$customer_number = $cus_number[0]['customer_number']+1;
		}
		//$customer_number="CUS-".$customer_number;
		$ste_id = $updateresult[0]['state_id'];
		$dis_id = $updateresult[0]['district_id'];
		$updateresult[0]['city_id'];
		//echo $sql1="SELECT * FROM district WHERE state_id = $ste_id ORDER BY district_id ASC";
		
	/**************************************district list*************************************************************/
	
	$state_list = $pdo_conn->prepare("SELECT * FROM district WHERE state_id = $ste_id ORDER BY district_id ASC");
	$state_list->execute();
	$dislist = $state_list->fetchAll();
	
	$dist = '';
	$dist .='<select class="form-control numeric" name="district_id" id="district_id" required>
			<option value="">Select District</option>'; 
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
	
	/***************************************************************************************************************************/
	

//	echo "***".$_GET['customer_id']; 
	
	
?>
<script language="javascript" type="text/javascript" src="customer/customer.js"></script>
    <!-- Main content -->
    <section class="" id="my-form">
		
		<div class="col">
            <div class="box">
       
       
				<!-- /.box-header -->
				<div class="box-body">
        
				
        
					<form class="was-validated" name="customer"  autocomplete="off">
                    <div class="row">
                    <input type="hidden" id="curr_usr_id" name="curr_usr_id" value="<?php echo $_GET['customer_id']; ?>" />
						
        
							<div class="col-md-12">
								<h3>Customer Profile</h3><br>
							</div>
							
							
							 
							 
							<div  hidden class="col-md-3 ">
								<div class="form-group">
									   <h5>Customer Number</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="customer_number" id="customer_number"  value="<?php if(empty($_GET['customer_id'])){echo $customer_number++; } else { echo $updateresult[0]['customer_number']; } ?>" >
										</div>
								 </div>
							</div>
							
							<div class="col-md-3 ">
								<div class="form-group">
									   <h5>Customer Name</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="company_name" id="company_name"  value="<?php echo $updateresult[0]['company_name'];?>" >
										</div>
								 </div>
							</div>
							 
							
							 
							 
							
							
							
							<div class="col-md-3 ">
								<div class="form-group">
									   <h5>Landline Number</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="landline_num" id="landline_num" value="<?php echo $updateresult[0]['landline_num'];?>" >
										</div>
								  </div>
							</div>
							
							 
							
		 
							<div class="col-md-3 ">
								
								  <div class="form-group">
									   <h5>Billing Address</h5>
									   <div class="controls">
											<textarea class="form-control" name="billing_address" id="billing_address" ><?php echo $updateresult[0]['billing_address'];?></textarea>
										</div>
								  </div>
								 
							
							</div>
							 
							<div class="col-md-3 ">
								 <div class="form-group">
									   <h5>Delivery Address</h5>
									   <div class="controls">
											<textarea class="form-control" name="delivery_address" id="delivery_address" ><?php echo $updateresult[0]['delivery_address'];?></textarea>
										</div>
								  </div>
							</div>
		 
							<div class="col-md-3 ">
								 <div class="form-group">
									   <h5>Pan Number</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="pan_num" id="pan_num"  value="<?php echo $updateresult[0]['pan_num'];?>" >
										</div>
								  </div>
							</div>
							 
							<div class="col-md-3 ">
								 <div class="form-group">
									   <h5>GST Number</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="gst_num" id="gst_num" value="<?php echo $updateresult[0]['gst_num'];?>" >
										</div>
								  </div>
							</div>
		
							<div class="col-md-3 ">
								<div class="form-group">
									   <h5>Adhar Number </h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="adhar_num" id="adhar_num" value="<?php echo $updateresult[0]['adhar_num'];?>" >
										</div>
								  </div>
							</div>
							
						
							
							
							
							
							<div class="col-md-3 ">
								<div class="form-group">
									   <h5>State</h5>
									   <div class="controls">
											<select class="form-control select2 item_name" name="state_id" id="state_id" onchange="district_list(state_id.value)" >
												<option value="">Select Your State</option>
												<?php foreach($state as $value){?>
													<option value="<?php echo $value['state_id']?>"><?php echo $value['state_name']?></option>
												<?php } ?>
											</select>
											
										</div>
								  </div>
							</div>
							
							<div class="col-md-3 ">
								<div class="form-group">
									   <h5>District</h5>
									   <div class="controls">
											
											
                                       		<div class="district_name_list" id="district_name_list"> 
											<?php if ($_GET['customer_id']==''){  ?>
											<select class="form-control select2 item_name" name="district_id" id="district_id" onchange="city_list()" >
												<option value="">Select Your District</option>
											<?php } else { echo $dist; } ?>
											</select>											
											</div>
										</div>
								  </div>
							</div>
							
							<div class="col-md-3 ">
								<div class="form-group">
									   <h5>City</h5>
								  <div class="controls">
											
											
                                       <!----		<div class="city_name_list" id="city_name_list"> ---->
											<?php if ($_GET['customer_id']==''){  ?>
											<select class="form-control select2 item_name" name="city_id" id="city_id">
												<option value="">Select Your City</option>
											<?php } else { echo $cty; } ?>
											</select>											
										<!----		</div>---->
										</div>
								  </div>
							</div>
							
							<div class="col-md-3 ">
								<div class="form-group">
									   <h5>Email</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="email" id="email" value="<?php echo $updateresult[0]['email'];?>" >
										</div>
								  </div>
							</div>
		
							<div class="col-md-12 ">

								<h3>Contact</h3><BR>
									
							 </div>
		 
							
							<?php include "contact_form.php" ?>
							
							<div class="col-md-12 ">

								<h3>Bank Account Details</h3><BR>
								
							</div>
							
							<div class="col-md-3 ">
								<div class="form-group">
									   <h5>Account Holder Name </h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="account_holder_name" id="account_holder_name" value="<?php echo $updateresult[0]['account_holder_name'];?>" >
										</div>
								  </div>
							</div>
							
							<div class="col-md-3 ">
								<div class="form-group">
									   <h5>Bank Name </h5>
									   <div class="controls">
											<select class="form-control select2 item_name" name="bank_name" id="bank_name">
												<option value="">Select Your Bank</option>
												<?php foreach($bankmaster as $value){?>
												<option value="<?php echo $value['bank_name']?>"><?php echo $value['bank_name']?></option>
												<?php } ?>
											</select>
										</div>
								</div>
							</div>
		
							<div class="col-md-3 ">
								<div class="form-group">
									   <h5>Account Number </h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="account_number" id="account_number" value="<?php echo $updateresult[0]['account_number'];?>" >
										</div>
								</div>
							</div>
							
							<div class="col-md-3 ">
								<div class="form-group">
									   <h5>IFSC Code</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="ifsc_code" id="ifsc_code" value="<?php echo $updateresult[0]['ifsc_code'];?>" >
										</div>
								  </div>
							</div>
		 
		 
							<div class="col-md-12">
								<h3>Production Facilities</h3><br>
							 
							</div>
							 
							 
							 
							<div class="col-md-2">
								<div class="form-group">
									
									<input type="checkbox" name="yarn" id="yarn_check" onclick="yarncheck()" > Yarn
									
									</div>
								
								<?php
                           $str = $production_result[0]['yarn_type'];
                           $st=explode(",",$str);
                            ?> 
								<div class="" style="display:none" id="yarn_select">
            
                                    <select class="form-control select2 item_name" name="yarn_type[]" id="yarn_type" onchange="validation(this.id)" multiple style="width: 135px;">
									
                                    <option value="">Select Your Yarn</option>
									<option value="Cheese Dyeing" <?php if (in_array("Cheese Dyeing", $st)){ ?> selected <?php } ?>> Cheese Dyeing</option>
									<option value="Cabinet Dyeing" <?php if (in_array("Cabinet Dyeing", $st)){ ?> selected <?php } ?>>Cabinet Dyeing</option>
									</select>
			
      							</div><br>
  
								
								<div class="" style="display:none" id="yrn_tns">
									
									   <h5>Tons</h5>
									   
										<input type="text"  class="form-control" name="yarn_tons" id="yarn_tons" value ="<?php echo $production_result[0]['yarn_tons'];?>" >

										
								</div> <br>
								
								
								
								<div class="" style="display:none" id="yarn_description">
									<h5>Machine Description</h5>
									<textarea class="form-control" name="yarn_machine_dscrpt" id="yarn_machine_dscrpt"  onchange="validation(this.id)" ><?php echo $production_result[0]['yarn_machine_dscrpt'];?></textarea>
									
								</div>
								
							 
						
							</div>
		
		
							<div class="col-md-2">
								<div class="form-group">
									
									<input type="checkbox" name="knits" id="knits_check" onclick="knitscheck()"> Knits
									
									
								</div> 
								
								<?php
                           $str = $production_result[0]['knits_type'];
                           $st=explode(",",$str);
                            //print_r($st);
                           //echo $st[0]."<br>";
                           // echo $st[1];
                            ?> 
								
								
								<div class="" style="display:none" id="knits_select">
								
									<select class="form-control select2 item_name" name="knits_type[]" id="knits_type" onchange="validation(this.id)" multiple style="width: 135px;">
									<option value="">Select Your Knits</option>

									
									
									<option value="Softflow" <?php if (in_array("Softflow", $st)){ ?> selected <?php } ?>>Softflow</option>
									<option value="Winch" <?php if (in_array("Winch", $st)){ ?> selected <?php } ?>>Winch</option>

									

									</select>
									
								</div><br>
								
								<div class="" id="knts_tns" style="display:none">
									<div class="form-group" >
									   <h5>Tons</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="knits_tons" id="knits_tons" value ="<?php echo $production_result[0]['knits_tons'];?>"  >
										</div>
									</div>
								</div>
								
								<div class="" style="display:none" id="knits_description">
									<h5>Machine Description</h5>
									<textarea class="form-control" name="knits_machine_dscrpt" id="knits_machine_dscrpt" onchange="validation(this.id)" ><?php echo $production_result[0]['knits_machine_dscrpt'];?></textarea>
									
								</div>
								
							</div>
		
							<div class="col-md-2">
								<div class="form-group">
									
									<input type="checkbox" name="woven" id="woven_check" onclick="wovencheck()"> Woven
									
									
								</div> 

								<?php
                           $str = $production_result[0]['woven_type'];
                           $st=explode(",",$str);
                           // print_r($st);
                           //echo $st[0]."<br>";
                            //echo $st[1]."<br>";
                            //echo $st[2];
                            ?> 
								
								<div class="" style="display:none" id="woven_select">
								
									<select class="form-control select2 item_name" name="woven_type[]" id="woven_type"  onchange="validation(this.id)" multiple style="width: 135px;">
									<option value="">Select Your Woven</option>

									

									<option value="JIGGER" <?php if (in_array("JIGGER", $st)){ ?> selected <?php } ?>>JIGGER</option>
									<option value="CPB" <?php if (in_array("CPB", $st)){ ?> selected <?php } ?>>CPB</option>
									<option value="BBR" <?php if (in_array("BBR", $st)){ ?> selected <?php } ?>>CBR</option>

								
								</select>
									
								</div><br>
								
								<div class="" id="wv_tns" style="display:none">
									<div class="form-group" >
									   <h5>Tons</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="woven_tons" id="woven_tons" value ="<?php echo $production_result[0]['woven_tons'];?>">
										</div>
									</div>
								</div>
								
								<div class="" style="display:none" id="woven_description">
									<h5>Machine Description</h5>
									<textarea class="form-control" name="woven_machine_dscrpt" id="woven_machine_dscrpt" onchange="validation(this.id)" ><?php echo $production_result[0]['woven_machine_dscrpt'];?></textarea>
									
								</div>
								
							</div>
		
							<div class="col-md-2">
								<div class="form-group">
									
									<input type="checkbox" name="printing" id="printing_check" onclick="printingcheck()"> Printing
									
									
								</div> 

								<?php
                           $str = $production_result[0]['printing_type'];
                           $st=explode(",",$str);
                           // print_r($st);
                          // echo $st[0]."<br>";
                          //  echo $st[1]."<br>";
                          //  echo $st[2];
                          //  echo $st[3];
                            ?> 
								
								<div class="" style="display:none" id="printing_select">
								
									<select class="form-control select2 item_name" name="printing_type[]" id="printing_type"  onchange="validation(this.id)" multiple style="width: 135px;">

									<option value="">Select Your Printing</option>

									

									<option value="Rotary" <?php if (in_array("Rotary", $st)){ ?> selected <?php } ?>> Rotary</option>
									<option value="Table" <?php if (in_array("Table", $st)){ ?> selected <?php } ?>>Table</option>
									<option value="Chest" <?php if (in_array("Chest", $st)){ ?> selected <?php } ?>>Chest</option>
									<option value="Reactive" <?php if (in_array("Reactive", $st)){ ?> selected <?php } ?>>Reactive</option>

									
									</select>
									
								</div><br>
								
								<div class="" id="prt_tns" style="display:none">
									<div class="form-group">
									   <h5>Tons</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="printing_tons" id="printing_tons" value ="<?php echo $production_result[0]['printing_tons'];?>"    >
										</div>
									</div>
								</div>
								
								
								<div class="" style="display:none" id="printing_description">
									<h5>Machine Description</h5>
									<textarea class="form-control" name="printing_machine_dscrpt" id="printing_machine_dscrpt" onchange="validation(this.id)" ><?php echo $production_result[0]['printing_machine_dscrpt'];?></textarea>
									
								</div>
								
							</div>
							
							<div class="col-md-2">
								<div class="form-group">
									
									<input type="checkbox" name="sizing" id="sizing_check" onclick="sizingcheck()"> Sizing
									
									
								</div> 

								<?php
                           $str = $production_result[0]['sizing_type'];
                           $st=explode(",",$str);
                          // print_r($st);
                          // echo $st[0]."<br>";
                         //   echo $st[1]."<br>";
                          // echo $st[2];
                          //  echo $st[3];
                            ?>
								
								<div class="" style="display:none" id="sizing_select">
								
									<select class="form-control select2 item_name" name="sizing_type[]" id="sizing_type" multiple style="width: 135px;">
									<option value="" disabled>Select Your Sizing</option>
									
									<option value="Power Loom" <?php if (in_array("Power Loom", $st)){ ?> selected <?php } ?>>Power Loom</option>
									<option value="Auto Loom" <?php if (in_array("Auto Loom", $st)){ ?> selected <?php } ?>> Auto Loom</option>
									<option value="Sectional Warping" <?php if (in_array("Sectional Warping", $st)){ ?> selected <?php } ?>>Sectional Warping</option>
									
								

									</select>
									
								</div><br>
								
								<div class="" id="szg_tns" style="display:none">
									<div class="form-group">
									   <h5>Tons</h5>
									   <div class="controls">
											<input type="text"  class="form-control" name="sizing_tons" id="sizing_tons"  value ="<?php echo $production_result[0]['sizing_tons'];?>"  >
										</div>
									</div>
								</div>
								
								
								<div class="" style="display:none" id="sizing_description">
									<h5>Machine Description</h5>
									<textarea class="form-control" name="sizing_machine_dscrpt" id="sizing_machine_dscrpt" onchange="validation(this.id)" ><?php echo $production_result[0]['sizing_machine_dscrpt'];?></textarea>
									
								</div>
								
							</div>
		
		
							<div class="col-md-12 ">
								<div class="form-group"><br>
									   <h5>Production Facilities Description</h5>
									   <div class="controls">
											<textarea class="form-control" name="production_dscrpt" id="production_dscrpt" ><?php echo $production_result[0]['production_dscrpt'];?></textarea>
										</div>
								  </div>
							</div>
							
							
					
					
						<div class="col-md-12 ">
							<h3>Chemical Using Details</h3><br>
						</div>
					
								
                                
					
						
						
						
						
						<div class="col-md-12">
								<div class="form-group">
									
									<input type="checkbox" name="payment_terms" id="payment_terms" onclick="" checked disabled > Agreed Payments Terms
									
									
								</div>
						</div>
					
						<div class="col-md-12"><br><br>
									<a href="index.php?file=customer/list" class="float-left btn btn-primary">Cancel</a>
									<?php if($updateresult==''){?>
									<button type="button" class="float-right btn btn-success" onclick="customer_cu('','Add')">Save</button>
									<?php }else{?>
									<button type="button" class="float-right btn btn-success" onclick="customer_cu('<?php echo $updateresult[0]['customer_id']?>','Update')">Update</button>
									<?php  }   ?>                                    
							</div>
                         
              </form>
             
              </section>              				
    
    
	
	

<?php if($updateresult!=''){?>
<script>


document.getElementById("state_id").value ="<?php echo $updateresult[0]['state_id'];?>";

document.getElementById("district_id").value ="<?php echo $updateresult[0]['district_id'];?>";
document.getElementById("city_id").value ="<?php echo $updateresult[0]['city_id'];?>";

document.getElementById("bank_name").value ="<?php echo $updateresult[0]['bank_name'];?>";

var yarn_chk="<?php echo $production_result[0]['yarn']; ?>";
//alert(yarn_chk);
if(yarn_chk=="on"){ $('#yarn_check').attr('checked', true); yarncheck();}

var knits_chk="<?php echo $production_result[0]['knits']; ?>";
if(knits_chk=="on"){ $('#knits_check').attr('checked', true); knitscheck();}

var woven_chk="<?php echo $production_result[0]['woven']; ?>";
if(woven_chk=="on"){ $('#woven_check').attr('checked', true); wovencheck();}

var print_chk="<?php echo $production_result[0]['printing']; ?>";
if(print_chk=="on"){ $('#printing_check').attr('checked', true); printingcheck();}

var sizg_chk="<?php echo $production_result[0]['sizing']; ?>";
if(sizg_chk=="on"){ $('#sizing_check').attr('checked', true); sizingcheck();} 

</script>
<?php }?>
