<section class="content-header">
	<h1>
		<center>Collection Reports</center>
	</h1>	  
</section>
<?php 
include("../inc/dbConnect.php");
error_reporting(0);

$current_date = date('Y-m-d');
$from_date = $_POST['start_date'];
$to_date = $_POST['end_date'];
if($from_date != "") { 
	$from_date1 = "sales_date>='$from_date'"; 
} else {
	$from_date1 = "sales_date='$current_date'";
}
if($to_date != "") { 
	$to_date1 =  "sales_date<='$to_date'"; 
} else {
	$to_date1 = '';
}

$get_query101 = $from_date1 . " AND " . $to_date1;

$select_sales_entry = $pdo_conn->prepare("SELECT * FROM sales_entry WHERE $get_query101 AND sales_date != '' ORDER BY sales_date DESC");
$select_sales_entry->execute();
$result = $select_sales_entry->fetchAll();
?>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-12">
			<div class="box">
				<div class="box-body">
					<div class="table-responsive">
						<table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">
							<div class="pint_btn">
								<button onclick="print_list('collectionreport/list_print.php')">
									<i class="fa fa-print"></i>PRINT
								</button>
								&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							</div>
							<form>
								<label for="start_date">Start Date:</label>
								<input type="date" id="start_date" name="start_date" value="<?php echo date('Y-m-d');?>">
								<label for="end_date">End Date:</label>
								<input type="date" id="end_date" name="end_date" value="<?php echo date('Y-m-d');?>">
								<label class="pint_btn"></label>
								<div>
									<button onClick="collectionreport_list(start_date.value,end_date.value);">Search</button>
								</div>
							</form>
							<thead>
								<tr class="bold">
									<th class="th_div">#</th>
									<th class="th_div">Sales Date</th>
									<th class="th_div">Party Name</th>
									<th class="th_div">Outstanding Amount</th>
									<th class="th_div">Seller Name</th>
									<th class="th_div">Area</th>
									<th class="th_div">Today</th>
								</tr>
							</thead>
							<tbody>	
								<?php
								$i = 0;
								foreach($result as $value) {        
								?>
								<tr>
									<td><?php echo $i += 1;?></td>
									<td><?php echo date('d-m-Y',strtotime($value['sales_date']));?></td>
									<td><?php echo $value['party_id'];?></td> 
									<td><?php echo $value['party_id'];?></td>
									<td><?php echo $value['sales_date'];?></td>
									<td><?php echo $value['sales_date'];?></td>
								</tr>		                    
								<?php } ?> 
							</tbody>
						</table>
					</div>              
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
