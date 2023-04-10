<section class="content-header">
	<h1>
    <small>Manage</small>
  	<?php echo 'Equipment Nature'; //ucfirst($foldername); ?><a href="index.php?file=equipmentnature/create" class="float-right btn-sm btn-primary">Add New</a>
  </h1>	  
</section>

<?php 
  $select_purchaseentry = $pdo_conn->prepare("SELECT * FROM equipmentnature_creation ORDER BY equipmentnature_id DESC");
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
                <button onclick="print_list('equipmentnature/list_print.php')"><i class="fa fa-print" ></i>PRINT</button>
            </div>
					<thead>
						<tr class="bold">
							<th>#</th>
							<th>Work Name</th>
							<th>Outturn</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>						
    <?php foreach($result as $value) { 				
						?>
                          <tr>
							<td><?php echo $roll_id;?></td>
							<td><?php echo $value['equipmentnature_name'];?></td>
							<td><?php echo $value['outturn'];?></td>
              				<td><?php echo $value['active_status'];?></td>
                           	<td> 
						  <a href="#" title="View" id="staff_view_modal" onclick="equipmentnature_view_modal('equipmentnature/view.php','<?php echo $value['equipmentnature_id'];?>')" data-toggle="modal" data-target="#staff_view"><i class="fa fa-eye" aria-hidden="true"></i></a>
                          
						  <a href="index.php?file=equipmentnature/update&equipmentnature_id=<?php echo $value['equipmentnature_id']?>" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  
                          	
                          <a href="#" id="<?php echo $value['equipmentnature_id']?>" onclick="del(<?php echo $value['equipmentnature_id']?>)" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
						 
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
function del(equipmentnature_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "equipmentnature/curd.php?action=DELETE",
			data: "equipmentnature_id="+equipmentnature_id,
			success: function(msg){ 
			alert(msg);
			$("#"+equipmentnature_id).closest('tr').remove();
			}});
	}

}


function equipmentnature_view_modal(url,equipmentnature_id){
	window.open(url+'?equipmentnature_id='+equipmentnature_id,'onmouseover','height=650,width=950,scrollbars=yes,resizable=no,left=250,top=250,toolbar=no,location=no,directories=no,status=no,menubar=no');  
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