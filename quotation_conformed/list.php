<?php
 

$cr_dt=date("Y-m-d");

if($_GET['from_date']=="" && $_GET['to_date']=="" ){
	$query = "  and date='".$cr_dt."'";
}
else{
$query = " and date between '".$_GET['from_date']."' AND '".$_GET['to_date']."'";
}
if($_GET['customer_id']!='')
{
	$query.=" and customer_id='".$_GET['customer_id']."'";

}
if($_GET['staffcreation_id']!='')
{
	$query.=" and usercreation_id='".$_GET['staffcreation_id']."'";
}
?>
 
    
       <div class="box-body">
       	 <h3>   Quotation Approval List</h3>
		<form class="was-validated" name="project_report" autocomplete="off" method="post" action="list_view.php">
		<div class="container">
        <div class="row">
		
        
        <div class="col-md-3  ">
			<div class="form-group">
				   <h5>From Date</h5>
				   <div class="controls">
                        <input type="date" name="from_date" id="from_date" class="form-control" value="<?php if($_GET['from_date']!=""){ echo $_GET['from_date'];  } else{ echo $cr_dt; } ?>" required>
					</div>
			</div>
		</div>
		 
		<div class="col-md-3  ">
			<div class="form-group">
				   <h5>To Date </h5>
				   <div class="controls">
                        <input type="date" name="to_date" id="to_date" class="form-control" value="<?php if($_GET['to_date']!=""){ echo $_GET['to_date'];  } else{ echo $cr_dt; } ?>" required>
					</div>
			</div>
		</div>


		<div class="col-md-2 ">
			<div class="form-group">
				   <h5>Customer Name</h5>
				   <div class="controls">
                        <select id="customer_id" name="customer_id" class="form-control select2" >
	        <option value="">Select Customer</option>
	        <?php 
	        
             $customr_list=$pdo_conn->prepare("SELECT customer_name,customer_id,mobile_no FROM customer_creation where delete_status!='1' ");
	        $customr_list->execute();
	        $customers=$customr_list->fetchAll();

	          foreach ($customers as $record) { ?>
	          <option value="<?php echo $record['customer_id'];  ?>" <?php if($_GET['customer_id']==$record['customer_id']) { echo  "Selected"; } ?> ><?php echo $record['customer_name']; ?></option>
	           
	        <?php }  
 
	      
	       ?>
	      </select>  
					</div>
			</div>
		</div>

		<div class="col-md-2 ">
			<div class="form-group">
				   <h5>Executive </h5>
				   <div class="controls">
                        <select class="select2" name="staffcreation_id" id="staffcreation_id" >
						<option value="">Select Executive Name</option>
					<?php	
					$staffcreation = $pdo_conn->prepare("SELECT staff_name,staffcreation_id,staff_type FROM staffcreation  WHERE delete_status='0' ");
					$staffcreation->execute();
					$staff_list = $staffcreation->fetchAll();
						  	foreach($staff_list as $value)	{ 
					 
					 
					 ?>
						<option value="<?php echo $value['staffcreation_id']; ?>" <?php if($_GET['staffcreation_id']==$value['staffcreation_id']) { echo  "Selected"; } ?>><?php echo $value['staff_name']?></option>
					<?php 	} ?>
					</select>	
					</div>
			</div>
		</div>
		 
		 
		 
		<div class="col-md-2 col-lg-2">
			<h5><br></h5>
			<div class="form-group">
				<input type="button" name="" id="" onclick="quotation_confirm_list()" class="form-control btn-info" value="GO" >
				
			</div>
			
        </div>

		
		</div>
		</div>
		</form>
		</div>
   
    <!-- Main content -->
         <section class="content">
      <div class="row">
        <div class="col-12">
         
          <div class="box">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
         <td><a onclick="javascript:all_fee_report_print_approval('quotation_conformed/approval_print.php?from_date='+from_date.value+'&to_date='+to_date.value+'&customer_id='+customer_id.value+'&staffcreation_id='+staffcreation_id.value+'');" style="float:right;margin-right:20px;"><img  align="right" src="images/report_print.png" width="35" height="35" border="0" title="PRINT"></a></td>
    </tr>
</table>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">               
				  <table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">
					<thead>
						<tr>
							<th>#</th>
							<th>Quotation No</th>
							<th>Confirm No</th>
							<th>Staff Name</th>
							<th>Customer Name</th>
							<th>Total Amount</th>
							<!--<th>Status</th>
							<th>Approval Status</th>-->
							<th>File</th>
							<th>Order Details</th>
							 
							 
						</tr>
					</thead>
					<tbody>						
                        <?php 
                        $select_quotation=$pdo_conn->prepare("SELECT sum(final_amount) as amount,enquiry_id,quotation_number,usercreation_id,confirm_status,date,customer_id  FROM quotation WHERE   confirm_status='Approved' $query group by enquiry_id   ORDER BY quotation_id DESC ");
                        $select_quotation->execute();
                        $quotation = $select_quotation->fetchAll();
                        foreach($quotation as $value){ 
                          $quotation_pdf=$pdo_conn->prepare("SELECT * FROM enquiry_pdf WHERE quotation_number='$value[quotation_number]' and enquiry_id='$value[enquiry_id]'");
                          $quotation_pdf->execute();
                          $pdf = $quotation_pdf->fetch();
                          
                           $order=$pdo_conn->prepare("SELECT * FROM  order_confirm WHERE quotation_number='$value[quotation_number]' and enquiry_id='$value[enquiry_id]'");
                          $order->execute();
                          $order_no = $order->fetch();?>
                          <tr>
						    <td><?php echo $roll_id;?></td>
							<td><?php echo $value['quotation_number']; ?></td>
							<td><?php echo $order_no['confirm_number']; ?></td>
							<td><?php echo get_staff_name($value['usercreation_id']);?></td>
							<td><?php echo get_customer_name($value['customer_id']); ?></td>
						    <td><?php echo number_format($value['amount'],2); ?></td>
						 <!--   <td></td>
						    <td></td>-->
 <td><?php if($pdf['quotation_pdf']!=""){?><a href="javascript:pdf_view('<?php echo $image_path_back."quotation/".$pdf['quotation_pdf']; ?>');" title="View Material"><img src="images/pdf.png" id='picture' name='picture' style="width: 50px; height: 50px;" ></a><?php } else { ?><img src="images/images.jpg" id='picture' name='picture' style="width: 50px; height: 50px;" ><?php } ?></td> 							  <td>
							  	<a id="quotation_view_modal" onclick="quotation_view_modal('<?php echo $value['enquiry_id'];?>','<?php echo $value['quotation_number']; ?>')" data-toggle="modal" data-target="#quotation_view">
							  	  <i class="fa fa-eye" aria-hidden="true"></i>
							  	</a>
							  </td>
							</div> 
						  </tr>
						<?php $roll_id+=1;}?>		
					</tbody>				  
				</table>


							<!-- open modal popup for enquiry item view -->
			<!-- <div class="modal fade" id="order_view">
            <div class="modal-dialog modal-lg">
              <div class="modal-content"> -->
                <!-- Modal Header -->
                <!-- <div class="modal-header">
                  <h3 class="modal-title">Enquiry Item View</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div> -->
                <!-- Modal body -->
                <!-- <div class="modal-body">
                	<div id="order_view_modal_body"></div>
                </div> -->
                <!-- Modal footer -->
                <!-- <div class="modal-footer">
                          <a href="#" class="float-right btn btn-primary" data-dismiss="modal">Close</a>
                </div>                    
              </div>
            </div>
          </div>  -->
		  <!-- open modal popup ends -->
 <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
        	  
		  
		  				 
			<div class="modal fade" id="quotation_view">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
               
                <div class="modal-header">
                  <h3 class="modal-title">Order List</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                 <div class="modal-body">
                	<div id="quotation_view_modal_body"></div>
                </div>  
                 
                  <div class="modal-footer">
				  <a href="#" class="float-right btn btn-primary" data-dismiss="modal">Close</a>
                </div>                    
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
function quotation_confirm_list(){
	
	var from_date =$('#from_date').val();
	var to_date =$('#to_date').val();
	var customer_id=$("#customer_id").val();
	var staffcreation_id=$("#staffcreation_id").val();
	var format ="from_date="+from_date+"&to_date="+to_date+"&customer_id="+customer_id+"&staffcreation_id="+staffcreation_id;
	
	window.location.href = "index.php?file=quotation_conformed/list&"+format;
//window.location.href = "index.php?file=projectlist/list&"+format;
}
function order_view(url, order_id)
    {
	alert("test");
	window.open(url+'?order_id='+order_id,'onmouseover','height=650,width=950,scrollbars=yes,resizable=no,left=250,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no');	
    }
	 
//$( "p" ).click(function() {
  //$( this ).replaceWith( $( "b" ) );
//});

function all_fee_report_print_approval(url)
{
  onmouseover= window.open(url,'','height=450,width=950,scrollbars=yes,left=320,top=120,toolbar=no,location=no,directories=no,status=no,menubar=no');
}
	function quotation_view_modal(enquiry_id,quotation_number){
		
	// alert("enquiry no is: " + enquiry_no);
	 jQuery.ajax({
			type: "POST",
			url: "quotation_conformed/quotation.php?",
			data: "enquiry_id="+enquiry_id+"&quotation_number="+quotation_number,
			// alert(enquiry_id);
			success: function(msg){ 
			// alert(msg);
			$("#quotation_view_modal_body").html(msg);
			}
		});
}	


function pdf_view(url)
  {
  onmouseover55= window.open(url,'onmouseover55','height=450px,width=650px,scrollbars=yes,resizable=no,left=420,top=190,toolbar=no,location=no,directories=no,status=no,menubar=no');
  }
 
</script>
