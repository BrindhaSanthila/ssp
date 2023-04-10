<?php

error_reporting(0);  
$roll_id=1;
$cr_dt=date("Y-m-d");

if($_GET['from_date']=="" && $_GET['to_date']=="" ){
	$query = "  date='".$cr_dt."'";
}
else{
$query = "  date between '".$_GET['from_date']."' AND '".$_GET['to_date']."'";
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
   	<h3>   Quotation List</h3>
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
				<input type="button" name="" id="" onclick="quotation_list()" class="form-control btn-info" value="GO" >
				
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
          	  <table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
         <td><a   onclick="javascript:all_fee_report_print_quotation('quotation/quotation_print.php?from_date='+from_date.value+'&to_date='+to_date.value+'&customer_id='+customer_id.value+'&staffcreation_id='+staffcreation_id.value+'');" style="float:right;margin-right:20px;"><img  align="right" src="images/report_print.png" width="35" height="35" border="0" title="PRINT"></a></td>
    </tr>
    </table>
          
            <div class="box-body">
				<div class="table-responsive">               
				  <table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">

					<thead>
						<tr>
							<th>#</th>
							<th>Date</th>
							<th>Enquiry No</th>
							<th>Quotation No</th>
							<th>Customer Name</th>
							<th>Executives</th>
							<th>Quotation Amount</th>
							<th>File</th>
							<th>Approval Status</th>
							<th>Status</th>
							<th>Quotation View</th>

						</tr>
					</thead>
<?php 
					 
                        $select_quotation=$pdo_conn->prepare("SELECT sum(amount) as amount,enquiry_id,quotation_number,usercreation_id,confirm_status,date,customer_id  FROM quotation WHERE  $query group by enquiry_id   ORDER BY quotation_id DESC ");
                        $select_quotation->execute();
                        $quotation = $select_quotation->fetchAll();
                        ?>
					<tbody>						
                        <?php foreach($quotation as $value){
 						$pdf_file=$pdo_conn->prepare("SELECT * from enquiry_pdf WHERE enquiry_id='$value[enquiry_id]' ");
                        $pdf_file->execute();
                        $pdf = $pdf_file->fetch();

                        	?>
                        
                           <tr>
						    <td><?php echo $roll_id;?></td>
						    <td><?php echo date("d-m-Y",strtotime($value['date']));?></td>
						    <td><?php echo get_enquiry_number($value['enquiry_id']);?></td>
							<td><?php echo $value['quotation_number'];?></td>
							<td><?php echo get_customer_name($value['customer_id']); ?></td>
							<td><?php echo get_staff_name($value['usercreation_id']);?></td>
							<td><?php echo number_format($value['amount'],2);?></td>
						    <td><?php if($pdf['pdf']!=""){?><a href="javascript:pdf_view1('<?php echo $image_path_back."enquiry/".$pdf['pdf']; ?>');" title="View Material"><img src="images/pdf.png" id='picture' name='picture' style="width: 50px; height: 50px;" ></a><?php } else { ?><img src="images/images.jpg" id='picture' name='picture' style="width: 50px; height: 50px;" ><?php } ?><?php if($pdf['pdf1']!=""){?><a href="javascript:pdf_view1('<?php echo $image_path_back."enquiry/".$pdf['pdf1']; ?>');" title="View Material" /><img src="images/pdf.png" id='picture' name='picture' style="width: 50px; height: 50px;" ></a><?php } ?></td>
							<td><img <?php if($value['confirm_status']=='Approved') { ?>src="images/tick.png" <?php } else { ?> src="images/deletes.png" <?php } ?> style="width: 50px; height: 50px;"></td>
							<td ><?php echo $value['confirm_status'];?></td>
							<td><a id="quotation_view_modal" onclick="quotation_view_modal(<?php echo $value['enquiry_id'] ?>,'<?php echo $value['quotation_number'] ?>')" data-toggle="modal" data-target="#quotation_view"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
							</tr>
						<?php $roll_id+=1;
						
					}?>		
					</tbody>				  
				</table>
		  
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery//3.4.1/jquery.min.js"></script>
           -->

							<!-- open modal popup -->
		<div class="modal fade" id="quotation_view">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h3 class="modal-title">Quotation View</h3>
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
function quotation_view_modal(enquiry_id,quotation_number){
	
	 jQuery.ajax({
			type: "POST",
			url: "quotation/quotation_view.php?",
			data: "enquiry_id="+enquiry_id+"&quotation_number="+quotation_number,
			// alert(enquiry_id);
			success: function(msg)
			{ 

			 
			$("#quotation_view_modal_body").html(msg);
			}
		});
}	



function quotation_list(){
	
	var from_date =$('#from_date').val();
	var to_date =$('#to_date').val();
	var customer_id=$("#customer_id").val();
	var staffcreation_id=$("#staffcreation_id").val();
	var format ="from_date="+from_date+"&to_date="+to_date+"&customer_id="+customer_id+"&staffcreation_id="+staffcreation_id;
	
	window.location.href = "index.php?file=quotation/list&"+format;
//window.location.href = "index.php?file=projectlist/list&"+format;
}
			
function all_fee_report_print_quotation(url)
{
	onmouseover= window.open(url,'','height=450,width=950,scrollbars=yes,left=320,top=120,toolbar=no,location=no,directories=no,status=no,menubar=no');
}				

	function pdf_view1(url)
  {
  onmouseover55= window.open(url,'onmouseover55','height=450px,width=650px,scrollbars=yes,resizable=no,left=420,top=190,toolbar=no,location=no,directories=no,status=no,menubar=no');
  }
	</script>
