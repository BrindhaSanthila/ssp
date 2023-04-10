    <section class="content-header">
	  <h1>
        <small>Manage</small>
		<?php echo ucfirst($foldername); ?><a href="index.php?file=customer/create" class="float-right btn-sm btn-primary">Add New</a>
      </h1>	  
    </section>
    
    <?php 
            $select_customer_profile = $pdo_conn->prepare("SELECT * FROM customer_profile WHERE delete_status='0' ORDER BY customer_id DESC");
            $select_customer_profile->execute();
            $customer_profile = $select_customer_profile->fetchAll();
            $roll_id=1;
        ?>


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
						<tr class="bold">
							<th>#</th>
							<th>Coustomer Name</th>
							<th>Billing Address</th>
							<th>Gst Number</th>
							<th>Pan Number</th>
							<th>Landline Number</th>
							<th>View</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>						
                       <?php foreach($customer_profile as $value){?>
					   
                          <tr>
							<td><?php echo $roll_id;?></td>
							
							<td><?php echo $value['company_name'];?></td>
							<td><?php echo $value['billing_address'];?></td>
							<td><?php echo $value['gst_num'];?></td>
							<td><?php echo $value['pan_num'];?></td>
							<td><?php echo $value['landline_num'];?></td>
							
							<td><a id="customer_view_modal" onclick="customer_view_modal('<?php echo $value['customer_id'];?>')" data-toggle="modal" data-target="#customer_view"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                           <td> 
				<!---		  <a title="Print" id="<?php echo $value['customer_id'];?>" onclick="customer_print('customer/customer_print.php','<?php echo $value['customer_id'];?>')"><i class="fa fa-print" aria-hidden="true"></i></a>  ---->
						  <a href="index.php?file=customer/update&customer_id=<?php echo $value['customer_id']?>" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  	
                          <a href="#" id="<?php echo $value['customer_id']?>" onclick="del(<?php echo $value['customer_id']?>)" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
						  
						  </td>
						</tr>
                        <?php $roll_id++;} ?>
						
						
					</tbody>				  
					
				</table>
				</div>  
                   <div class="modal fade" id="customer_view">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header" style="padding-bottom: 0px;border: 0px;">
    
                      <h3 class="modal-title"></h3>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body" style="padding-top: 0px;">
                    	<div id="customer_view_modal_body">
                        	
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                              <a href="#" class="float-right btn btn-primary" data-dismiss="modal">Close</a>
                    </div>                    
                  </div>
                </div>
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
function del(customer_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "customer/curd.php",
			data: "customer_id="+customer_id+"&action="+"Delete",
			success: function(msg){ 
			alert(msg);
			window.location.href="index.php?file=customer/list";
			}});
	}

}
function customer_view_modal(customer_id){
	 jQuery.ajax({
			type: "POST",
			url: "customer/customer_view.php?action=CUSTOMER_VIEW",
			data: "customer_id="+customer_id,
			success: function(msg){ 
			//alert(msg);
			$("#customer_view_modal_body").html(msg);
			}
		});
}
function customer_print(url, customer_id)
{
	window.open(url+'?salesentry_id='+customer_id,'onmouseover','height=450,width=900,scrollbars=yes,resizable=no,left=200,top=150,toolbar=no,location=no,directories=no,status=no,menubar=no');
}

</script>
<style>
.modal-content {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 106%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 0.3rem;
    outline: 0;
}
/*.modal-header {
    border-bottom-color: #f5514e;
    color: #f5514e;
}*/
.tr-bg {
    color: #447c09;
    font-weight: 700;
}
tr.padng {
    color: #ef5350;
}
td.style3 {
    color: black;
	font-weight:600;
}
tr {
    color: black;
}
tr.bold th {
    font-weight: 600;
}
.modal-header {
    padding: 10px;
}

</style>
