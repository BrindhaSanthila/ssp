   <?php

   include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
   ?>
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
            
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">               
				  <table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">

					<thead>
						<tr>
							<th>#</th>
			<th>Invoice No</th>
			<th>Enquiry No</th>
			<th>Customer Name</th>
			<th>Amount</th>
			
							
						</tr>
					</thead>
<?php 

 $invoice_list= $pdo_conn->prepare("SELECT sum(amount) as amount,customer_id,invoice_no,enquiry_id from invoice where  delivered_status='1' group by invoice_no order by invoice_id desc");
$invoice_list->execute();
$invoicelist = $invoice_list->fetchAll();

  $roll_id=1;
?>

					<tbody>						
                        <?php foreach($invoicelist as $value){?>
                        
                           <tr>
						    <td>
                 
				<?php echo $roll_id;?></td>
            <td> 
             <?php echo $value['invoice_no']; ?>
			</td>
			<td> 
             <?php echo $value['enquiry_id']; ?>
			</td>
              <td><?php echo  get_customer_name($value['customer_id']);?>	</td>
               <?php
              $total_amount=$value['amount'];
             
		$enquiry_view = $pdo_conn->prepare("SELECT * FROM enquiry  WHERE  enquiry_id='".$value['enquiry_id']."'  ");
		$enquiry_view->execute();
		$enquiry = $enquiry_view->fetch();
		$discount_amount=$total_amount*$enquiry['discount_per']/100;
		$discount_less=$total_amount-$discount_amount-$enquiry['advance_amount'];
?>
             <td><?php  
           
             echo $discount_less;
              
              
             ?>

            </td>
			<!-- <td><a id="quotation_print" onclick="quotation_print(<?php echo $value['invoice_id'] ?>,<?php echo $value['enquiry_id'] ?>)" ><i class="fa fa-print" aria-hidden="true"></i></a></td>
		
							 -->
						</tr>
						<?php $roll_id+=1;}?>		
					</tbody>				  
				</table>


							<!-- open modal popup -->
			
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

	</script>