
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
		
		$sales_date		    =   '';
		
		$order_date		    =	'';
		$seller_name    	=   '';
		$party_id	 		=   '';
		$area				=	'';
		
		$order_quantity		=	'';
		$pending_amount		=	'';
		
		;
		

	if(isset($_GET['sales_id'])){
	$main_list = $pdo_conn->prepare("SELECT * FROM sales_entry WHERE sales_id ='".$_GET['sales_id']."'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	
	//	$sales_no		    	= $mainlist[0]['sales_no'];
		$sales_date				= $mainlist[0]['sales_date'];
	//	$random_sc				= $mainlist[0]['random_sc'];
	//	$random_no				= $mainlist[0]['random_no'];
	//  $order_no				= $mainlist[0]['order_no'];
		$order_date				= $mainlist[0]['order_date'];
		$seller_name			= $mainlist[0]['seller_name'];
		$party_id		    	= $mainlist[0]['party_id'];
		$area					= $mainlist[0]['area'];
	//	$material_id			= $mainlist[0]['material_id'];
	//	$order_quantity		    = $mainlist[0]['order_quantity'];
		$amount_quantity		= $mainlist[0]['amount_quantity'];
		$payment_mode		    = $mainlist[0]['payment_modes'];
		
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
	

/***
?>
<script language="javascript" type="text/javascript" src="city/city.js"></script>

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
									   <h5>City Name</h5>
									   <div class="controls">
											<input type="text" name="city_name" id="city_name" value="<?php echo $city_name ?>" class="form-control" onchange="validation(this.id)" >
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
									<a href="index.php?file=city/list" class="float-left btn btn-primary">Cancel</a>
									<?php if(isset($_GET['city_id'])){?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="citycreation_cu('<?php echo $_GET['city_id']?>','Update')">Update</button>
									<?php }else{?>
									<button type="button" id="add" class="float-right btn btn-success" onclick="citycreation_cu('','Add')"> Save</button>
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
			url: "city/curd.php",
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
</style> ***/