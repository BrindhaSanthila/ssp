	<script language="javascript" type="text/javascript" src="special_days/special_days.js"></script>
	
	<section class="content-header">
	  <h1>
        <small>Manage</small>
		<?php echo "Special Days" ?><a href="index.php?file=special_days/create" class="float-right btn-sm btn-primary">Add New</a>
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
					<div class="pint_btn">
			        
					</div>   
					<thead>
						<tr class="bold">
							<th>#</th>
							<th>Date</th>
							<th>Special Days Name</th>
							<th>Religion</th>
							<th>SMS Content</th>
							<th>Email Content</th>
							<th>Description</th>
							<th>Email Status</th>
							<th>SMS_Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>						
                        <?php 
							$roll_id = 1;
							
							$select_special_days=$pdo_conn->prepare("SELECT * FROM  special_days order by special_id desc ");
							$select_special_days->execute();
							$special_days = $select_special_days->fetchAll();
								 
								  foreach($special_days as $value)
							{?>
							
                      
                           <tr>
						    <td><?php echo $roll_id;?></td>
							
							<td><?php echo date("d-m-Y",strtotime($value['date']));?>	</td>
							<td><?php echo $value['special_day_name'];?></td>
							
							<?php 
							$select_religion = $pdo_conn->prepare("SELECT * FROM religion WHERE religion_id='".$value['religion_id']."' ");
							$select_religion->execute();
							$religion = $select_religion->fetchAll();
							?>
							<td><?php echo $religion[0]['religion_name'];?></td>
                           <td><?php echo $value['sms_content'];?></td>
						   <td><?php echo $value['email_content'];?></td>
						   <td><?php echo $value['description'];?></td>
						   <td><?php if ($value['email_status']=='1'){ echo "Active";} else { echo "Inactive"; }?></td>
						   <td><?php if ($value['sms_status']=='1'){ echo "Active";} else { echo "Inactive"; }?></td>
                                
                           <td> 
<!--						  <a href="index.php?file=state/view&state_id=<?php echo $value['special_id']?>" title="Edit"><i class="fa fa-eye" aria-hidden="true"></i></a> 

-->				<?php if($count <=1)  {?>  <a href="index.php?file=special_days/update&special_id=<?php echo $value['special_id']?>" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  <?php } ?>	
                          <a href="#" onclick="del(<?php echo $value['special_id']?>)" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
						  
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
  

<style>
tr.bold th {
    font-weight: 600;
}
.pint_btn button {
    background: #447c09;
    color: white;
    padding: 8px;
    width: 80px;
    border: 0px;
    font-weight: 600;
    float: left;
}
.pint_btn i {
    padding-right: 10px;
    font-size: 17px;
}
</style>