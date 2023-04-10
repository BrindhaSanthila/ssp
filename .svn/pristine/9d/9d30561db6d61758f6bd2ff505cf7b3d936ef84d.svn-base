<section class="content-header">
	<h1>
    <small>Manage</small>
  	<?php echo ucfirst($foldername); ?><a href="index.php?file=unit/create" class="float-right btn-sm btn-primary">Add New</a>
  </h1>	  
</section>

<?php 
  $select_purchaseentry = $pdo_conn->prepare("SELECT * FROM unit_creation ORDER BY unit_id DESC");
  $select_purchaseentry->execute();
  $result = $select_purchaseentry->fetchAll();
  $roll_id=1;
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
                <button onclick="print_list('unit/list_print.php')"><i class="fa fa-print" ></i>PRINT</button>
            </div>
					<thead>
						<tr class="bold">
							<th>#</th>
							<th>Unit Name</th>
							<th>Remarks</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>						
    <?php foreach($result as $value) { 				
						?>
                          <tr>
							<td><?php echo $roll_id;?></td>
							<td><?php echo $value['unit_name'];?></td>
							<td><?php echo $value['remarks'];?></td>
              				<td><?php echo $value['active_status'];?></td>
                           <td> 
						  <a href="#" title="View" id="staff_view_modal" onclick="unit_view_modal('unit/view.php','<?php echo $value['unit_id'];?>')" data-toggle="modal" data-target="#staff_view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          
						  <a href="index.php?file=unit/update&unit_id=<?php echo $value['unit_id']?>" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  
                          	
                          <a href="#" id="<?php echo $value['unit_id']?>" onclick="del(<?php echo $value['unit_id']?>)" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
						 
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
function del(employee_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "unit/curd.php?action=DELETE",
			data: "employee_id="+employee_id,
			success: function(msg){ 
			alert(msg);
			$("#"+employee_id).closest('tr').remove();
			}});
	}

}


function unit_view_modal(url,unit_id){
	window.open(url+'?unit_id='+unit_id,'onmouseover','height=650,width=950,scrollbars=yes,resizable=no,left=250,top=250,toolbar=no,location=no,directories=no,status=no,menubar=no');  
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