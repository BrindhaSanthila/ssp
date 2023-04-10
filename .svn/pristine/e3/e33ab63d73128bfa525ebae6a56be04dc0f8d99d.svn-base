<style>
h5.view_mode{
	font-weight:bold;
}
</style>
<script language="javascript" type="text/javascript" src="enquiry/enquiry.js"></script>
<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
 
$enquiry_id =$_POST['enquiry_id'];
$quotation_number=$_POST['quotation_number'];

$quotation = $pdo_conn->prepare("SELECT * FROM quotation  WHERE  enquiry_id='".$_POST['enquiry_id']."'");
$quotation->execute();
$quotation_list = $quotation->fetchAll();
$enquiry = $pdo_conn->prepare("SELECT * FROM enquiry  WHERE  enquiry_id='".$_POST['enquiry_id']."'");
$enquiry->execute();
$enquiry_list = $enquiry->fetch();
?>
<form>
<h5>Enquiry Id: <?php echo get_enquiry_number($enquiry_id);?> </h5>
<h5>Quotation Number: <?php echo $quotation_number;?> </h5>
<input type="hidden" name="enquiry_id" id="enquiry_id" value="<?php echo $enquiry_id; ?>">
<input type="hidden" name="quotation_number" id="quotation_number" value="<?php echo $quotation_number; ?>">
<input type="hidden" name="count" id="count" value=" <?php echo count($quotation_list); ?>">
<input type="hidden" name="usercreation_id" id="usercreation_id" value=" <?php echo  $enquiry_list['usercreation_id']; ?>">
<table width="90%" id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">
				
	<thead>
		<tr class="bold">
			<th>#</th>
			<th>Category Name</th>
			<th>Sub Category Name</th>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>GST(%)</th>
			<th>Rate</th>
			<th>Amount</th>
		</tr>
	</thead>
	
	<tbody>						
		<?php 
			$total_amount=0;
		foreach($quotation_list as $value){
			$quotation_status=$value['confirm_status'];
			$enquiry_item = $pdo_conn->prepare("SELECT * FROM enquiry_item  WHERE  enquiry_id='".$_POST['enquiry_id']."' order by order_id DESC");
$enquiry_item->execute();
$enquiryitem = $enquiry_item->fetch();

			$image1=$enquiryitem['enquiry_image'];
			$image2=$enquiryitem['enquiry_image1'];
			$image3=$enquiryitem['enquiry_image2'];
			$image4=$enquiryitem['enquiry_image3'];

?>

		<tr>
			<td><?php echo $roll_id;?></td>
			<td><?php echo get_category_name($value['category_id']); ?></td>				
			<td><?php echo get_subcategory_name($value['subcategory_id']); ?></td>
			<td><?php  echo get_item_name($value['item_id']);		?></td>

								
			<td> <input type="number" class="form-control quotation"      name="<?php echo 'quantity'.$roll_id;?>" id="<?php echo 'quantity'.$roll_id;?>" value="<?php  echo $value['quantity']; ?>" <?php if($status==1)
             {	?> readonly	<?php } else{?> onkeyup="get_total_amount('<?php echo $roll_id; ?>')" <?php } ?> ></td>	
         
			   <td> <input type="number" class="form-control quotation"      name="<?php echo 'gst_per'.$roll_id;?>" id="<?php echo 'gst_per'.$roll_id;?>" value="<?php  echo $value['gst_per']; ?>" <?php if($status==1)
             {	?> readonly	<?php } else{?> onkeyup="get_gst_per('<?php echo $roll_id; ?>')" <?php } ?> ></td>	
             
		
		<td>
			<input type="number" class="form-control quotation" id="<?php echo 'rate'.$roll_id;?>" value="<?php echo $value['rate']; ?>" name="<?php echo 'rate'.$roll_id;?>" <?php if($status==1)
             {	?> readonly	<?php } else{?> onkeyup="get_total_amount('<?php echo $roll_id; ?>')" <?php 
          }
          ?>></td>	
			<td>	<input type="number" class="form-control quotation amt1" id="<?php echo 'amount'.$roll_id;?>" name="<?php echo 'amount'.$roll_id;?>"  value="<?php echo $value['amount'];?>" readonly></td>	
				<input type="hidden" name="quotation_id<?php echo $roll_id ?>" id="quotation_id<?php echo $roll_id ?>" value="<?php echo $value['quotation_id'];  ?>">
			 
		
	 
		</tr>
		<?php $roll_id++;
		 $total_amount+=$value['amount']; }?>


	</tbody>				  
		</table>

<div class="row">
   <div class="col-md-12 amount">
     <p> Total Amount: <input type="text" name="total_amount" id="total_amount" value="<?php echo number_format($total_amount,2); ?>" readonly></p>
    </div>
  
</div>
</form>
<?php //if($quotation_status=='Pending') { ?>

		<a   style="margin-right:10px;" class="float-right btn btn-primary quotation-save  " id="quo_cancel" onclick="quotation_cancel('<?php echo $enquiry_id; ?>')"  >Cancel</a>
		 <a  style="margin-right:10px;" class="float-right btn btn-primary quotation-save  "  id="quo_approve" onclick="quotation_approve('<?php echo $enquiry_id; ?>')" >Approve</a> 

<?php// } ?>
 <script type="text/javascript">
 
 
  function quotation_approve(enquiry_id)
  {
 
 	var other_data = $('form').serializeArray();
 	  	$('#quo_approve').removeAttr('onclick');
  	jQuery.ajax({
			type: "POST",
			url: "quotation/curd.php?action=approve_quotation",
			 
			data:  other_data,
			success: function(msg)
			{
			  //  alert(msg)
	 			 alert("Quotation Approved")
			
					 
					window.location.href="index.php?file=quotation/list";
	 			
			}
	 	});
  }
function quotation_cancel(enquiry_id)
{
	 
	 	var other_data = $('form').serializeArray();
   	$('#quo_cancel').removeAttr('onclick');
   	jQuery.ajax({
			type: "POST",
			url: "quotation/curd.php?action=cancel_quotation",
			 
			data: other_data,
			success: function(msg)
			{
	 			 
			alert("Quotation Canceled")
					 
					window.location.href="index.php?file=quotation/list";
	 			
			}
	 	});
}

function get_total_amount(roll_id)
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
	$(".amt1").each(function(){
		num1=parseFloat(num1) + parseFloat(($(this).val() * 1));			
	});
	$("#total_amount").val(num1);
 
}
function get_gst_per(id)
{
        var rate= $("#rate"+id).val();
	 
	 var quantity=$("#quantity"+id).val();
	 var total_amount=parseFloat(rate) * parseFloat(quantity);
    

	var gst_per=$("#gst_per"+id).val();
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
 $("#amount"+id).val(total.toFixed(2));

     calculate();
}
 </script>

 <style type="text/css">
 	.font_color
 	{
 		color: white;
 	}
 	.col-md-12.amount p
{
	text-align: right;
}
 </style>