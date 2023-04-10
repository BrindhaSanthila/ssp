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
   <script language="javascript" type="text/javascript" src="quotation/quotation.js"></script>
   
   <div class="box-body">
   	<h3>   Customer Satisfaction List</h3>
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
				<input type="button" name="" id="" onclick="customer_list()" class="form-control btn-info" value="GO" >
				
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
            <?php

	 

            ?>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">               
				  <table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">

					<thead>
						<tr>
							<th>#</th>
							<th>Date</th>
							<th>Enquiry No</th>
						<!--	<th>Quotation No</th>-->
							<th>Customer Name</th>
							<th>Executives</th>
							<th>Status</th>
							<th>Remarks</th>
							<th>File</th>
						 

						</tr>
					</thead>
<?php 
					 
                        $customer_satisfaction=$pdo_conn->prepare("SELECT * from customer_satisfaction WHERE  $query    ORDER BY id DESC ");
                        $customer_satisfaction->execute();
                        $satisfaction_list = $customer_satisfaction->fetchAll();
                        ?>
					<tbody>						
                        <?php foreach($satisfaction_list as $value){
 					 

                        	?>
                        
                           <tr>
						    <td><?php echo $roll_id;?></td>
						    <td><?php echo date("d-m-Y",strtotime($value['date']));?></td>
						    <td><?php echo $value['enquiry_id'];?></td>
						<!--	<td><?php //echo $value['quotation_number'];?></td>-->
							<td><?php echo get_customer_name($value['customer_id']);?></td>
							<td><?php echo get_staff_name($value['usercreation_id']);?></td>
							
							<td><?php echo $value['status'];?></td>
							<td><?php echo $value['description'];?></td>
							 
							<td><a href="javascript:pdf_view('<?php echo $image_path."customer_satisfaction/".$value['image']; ?>');" title="View Material" ><img <?php if($value['image']!='') { ?> src="<?php echo $image_path."customer_satisfaction/".$value['image']; ?>" <?php } else { ?>  src="images/images.jpg"  <?php }  ?> style="height:60px; width:60px;"  ></a></td>
							
						</tr>
						<?php $roll_id+=1;
						
					}?>		
					</tbody>				  
				</table>


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
 
	function pdf_view(url)
  {
  onmouseover55= window.open(url,'onmouseover55','height=450px,width=650px,scrollbars=yes,resizable=no,left=420,top=190,toolbar=no,location=no,directories=no,status=no,menubar=no');
  }
  
  function customer_list(){
	
	var from_date =$('#from_date').val();
	var to_date =$('#to_date').val();
	var customer_id=$("#customer_id").val();
	var staffcreation_id=$("#staffcreation_id").val();
	 
	var format ="from_date="+from_date+"&to_date="+to_date+"&customer_id="+customer_id+"&staffcreation_id="+staffcreation_id;

	window.location.href = "index.php?file=customer_satisfaction/list&"+format;
//window.location.href = "index.php?file=projectlist/list&"+format;
}

	</script>
