<script language="javascript" type="text/javascript" src="sms/sms.js"></script> 
    <section class="content-header">
      <h1>
        <small>Manage SMS</small>
		  <a href="index.php?file=sms/create" class="float-right btn-sm btn-primary">Add New</a>
      </h1>
    </section>


    <!-- Main content -->
      <section class="content">
      <div class="row">
        <div class="col-12">         
          <div class="box">            
            <!-- /.box-header -->
            <div class="box-body">
    <?php
    $select_sms=$pdo_conn->prepare("SELECT * FROM sms WHERE delete_status!='1'  ORDER BY sms_id DESC");
  $select_sms->execute();
  $sms=$select_sms->fetchAll();
  $roll_id=1;
    ?>        	
				<div class="table-responsive">               
					<table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">
					<thead>
						<tr>
							<th>#</th>
							<th>SMS Type</th>
							<th>Mobile No</th>
							<th>Message</th>
							<th>Active Status</th>
                            <th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($sms as $value)
						{ 
						?>
							<tr>
							  <td><?php echo $roll_id;?></td>
							  <td><?php echo $value['sms_type'];?></td>
							   <td><?php echo $value['mobile_no'];?></td>
							    <td><?php echo $value['message'];?></td>
							  <td><?php if ($value['active_status']=='1'){ echo "Active";} else { echo "Inactive"; }?></td>
							  <td> 
								<a href="index.php?file=sms/update&sms_id=<?php echo $value['sms_id']?>" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  	
								<a href="#" onclick="del(<?php echo $value['sms_id']?>)" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
							  </td>
							</tr>								
						<?php 
						$roll_id+=1;
						} 
						?>
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
