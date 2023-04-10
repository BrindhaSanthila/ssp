<style>
h5.view_mode{
	font-weight:bold;
}
</style>
<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
error_reporting(0);
$enquiry_id =$_POST['enquiry_no'];

// echo "Enquiry id: " . $enquiry_id;
// echo "<script>alert('enquiry id is: "+" ".$enquiry_id."')</script>";

$order_view = $pdo_conn->prepare("SELECT * FROM order_confirm  WHERE  enquiry_id='".$_POST['enquiry_no']."'");
$order_view->execute();
$orderview = $order_view->fetchAll();

$order_view = $pdo_conn->prepare("SELECT * FROM enquiry  WHERE  enquiry_id='".$_POST['enquiry_no']."'");
$order_view->execute();
$orderview = $order_view->fetchAll();
?>

<h5>Quotation No: <?php echo $enquiry_id;?> </h5>
<table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">
				
	<thead>
		<tr class="bold">
			<th>#</th>
			<th>Category Name</th>
			<th>Sub Category Name</th>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Status</th>
		</tr>
	</thead>
	
	<tbody>						
		<?php foreach($orderview as $value){?>

		<tr>
			<td><?php echo $roll_id;?></td>

			<td>
			<?php $select_categoryname = $pdo_conn->prepare("SELECT order_confirm.order_id, order_confirm.enquiry_id,  order_confirm.status, category.category_id, category.category_name FROM (order_confirm INNER JOIN category ON category.category_id=order_confirm.category_id) WHERE order_id='".$value['order_id']."' ");
							$select_categoryname->execute();
							$categoryname = $select_categoryname->fetch();
							echo $categoryname['category_name'];
								?>
			</td>

				
			<td>
			 <?php $select_subcategory = $pdo_conn->prepare("SELECT order_confirm.order_id, order_confirm.enquiry_id order_confirm.status, subcategory.subcategory_id, subcategory.subcategory_name FROM (order_confirm INNER JOIN subcategory ON subcategory.subcategory_id=orders.subcategory_id) WHERE order_id='".$value['order_id']."' ");
							$select_subcategory->execute();
							$subcategory = $select_subcategory->fetch();
							echo $subcategory['subcategory_name'];
								?>
			</td>
			<td><?php $select_item = $pdo_conn->prepare("SELECT order_confirm.order_id, order_confirm.enquiry_id, order_confirm.enquiry_no, order_confirm.status, itemcreation.item_id, itemcreation.item_name FROM (order_confirm INNER JOIN itemcreation ON itemcreation.item_id=order_confirm.item_id) WHERE order_id='".$value['order_id']."' ");
							$select_item->execute();
							$selectitem = $select_item->fetch();
							echo $selectitem['item_name'];
								?></td>
								
			<td><?php echo $value['quantity']; ?></td>	
			
			<td><?php if ($value['status']=='1'){ echo "Active";} else { echo "Inactive"; }?></td>
		
		</tr>
		<?php $roll_id++;} ?>


	</tbody>				  
		</table>
<label>Discount Amount : <?php echo  ?></label>
<style>

</style>