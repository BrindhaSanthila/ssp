   <?php $cr_dt=date("Y-m-d"); ?>
   <script language="javascript" type="text/javascript" src="assign_customer/assigncustomer.js"></script>
   <section class="content-header">
  <h1>
    <small>Manage</small>
		Assign Customer<a href="index.php?file=assign_customer/create" class="float-right btn-sm btn-primary">Add New</a>
  </h1>	  
</section>

   <div class="box-body">
		<form class="was-validated" name="project_report" autocomplete="off" method="post" action="list_view.php">
		<div class="container">
        <div class="row">
		
        
      	 
	
		
		</div>
		</div>
		</form>
		</div>
   <!-- <section class="content-header">
	  <h1>
        <small>Manage</small>
		<?php echo ucfirst($foldername); ?><a href="index.php?file=enquiry/create" class="float-right btn-sm btn-primary">Add New</a>
      </h1>	  
    </section> -->

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
							<th>Customer Name</th>
							<th>Staff Name</th>
							<th>Status</th>
							<th>Action</th>
							
						</tr>
					</thead>
<?php 
  $select_assign_customer = $pdo_conn->prepare("SELECT * FROM assign_customer WHERE status='1' ORDER BY assign_customer_id DESC");
  $select_assign_customer->execute();
  $assign_customer = $select_assign_customer->fetchAll();
  $roll_id=1;
?>

					<tbody>						
                        <?php foreach($assign_customer as $value){?>
                        
                           <tr>
						    <td><?php echo $roll_id;?></td>
						    <td><?php echo get_customer_name($value['customer_id']);?></td>
						   
                            <td><?php echo get_staff_name($value['staffcreation_id']);?></td>
							
							<td><?php if ($value['status']=='1'){ echo "Active";} else { echo "Inactive"; }?></td>
														
							
								
						<td>             
				
						  <a href="index.php?file=assign_customer/update&assign_customer_id=<?php echo $value['assign_customer_id']?>" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> 

                          <a href="#" id="<?php echo $value['assign_customer_id']?>" onclick="del(<?php echo $value['assign_customer_id']?>)" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
						  </td>
							
							
						</tr>
						<?php $roll_id+=1;}?>		
					</tbody>				  
				</table>


							<!-- open modal popup -->
			<div class="modal fade" id="order_view">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h3 class="modal-title">Enquiry Item View</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                	<div id="order_view_modal_body"></div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                          <a href="#" class="float-right btn btn-primary" data-dismiss="modal">Close</a>
                </div>                    
              </div>
            </div>
          </div> 
		  <!-- open modal popup ends -->
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

	<script>
	function order_view_modal(enquiry_no){
	// alert("enquiry no is: " + enquiry_no);
	 jQuery.ajax({
			type: "POST",
			url: "enquiry/order_view.php?",
			data: "enquiry_no="+enquiry_no,
			// alert(enquiry_id);
			success: function(msg){ 
			// alert(msg);
			$("#order_view_modal_body").html(msg);
			}
		});
}	


function quotation_list(){
	
	var from_date =$('#from_date').val();
	var to_date =$('#to_date').val();
	var format ="from_date="+from_date+"&to_date="+to_date;
	
	window.location.href = "index.php?file=quotation/list&"+format;
//window.location.href = "index.php?file=projectlist/list&"+format;
}
	</script>
