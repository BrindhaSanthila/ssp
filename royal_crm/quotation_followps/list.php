   <?php

   include('../inc/dbConnect.php');
include('../inc/commonfunction.php');

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

   ?>   <div class="box-body">
      	 <h3>
    <small> </small>
		<?php //echo ucfirst($foldername); ?> Quotation Followups List 
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
                        <select id="customer_id" name="customer_id" class="form-control select2"  >
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
				<input type="button" name="" id="" onclick="quotationfollowup_list()" class="form-control btn-info" value="GO" >
				
			</div>
			
        </div>

		
		</div>
		</div>
		</form>
		</div>
   <section class="content-header">
  
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
        <div class="box-body">
		  <div class="table-responsive">               
			<table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">

			  <thead>
				<tr>
				<th>#</th>
				<th>Date</th>
				<th>Enquiry No</th>
				<th>Quotation No</th>
				<th>Executive Name</th>
				<th>Customer Name</th>
				<th>Next Followup date</th>
				<th>Remarks</th>
				<th>Location</th>
				 	
				</tr>
			  </thead>
				<?php 
 
				$quotation_followups= $pdo_conn->prepare("SELECT * from quotation_followups where   $query order by quotation_followup_id desc");
				$quotation_followups->execute();
				$quotation_followups_list = $quotation_followups->fetchAll();

				  $roll_id=1;
				?>

			  <tbody>						
              <?php foreach($quotation_followups_list as $value){
				 
				 $latitude=$value['latitude'];
			 	$longitude=$value['longitude'];
				 
			 ?>
                        
                <tr>
				  <td><?php echo $roll_id;?></td>
				  <td><?php echo date("d-m-Y",strtotime($value['date']));?></td>
				<td><?php echo get_enquiry_number($value['enquiry_id']); ?></td>
				<td><?php echo $value['quotation_number']; ?></td>
				<td><?php echo get_staff_name($value['usercreation_id']);?></td>
				<td><?php echo  get_customer_name($value['customer_id']);?>	</td>
				<td><?php echo $value['next_date']; ?></td>
				<td><?php echo $value['remarks']; ?></td>
				<td><?php if(($longitude!='')&&($latitude!='')) {?>
                  <div align="center">
                  <a onclick="print_google_map('quotation_followps/map.php?latitude=<?php echo $latitude; ?>&longitude=<?php echo $longitude; ?>');" target="new">
                  <img src="images/map.png" height="30" width="30">
                  </a></div><?php }?></td>
				 
		 
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

	
	<script>
function quotationfollowup_list(){
	
	var from_date =$('#from_date').val();
	var to_date =$('#to_date').val();
	var customer_id=$("#customer_id").val();
	var staffcreation_id=$("#staffcreation_id").val();
	var format ="from_date="+from_date+"&to_date="+to_date+"&customer_id="+customer_id+"&staffcreation_id="+staffcreation_id;
	
	window.location.href = "index.php?file=quotation_followps/list&"+format;
//window.location.href = "index.php?file=projectlist/list&"+format;
}
function print_google_map(url)
{	 
	onmouseover= window.open(url,'onmouseover','height=600,width=1200,scrollbars=yes,resizable=no,left=50,top=50,toolbar=no,location=no,directories=no,status=no,menubar=no');
}
	</script>