<style>
h5.view_mode{
	font-weight:bold;
}
</style>
<script language="javascript" type="text/javascript"></script>
<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');

$invoice_list= $pdo_conn->prepare("SELECT * FROM invoice  WHERE  status='1' ");
$invoice_list->execute();
$invoicelist = $invoice_list->fetchAll();


?>
 

<form>

		<table>
	<thead>
		<tr class="bold">
			<th>#</th>
			<th>Invoice No</th>
			<th>Category Name</th>
			<th>Sub Category Name</th>
			<th>Item Name</th>
			<th>Final Quantity</th>
			<th>Amount</th>
			
		</tr>
	</thead>
	
	<tbody>						
		<?php 
		$i=0;
		$total_amount=0;
		foreach($invoicelist as $value){
  

		 
			?>

		
		<tr>
			<td>
                 
				<?php echo $roll_id;?></td>
            <td> 
             <?php echo $value['invoice_no']; ?>
			</td>
              <td><?php echo  get_category_name($value['category_id']);?>	</td>
			<td> <?php  echo get_subcategory_name($value['subcategory_id']);?></td>
			<td><?php  echo get_item_name($value['item_id']);?></td>
			 <td><?php  echo $value['final_quantity'];?></td>
             <td><?php  echo $value['amount'];?></td>
			

		</tr>
		
		<?php $roll_id++;
		
	}

	 ?>
	</tbody>				  
		</table>


</form>

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
</style>