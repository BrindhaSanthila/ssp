  <?php
 


error_reporting(0);  
$roll_id=1;
$cr_dt=date("Y-m-d");

if($_GET['from_date']=="" && $_GET['to_date']=="" ){
  $query = " and date='".$cr_dt."'";
}
else{
$query = "  and date between '".$_GET['from_date']."' AND '".$_GET['to_date']."'";
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
         <h3>   Invoice List</h3>
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
        <input type="button"    onclick="order_list()" class="form-control btn-info" value="GO" >
        
      </div>
      
        </div>

    
    </div>
    </div>
    </form>
    </div>
   <!--<section class="content-header">
  
</section>---->

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
               <table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
         <td><a onclick="javascript:all_fee_report_print_invoice('invoice/invoicelist_print.php?from_date='+from_date.value+'&to_date='+to_date.value+'&customer_id='+customer_id.value+'&staffcreation_id='+staffcreation_id.value+'&status=<?php echo $_REQUEST['status']?>');" style="float:right;margin-right:20px;"><img  align="right" src="images/report_print.png" width="35" height="35" border="0" title="PRINT"></a></td>
    </tr>
</table>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">               
				   <table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">

					<thead>
						<tr>
							<th>#</th>
			<th>Invoice No</th>
			<th>Executive</th>
			<th>Customer Name</th>
			<th>Amount</th>
      <th>File</th>
			<th>Delivery Status</th>
			<th>Print</th>
							
						</tr>
					</thead>
      <?php 

      $invoice_list= $pdo_conn->prepare("SELECT sum(amount) as amount,customer_id,invoice_no,enquiry_id,invoice_id,staffcreation_id,delivered_status from invoice where status='1' $query group by invoice_no  order by invoice_id desc");
      $invoice_list->execute();
      $invoicelist = $invoice_list->fetchAll();

      $roll_id=1;
      ?>

			<tbody>						
      <?php foreach($invoicelist as $value){ 
        $order_pdf= $pdo_conn->prepare("SELECT * from order_pdf where invoice_no='".$value['invoice_no']."' ");
      $order_pdf->execute();
      $pdf = $order_pdf->fetch(); 	?>
      <tr>
			  <td>           
				<?php echo $roll_id;?></td>
        <td>  <?php echo $value['invoice_no']; ?></td>
        <td> <?php  echo get_staff_name($value['staffcreation_id']); ?></td>
        <td><?php echo  get_customer_name($value['customer_id']);?>	</td>

        <td><?php  echo number_format($value['amount'],2);?></td>
        <td><a href="javascript:pdf_view('<?php echo $image_path_back."order/".$pdf['pdf']; ?>');" title="View Material" ><img <?php if($pdf['pdf']!='') { ?>src="images/pdf.png" <?php } else { ?> src="images/images.jpg" <?php } ?> id='picture' name='picture' style="width: 50px; height: 50px;" ></a></td>
        <td> <?php if($value['delivered_status']!='1') { ?><a onclick="delivered('<?php echo $value['invoice_no'];?>','<?php echo $value['enquiry_id']; ?>','<?php  echo $value['staffcreation_id']; ?>','<?php  echo $value['customer_id']; ?>')">  Undelivered</a><?php } else { echo  "Delivered"; }?>
					 
								</td>
						
         <td><a href="#" title="View" id="quotation_print" onclick="quotation_print('invoice/print.php','<?php echo $value['invoice_no'];?>')" data-toggle="modal" data-target="#customer_view"><i class="fa fa-print" aria-hidden="true"></i></a></td> 
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
function quotation_print(url,invoice_no)
{
	window.open(url+'?invoice_no='+invoice_no,'onmouseover','height=650,width=950,scrollbars=yes,resizable=no,left=250,top=250,toolbar=no,location=no,directories=no,status=no,menubar=no');	
}
		
function  delivered(invoice_no,enquiry_id,staffcreation_id,customer_id)
{
    $.ajax({
        url:'invoice/model.php',
        type:'GET',
        data: "invoice_no="+invoice_no+'&enquiry_id='+enquiry_id+'&staffcreation_id='+staffcreation_id+"&customer_id="+customer_id,
        timeout:60000,
        success:function(data)
        {   
            alert(data);
            location.reload();
        }
    });
}
function order_list()
{  
  var from_date =$('#from_date').val();
  var to_date =$('#to_date').val();
  var customer_id=$("#customer_id").val();
  var staffcreation_id=$("#staffcreation_id").val();
  var format ="from_date="+from_date+"&to_date="+to_date+"&customer_id="+customer_id+"&staffcreation_id="+staffcreation_id;
  
  window.location.href = "index.php?file=invoice/invoice_list&"+format;
//window.location.href = "index.php?file=projectlist/list&"+format;
}
function all_fee_report_print_invoice(url)
{
  onmouseover= window.open(url,'','height=450,width=950,scrollbars=yes,left=320,top=120,toolbar=no,location=no,directories=no,status=no,menubar=no');
}       
    
function pdf_view(url)
  {
  onmouseover55= window.open(url,'onmouseover55','height=450px,width=650px,scrollbars=yes,resizable=no,left=420,top=190,toolbar=no,location=no,directories=no,status=no,menubar=no');
  }
	</script>