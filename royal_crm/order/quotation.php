<?php 
error_reporting(0);  
?>
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
 $staffcreation_id=$_POST['staffcreation_id'];
 $customer_id=$_POST['customer_id'];
 $quotation_number=$_POST['quotation_number'];
// echo "Enquiry id: " . $enquiry_id;
// echo "<script>alert('enquiry id is: "+" ".$enquiry_id."')</script>";
//echo "SELECT * FROM quotation  WHERE  enquiry_id='".$_POST['enquiry_id']."' and confirm_status='Conformed'";
$order_view = $pdo_conn->prepare("SELECT * FROM order_confirm  WHERE  enquiry_id='".$_POST['enquiry_id']."' ");
$order_view->execute();
$orderview = $order_view->fetchAll();


$order_view1 = $pdo_conn->prepare("SELECT * FROM invoice  WHERE  enquiry_id='".$_POST['enquiry_id']."' ");
$order_view1->execute();
$orderview1 = $order_view1->fetch();


$get_all_values=array();




?>
 

<form>
<input type="hidden" name="enquiry_id" id="enquiry_id" value="<?php echo $enquiry_id; ?>">
<input type="hidden" name="staffcreation_id" id="staffcreation_id" value="<?php echo $staffcreation_id; ?>">
<input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer_id; ?>">
<input type="hidden" name="count" id="count" value="<?php echo count($orderview); ?>">
<input type="hidden" name="quotation_number" id="quotation_number" value="<?php echo $quotation_number; ?>">
<input type="hidden" name="quotation_ids" id="quotation_ids" value="<?php echo $quotation_ids; ?>">

<div class="row header_part"><label> Customer Name : <?php echo get_customer_name($customer_id); ?></label></div>
<div class="row header_part">	<label>Invoice Number :  </label><input type="text" class="form-control quotation" name="invoice_no" id="invoice_no" value="<?php echo $orderview1['invoice_no'] ?>" style="margin-left: 10px;">	&nbsp;	&nbsp; (OR)	&nbsp;	&nbsp; 	<label>Register Number :  </label><input type="text" class="form-control quotation" name="reg_no" id="reg_no" style="margin-left: 10px;" value="<?php echo $orderview1['reg_no']  ?>">  </div>
<table id="quotation" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">
				
	<thead>
	 
			<th>#</th>
			<th>Check</th>
			<th>Category Name</th>
			<th>Sub Category Name</th>
			<th>Item Name</th>
			<th>Rate</th>
			<th>Quantity</th>
		    <th>GST(%)</th>
			<th>Amount</th>
	 
	</thead>
	
	<tbody>						
		<?php 
		$i=0;
		$total_amount=0;
		$t_balance_quantity=0;
		foreach($orderview as $value)
		{
            array_push($get_all_values, $value['quotation_id']);
            $i=$i+1;
            
            $quotation_view = $pdo_conn->prepare("SELECT * FROM quotation  WHERE  enquiry_id='".$_POST['enquiry_id']."' and quotation_id='".$value['quotation_id']."' ");
            $quotation_view->execute();
            $quotation = $quotation_view->fetch();
            
            $final_quantity=$quotation['final_quantity'];
            
            $enquiry_view = $pdo_conn->prepare("SELECT * FROM enquiry  WHERE  enquiry_id='".$_POST['enquiry_id']."'  ");
            
            $enquiry_view->execute();
            $enquiry = $enquiry_view->fetch();
            $discount=$enquiry['discount_per'];
            $advance_amount=$enquiry['advance_amount'];
            $amt=0;
            $invoice_list = $pdo_conn->prepare("SELECT sum(final_quantity) as final_quantity,amount FROM invoice  WHERE status='1' and quotation_id='".$value['quotation_id']."' ");
            $invoice_list->execute();
            $invoice = $invoice_list->fetch();
            $status=$invoice['status'];
            if($invoice['final_quantity']!='')
            {
            $invoice_quantity=$invoice['final_quantity'];
            }
            else
            {
            $invoice_quantity=0;
            }
            $amt+=$invoice['amount'];
            $balance_quantity= $final_quantity- $invoice_quantity;
            $t_balance_quantity=$t_balance_quantity+$balance_quantity;
            $amount_value=$balance_quantity*$quotation['final_rate'];
            $gst_perc=$quotation['gst_per'];
			?>

		
		<tr>
			<td>
                 
				<?php echo $roll_id;?></td>
            <td> 
               <?php

?>
				<input type="checkbox"  id='quotation_id<?php echo $roll_id; ?>' name='quotation_id<?php echo $roll_id; ?>'   value="<?php echo $value['quotation_id']; ?>" <?php if($balance_quantity==0) {
					?> checked="checked" disabled="disabled"	<?php	}?> onclick="get_total_amount('<?php echo $roll_id; ?>')"   >
			</td>
			<td><label name='category_id<?php echo $roll_id; ?>' id='category_id<?php echo $roll_id; ?>'><?php echo  get_category_name($quotation['category_id']);?></label>	</td>
				
			<td> <label name='subcategory_id<?php echo $roll_id;?>' id='subcategory_id<?php echo $roll_id; ?>'> <?php  echo get_subcategory_name($quotation['subcategory_id']);?>	</label>	</td>
			<td><label name='item_id<?php echo $roll_id;?>' id='item_id<?php echo $roll_id; ?>'> <?php  echo get_item_name($quotation['item_id']);?></label>		</td>
			 

			<td>
             <input type="number" class="form-control quotation" id="<?php echo 'rate'.$roll_id;?>" value="<?php echo $quotation['final_rate'];?>" name="<?php echo 'rate'.$roll_id;?>"  readonly style="width: 70px;">
         </td>	
		    <td>
              <input type="number" class="form-control quotation" style="width: 70px;"     name="<?php echo 'quantity'.$roll_id;?>" id="<?php echo 'quantity'.$roll_id;?>" value="<?php  echo $balance_quantity; ?>" <?php if($balance_quantity==0) {	?> readonly	<?php } else{?> onkeyup="get_total_amount('<?php echo $roll_id; ?>')" <?php } ?>   >
           </td>
           <td>
              <input type="number" class="form-control quotation"   style="width: 70px;"   name="<?php echo 'gst_per'.$roll_id;?>" id="<?php echo 'gst_per'.$roll_id;?>" value="<?php  echo $gst_perc; ?>"  onkeyup="get_total_amount('<?php echo $roll_id; ?>')" >
           </td>
          <td class="sum">
          	<input type="number" class="form-control quotation amt1" id="<?php echo 'amount'.$roll_id;?>" style="width: 70px;" name="<?php echo 'amount'.$roll_id;?>"  value="<?php echo $amount_value ?>" readonly>
          
          </td>
		</tr>
		
		<?php 
		$roll_id++;
		
		$amut="amount".$roll_id;
       
		$total_amount+=$value['final_amount'];
	?>

	<?php 
}
$quotation_ids=implode(',', $get_all_values)
	 ?>
	</tbody>				  

		</table>

	
	<div class="row">
   <div class="col-md-12 amount">
     <p>Total Amount: <input type="text" name="ratefix" id="ratefix" value="<?php echo number_format($total_amount,2); ?>" readonly ></p>
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
<!--<div class="row">
   <div class="col-md-12 amount">
     <p  >Discount percentage: <input type="text" id="discount" name="discount" value="<?php echo $discount ?>" readonly> </p>
    </div>
</div>
<div class="row">
   <div class="col-md-12 amount">
       <p  >Advance Amount : <input type="text" id="advance_amount" name="advance_amount" value="<?php echo $enquiry['advance_amount'];  ?>" readonly> </p>
    </div>
</div>
<div class="row">
   <div class="col-md-12 amount">
       <p  >Balance Amount : <input type="text" id="balance_amount" name="balance_amount" value="<?php echo $balance_amount;  ?>" readonly> </p>
    </div>
</div>
 -->
		<div class="controls">
			<input type="file" name="image" id="image"  class="form-control">
		</div>	
 
	<?php if( $t_balance_quantity!=0) {?>
		<a id="quotation_view"   style="margin-right:10px;" class="float-right btn btn-primary quotation-save"   onclick="invoice_save()"  >Save</i></a>
	<?php } ?>

</form>
<script>
	

function invoice_save()
{	 
   
   	var invoice_no=$("#invoice_no").val();
	var file_data = jQuery("#image").prop("files")[0];
	var file_value=$("#image").val();
    var reg_no=$('#reg_no').val();
	if(invoice_no=='')
	{
	    if(reg_no=='')
	    {
		alert("Please Enter the Invoice Number");
		$("#invoice_no").focus();
	    }
	}
	else if(file_value=='')
	{
		alert("Please upload the PDF File");
	}
	else
	{
	    var event_check_array=[];  
	  	$( "input[type='checkbox']:checked").each(function(){
	 	event_check_array.push($(this).val());
	    });
  		$("#quotation_ids").val(event_check_array);
  		var action="conform_order";
        var fdata=new FormData();
	    fdata.append("file", file_data);
	       
	    fdata.append("action",action); 
		
	  //  alert(roll_id);
	    var other_data = $('form').serializeArray();
		$.each(other_data,function(key,input){
		    fdata.append(input.name,input.value);
		}); 	
		   $('.quotation-save').removeAttr('onclick');
 		jQuery.ajax({
	 		type: "POST",
	 		url: "order/curd.php",
	 		cache: false,
			contentType: false,
			processData: false,
			data: fdata,																	
	 		success: function(msg)
	 		{	
	 		alert("Invoice Generated");
	 			window.location.href="index.php?file=order/list";
	 		}
	 	});	
	}
}

function get_total_amount(roll_id,discount)
{

	var rate= $("#rate"+roll_id).val();
 
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
 

	 calculate();
	 

}  
function calculate()
{

var num1=0;
var count=$("#count").val();
for(var i=1;i<=count;i++)
{
    if($("#quotation_id"+i).is(':checked'))
    {
        var rate= $("#rate"+i).val(); 
        var final_quantity=$("#quantity"+i).val();
        var total_amount=parseInt(rate) * parseInt(final_quantity);	
     //   alert(final_quantity+','+rate);
        var gst_per=$("#gst_per"+i).val();
        
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
        num1+=total;
        
    }
}
$("#ratefix").val(num1.toFixed(2)); 
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