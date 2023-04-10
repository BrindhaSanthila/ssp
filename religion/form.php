
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

<script language="javascript" type="text/javascript" src="religion/religion.js"></script>

		<section class="content">
		
			<div class="col">
                <div class="box">
					<div class="box-body">
        
						<form class="was-validated" name="religion" autocomplete="off">
							<div class="row">
 
        
								<div class="col-md-12 ">
									<div class="col-lg-6">
									  <div class="form-group">
										   <h5>Religion Name </h5>
										   <div class="controls">
												<input type="text"  name="religion_name" id="religion_name"  class="form-control" onchange="validation(this.id)"  required>
											</div>
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

         
								<div class="col-md-12"><br><br>
									<a href="index.php?file=religion/list" class="float-left btn btn-primary">Cancel</a>
									<?php if($updateresult==''){?>
									<button type="button" class="float-right btn btn-success" onclick="religion_cu('','Add')">Save</button>
									<?php }else{?>
									<button type="button" class="float-right btn btn-success" onclick="religion_cu('<?php echo $updateresult[0]['religion_id']?>','Update')">Update</button>
									<?php }?>
								</div>
         

							</div>
						</form>
                
					</div>
                
				</div>

			</div>
			 
		
		</section>
    
<?php if($updateresult!=''){?>
<script>
document.getElementById("religion_name").value ="<?php echo $updateresult[0]['religion_name'];?>";
document.getElementById("status").value ="<?php echo $updateresult[0]['status'];?>";
</script>
<?php }?>