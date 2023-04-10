<script language="javascript" type="text/javascript" src="sms/sms.js"></script>
<section class="content">
<div class="col">

	<div class="box">
		<!-- /.box-header -->
		<div class="box-body">
			<form class="was-validated"  name="userroll" autocomplete="off">
				<div class="row">
					<div class="col-md-6 ">
					<div class="form-group">
					<h5>SMS Type</h5>
					<div class="controls">
					<select name="sms_type" id="sms_type" class="form-control" required="">
					<option value="">Select</option>
					<option value="Enquiry">Enquiry</option>
					<option value="Quotation Prepared">Quotation Prepared</option>
					<option value="Quotation Not Confirmed">Quotation Not Prepared</option>
					<option value="Quotation Approved">Quotation Approved</option>
					<option value="Order Confirmed">Order Confirmed</option>
					<option value="Invoice Generation">Invoice Generation</option>
					<option value="Delivered">Delivered</option>
                    <option value="Customer Satisfication">Customer Satisfication</option>
                    <option value="Sales Coordinator">Sales Coordinator</option> 
                    <option value="Accounts">Accounts</option> 
                    <option value="Production">Production</option>
                    <option value="Store">Store</option>
					</select>
					</div>
					</div>	
					<div class="form-group">
					<h5>Mobile Number </h5>
					<div class="controls">
					<input type="text" name="mobile_no" id="mobile_no" onkeyup="validation(this.id)" class="form-control">
					<div id="roll_name_error"></div>
					</div>
					</div>

					<div class="form-group">
					<h5>Message </h5>
					<div class="controls">
					<textarea id="message" name="message" style="width: 100%;height: 110px"></textarea>
					 
					<div id="roll_name_error"></div>
					</div>
					</div>                                        
					<div class="form-group">
					<h5>Active Status  </h5>
					<div class="controls">
					<select name="active_status" id="active_status" class="form-control" required>
					<option value="1">Active</option>
					<option value="0">Inactive</option>
					</select>
					</div>
					</div>
					</div>
				</div>
				<a href="index.php?file=sms/list" class="float-left btn btn-primary">Cancel</a>
				<?php if($updateresult==''){?>
				<button type="buton" class="float-right btn btn-success" id="add" onclick="sms('','Add')">Save</button>
				<?php }else{?>
				<button type="button" class="float-right btn btn-success" id="add" onclick="sms('<?php echo $updateresult[0]['sms_id'];?>','Update')">Update</button>
				<?php }?>
			</form>
		</div>
		<!-- /.box-body -->
		<div id="userrole_list"></div>
		<div id="distinct_error" style="color:red"></div>
	</div>
</div>
</section>
<?php if($updateresult!=''){?>
<script>
document.getElementById("sms_type").value ="<?php echo $updateresult[0]['sms_type'];?>";
document.getElementById("mobile_no").value ="<?php echo $updateresult[0]['mobile_no'];?>";
document.getElementById("message").value ="<?php echo $updateresult[0]['message'];?>";
document.getElementById("active_status").value ="<?php echo $updateresult[0]['active_status'];?>";
</script>
<?php } ?>


