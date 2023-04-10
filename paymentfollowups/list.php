   <?php

   include('../inc/dbConnect.php');
include('../inc/commonfunction.php');

$cr_dt=date("Y-m-d");

 
if($_GET['customer_id']!='')
{
	$query.=" and customer_id='".$_GET['customer_id']."'";

}

function coll_payment_amount($enquiry_id)
{
global $pdo_conn;
$sql_sub ="SELECT  coll_amount,payment_type FROM  paymentcollection where enquiry_id='$enquiry_id'  ORDER BY paymentcreation_id DESC " ;
$prepare_sub = $pdo_conn->prepare($sql_sub);
$exc_sub = $prepare_sub->execute();
$purchasesub_list = $prepare_sub->fetchall(PDO::FETCH_ASSOC);
foreach($purchasesub_list as $value)
{
   $type_pay= preg_replace('/[^A-Za-z0-9]/', '', $value[payment_type]);    
  $res.=number_format($value[coll_amount],2)."(".ucfirst($type_pay).")";
 $res.= "<br>";
  
}
  return $res;
}
		               
		                
 

   ?>   <div class="box-body">
      	 <h3>
    <small> </small>
		<?php echo ucfirst($foldername); ?> List 
  </h3>	
	 
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
				<th>Enquiry No</th>
				<th>Quotation No</th>
				<th>Customer Name</th>
				<th>Total Amount</th>
				<th>Discount Amount</th>
					<th>Advance Amount</th>
                   <th>Collection Amount</th>

				<th>Balance Amount</th>	
				</tr>
			  </thead>
			  <tbody>
				  <?php 
			//	  echo "SELECT  sum(final_amount) as amount,customer_id,enquiry_id,quotation_number FROM  quotation   where   confirm_status='Approved'  group by enquiry_id   ORDER BY enquiry_id DESC ";
	                $invoice=$pdo_conn->prepare("SELECT  sum(final_amount) as amount,customer_id,enquiry_id,quotation_number FROM  quotation   where   confirm_status='Approved' and final_amount!='0' group by enquiry_id   ORDER BY enquiry_id DESC ");
	                $invoice->execute();
	                $invoice_list = $invoice->fetchAll(); 
			  		$roll_id=1;	  

			  		foreach($invoice_list as $value)
			  		{ 	 
			  		    $enquiry=$pdo_conn->prepare("SELECT * FROM  enquiry where enquiry_id='$value[enquiry_id]'  ");
		                $enquiry->execute();
		                $enquiry_amount = $enquiry->fetch();
		                $advance_amount=$enquiry_amount['advance_amount'];
		                 $discount_pert=$enquiry_amount['discount_per'];
		                $discount_amount=($discount_pert/100)*$value['amount'];
$paymentcollection=$pdo_conn->prepare("SELECT  sum(coll_amount) as coll_amount FROM  paymentcollection where enquiry_id='$value[enquiry_id]'  ");
		                $paymentcollection->execute();
		                $payment = $paymentcollection->fetch();
		                $type_amount= coll_payment_amount($value['enquiry_id']);
		                
		                $balance_amount=$value['amount']-$advance_amount-$discount_amount-$payment['coll_amount'];;
		                ?>
	                        
	                <tr>
					  <td><?php echo $roll_id;?></td>
					  <td><?php echo get_enquiry_number($value['enquiry_id']); ?></td>
					  <td><?php echo $value['quotation_number']; ?></td>
					  <td><?php echo get_customer_name($value['customer_id']);?>	</td>
					  <td><?php echo number_format($value['amount'],2); ?></td>
					  <td><?php echo number_format($discount_amount,2) ?></td>
					  <td><?php echo number_format($advance_amount,2) ?></td>
                      <td><?php echo number_format($payment[coll_amount],2)."<br>".$type_amount;?></td>

					  <td><?php echo number_format($balance_amount,2); ?></td> 
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
function paymentfollowup_list(){
	
	var from_date =$('#from_date').val();
	var to_date =$('#to_date').val();
	var customer_id=$("#customer_id").val();
	var staffcreation_id=$("#staffcreation_id").val();
	var format ="from_date="+from_date+"&to_date="+to_date+"&customer_id="+customer_id+"&staffcreation_id="+staffcreation_id;
	
	window.location.href = "index.php?file=paymentfollowups/list&"+format;
//window.location.href = "index.php?file=projectlist/list&"+format;
}

	</script>