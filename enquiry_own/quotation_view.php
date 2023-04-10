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

// echo "Enquiry id: " . $enquiry_id;
// echo "<script>alert('enquiry id is: "+" ".$enquiry_id."')</script>";

$order_view = $pdo_conn->prepare("SELECT * FROM enquiry  WHERE  enquiry_id='".$_POST['enquiry_id']."'");
$order_view->execute();
$orderview = $order_view->fetch();


$enquiry_item= $pdo_conn->prepare("SELECT *  FROM enquiry_item  WHERE enquiry_id='".$_POST['enquiry_id']."' and status='1'");
$enquiry_item->execute();
$record_enquiry_item = $enquiry_item->fetchAll();
$count=count($record_enquiry_item);

$order_view1= $pdo_conn->prepare("SELECT * FROM quotation WHERE  enquiry_id='".$_POST['enquiry_id']."'");
$order_view1->execute();
$orderview1 = $order_view1->fetch();

//////////////For Converted quatation //////////

?>

<form>	
	<div class="row header_part">Customer Name : <?php echo get_customer_name($orderview['customer_id']);?></div>
<div class="row header_part">Enquiry ID: <?php echo get_enquiry_number($enquiry_id);?></div>
<div class="row header_part">Count is: <?php echo count($record_enquiry_item); ?></div>
<div class="row header_part">
	<label>Quotation Number : </label><input type="number" name="quotation_number"  id="quotation_number" <?php if($orderview1!="") { ?> readonly <?php } ?> style="margin-left: 10px;"value="<?php echo $orderview1['quotation_number'];?>">
</div>
<input type="hidden" name="usercreation_id" id="usercreation_id" value="<?php echo $orderview['usercreation_id']; ?>">

<input type="hidden" name="customer_id" id="customer_id" value="<?php echo $orderview['customer_id']; ?>">
<input type="hidden" name="enquiry_id" id="enquiry_id" value="<?php echo $enquiry_id; ?>">
<input type="hidden" name="count" id="count" value="<?php echo $count;?>">
<input type="hidden" name="user_type_id" id="user_type_id" value="<?php echo $orderview['user_type_id']; ?>">
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
$total_amount=0;
		 if($orderview['quotation_status']!='1') { ?>
		 
		 	<?php 
		//$cat='1';$subcat='1';$item='1';$rate='1'; $rate_id='1'; $qty='1';$amount='1';
		
		foreach($record_enquiry_item as $value)
		{		

    

			?>
		<tr>
			<td><?php echo $roll_id;?></td>

			<td><?php echo get_category_name($value['category_id']);?></td>

			<td><?php echo get_subcategory_name($value['subcategory_id']);?></td>
			<td><?php echo get_item_name($value['item_id']);	?></td>
			<td> 
				<input type="number" class="form-control quotation"  value="<?php  if($quatationview['status']=='1')  echo $quatationview['rate'];  ?>"    name="<?php echo 'rate'.$roll_id;?>" id="<?php echo 'rate'.$roll_id;?>" onkeyup="get_total_amount('<?php echo $roll_id; ?>')">
			</td>
 
			<td>
				<input type="number" class="form-control" style="width: 70px;" id="<?php echo 'qty'.$roll_id;?>" value="<?php echo $value['quantity']; ?>"   name="<?php echo 'qty'.$roll_id;?>" onkeyup="get_total_amount('<?php echo $roll_id; ?>')" >
			</td>
			<td>
				<input type="number" class="form-control" id="<?php echo 'gst_per'.$roll_id;?>" value="<?php echo $value['gst_per']; ?>"   name="<?php echo 'gst_per'.$roll_id;?>" onkeyup="get_per_amt('<?php echo $roll_id; ?>')" style="width: 70px;">
			</td>
		
			<td>
				<input type="number" class="form-control quotation" id="<?php echo 'amount'.$roll_id;?>" value="<?php if($quatationview['status']=='1') { echo $quatationview['amount'];  }  else { echo $value['amount']; }?>" name="<?php echo 'amount'.$roll_id;?>" readonly>
			</td>
		
		 
			<input type="hidden" class="form-control" value="<?php echo $value['category_id']; ?>"   name="<?php echo 'category_id'.$roll_id;?>" id="<?php echo 'category_id'.$roll_id;?>">
			<input type="hidden" class="form-control" value="<?php echo $value['subcategory_id']; ?>"   name="<?php echo 'subcategory_id'.$roll_id;?>" id="<?php echo 'subcategory_id'.$roll_id;?>"  >
			<input type="hidden" class="form-control" value="<?php echo $value['item_id']; ?>" name="<?php echo 'item_id'.$roll_id;?>" id="<?php echo 'item_id'.$roll_id;?>" >

			<input type="hidden" class="form-control"  value="<?php echo $value['rate_id']; ?>"   name="<?php echo 'rate_id'.$roll_id;?>" id="<?php echo 'rate_id'.$roll_id;?>">
            
		</tr>
		 <?php $roll_id++;} } else  { 
		 $quotation_item= $pdo_conn->prepare("SELECT *  FROM quotation  WHERE enquiry_id='".$_POST['enquiry_id']."' ");
$quotation_item->execute();
$quotation_item_view = $quotation_item->fetchAll();
	foreach($quotation_item_view as $quotation_list)
		{	
 ?>
		 
	
		 <tr>
			<td><?php echo $roll_id;?></td>

			<td><?php echo get_category_name($quotation_list['category_id']);	?></td>

			<td><?php echo get_subcategory_name($quotation_list['subcategory_id']);	?></td>
			<td><?php echo get_item_name($quotation_list['item_id']);	?></td>
			<td> 
				<input type="number" class="form-control quotation" name="<?php echo 'rate'.$roll_id;?>" id="<?php echo 'rate'.$roll_id;?>" value="<?php   echo $quotation_list['rate'];  ?>" style="width: 70px;"   onkeyup="get_total_amount('<?php echo $roll_id; ?>')"   >
			</td>
 
			<td>
				<input type="number" class="form-control quotation" id="<?php echo 'qty'.$roll_id;?>" name="<?php echo 'qty'.$roll_id;?>"   value="<?php echo $quotation_list['quantity']; ?>"  style="width: 70px;" onkeyup="get_total_amount('<?php echo $roll_id; ?>')"    >
			</td>
						<td>
				<input type="number" class="form-control quotation"   value="<?php echo $quotation_list['gst_per']; ?>"  style="width: 70px;" id="<?php echo 'gst_per'.$roll_id;?>" name="<?php echo 'gst_per'.$roll_id;?>"  onkeyup="get_per_amt('<?php echo $roll_id; ?>')" style="width: 70px;"  >
			</td>

			<td>
				<input type="number" class="form-control quotation" id="<?php echo 'amount'.$roll_id;?>" name="<?php echo 'amount'.$roll_id;?>" value="<?php   echo $quotation_list['amount'];  ?>" style="width: 70px;"  readonly>
			</td>
		
		 		 
			<input type="hidden" class="form-control" value="<?php echo $quotation_list['category_id']; ?>"   name="<?php echo 'category_id'.$roll_id;?>" id="<?php echo 'category_id'.$roll_id;?>">
			<input type="hidden" class="form-control" value="<?php echo $quotation_list['subcategory_id']; ?>"   name="<?php echo 'subcategory_id'.$roll_id;?>" id="<?php echo 'subcategory_id'.$roll_id;?>"  >
			<input type="hidden" class="form-control" value="<?php echo $quotation_list['item_id']; ?>" name="<?php echo 'item_id'.$roll_id;?>" id="<?php echo 'item_id'.$roll_id;?>" >

			<input type="hidden" class="form-control"  value="<?php echo $quotation_list['rate_id']; ?>"   name="<?php echo 'rate_id'.$roll_id;?>" id="<?php echo 'rate_id'.$roll_id;?>">
		 

		</tr>
		 
		<?php $roll_id++;
		$total_amount+=$quotation_list['amount'];
	  
		}
		 ?>
		 <?php } ?>
	</tbody>				  
		</table>
<label style="margin-left:  600px;font-size: 16px;font-weight: 600"  id="net_amount">Total Amount : <?php echo number_format($total_amount,2); ?></label>



<?php
 
if($orderview['quotation_status']=='1')
{

	include("file_upload_subllist.php"); 
	 if(count($pdfview)=='0')
	 {
	     ?>
	     		<div class="controls">
	     <input type='hidden' id='check_img' name='check_img' value='0'>
		 <input type="file" name="image1" id="image1"  class="form-control">
		 <input type="file" name="image2" id="image2" class="form-control">
		</div>

	     <?php
	 }
	
}	
	 else  {?>
		<div class="controls">
		 <input type="file" name="image" id="image"  class="form-control">
		 <input type="file" name="image1" id="image1" class="form-control">
		</div>
		
						 <?php  } ?>
		 <?php if($orderview['quotation_status']!='1') {?>
		 <a id="quotation_save" style="margin-right:10px;" class="float-right btn btn-primary quotation-save lookUpClick"   onclick="quotation_save('<?php echo $enquiry_id; ?>', '<?php echo $count ?>',<?php echo $roll_id; ?>,  'quotation_add')"  >Save</a> 
		<?php } 

		else
		{ ?>
			<a id="quotation_save" style="margin-right:10px;" class="float-right btn btn-primary quotation-save lookUpClick"   onclick="quotation_update('<?php echo $enquiry_id; ?>', '<?php echo $count ?>',<?php echo $roll_id; ?>,  'quotation_update')"  >Update</a> 
			<?php
			}
			?>
		
</form>
<script>/*
function calc(roll_id) {
	//alert(roll_id);
	var net_total=0;
	$("#amount"+roll_id).val("");
	 var rate=$("#rate"+roll_id).val();
	 var quantity=$("#qty"+roll_id).val();
	 var total_amount=parseInt(rate) * parseInt(quantity);
	 $("#amount"+roll_id).val(total_amount);
	 
	for (var i=1;i<=count;i++)
	 {
	     var total_value=	$("#amount"+i).val();
	      
	     if(total_value!='')
	     {
	     net_total+=parseInt(net_total)+parseInt(total_value);
	     }
	 }
	 	 $("#net_amount").text("Total Amount  : "+net_total);
}*/


function quotation_update(enquiry_id, count,roll_id ,action)
{	 


var quotation_number=$("#quotation_number").val();

var file_data = jQuery("#image1").prop("files")[0];

var file_data1 = jQuery("#image2").prop("files")[0];

var file_value=$("#image1").val();

 var file_value1=$("#image2").val();
var check_img=$('#check_img').val();
if(check_img==undefined)
{
	check_img='2';
}
	if(quotation_number=='')
	{
		alert("Please Enter the Quotation Number");
		$("#quotation_number").focus();
	}

	else
	{

		for( var i=1;i<=count;i++)
		{
			var rate=$("#rate"+i).val()
			if(rate=='')
			{
				alert("Please Enter the rate");
				$("#rate"+i).focus();
				break;
			}
		}

var action="quotation_update"; 
		var roll_id=roll_id; 
	    var fdata=new FormData();
	    fdata.append("enquiry_id", enquiry_id);
	    fdata.append("count", count); 	
	    fdata.append("user_type_id",user_type_id);
	    fdata.append("usercreation_id",usercreation_id);
	    fdata.append("action",action);
	     fdata.append("file", file_data);
	    fdata.append("file1", file_data1);
	    fdata.append("check_img",check_img);
	  
	  //  alert(roll_id);
	    var other_data = $('form').serializeArray();
		$.each(other_data,function(key,input){
		    fdata.append(input.name,input.value);
		});
	 	if((i-1)==count)
		{
	
$('#quotation_save').removeAttr('onclick');
	
	 		jQuery.ajax({
			type: "POST",
			url: "enquiry/curd.php",
			cache: false,
			contentType: false,
			processData: false,
			data: fdata,
			success: function(msg)
			{
	 	
	 console.log(msg);
				// alert("Enq Id: " + enquiry_id + "Count is: " + count + "Action is: " + Add);
	 			if(msg=='error')
	 			{						
	 				$("#distinct_error").text("Invalid Data");
	 				return false;
	 			}
	 			else
				{
				//alert(msg);
			//
					alert("Successfully Updated");
					window.location.href="index.php?file=enquiry/list";
	 			}
			}
	 	});
	 	}	
	}
}

function quotation_save(enquiry_id, count,roll_id ,action)
{	 


var quotation_number=$("#quotation_number").val();
var file_data = jQuery("#image").prop("files")[0];

var file_data1 = jQuery("#image1").prop("files")[0];

var file_value=$("#image").val();

 var file_value1=$("#image1").val();
	if(quotation_number=='')
	{
		alert("Please Enter the Quotation Number");
		$("#quotation_number").focus();
	}
	else if(file_value=='')
	{
		alert("Please Upload the PDF File");
	}
	else
	{

		for( var i=1;i<=count;i++)
		{
			var rate=$("#rate"+i).val()
			if(rate=='')
			{
				alert("Please Enter the rate");
				$("#rate"+i).focus();
				break;
			}
		}
var action="quotation_add"; 
		var roll_id=roll_id; 
	    var fdata=new FormData();
	    fdata.append("file", file_data);
	    fdata.append("file1", file_data1);
	    fdata.append("enquiry_id", enquiry_id);
	    fdata.append("count", count); 	
	    fdata.append("user_type_id",user_type_id);
	    fdata.append("usercreation_id",usercreation_id);
	    fdata.append("action",action);
	  //  alert(roll_id);
	    var other_data = $('form').serializeArray();
		$.each(other_data,function(key,input){
		    fdata.append(input.name,input.value);
		});
	 	if((i-1)==count)
		{
	
$('#quotation_save').removeAttr('onclick');
	
	 		jQuery.ajax({
			type: "POST",
			url: "enquiry/curd.php",
			cache: false,
			contentType: false,
			processData: false,
			data: fdata,
			success: function(msg)
			{
	 	
				// alert("Enq Id: " + enquiry_id + "Count is: " + count + "Action is: " + Add);
	 			if(msg=='error')
	 			{						
	 				$("#distinct_error").text("Invalid Data");
	 				return false;
	 			}
	 			else
				{
				//alert(msg);
			//
					alert("Successfully Updated");
					window.location.href="index.php?file=enquiry/list";
	 			}
			}
	 	});
	 	}	
	}
}//}


function get_total_amount(roll_id)
{
    
    	

    var rate= $("#rate"+roll_id).val();
	 
	 var quantity=$("#qty"+roll_id).val();
	 var total_amount=parseFloat(rate) * parseFloat(quantity);
    

	var gst_per=$("#gst_per"+roll_id).val();

   if(gst_per!='')
    {
        //var perc=gst_per/100;
       //var gst_val=parseFloat(total_amount)*parseFloat(perc);
       var gst_rate=parseFloat(rate)*(gst_per/100);
       var plus_rate_gst=parseFloat(gst_rate) + parseFloat(rate);
       var plus_rate_gst=Math.round(plus_rate_gst);
       var gst_val=parseFloat(plus_rate_gst) * parseFloat(quantity);
       var total=Math.round(gst_val);

    }
    else
    {
       var gst_val=parseFloat(total_amount)*(gst_per/100);
       var total=parseFloat(total_amount) + parseFloat(gst_val);

    }
     $("#amount"+roll_id).val(total.toFixed(2));
      var count=$("#count").val();
	  var net_total=0;
	 for (var i=1;i<=count;i++)
	 {
	    var total_value=$("#amount"+i).val();
        if(total_value!='')
	     {

	     net_total=parseFloat(net_total) + parseFloat(total_value);

	     }
	 }
	 	 $("#net_amount").text("Total Amount  : "+(net_total.toFixed(2)));
	 	 
	 	 
}
function get_per_amt(id)
{
    var rate= $("#rate"+id).val();
	 
	 var quantity=$("#qty"+id).val();
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

	 var count=$("#count").val();

	  var net_total=0;
	 for (var i=1;i<=count;i++)
	 {
	    
	     var total_value=	$("#amount"+i).val();
	      
	      
	      
	     if(total_value!='')
	     {
	       
	     net_total=parseFloat(net_total) + parseFloat(total_value);
	   
	     }
	 }
	 	 $("#net_amount").text("Total Amount  : "+(net_total.toFixed(2)));
 
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


.header_part
{
	font-size: 15px;
	margin-left: 10px;
}
</style>

