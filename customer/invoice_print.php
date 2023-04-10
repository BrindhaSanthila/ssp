ssssssssssssssssssssss<?php


echo "dsfsdf".$package_amount    = $_GET['package_amount'];

echo "jzxljzxc".$order_tax 	    = $_GET['order_tax'];
echo "zxczcxzc".$transaction_charges 	= $_GET['trans_charges'];

?>
<div class="container">
<div class="row">
	    <div class="col-md-3"></div>
		<div class="col-md-9">
	<table class="table table-striped table-bordered">
	<thead>
	<tr>
	  <th scope="col" style="text-align:center"><b>#</th>
	  <th scope="col"><b>Description</b></th>
	  <th scope="col" style="text-align:right"><b>Amount</b></th>
	</tr>
	</thead>
	<tbody>
	<tr>
	  <th scope="row" style="text-align:center">1</th>
	  <td>Starter Pack</td>
	  <td style="text-align:right"><b><?php echo $package_amount;?></b></td>
	</tr>
	<tr>
	  <th scope="row"></th>
	  <td>GST 18%</td>
	  <td style="text-align:right"><b><?php echo $order_tax;?></b></td>
	</tr>
	<tr>
	  <th scope="row"></th>
	  <td>Transaction fee 2.25%</td>
	  <td style="text-align:right"><b><?php echo $transaction_charges;?></b></td>
	</tr>
	<tr>
	  <th scope="row"></th>
	  <td style="text-align:right"><b>Total</b></td>
	  <td style="text-align:right"><b>734.fghgfh46</b></td>
	</tr>
	</tbody>
	</table>
	</div>
	</div>
	</div>
<script>
window.onload = function() 
{
	//window.print();
}

</script>