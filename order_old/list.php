<?php
 


error_reporting(0);  
$roll_id=1;
$cr_dt=date("Y-m-d");

if($_GET['from_date']=="" && $_GET['to_date']=="" ){
  $query = "  order_date='".$cr_dt."'";
}
else{
$query = "  order_date between '".$_GET['from_date']."' AND '".$_GET['to_date']."'";
}
if($_GET['customer_id']!='')
{
  $query.=" and customer_id='".$_GET['customer_id']."'";

}
if($_GET['staffcreation_id']!='')
{
  $query.=" and staffcreation_id='".$_GET['staffcreation_id']."'";
}
?>
   
      <div class="box-body">
         <h3>   Order List</h3>
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


    <div class="col-md-5 col-lg-3">
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

    <div class="col-md-5 col-lg-3">
      <div class="form-group">
           <h5>Executive </h5>
           <div class="controls">
                        <select class="select2" name="staffcreation_id" id="staffcreation_id" >
            <option value="">Select Executive Name</option>
          <?php 
          $staffcreation = $pdo_conn->prepare("SELECT staff_name,staffcreation_id,staff_type FROM staffcreation  WHERE delete_status='0' ");
          $staffcreation->execute();
          $staff_list = $staffcreation->fetchAll();
                foreach($staff_list as $value)  { 
           
           
           ?>
            <option value="<?php echo $value['staffcreation_id']; ?>" <?php if($_GET['staffcreation_id']==$value['staffcreation_id']) { echo  "Selected"; } ?>><?php echo $value['staff_name']?></option>
          <?php   } ?>
          </select> 
          </div>
      </div>
    </div>
     
     
     
    <div class="col-md-2 col-lg-2">
      <h5><br></h5>
      <div class="form-group">
        <input type="button" name="" id="" onclick="order_list()" class="form-control btn-info" value="GO" >
        
      </div>
      
        </div>

    
    </div>
    </div>
    </form>
    </div>
   
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
							<th>Quotation No</th>
							<th>Staff Name</th>
							<th>Customer Name</th>
              <th>Amount</th>
               <th>File</th>
							<th>Order Details</th>
							 
						 
						</tr>
					</thead>
					<tbody>						
                        <?php 
                       

                        $order=$pdo_conn->prepare("SELECT   * FROM order_confirm  where $query    group by enquiry_id   ORDER BY quotation_id DESC ");
                        $order->execute();
                        $order_list = $order->fetchAll();
                        foreach($order_list as $value){

                          $quotation=$pdo_conn->prepare("SELECT sum(final_amount) as amount,quotation_number FROM quotation WHERE    enquiry_id='$value[enquiry_id]'   ");
                          $quotation->execute();
                          $quotation_list = $quotation->fetch();

                          $order_pdf=$pdo_conn->prepare("SELECT * FROM order_pdf WHERE    enquiry_id='$value[enquiry_id]'   ");
                          $order_pdf->execute();
                          $pdf = $order_pdf->fetch();
                        	?>
                        
                           <tr>
						    <td><?php echo $roll_id;?></td>
							
							<td><?php echo $quotation_list['quotation_number'];		?>			</td>				 
							
							<td><?php echo get_staff_name($value['staffcreation_id']);?></td>
							

							<td><?php echo get_customer_name($value['customer_id']);	?></td>
              <td><?php echo number_format($quotation_list['amount'],2);  ?></td>
              <td><a href="javascript:pdf_view('<?php echo $image_path_back."order/".$pdf['pdf']; ?>');" title="View Material" ><img <?php if($pdf['pdf']!='') { ?>src="images/pdf.png" <?php } else { ?> src="images/images.jpg" <?php } ?> id='picture' name='picture' style="width: 50px; height: 50px;" ></a></td>
						<div id="quotation_id">
								
							<td><a id="quotation_view_modal" onclick="quotation_view_modal('<?php echo $value['enquiry_id'] ?>','<?php echo $value['customer_id'] ?>','<?php echo  $value['staffcreation_id'] ?>','<?php echo $quotation_list['quotation_number']; ?>')" data-toggle="modal" data-target="#quotation_view"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
 
						 
						
						 
						
						</tr>
                       
						<?php $roll_id+=1;}?>		
					</tbody>				  
				</table>

 
		  
		  
		  				<!-- open modal popup for quotation view -->
			<div class="modal fade" id="quotation_view">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h3 class="modal-title">Invoice List</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                	<div id="quotation_view_modal_body"></div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
				  <a href="#" class="float-right btn btn-primary" data-dismiss="modal">Close</a>
                </div>                    
              </div>
            </div>
          </div> 
		  <!-- open modal popup ends -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

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
 
 
function order_list(){
  
  var from_date =$('#from_date').val();
  var to_date =$('#to_date').val();
  var customer_id=$("#customer_id").val();
  var staffcreation_id=$("#staffcreation_id").val();
  var format ="from_date="+from_date+"&to_date="+to_date+"&customer_id="+customer_id+"&staffcreation_id="+staffcreation_id;
  
  window.location.href = "index.php?file=order/list&"+format;
//window.location.href = "index.php?file=projectlist/list&"+format;
}
	function quotation_view_modal(enquiry_id,customer_id,staffcreation_id,quotation_number){
	 //alert(enquiry_id);
	 jQuery.ajax({
			type: "POST",
			url: "order/quotation.php?",
			data: "enquiry_id="+enquiry_id+"&customer_id="+customer_id+"&staffcreation_id="+staffcreation_id+"&quotation_number="+quotation_number,
			// alert(enquiry_id);
			success: function(msg){ 
		
			$('#quotation_view_modal_body').html(msg);
			}
		});
}	


function pdf_view(url)
  {
  onmouseover55= window.open(url,'onmouseover55','height=450px,width=650px,scrollbars=yes,resizable=no,left=420,top=190,toolbar=no,location=no,directories=no,status=no,menubar=no');
  }
</script>
