<?php
include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
error_reporting(0);
 
$invoice_list= $pdo_conn->prepare("SELECT * FROM invoice  WHERE  status='1' and invoice_no='".$_GET['invoice_no']."' ");
$invoice_list->execute();
$invoicelist = $invoice_list->fetchAll();
$invoice_no=$invoicelist[0]['invoice_no'];
$enquiry_id=$invoicelist[0]['enquiry_id'];

$enquiry_list = $pdo_conn->prepare("SELECT customer_id FROM enquiry WHERE enquiry_id='".$enquiry_id."'");
	$enquiry_list->execute();
	$enquiry = $enquiry_list->fetch(); 
	$customer_name=$enquiry['customer_id'];

	$customer_mobile = $pdo_conn->prepare("SELECT customer_name,address FROM customer_creation WHERE customer_id='".$customer_name."'");
	$customer_mobile->execute();
	$customer = $customer_mobile->fetch(); 
	$customer1=$customer['customer_name'];
	$address=$customer['address'];





?>


<style>
.name{font-family:calibri;font-size:36px;color:#333;font-weight:bold;}
.invoice{font-family:calibri;font-size:26px;color:#333;font-weight:bold;}
.title{font-family:calibri;font-size:16px;color:#333;font-weight:bold;}
.data{font-family:calibri;font-size:16px;color:#333;}
.left{border-left:1px solid #ccc;}
.right{border-right:1px solid #ccc;}
.top{border-top:1px solid #ccc;}
.bottom{border-bottom:1px solid #ccc;}
.head2{font-family:calibri;font-size:26px;color:#333;}
.head{font-family:calibri;font-size:20px;color:#333;}
.head1{font-family:calibri;font-size:16px;color:#333;}
</style>

<!-- <table width="850px" align="center" cellpadding="0" cellspacing="0">
<tr align="center">
<td width="538" height="50" class="top left head2 right"><span style="font-weight:bold" ><?php echo nl2br($building_details[building_name]); ?></span></br><span class="data head1"><?php echo $building_details[description]; ?></br><span  style="font-weight:bold">GST No:<?php echo "29ACGPD9381D1ZI"; ?></span></td>
</tr>
</table> -->

<table width="850px" align="center" cellpadding="0" cellspacing="0">
<tr align="center">
<td colspan="3" height="5" class="top right left head" style="font-weight:bold">INVOICE</td>
</tr>

<tr>
<td width="250" class="data head1 left" style="padding-left:10px; font-size:18px;"><b>Mr/Ms. <?php echo ucfirst(strtolower($customer1));?>,</b></td>
<td width="340" class="data head1" rowspan="2" style="padding-left:10px; font-size:18px;"></td>
<td width="250" class="data right head1" style="padding-left:10px; font-size:18px;"><b style=" font-weight:bold">Invoice No&nbsp;:&nbsp;</b>
<span style="font-size:16px;"><?php echo  $invoice_no;?></span></br>
Date:<?php echo date("d-m-Y");?>
</td>

</tr>
<tr>
<!-- <td class="data left head1" style="padding-left:10px; font-size:16px;"><?php echo ucfirst(strtolower(nl2br($address)));?>
<?php if($get_cust_details[pancard_no]!=''){?></br><b style="font-weight:bold">Pancard No&nbsp;:&nbsp;</b><?php echo $get_cust_details[pancard_no];?><?php } ?>
<?php if($get_cust_details[gst_no]!=''){?></br><b style="font-weight:bold">GST No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b><?php echo $get_cust_details[gst_no];?><?php } ?>
</td> -->
<!-- <td class="data right head1" style="padding-left:10px; font-size:18px;" valign="top"><b style=" font-weight:bold">Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b>
<span style="font-size:16px;"><?php echo  date("d-m-Y",strtotime($receipt_no_details[receipt_date]));?></span></td>
 --></tr>
<tr>

<td colspan="3" class="left  right">&nbsp;</td>
</tr>
</table>

<table width="850px" align="center" cellpadding="0" cellspacing="0">
<tr style="background-color:#efefef;">
<td width="4%" height="35" align="center" class="left top right bottom title">S.No</strong></td>
<td class="right bottom top title" align="left">&nbsp;Description</strong></td>
<td width="12%" class="right bottom top title" align="right">Amount&nbsp;</td>
</tr>
<tbody>
<?php

/*************************************************************** Current Page *************************************************************/

$rscount=mysql_num_rows($invoicelist);
$sno=$from+1;
 foreach($invoicelist as $value){

	
	$item_rate=$value[amount];
	$tax=18;
	$tax_divide=$tax/2;
// calculations
	$amount=$value[amount];
	$amount_sum=$value[amount];
	$c_s_gst = ($amount_sum*$tax)/100;
	$tot_amount=$c_s_gst+$amount;
	?>
<tr height="30">
<td width="12%" height="25" style="text-align:center; padding-bottom:20px" class="right left data">&nbsp;<?php echo $sno++;?></td>
<td class="right data" style="padding-left:5px;"><?php echo get_item_name($value['item_id']); ?></td>
<td width="10%" align="right" class="right data"><?php echo  number_format($amount,2);?>&nbsp;</td>
</tr>
<?php 

$amnt+=$amount;
$tot_cgst_amt+=$c_s_gst;
$tot_sgst_amt+=$c_s_gst;
$tot_finail_tot+=$tot_amount;
$amt_tot+=$amount_sum;
}
$height=500;
?>
</tbody>
<tr height="500">
<td width="4%" height="25" style="text-align:center; padding-bottom:20px;" class="right left data">&nbsp;</td>
<td class="right data" style="padding-left:5px;"></td>
<td width="12%" align="right"  class="right   title">&nbsp;</td>

</tr>	

<tr height="10" style="background-color:#efefef;">
<td width="4%" height="25" style="text-align:center; padding-bottom:20px;" class="top right left data">&nbsp;</td>
<td align="right" class="top right data" style="padding-left:5px; font-weight:bold"><?php echo "Amount";?>&nbsp;</td>
<td class="top right title" align="right"><?php echo number_format(round($amt_tot),2); ?>&nbsp;</td> 


</tr>

</table>
<?php if($rscount<16){?>
<table width="850px" align="center" cellpadding="0" cellspacing="0">
<tr>
<td height="30" class="top title left bottom">&nbsp;Amount in Words :&nbsp;&nbsp;Rupees <?php echo convert_number(round($tot_finail_tot));?> Only</td>
<td class="top data left bottom">&nbsp;CGST</td>
<td class="top data right bottom" align="right"><?php echo number_format($tot_cgst_amt/2,2); ?>&nbsp;</td>
</tr>

<!-- <td rowspan="4" class="left bottom">
	<table width="100%" height="91">
	<tr>
    <td width="18%" class="data">Account Name</td>
    <td width="2%" class="data">:</td>
    <td width="80%" class="data"><b>Devaraj</b></td>
    </tr>
    
     <tr>
    <td class="data">Account No</td>
    <td width="2%" class="data">:</td>
    <td class="data"><b>512120020006765</b></td>
    </tr>
    <td class="data">IFS Code</td>
    <td width="2%" class="data">:</td>
    <td class="data"><b>CIUB0000059</b></td>
    </tr>
    <tr>
    <td class="data">Bank Name</td>
    <td width="2%" class="data">:</td>
    <td class="data"><b>City Union Bank</b></td>
    </tr>
    </table> -->

<table width="850px" align="center" cellpadding="0" cellspacing="0">
<td height="30" class="data left bottom">&nbsp;SGST</td>
<td class="data right bottom" align="right"><?php echo number_format($tot_cgst_amt/2,2); ?>&nbsp;</td>
</tr>
<tr>
<td height="30" class="title left bottom" style="background-color:#efefef;">&nbsp;GST</td>
<td class="title right bottom" style="background-color:#efefef;" align="right"><?php echo number_format($tax_amt_gst=$tot_cgst_amt,2); ?>&nbsp;</td>
</tr>
<tr>
<td height="30" class="title left" style="background-color:#efefef;">&nbsp;Total Amount</td>
<td class="title right" style="background-color:#efefef;" align="right"><?php echo  number_format(round($tot_finail_tot),2); ?>&nbsp;</td>
</tr>
<tr>
<td class="data left right bottom" colspan="2" style="font-size:12px;" align="right"></td>
</tr>
<!--<tr>
<td class="data left right bottom" colspan="3" style="font-size:12px;" align="right">Continued to 2 Page</td>
</tr>-->
</table>
</table>   
<?php }?> 
   

<table width="850px" align="center" cellpadding="0" cellspacing="0">
<tr>
<td height="100" valign="top" class="left right top data" style="padding-top:3px;padding-left:5px;"><strong>Terms and Conditions :</strong></td>
</tr>
<tr>
<td height="25" align="center" class="top bottom left right title" style="padding-top:3px;padding-left:5px;">
This is a computer generated Print &amp; does not require signature.</td>
</tr>



</table>
 
<?php 
function convert_number($number) 
{ 
if (($number < 0) || ($number >99999999)) 
{ 
throw new Exception("Number is out of range");
} 

$Gn = floor($number / 10000000); /* Crores (giga) */ 
$number -= $Gn * 1000000; 
  $ln = floor($number / 100000); /* laksh (giga1) */ 
$number -= $ln * 100000; 
$kn = floor($number / 1000); /* Thousands (kilo) */ 
$number -= $kn * 1000; 
$Hn = floor($number / 100); /* Hundreds (hecto) */ 
$number -= $Hn * 100; 
$Dn = floor($number / 10); /* Tens (deca) */ 
$n = $number % 10; /* Ones */ 

$res = ""; 

if ($Gn) 
{ 
$res .= convert_number($Gn) . " Crore"; 
} 
if ($ln) 
{ 
$res .= (empty($res) ? "" : " ") . 
convert_number($ln) . " Lakh"; 
} 
if ($kn) 
{ 
$res .= (empty($res) ? "" : " ") . 
convert_number($kn) . " Thousand"; 
} 

if ($Hn) 
{ 
$res .= (empty($res) ? "" : " ") . 
convert_number($Hn) . " Hundred"; 
} 

$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
"Nineteen"); 
$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
"Seventy", "Eigty", "Ninety"); 

if ($Dn || $n) 
{ 
if (!empty($res)) 
{ 
$res .= " and "; 
} 

if ($Dn < 2) 
{ 
$res .= $ones[$Dn * 10 + $n]; 
} 
else 
{ 
$res .= $tens[$Dn]; 

if ($n) 
{ 
//$res .= "-" . $ones[$n]; 
$res .= " " . $ones[$n]; 
} 
} 
} 

if (empty($res)) 
{ 
$res = "zero"; 
} 

return $res; 
} 
function ledger_name1() {
	
$creditors = 0;

return $creditors;
}


function get_address(){
	
	$address = 0;
	return $address;
	
	}
	

				  
	function get_gst_code(){
		
	
	$gst_code = 0;
	return $gst_code;
		
		}
		
		/*function get_state_name(){
			
		$gst_code = 0;
	return $gst_code;
			
			}
			function get_state_code(){
			
		$gst_code = 0;
	return $gst_code;
		
			
			
			}
*/
?>

<?php 

 if ($page_count_tot > $show) 
			  { 			  $show;
			include("footer_links.php");
			  }
	?>