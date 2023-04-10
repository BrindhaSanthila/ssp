	
	  <?php if (!empty($_GET['customer_id'])){  
	  
		$pdo_contact = $pdo_conn->prepare("SELECT * FROM contact where delete_status!='1' and customer_id=".$_GET['customer_id']);
		$pdo_contact->execute();
		$contact_result = $pdo_contact->fetchAll();
		//echo "SELECT * FROM contact where customer_id=".$_GET['customer_id'];
		$ff=count($contact_result);		
		$contact_id=1;		
		foreach($contact_result as $value1){
			
	  ?>
	  
	  <div hidden class="col-lg-3 col-md-6">
			<div class="form-group">
				<h5>Contact Id</h5>
				<input type="text" class="form-control" name="contact_id<?php echo $contact_id; ?>" value="<?php echo $value1['contact_id'];?>" id="contact_id<?php echo $contact_id; ?>" >
			</div>
      </div> 
	  
	  <div class="col-lg-3 col-md-6 " id="contact-name<?php echo $contact_id; ?>">
			<div class="form-group">
				<h5>Contact Person</h5>
				<input type="text" class="form-control" name="contact_name<?php echo $contact_id; ?>" id="contact_name<?php echo $contact_id; ?>" value="<?php echo $value1['contact_name'];?>" >
			</div>
      </div> 
	  
	  <div class="col-lg-3 col-md-6" id="contact-type<?php echo $contact_id; ?>" >
		<div class="form-group">	
				<h5>Designation</h5>
				
			<div class="controls">
          
				<select class="form-control select2 item_name" name="contact_type<?php echo $contact_id; ?>" id="contact_type" required>
					<option value="">Select Your Contact</option>
					<?php foreach($contact_type as $value){?>
					<option value="<?php echo $value['contact_type_id'];?>" <?php if($value['contact_type_id']==$value1['contact_type']){ echo "selected"; }?>><?php echo $value['contact_type_name']?></option>
					<?php } ?>
				</select>
                </div>
		</div>
        </div>
       
		
		 
		<div class="col-lg-2 col-md-6" id="mobile-number<?php echo $contact_id; ?>">
			<div class="form-group">
				<h5>Mobile Number</h5>
				<input type="text" class="form-control" name="mobile_number<?php echo $contact_id; ?>" value="<?php echo $value1['mobile_number'];?>" id="mobile_number<?php echo $contact_id; ?>" >
			</div>
        </div> 
		
		<div class="col-lg-3 col-md-6" id="contact_email<?php echo $contact_id; ?>">
			<div class="form-group" >
				<h5>Email</h5>
				<input type="email" class="form-control" name="contact_email<?php echo $contact_id; ?>" id="contact_email<?php echo $contact_id; ?>" value="<?php echo $value1['contact_email'];?>" >
			</div>
        </div> 
		
		
		
		
		
		<div class="col-md-1"  <?php if($contact_id=="1") { ?> id="add_button" <?php } else { ?>id="remove-type<?php echo $contact_id; ?>"<?php } ?>>
			<div class="form-group">
				<h5><br></h5>
				<?php if($contact_id=="1") { ?>
				<input type="button" class="btn btn-info" name="add" id="add" data_id="<?php echo $ff; ?>" value="+" onclick="add_contact_form()">
				<?php } else { ?>
				<input type="button" class="btn btn-info" data_id="<?php echo $contact_id; ?>" id="remove_button<?php echo $contact_id; ?>" value="-" onclick="remove(this.id)">
				<?php } ?>
			</div>
        </div> 


		<?php $contact_id++; } } else { ?>
	
		
	  
		
		<div class="col-lg-3 col-md-12">
			<div class="form-group">
				<h5>Contact Person</h5>
				<input type="text" class="form-control" name="contact_name1" id="contact_name1" >
			</div>
         </div> 
		 
		 <div class="col-lg-3 col-md-6">
			<div class="form-group">
				<h5>Designation</h5>
				
				
				<select class="form-control select2 item_name" name="contact_type1" id="contact_type1" required>
					<option value="">Select Your Contact</option>
					<?php foreach($contact_type as $value){?>
					<option value="<?php echo $value['contact_type_id']?>"><?php echo $value['contact_type_name']?></option>
					<?php } ?>
				</select>
			</div>
        </div>
		 
		<div class="col-lg-2 col-md-6">
			<div class="form-group">
				<h5>Mobile Number</h5>
				<input type="text" class="form-control" name="mobile_number1" id="mobile_number1" >
			</div>
        </div> 
		
		<div class="col-lg-3 col-md-6">
			<div class="form-group">
				<h5>Email</h5>
				<input type="email" class="form-control" name="contact_email1" id="contact_email1" >
			</div>
        </div> 
		
		
		
		<div class="col-md-1" id="add_button">
			<div class="form-group">
				<h5><br></h5>
				<input type="button" class="btn btn-info" name="add" id="add" data_id="1" value="+" onclick="add_contact_form()">
			</div>
        </div> 		
		<?php } ?>

<script>
$(document).ready(function(){
				
	
	$('#add').click(function(){
		var i =$("#add").attr("data_id");
		i =parseInt(i)+1;

	$('#add_button').after('<div class="col-lg-2 col-md-6" hidden id="contact-id'+i+'"><div class="form-group"><h5>Contact Id</h5><input type="text" class="form-control" name="contact_id'+i+'" id="contact_id'+i+'" ></div></div><div class="col-lg-3 col-md-12" id="contact-name'+i+'"><div class="form-group"><h5>Contact Person</h5><input type="text" class="form-control" name="contact_name'+i+'" id="contact_name'+i+'" ></div></div><div class="col-lg-2 col-md-6" id="contact-type'+i+'"><h5>Designation</h5><select class="form-control select2 item_name" name="contact_type'+i+'" id="contact_type" ><option value="">Select Your Contact</option><?php foreach($contact_type as $value){?><option value="<?php echo $value['contact_type_id']?>"><?php echo $value['contact_type_name']?></option><?php } ?></select></div><div class="col-lg-2 col-md-6" id="mobile-number'+i+'"><div class="form-group"><h5>Mobile Number</h5><input type="text" class="form-control" name="mobile_number'+i+'" id="mobile_number'+i+'" ></div></div><div class="col-lg-2 col-md-6" id="contact-email'+i+'"><div class="form-group"><h5>Email</h5><input type="email" class="form-control" name="contact_email'+i+'" id="contact_email'+i+'" ></div></div><div class="col-lg-2 col-md-6" id="remove-type'+i+'" ><div class="form-group"><h5><br></h5><input type="button" class="btn btn-info" data_id="'+i+'" id="remove_button'+i+'" value="-" onclick="remove(this.id)"></div></div>'); 
				
		$("#add").attr("data_id", i);
	});
	
	
});


</script>





