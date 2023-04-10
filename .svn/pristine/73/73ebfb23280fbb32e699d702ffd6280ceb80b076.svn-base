<section class="content-header">
	<h1>
    <small>Manage</small>
  	<?php echo ucfirst($foldername); ?><a href="index.php?file=area/create" class="float-right btn-sm btn-primary">Add New</a>
  </h1>	  
</section>



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
                <button onclick="print_list('area/list_print.php')"><i class="fa fa-print" ></i>PRINT</button>
            </div>
					<thead>
						<tr class="bold">
							<th>#</th>
							<th>Area Name</th>
							<th>This Area containing under - Area</th>
							<th>Under Area</th>
							<th>Approximate km from Crusher</th>
							<th>Area allows limit Radius</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>						
    <?php foreach($result as $value) { 				
						?>
                          <tr>
							<td><?php echo $roll_id;?></td>
							<td><?php echo $value['area_name'];?></td>
							<td><?php echo $value['under_area'];?></td>
							<td><?php echo get_city($value['under_area_id']);?></td>
              				<td><?php echo $value['crusher_km'];?></td>
							<td><?php echo $value['limit_radius'];?></td>
              				<td><?php echo $value['active_status'];?></td>
                           <td> 
						  <a href="#" title="View" id="staff_view_modal" onclick="area_view_modal('area/view.php','<?php echo $value['area_id'];?>')" data-toggle="modal" data-target="#staff_view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          
						  <a href="index.php?file=area/update&area_id=<?php echo $value['area_id']?>&under_area=<?php echo $value['under_area']; ?>" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  
                          	
                          <a href="#" id="<?php echo $value['area_id']?>" onclick="del(<?php echo $value['area_id']?>)" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
						 
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
function del(area_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "area/curd.php?action=DELETE",
			data: "area_id="+area_id,
			success: function(msg){ 
			alert(msg);
			$("#"+area_id).closest('tr').remove();
			}});
	}

}


function area_view_modal(url,area_id){
	window.open(url+'?area_id='+area_id,'onmouseover','height=650,width=950,scrollbars=yes,resizable=no,left=250,top=250,toolbar=no,location=no,directories=no,status=no,menubar=no');  
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