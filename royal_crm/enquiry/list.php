
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

if($_GET['status']!='')
{
    $query.=" and status='".$_GET['status']."'";
}
   ?>
   <script language="javascript" type="text/javascript" src="enquiry/enquiry.js"></script>
      <div class="box-body">
      	 <h3>
    <small> </small>
		<?php echo ucfirst($foldername); ?> List<a href="index.php?file=enquiry/create" class="float-right btn-sm btn-primary">Add New</a>
  </h3>	
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
						<option value="">Select Executive  </option>
					<?php	
					$staffcreation = $pdo_conn->prepare("SELECT staff_name,staffcreation_id,staff_type FROM staffcreation  WHERE delete_status='0'");
					$staffcreation->execute();
					$staff_list = $staffcreation->fetchAll();
						  	foreach($staff_list as $value)	{ ?>
						<option value="<?php echo $value['staffcreation_id']; ?>" <?php if($_GET['staffcreation_id']==$value['staffcreation_id']) { echo  "Selected"; } ?>><?php echo $value['staff_name']?></option>
					<?php 	} ?>
					</select>	
					</div>
			</div>
		</div>
		
	<div class="col-md-2 ">
			<div class="form-group">
				   <h5>Status </h5>
				   <div class="controls">
                        <select class="select2" name="status" id="status" >
						<option value="">Select Status  </option> 
						<option value="Pending" <?php if($_GET['status']=='Pending') { echo  "Selected"; } ?>>Pending</option>
				        <option value="Quoted" <?php if($_GET['status']=='Quoted') { echo  "Selected"; } ?>>Quoted</option>
				        <option value="Confirmed" <?php if($_GET['status']=='Confirmed') { echo  "Selected"; } ?>>Confirmed</option>
				        <option value="Enquiry Cancelled" <?php if($_GET['status']=='Enquiry Cancelled') { echo  "Selected"; } ?>>Enquiry Cancelled</option>
				        <option value="Quotation Cancelled" <?php if($_GET['status']=='Quotation Cancelled') { echo  "Selected"; } ?>>Quotation Cancelled</option>
				        <option value="Delivered" <?php if($_GET['status']=='Delivered') { echo  "Selected"; } ?>>Quotation Delivered</option>
				        <option value="100% finished" <?php if($_GET['status']=='100% finished') { echo  "Selected"; } ?>>100% finished</option>
				        <option value="Approved" <?php if($_GET['status']=='Approved') { echo  "Selected"; } ?>>Approved </option>
					</select>	
					</div>
			</div>
		</div>
		 
		 
		 
		<div class="col-md-2 col-lg-2">
			<h5><br></h5>
			<div class="form-group">
				<input type="button" name="" id="" onclick="enquiry_list()" class="form-control btn-info" value="GO" >
				
			</div>
			
        </div>

		
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
             <table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
         <td><a onclick="javascript:all_fee_report_print('enquiry/enquiry_print.php?from_date='+from_date.value+'&to_date='+to_date.value+'&customer_id='+customer_id.value+'&staffcreation_id='+staffcreation_id.value+'&status=<?php echo $_REQUEST['status']?>');" style="float:right;margin-right:20px;"><img  align="right" src="images/report_print.png" width="35" height="35" border="0" title="PRINT"></a></td>
    </tr>
</table>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">               
				  <table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">
					<thead>
						<tr>
							<th>#</th>
							<th>Date</th>
							<th>Enquiry No</th>
							<th>Quotation Numrer</th>
							<th>Executive</th>
							<th>Customer Name</th>
							<th>Mobile No</th>
							<th>Next Followup dat</th>
							<th>Location</th>
							<th>  Item List</th>
							
						
					        <th>Quotation Status</th>
					        	<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>						
                        <?php 

						$pdo_enquiry = $pdo_conn->prepare("SELECT * FROM enquiry  where $query ORDER BY enquiry_id DESC");
						$pdo_enquiry->execute();
						$pdoenquiry = $pdo_enquiry->fetchAll();
                        foreach($pdoenquiry as $value){
                        		$staff_longitude=$value['longitude'];
                        		$staff_latitude=$value['latitude'];
                        		   $select_quotation=$pdo_conn->prepare("SELECT quotation_number  FROM quotation WHERE enquiry_id='".$value['enquiry_id']."'  group by enquiry_id   ORDER BY quotation_id DESC ");
                        $select_quotation->execute();
                        $quotation = $select_quotation->fetch();
                    
                        	?>
                        
                           <tr>
						    <td><?php echo $roll_id;?></td>
							<td><?php echo date("d-m-Y",strtotime($value['date']));?></td>
							<td><?php echo $value['enquiry_no'];?></td>
								<td><?php echo $quotation['quotation_number'];?></td>
							<td><?php echo get_staff_name($value['usercreation_id']);?></td>
						    <td><?php echo get_customer_name($value['customer_id']);?></td>
							
							<td><?php echo get_customer_mobileno($value['customer_id']);?></td>
                            <td><?php echo  date('d-m-Y',strtotime(get_followup_date($value['enquiry_id'])));?></td>
							<td><?php if(($staff_longitude!='')&&($staff_latitude!='')) {?>
			                  <div align="center">
			                  <a onclick="print_google_map('enquiry/map.php?staff_latitude=<?php echo $staff_latitude; ?>&staff_longitude=<?php echo $staff_longitude; ?>');" target="new">
			                  <img src="images/map.png" height="30" width="30">
			                  </a></div><?php }?>
			              </td>

							<td><a id="order_view_modal" onclick="order_view_modal(<?php echo $value['enquiry_id'] ?>)" data-toggle="modal" data-target="#order_view"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
							
							<!-- <td><?php if ($value['status']=='1'){ echo "Active";} else { echo "Inactive"; }?></td> -->
							
							<td><a id="quotation_view_modal" onclick="quotation_view_modal(<?php echo $value['enquiry_id'] ?>)" data-toggle="modal" data-target="#quotation_view"><i class="fa fa-eye" aria-hidden="true"></i> <?php if($value['quotation_status']=='1') { echo "Quoted"; } else { echo "Not Quoted"; }  ?></a></td>

<td><?php echo $value['status']; ?></td>
							 <td>

							 <!-- <td> <p id="order_id" onclick="approved('<?php echo $value['order_id']?>','approved_status')"><?php if($value['aproved_status']=='1'){
							echo "<font color=green>Approved</font>";
						}
							else
							{
								echo "Unapproved";
							}
						?></p>
							</td>              -->
				<?php //if($value['quotation_status']!='1') { ?>
						  <a href="index.php?file=enquiry/update&enquiry_id=<?php echo $value['enquiry_id']?>"title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  	
                          <a href="#" id="<?php echo $value['enquiry_id']?>" onclick="del(<?php echo $value['enquiry_id']?>)" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
						<?php //} ?>
						  </td>
						</tr>
                       
						<?php $roll_id+=1;}?>		
					</tbody>				  
				</table>


							<!-- open modal popup for enquiry item view -->
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
		  
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery//3.4.1/jquery.min.js"></script>-->
          

		  				<!-- open modal popup for quotation view -->
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
	function order_view_modal(enquiry_id){
		//alert(enquiry_id)
	 jQuery.ajax({
			type: "POST",
			url: "enquiry/order_view.php?",
			data: "enquiry_id="+enquiry_id,
			// alert(enquiry_id);
			success: function(msg){ 
		 //alert(msg);
			$("#order_view_modal_body").html(msg);
			}
		});
}	


	function quotation_view_modal(enquiry_id){
	
	 jQuery.ajax({
			type: "POST",
			url: "enquiry/quotation_view.php?",
			data: "enquiry_id="+enquiry_id,
			// alert(enquiry_id);
			success: function(msg)
			{ 
			 
			$("#quotation_view_modal_body").html(msg);
			}
		});
}	

/*function pdf_upload()
   	{
   		//alert("dsf");
   		
   		var file_data = jQuery("#file_data").prop("files")[0];


   		var sendInfo = 
		{		
		file_data:file_data,
		};
   		jQuery.ajax({
			type: "POST",
			url: "enquiry/pdf.php?file_name="+file_data,
			data: sendInfo,
			timeout:60000,
			
			success: function(data)
			{ 
			 alert(data);
		     window.location.href="index.php?file=enquiry/list";
			}
		});
*/
function enquiry_list(){
	
	var from_date =$('#from_date').val();
	var to_date =$('#to_date').val();
	var customer_id=$("#customer_id").val();
	var staffcreation_id=$("#staffcreation_id").val();
	var  status=$("#status").val();
	var format ="from_date="+from_date+"&to_date="+to_date+"&customer_id="+customer_id+"&staffcreation_id="+staffcreation_id+"&status="+status;

	window.location.href = "index.php?file=enquiry/list&"+format;
//window.location.href = "index.php?file=projectlist/list&"+format;
}

  

function all_fee_report_print(url)
{
	onmouseover= window.open(url,'','height=450,width=950,scrollbars=yes,left=320,top=120,toolbar=no,location=no,directories=no,status=no,menubar=no');
}				
   				

function print_google_map(url)
{	 
	onmouseover= window.open(url,'onmouseover','height=600,width=1200,scrollbars=yes,resizable=no,left=50,top=50,toolbar=no,location=no,directories=no,status=no,menubar=no');
}				
 </script>