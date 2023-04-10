
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

<script language="javascript" type="text/javascript" src="category/category.js"></script>

    <!-- Main content -->
    <section class="content">
		
		<div class="col">
            <div class="box">
       
       
			<!-- /.box-header -->
			<div class="box-body">
        
       
        
				<form class="was-validated" name="category" autocomplete="off">
					<div class="row">
        
         
						<div class="col-md-12 ">
							<div class="col-lg-6">
							  <div class="form-group">
								   <h5>Category Name </h5>
								   <div class="controls">
								   <input type="text"name="category_name" id="category_name"  class="form-control" onchange="validation(this.id)" required>
									</div>
							  </div>
							 </div>
							</div>
						
						 
						<div class="col-md-12">
							<div class="col-lg-6">
								<h5>Status</h5>
								 <div class="controls">
								<select name="status" id="status"  class="form-control"   required>
								<option value="1">Active</option>
								<option value="0">Inactive</option>
								</select>
							</div>
						</div>
					</div>
					
                      <div class="col-md-12 ">
							<div class="col-lg-6">
							  <div class="form-group">
								   <h5>Description </h5>
								   <div class="controls">
							<textarea  name="description" id="description"  class="form-control" onkeyup="validation(this.id)" ><?php echo $updateresult[0]['description'];?></textarea>
									</div>
							  </div>
							 </div>
						
						</div>
						<div class="col-md-12"><br><br>
							<a href="index.php?file=category/list" class="float-left btn btn-primary">Cancel</a>
							<?php if($updateresult==''){?>
							<button type="button" class="float-right btn btn-success" onclick="category_cu('','Add')">Save</button>
							<?php }else{?>
							<button type="button" class="float-right btn btn-success" onclick="category_cu('<?php echo $updateresult[0]['category_id']?>','Update')">Update</button>
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
document.getElementById("category_name").value ="<?php echo $updateresult[0]['category_name'];?>";
document.getElementById("description").value ="<?php echo $updateresult[0]['description'];?>";
document.getElementById("status").value ="<?php echo $updateresult[0]['status'];?>";
</script>
<?php }?>