<style>
h5.view_mode{
	font-weight:bold;
}
</style>
<script language="javascript" type="text/javascript" src="quotation/quotation.js"></script>
<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
 
$enquiry_id =$_POST['enquiry_id'];
$quotation_number =$_POST['quotation_number']; 
$pdo_enquiry = $pdo_conn->prepare("SELECT * FROM enquiry WHERE enquiry_id='".$_POST['enquiry_id']."'");
$pdo_enquiry->execute();
$pdoenquiry = $pdo_enquiry->fetch();
 
$quotation = $pdo_conn->prepare("SELECT * FROM quotation  WHERE  enquiry_id='".$_POST['enquiry_id']."' and confirm_status='Approved'");
$quotation->execute();
$quotation_list = $quotation->fetchAll();
 
$order_check = $pdo_conn->prepare("SELECT * FROM order_confirm  WHERE  enquiry_id='".$_POST['enquiry_id']."' ");
$order_check->execute();
  $ordercheck = $order_check->fetchAll();
 

 
$get_all_values=array();




?>
 

<form>
	<div class="row header_part">Customer Name : <?php echo get_customer_name($pdoenquiry['customer_id']); ?></div>
	<div class="row header_part">Quotation Number : <?php echo $quotation_number; ?></div>
<div class="row header_part"><label>Confirm Number :   </label>	 <input type="text" value="<?php echo $ordercheck[0]['confirm_number'];; ?>" name="confirm_number" id="confirm_number"  style="margin-left: 10px;"  ></div>
<div class="row header_part"><label>Expected delivery Date :   </label>	 <input type="date" name="delivery_date" id="delivery_date"  style="margin-left: 10px;" ></div>
<input type="hidden" name="enquiry_id" id="enquiry_id" value="<?php echo $enquiry_id; ?>">
<input type="hidden" name="staffcreation_id" id="staffcreation_id" value="<?php echo $pdoenquiry['usercreation_id']; ?>">
<input type="hidden" name="customer_id" id="customer_id" value="<?php echo $pdoenquiry['customer_id']; ?>">
<input type="hidden" name="count" id="count" value=" <?php echo count($quotation_list); ?>">
<input type="hidden" name="quotation_ids" id="quotation_ids" value="<?php echo $quotation_ids; ?>">


<input type="hidden" name="quotation_number" id="quotation_number" value="<?php echo $_POST['quotation_number']; ?>">
<table id="quotation" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">
				
	<thead>
		<tr class="bold">
			<th>#</th>
			<th>Category Name</th>
			<th>Sub Category Name</th>
			<th>Item Name</th>
			<th>Rate</th>
			<th>Quantity</th>
			<th>GST(%)</th>
			<th>Amount</th>
			
		</tr>
	</thead>
	
	<tbody>						
		<?php 
		$i=0;
		$total_amount=0;
		foreach($quotation_list as $value){

  array_push($get_all_values, $value['quotation_id']);


               	$enquiry_view = $pdo_conn->prepare("SELECT * FROM enquiry  WHERE  enquiry_id='".$_POST['enquiry_id']."'  ");

		         $enquiry_view->execute();
		         $enquiry = $enquiry_view->fetch();
		         $discount=$enquiry['discount_per'];
		         $advance_amount=$enquiry['advance_amount'];
              $amt=0;
              $invoice_list = $pdo_conn->prepare("SELECT * FROM invoice  WHERE status='1' and quotation_id='".$value['quotation_id']."' ");
              $invoice_list->execute();
              $invoice = $invoice_list->fetch();
              $status=$invoice['status'];
			  
			   $amt+=$invoice['amount'];
		 $i=$i+1;
		 
			?>

		
		<tr>
			<td>
                 
				<?php echo $roll_id;?></td>
           
			<td><label name='category_id<?php echo $roll_id; ?>' id='category_id<?php echo $roll_id; ?>'><?php echo  get_category_name($value['category_id']);?></label>	</td>
				
			<td> <label name='subcategory_id<?php echo $roll_id;?>' id='subcategory_id<?php echo $roll_id; ?>'> <?php  echo get_subcategory_name($value['subcategory_id']);?>	</label>	</td>
			<td><label name='item_id<?php echo $roll_id;?>' id='item_id<?php echo $roll_id; ?>'> <?php  echo get_item_name($value['item_id']);?></label>		</td>
			 

			<td>
             <input type="number" class="form-control quotation" id="<?php echo 'rate'.$roll_id;?>" value="<?php echo $value['rate'];?>" name="<?php echo 'rate'.$roll_id;?>" <?php if($status==1)
             {	?> readonly	<?php } else{?> onkeyup="get_total_amount('<?php echo $roll_id; ?>','<?php echo $discount;?>','<?php echo $advance_amount; ?>')" <?php 
          }
          ?> style="width: 70px;">
         </td>	
		    <td>
              <input type="number" class="form-control quotation"      name="<?php echo 'quantity'.$roll_id;?>" id="<?php echo 'quantity'.$roll_id;?>" value="<?php  echo $value['quantity']; ?>" <?php if($status==1)
             {	?> readonly	<?php } else{?> onkeyup="get_total_amount('<?php echo $roll_id; ?>','<?php echo $discount;?>','<?php echo $advance_amount; ?>')" <?php } ?> style="width: 70px;" >
           </td>
           		    <td>
              <input type="number" class="form-control quotation"      name="<?php echo 'gst_per'.$roll_id;?>" id="<?php echo 'gst_per'.$roll_id;?>" value="<?php  echo $value['gst_per']; ?>" <?php if($status==1)
             {	?> readonly	<?php } else{?> onkeyup="get_total_amount('<?php echo $roll_id; ?>','<?php echo $discount;?>','<?php echo $advance_amount; ?>')" <?php } ?> style="width: 70px;" >
           </td>
           
          <td class="sum">
          	<input type="number" class="form-control quotation amt1" id="<?php echo 'amount'.$roll_id;?>" name="<?php echo 'amount'.$roll_id;?>"  value="<?php echo $value['amount'];?>" style="width: 90px;" readonly>
          	<input type="hidden" name="quotation_id<?php echo $roll_id ?>" id="quotation_id<?php echo $roll_id ?>" value="<?php echo $value['quotation_id'];  ?>">
          
          </td>
		</tr>
		
		<?php 
		$roll_id++;
		
		$amut="amount".$roll_id;
       
		$total_amount+=$value['amount'];
	 
}
 	 ?>
	</tbody>				  

		</table>

	
	<div class="row">
   <div class="col-md-12 amount">
     <p>  Amount: <input type="text" name="total_amount" id="total_amount" value="<?php echo number_format($total_amount,2); ?>" readonly></p>
    </div>
   <?php 
		$enquiry_view = $pdo_conn->prepare("SELECT * FROM enquiry  WHERE  enquiry_id='".$_POST['enquiry_id']."'  ");

		$enquiry_view->execute();
		$enquiry = $enquiry_view->fetch();
	    $discount=$enquiry['discount_per'];
   
		$discount_amount=$total_amount*$discount/100;
		$balance_amount=$total_amount-$discount_amount-$enquiry['advance_amount'];

	?>
</div>
<div class="row">
   <div class="col-md-12 amount">
     <p  >Discount percentage % : <input type="number" id="discount" name="discount" value="<?php echo number_format($discount,2); ?>" onkeyup="calculate(discount.value,total_amount.value)"> </p>
    </div>
</div>

<div class="row">
   <div class="col-md-12 amount">
     <p  >Total Amount: <input type="number" id="discount_amount" name="discount_amount"   readonly value="<?php echo "0.00"; ?>"> </p>
    </div>
</div>
<div class="row">
   <div class="col-md-12 amount">
       <p  >Advance Amount : <input type="number" id="advance_amount" name="advance_amount" value="<?php echo number_format($enquiry['advance_amount'],2);  ?>"  onkeyup="calculate_balance()" </p>
    </div>
</div>
  <div class="row">
   <div class="col-md-12 amount">
       <p  >Balance Amount : <input type="text" id="balance_amount" name="balance_amount" value="<?php echo number_format($balance_amount,2);  ?>" readonly> </p>
    </div>
</div>  

		<?php if(count($ordercheck)=='0') { ?>

			<div class="controls">
		 <input type="file" name="image" id="image"  class="form-control">
		</div>
<a id="quotation_view"   style="margin-right:10px;" class="float-right btn btn-primary quotation-save"   onclick="quotation_save()">Save </a>
<?php 
 }
 else{

 
	include("file_upload_subllist.php"); 
}	


?>

</form>
<script>
	

function quotation_save()
{	 
  
  
   
    var delivery_date=$("#delivery_date").val()
    var confirm_number=$("#confirm_number").val()
	var file_data = jQuery("#image").prop("files")[0];
    var file_value=$("#image").val();
	var fdata=new FormData();
	fdata.append("file", file_data);
	fdata.append("action", "conform_order");
	var other_data = $('form').serializeArray();
		
	$.each(other_data,function(key,input){
	    fdata.append(input.name,input.value);
	});
    if(confirm_number=='')
    {
        alert("Please Enter the  Confirm Number")
    }
    else if(file_value=='')
	{
		alert("Please Upload the PDF File");
	}
	else if(delivery_date=='')
	{
		alert("Please Selecct Delivery Date");
	}
    else
    {
      
       $('.quotation-save').removeAttr('onclick');
  
     	jQuery.ajax({
     		type: "POST",
     		url: "quotation_conformed/curd.php",
     		cache: false,
    		processData: false,
    		contentType: false,
     		data: fdata,																		
     		success: function(msg)
     		{
     		///	alert(msg)
     			alert("Order Placed")
    			// alert("Enq Id: " + enquiry_id + "Count is: " + count + "Action is: " + Add)
    		         //alert(msg);
    			
    			window.location.href="index.php?file=quotation_conformed/list";
    		}
    
     	});	
    }
}

function get_total_amount(roll_id,discount,advance_amount)
{

	var rate= $("#rate"+roll_id).val();
	
     var advance_amount=$("#advance_amount").val();
	 var final_quantity=$("#quantity"+roll_id).val();

	 var total_amount=parseInt(rate) * parseInt(final_quantity);	
 
	var gst_per=$("#gst_per"+roll_id).val();
    if(gst_per!='')
    {
    var gst_val=total_amount*(gst_per/100);
	var gst_value= gst_val;
    }
    else
    {
       var gst_val=total_amount*(gst_per/100);;
       var gst_value= gst_val;
    }
	 var total=parseFloat(total_amount) + parseFloat(gst_value);
     $("#amount"+roll_id).val(total.toFixed(2));
 
	 calculate(discount,total_amount);
	 calculate_balance();

} 
function calculate_balance()
{
   	var discount_amount= $("#discount_amount").val();
   	var advance_amount= $("#advance_amount").val();
    var  balance_amount=parseInt(discount_amount)-parseInt(advance_amount);
    
    
    $("#balance_amount").val(balance_amount.toFixed(2));
}
function calculate(discount,total_amount)
{
	 
  var num1=0;
	$(".amt1").each(function(){
		num1=num1 + ($(this).val() * 1);			
	});
	$("#total_amount").val(num1.toFixed(2));
	var discount1=(discount/100)*total_amount;
 
	var discount_amount=parseInt(total_amount)-parseInt(discount1);
	 
	//$("#discount").val(discount1);
	$("#discount_amount").val(discount_amount.toFixed(2));	
}
</script>

<style>
.quotation{
	width:100px;
}

.quotation-save{
position:absolute;
left:620px;

margin: 27px 0 0 0;
}
.col-md-12.amount p
{
	text-align: right;
}


.header_part
{
	font-size: 15px;
	margin-left: 10px;
}
</style>