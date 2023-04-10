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

// echo "Enquiry id: " . $enquiry_id;
// echo "<script>alert('enquiry id is: "+" ".$enquiry_id."')</script>";

$enquiry_item = $pdo_conn->prepare("SELECT * FROM enquiry_item  WHERE  enquiry_id='".$_POST['enquiry_id']."'");
$enquiry_item->execute();
$enquiryitem = $enquiry_item->fetchAll();
?>

<h5>Enquiry Id: <?php echo get_enquiry_number($enquiry_id);?> </h5>

<table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">
				
	<thead>
		<tr class="bold">
			<th>#</th>
			<th>Category Name</th>
			<th>Sub Category Name</th>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Status</th>
			<th>Image 1</th>
			<th>Image 2</th>
			<th>Image 3</th>
			<th>Image 4</th>
		</tr>
	</thead>
	
	<tbody>						
		<?php foreach($enquiryitem as $value){

			$image1=$value['enquiry_image'];
			$image2=$value['enquiry_image1'];
			$image3=$value['enquiry_image2'];
			$image4=$value['enquiry_image3'];
?>

		<tr>
			<td><?php echo $roll_id;?></td>

			<td>
			<?php $select_categoryname = $pdo_conn->prepare("SELECT enquiry_item.order_id, enquiry_item.enquiry_id, enquiry_item.status, category.category_id, category.category_name FROM (enquiry_item INNER JOIN category ON category.category_id=enquiry_item.category_id) WHERE order_id='".$value['order_id']."' ");
							$select_categoryname->execute();
							$categoryname = $select_categoryname->fetch();
							echo $categoryname['category_name'];
								?>
			</td>

				
			<td>
			 <?php $select_subcategory = $pdo_conn->prepare("SELECT enquiry_item.order_id, enquiry_item.enquiry_id, enquiry_item.status, subcategory.subcategory_id, subcategory.subcategory_name FROM (enquiry_item INNER JOIN subcategory ON subcategory.subcategory_id=enquiry_item.subcategory_id) WHERE order_id='".$value['order_id']."' ");
							$select_subcategory->execute();
							$subcategory = $select_subcategory->fetch();
							echo $subcategory['subcategory_name'];
								?>

			</td>
			<td><?php $select_item = $pdo_conn->prepare("SELECT enquiry_item.order_id, enquiry_item.enquiry_id, enquiry_item.status, itemcreation.item_id, itemcreation.item_name FROM (enquiry_item INNER JOIN itemcreation ON itemcreation.item_id=enquiry_item.item_id) WHERE order_id='".$value['order_id']."' ");
							$select_item->execute();
							$selectitem = $select_item->fetch();
							echo $selectitem['item_name'];
								?></td>

								
			<td><?php echo $value['quantity']; ?></td>	
			
			<td><?php if ($value['status']=='1'){ echo "Active";} else { echo "Inactive"; }?></td>
		
			<td><?php if($image1!=''){ ?><a href="javascript:pdf_view('<?php echo $image_path."enquiry_images/".$image1; ?>');" title="View Material" ><img  src="<?php echo $image_path."enquiry_images/".$value['enquiry_image']; ?>" style="height:60px; width:60px;"  ></a> <?php } else { ?><img   src="images/images.jpg" style="height:60px; width:60px;" > <?php } ?> </td>

			<td><?php if($image2!=''){ ?><a href="javascript:pdf_view('<?php echo $image_path."enquiry_images/".$image2; ?>');" title="View Material" ><img  src="<?php echo $image_path."enquiry_images/".$value['enquiry_image1']; ?>"  style="height:60px; width:60px;"  ></a> <?php } else { ?><img   src="images/images.jpg" style="height:60px; width:60px;" > <?php } ?> </td>

			<td><?php if($image3!=''){ ?><a href="javascript:pdf_view('<?php echo $image_path."enquiry_images/".$image3; ?>');" title="View Material" ><img  src="<?php echo $image_path."enquiry_images/".$value['enquiry_image2']; ?>" style="height:60px; width:60px;"  ></a><?php } else { ?><img   src="images/images.jpg" style="height:60px; width:60px;" > <?php } ?> </td>

			 
			<td><?php if($image4!=''){ ?><a href="javascript:pdf_view('<?php echo $image_path."enquiry_images/".$image4; ?>');" title="View Material" ><img  src="<?php echo $image_path."enquiry_images/".$value['enquiry_image3']; ?>"  style="height:60px; width:60px;"  ></a><?php } else { ?><img   src="images/images.jpg" style="height:60px; width:60px;" > <?php } ?> </td>
		
		</tr>
		<?php $roll_id++;} ?>


	</tbody>				  
		</table>
		
		 
<script type="text/javascript">
function pdf_view(url)
{
  onmouseover55= window.open(url,'onmouseover55','height=450px,width=650px,scrollbars=yes,resizable=no,left=420,top=190,toolbar=no,location=no,directories=no,status=no,menubar=no');
}
 
 </script>