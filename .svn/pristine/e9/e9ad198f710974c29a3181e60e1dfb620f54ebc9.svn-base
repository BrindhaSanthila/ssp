<style>
.size
{
	width:335px;
	height:35px;
}
</style>

<?php error_reporting(0);

		$select_category=$pdo_conn->prepare("SELECT * FROM category ORDER BY category_id ASC");
		$select_category->execute();
		$selectcategory = $select_category->fetchAll();
		
		$select_brand=$pdo_conn->prepare("SELECT * FROM brand ORDER BY brand_id ASC");
		$select_brand->execute();
		$selectbrand = $select_brand->fetchAll();

		$segment=$pdo_conn->prepare("SELECT * FROM segment ORDER BY segment_id ASC");
    	$segment->execute();
    	$segment = $select_segment->fetchAll();
		
 ?>
                        
<div class="row" id="sub-frm">
<div class="list" id="">
<form id="form1" class="was-validated" name="sub-form" method="post">
<input type="hidden" id="curr_usr_id" name="curr_usr_id" value="<?php echo $_GET['customer_id']; ?>" />
<table class="table table-bordered table-striped" width="100%">
    <thead>
        <tr>
           
			<td width="184">Category <span class="star">*</span></td>
			<td width="149">Brand <span class="star">*</span></td>
            <td width="150">Segment<span class="star">*</span></td>
        </tr>
    </thead>
	<tbody>
		
   
		<tr>
            
            <td>
            	<select class="form-control select2 item_name" name="category_id" id="category_id" onchange="segment_list(category_id.value)" required style="width: 270px;">
                	<option value="">Select Category</option>
                <?php  foreach($selectcategory as $value){ ?>
                    	<option value="<?php echo $value['category_id'] ?>"><?php echo $value['category_name'] ?></option>
                <?php   }	?>
				</select>
            </td>
               
            <td>
				
				
				<select class="form-control select2 item_name" name="brand_id" id="brand_id"  required style="width: 270px;">
                	<option value="">Select Brand Name</option>
                <?php  foreach($selectbrand as $value){ ?>
                    	<option value="<?php echo $value['brand_id'] ?>"><?php echo $value['brand_name'] ?></option>
                <?php   }	?>
				</select>
			</td> 
			
			<td>
            	<div id="segment_name_list" name="segment_name_list">
	            	<select class="form-control select2 item_name" name="segment_id" id="segment_id"  style="width: 270px;">
                    
	               	 <option value="">Select Segment Name</option>
	               	 	
	                </select> 
                </div>

			</td>

		</tr>
	</tbody>
</table>

<table class="table table-bordered table-striped" width="100%">
	<thead>
		<tr>
			<td align="left">Product Name </td>
			<td align="left">Dosage </td>
            <td align="left">GPL % </td>
            <td align="left">Rate </td>
			 
            <td width="65" colspan="4">Action </td>
		</tr>
	</thead>	
	<tbody>
		<tr>
			<td>
				<input type="text" class="form-control numeric" name="product_name" id="product_name" placeholder="Product Name" style="width: 191px;">
			</td>
              
			<td> 
				<input type="text" class="form-control numeric" name="dosage" id="dosage" placeholder="Dosage" value="" style="width: 191px;">   
            </td>
            
            <td>
				<input type="text" class="form-control numeric" name="gpi" id="gpi" placeholder="GPL %" value="" style="text-align:right; width: 191px;" >   
            </td>
		   
			<td>
				<input type="text" class="form-control numeric" name="rate" id="rate" placeholder="Rate" value="" style="text-align:right; width: 191px;" >   
			</td>
           
		   
		   
           
            <td align="center" colspan="2">
					
					<input type="button" class="btn btn-primary btn-sm green" id="btn" onclick="chemical_add('','chem_add')" value="ADD">
			</td>
        </tr>
	 </tbody>
</table>

<table class="table table-bordered table-striped" width="100%">
	
	<thead>
						<tr>
							<th>#</th>
							<th>Category</th>
							<th>Brand</th>
							<th>Segment</th>
							<th>Product Name</th>
							<th>Dosage</th>
							
							<th>GPL %</th>
							<th >Rate</th>
							
							<th colspan="4">Action</th>
						</tr>
					</thead>

	 <tbody id="list">
	 
	  <?php if($_GET['customer_id']!=''){ 

	  	//echo "SELECT * FROM chemical_using where delete_status!='1' AND customer_id=".$_GET['customer_id']);
	  
	  $pdo_chem_use = $pdo_conn->prepare("SELECT * FROM chemical_using where delete_status!='1' AND customer_id=".$_GET['customer_id']);
	 
      $pdo_chem_use->execute();
      $chem_use= $pdo_chem_use->fetchAll();
	  $i=0;
	  foreach($chem_use as $value){ ?>
		  
		  <tr>
					<td align='left'>
						<label for='form-field-1' class='no-padding-right control-label col-sm-20'><?php echo $i = $i+1 ; ?></label>
					</td>
					
					<?php 	$pdo_cat_name = $pdo_conn->prepare("SELECT * FROM category where category_id=".$value['category_id']);
							$pdo_cat_name->execute();
							$cat_name= $pdo_cat_name->fetchAll(); ?>
					
					<td id='ct'><?php echo $cat_name[0]['category_name']; ?></td>
					<?php 	$pdo_brnd_name = $pdo_conn->prepare("SELECT * FROM brand where brand_id=".$value['brand_id']);
							$pdo_brnd_name->execute();
							$brnd_name= $pdo_brnd_name->fetchAll(); ?>
					
					<td><?php echo $brnd_name[0]['brand_name']; ?></td> 
					
					<?php 	
							$ct=$value["category_id"];
							$sg=$value["segment_id"];
							
							$pdo_seg_name = $pdo_conn->prepare("SELECT * FROM segment where category_id=$ct AND segment_id=$sg");
							$pdo_seg_name->execute();
							$seg_name= $pdo_seg_name->fetchAll(); ?>
					
					<td><?php echo $seg_name[0]['segment_name']; ?></td>
					<td><?php echo $value['product_name']; ?></td>
					<td><?php echo $value['dosage']; ?></td>
					<td><?php echo $value['gpi']; ?></td>
					<td><?php echo $value['rate']; ?></td>
					<td align='center'>
							<a href='#'onclick='sub_edit("<?php echo $value['chemical_using_id']; ?>")'>Edit</a>
					</td>
					<td align='center'>
							<a href='#'onclick='sub_delete("<?php echo $value['chemical_using_id']; ?>")'>Delete</a>
					</td>
			
				</tr> <?php 
				}
	  }
		  
	  
	  ?>
	 
	 </tbody>
</table>


	
	
							<div class="col-md-12 ">
								<div class="form-group">
									   <h5>Description</h5>
									   <div class="controls">
											<textarea class="form-control" name="description" id="description" onchange="validation(this.id)" ><?php echo $updateresult[0]['description'];?></textarea>
										</div>
								</div>
							</div>
							
							<div class="col-md-8 ">
								<div class="form-group"><br>
									   <h5>Term and Condition Description</h5>
									   <div class="controls">
											<textarea class="form-control" name="term_condition" id="term_condition" onchange="validation(this.id)" ><?php echo $updateresult[0]['term_condition'];?></textarea>
										</div>
								  </div>
						</div>
</form>
</div>
</div>