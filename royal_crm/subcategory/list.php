   
   <script language="javascript" type="text/javascript" src="subcategory/subcategory.js"></script>
   
   <section class="content-header">
	  <h1>
        <small>Manage</small>
		<?php echo ucfirst($foldername); ?><a href="index.php?file=subcategory/create" class="float-right btn-sm btn-primary">Add New</a>
      </h1>	  
    </section>

 
    


    <!-- Main content -->
         <section class="content">
      <div class="row">
        <div class="col-12">
         
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">               
				  <table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">
					<thead>
						<tr>
							<th>#</th>
							<th>Category Name</th>
							<th>SubCategory Name</th>
							<th>Status</th>							
              <th>Action</th>
						</tr>
					</thead>
					<tbody>						
                        <?php foreach($pdosubcategory as $value){?>
                        
                           <tr>
						    <td><?php echo $roll_id;?></td>
							
							<td><?php $select_category = $pdo_conn->prepare("SELECT * FROM category WHERE category_id='".$value['category_id']."' ");
                                      $select_category->execute();
                                      $category_name = $select_category->fetch();
						              echo $category_name['category_name'];
								?>
							</td>
							<td><?php echo $value['subcategory_name'];?></td>
							<td><?php if ($value['status']=='1'){ echo "Active";} else { echo "Inactive"; }?></td>
							
                           <td> 
					  <a href="index.php?file=subcategory/update&subcategory_id=<?php echo $value['subcategory_id']?>" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  	
                          <a href="#" onclick="del(<?php echo $value['subcategory_id']?>)" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
						  
						  </td>
						</tr>
                        
						<?php $roll_id+=1;}?>		
						
					</tbody>				  
					
				</table>
				</div>              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
	<!-- /.content -->
