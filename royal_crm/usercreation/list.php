<script language="javascript" type="text/javascript" src="usercreation/usercreation.js"></script>   
    <section class="content-header">
      <h1>
        <small>Manage</small>
		 <?php echo ucfirst($foldername); ?> <a href="index.php?file=usercreation/create" class="float-right btn-sm btn-primary">Add New</a>
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
							<th>Full Name</th>
							<th>Address</th>
							<th>City </th>
							<th>State</th>
							  <th>Action</th>
						</tr>
					</thead>
					<tbody>
						<!--<tr>
							<td>1.</td>
							<td>Tiger Nixon</td>
							<td>hgds</td>
							<td>Erode</td>
							<td>Tamilnadu</td>
							<td>9876543210</td>
							<td>Master</td>
                            <td>user</td>
                            <td>987654</td>
                             <td>Active</td>
                           <td> 
						  <a href="index.php?file=usercreation/view" title="Edit"><i class="fa fa-eye" aria-hidden="true"></i></a>  
						  <a href="index.php?file=usercreation/update" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  	
                          <a href="#" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
						  
						  </td>
						</tr>//-->
                        <?php foreach($pdousercreation as $value){ ?>
                        <tr>
							<td><?php echo $roll_id;?></td>
							<td><?php echo $value['full_name'];?></td>
							<td><?php echo $value['address'];?></td>
							<td><?php 
							         $select_city=$pdo_conn->prepare("SELECT * FROM city WHERE city_id='".$value['city']."' ");
                                     $select_city->execute();
                                     $city=$select_city->fetchAll();
						             echo $city[0]['city_name'];
							?></td>
							<td><?php 
							         $select_state = $pdo_conn->prepare("SELECT * FROM state WHERE state_id='".$value['state']."' ");
                                     $select_state->execute();
                                     $state = $select_state->fetchAll();
									 echo $state[0]['state_name'];
							
						    ?></td>
                           <td> 
<!--						  <a href="index.php?file=usercreation/view&usercreation_id=<?php echo $value['usercreation_id']?>" title="Edit"><i class="fa fa-eye" aria-hidden="true"></i></a>  
-->						  <a href="index.php?file=usercreation/update&usercreation_id=<?php echo $value['usercreation_id']?>" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  	
                          <a href="#" onclick="del(<?php echo $value['usercreation_id']?>)"title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
						  
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
