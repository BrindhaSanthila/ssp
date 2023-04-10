
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

<script language="javascript" type="text/javascript" src="itemcreation/itemcreation.js"></script>

    <!-- Main content -->
    <section class="content">
		
		<div class="col">
            <div class="box">

				<div class="box-body">

					<form class="was-validated" name="itemcreation" autocomplete="off">
						<div class="row">
        
         
							<div class="col-md-12">
						
						<div class="col-lg-6">
							<div class="form-group">
							<h5>Category</h5>
								<select class="form-control select2 item_name" name="category_id" id="category_id" onchange="categoryChange(this.value)" >
									<option value="">Select Category</option>
									<?php foreach($pdocategory as $value)
									{
										if ($_GET['item_id']=='')
										{ 
										?>
											<option value="<?php echo $value['category_id']?>"><?php echo $value['category_name']?></option>
										<?php 
										} 
										else
										{
										?>
											<option value="<?php echo $value['category_id']?>" <?php if($updateresult[0]['category_id'] == $value['category_id']){ echo "selected";} ?>><?php echo $value['category_name'];?></option>
										<?php
										}
										?>
									<?php 
									} ?>
								</select>
							</div>
						</div>
         
							<div class="col-md-12">
							<div class="col-lg-6">
								<div class="form-group">
									<h5>Subcategory</h5>
									<div id="dist_name_list" name="dist_name_list">
									<select class="form-control select2 item_name" name="subcategory_id" id="subcategory_id" required>
										<option value="">Select Subcategory</option>
										<?php 
										if( $_GET['item_id']!='')
										{ 
											foreach($updateresult1 as $result)
											{
											?>
												<option value="<?php echo $result['subcategory_id']?>" <?php if($result['subcategory_id'] == $updateresult[0]['subcategory_id']){ echo "selected";} ?>><?php echo $result['subcategory_name'];?></option>
											<?php 
											} 
										}?>
									</select>
									</div>
								</div>
							</div>
						</div>
        
							<div class="col-md-12 ">
							<div class="col-lg-6">
								<div class="form-group">
									<h5>Item Name </h5>
									<div class="controls">
										<input type="text" class="form-control" name="item_name" id="item_name"   required>
									</div>
								</div>
							</div>
						</div>

							
							<div class="col-md-12 ">
							<div class="col-md-6">
									<div class="form-group">
										 <h5>Description</h5>
										 <div class="controls">
											  <textarea  name="description" id="description"  class="form-control"   ></textarea>
										  </div>
									</div>
							  </div>
							  </div>
							  	 
         
							<div class="col-md-12">
								<div class="col-lg-6">
									<h5>Status</h5>
									<select class="form-control" name="status" id="status"    required>
									<option value="1">Active</option>
									<option value="0">Inactive</option>
									</select>
								</div>
							</div>

         
							<div class="col-md-12"><br><br>
								<a href="index.php?file=itemcreation/list" class="float-left btn btn-primary">Cancel</a>
								<?php if($updateresult==''){?>
								<button type="button" class="float-right btn btn-success" onclick="item_cu('','Add')">Save</button>
								<?php }else{?>
								<button type="button" class="float-right btn btn-success" onclick="item_cu('<?php echo $updateresult[0]['item_id']?>','Update')">Update</button>
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
document.getElementById("category_id").value ="<?php echo $updateresult[0]['category_id'];?>";
document.getElementById("subcategory_id").value ="<?php echo $updateresult[0]['subcategory_id'];?>";
document.getElementById("item_name").value ="<?php echo $updateresult[0]['item_name'];?>";
document.getElementById("description").value ="<?php echo $updateresult[0]['description'];?>";
document.getElementById("status").value ="<?php echo $updateresult[0]['status'];?>";
</script>
<?php }?>
