include("../inc/dbConnect.php");
include '../inc/header.php';
<?php 
include_once('connection.php'); 
$query="select * from student"; 
$result=mysql_query($query); 
?> 
<!DOCTYPE html> 
<html> 
	<head> 
		<title> Fetch Data From Database </title> 
	</head> 
	<body> 
	<table align="center" border="1px" style="width:600px; line-height:40px;"> 
	<tr> 
		<th colspan="4"><h2> Order Details</h2></th> 
		</tr> 
			  <th> ID </th> 
			  <th> Order No </th> 
			  <th> Order Date </th> 
			  <th> random_no </th> 
			  <th> random_sc  </th> 
			  <th> Party_Id </th> 
			  <th> party_ac_no </th> 
			  <th>  material_id </th> 
			  <th> quantity </th> 
			  <th> rate </th> 
			  <th>  amount</th> 
			  <th>  delivery_area</th> 
			  <th>  delivery_date</th> 
			  <th>  payment_mode</th> 
			  <th>  status</th> 
			  <th>  created_employee_id </th>
			  <th>	updated_employee_id </th>
			  <th> created </th>
		</tr> 
		
		<?php 
		while($rows=mysql_fetch_assoc($result)) 
		{ 
		?> 
		<tr> <td><?php echo $rows['order_id']; ?></td> 
		<td><?php echo $rows['order_no']; ?></td> 
		<td><?php echo $rows['order_date']; ?></td> 
		<td><?php echo $rows['random_sc']; ?></td> 
		<td><?php echo $rows['order_no']; ?></td> 
		<td><?php echo $rows['order_date']; ?></td> 
		<td><?php echo $rows['party_id']; ?></td> 
		<td><?php echo $rows['party_ac_no']; ?></td> 
		<td><?php echo $rows['order_date']; ?></td> 
		<td><?php echo $rows['Country']; ?></td> 
		</tr> 
	<?php 
               } 
          ?> 

	</table> 
	</body> 
	</html>