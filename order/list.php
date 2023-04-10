<section class="content-header">
	<h1>
    <center>Orders Details</center>
  	<!-- <?php echo ucfirst($foldername); ?><a href="index.php?file=city/create" class="float-right btn-sm btn-primary">Add New</a> -->
  </h1>	  
</section>

<?php 
  $select_order_entry = $pdo_conn->prepare("SELECT * FROM order_entry ORDER BY order_date DESC ");
  $select_order_entry->execute();
  $result = $select_order_entry->fetchAll();
  $order_id=1;
?>


<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="box">
       <!-- /.box-header -->
      <div class="box-body">
				<div class="table-responsive">
				  <table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">
            <div class="pint_btn">
                <button onclick="print_list('order/list_print.php')"><i class="fa fa-print" ></i>PRINT</button>
            </div>
					<thead>
						<tr class="bold">
             
              <th class="th_div">#</th>
              <th class="th_div">Order ID</th>
              <th class="th_div">Order Date</th>
              <th class="th_div">Order No</th>
              <!--<th class="th_div">Random No</th>
              <th class="th_div">Random Sc</th> -->
              <th class="th_div">Party Name</th>
              <th class="th_div">Material Name</th>
              <th class="th_div">Delivery Area</th>
              <th class="th_div">Delivery date</th>
              <th class="th_div">Payment Mode</th>
              <th class="th_div">Status</th>
              <th class="th_div">Quantity</th>
               <th class="th_div">Rate</th>
              <th class="th_div">Amount</th>
              <!--<th class="th_div">Created_employee ID</th>
              <th class="th_div">Updatd Employee id</th>
              <th class="th_div">Created </th> -->
						</tr>
					</thead>
					<tbody>						
    <?php 
    $i='0';
    foreach($result as $value) { 				
						?>
             <tr>
              <td><?php echo $i+=1;?></td>
              <td><?php echo $value['order_id'];?></td>
							<td><?php echo date('d-m-Y',strtotime($value['order_date']));?></td>
              <td><?php echo $value['order_no'];?></td>
              <td><?php echo get_party_name($value['party_id']);?></td> 
              <td><?php echo get_material_name($value['material_id']);?></td>
              <td><?php echo get_area_name($value['delivery_area']);?></td>
              <td><?php echo date('d-m-Y',strtotime($value['delivery_date']));?></td>
              <td><?php echo $value['payment_mode'];?></td>
              <td><?php echo $value['status'];?></td>
              <td><?php echo $value['quantity'];?></td>
              <td><?php echo number_format($value['rate'],2);?></td>
              <td><?php echo number_format($value['amount'],2);?></td>

                           <td> 
						   <a href="#" title="View" id="staff_view_modal" onclick="order_view_modal('order/view.php','<?php echo $value['order_id'];?>')" data-toggle="modal" data-target="#staff_view"><i class="fa fa-eye" aria-hidden="true"></i></a> 
                          
						  <a href="index.php?file=order/update&order_id=<?php echo $value['order_id']?>" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  
                          	
               <a href="#" id="<?php echo $value['order_id']?>" onclick="del(<?php echo $value['order_id']?>)" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
						 -->
						  </td>
						</tr>
                        <?php $roll_id++;} ?>
						
						
					</tbody>				  
				</table>
				</div>              
            </div>
            <!-- /.box-body -->
             <!-- The Modal -->
              
               <!-- /.modal -->
            
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
	<!-- /.content -->
<script>
function del(city_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "city/curd.php?action=DELETE",
			data: "city_id="+city_id,
			success: function(msg){ 
			alert(msg);
			$("#"+city_id).closest('tr').remove();
			}});
	}

}


function city_view_modal(url,city_id){
	window.open(url+'?city_id='+city_id,'onmouseover','height=650,width=950,scrollbars=yes,resizable=no,left=250,top=250,toolbar=no,location=no,directories=no,status=no,menubar=no');  
}
function print_list(url) {
  window.open(url+'?','onmouseover','height=650,width=950,scrollbars=yes,resizable=no,left=250,top=400,toolbar=no,location=no,directories=no,status=no,menubar=no'); 
}


</script>
<style>
tr.bold th {
    font-weight: 600;
}
.pint_btn button {
    background: #447c09;
    color: white;
    padding: 8px;
    width: 80px;
    border: 0px;
    font-weight: 600;
    float: left;
}
.pint_btn i {
    padding-right: 10px;
    font-size: 17px;
}
</style>