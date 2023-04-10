
<script language="javascript" type="text/javascript" src="city/city.js"></script>
    <section class="content-header">
	  <h1>
        <small>Manage</small>
		<?php echo ucfirst($foldername); ?><a href="index.php?file=city/create" class="float-right btn-sm btn-primary">Add New</a>
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
											<th>State Name</th>
											<th>District Name</th>
											<th>City Name</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>						
										<?php foreach($pdocity as $value){?>
										<tr>
											<td><?php echo $roll_id;?></td>
											<td><?php $select_state = $pdo_conn->prepare("SELECT * FROM state WHERE state_id='".$value['state_id']."' ");
												$select_state->execute();
												$state = $select_state->fetchAll();
												echo $state[0]['state_name'];
												?>
											</td>
											<td><?php $select_district = $pdo_conn->prepare("SELECT * FROM district WHERE district_id='".$value['district_id']."' ");
												$select_district->execute();
												$district = $select_district->fetchAll();
												echo $district[0]['district_name'];
												?>
											</td>
											<td><?php echo $value['city_name'];?></td>
											<td><?php if ($value['status']=='1'){ echo "Active";} else { echo "Inactive"; }?></td>
											
										   <td> 
										  <a href="index.php?file=city/update&city_id=<?php echo $value['city_id']?>" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  	
										  <a href="#" onclick="del(<?php echo $value['city_id']?>)" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
										  
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
