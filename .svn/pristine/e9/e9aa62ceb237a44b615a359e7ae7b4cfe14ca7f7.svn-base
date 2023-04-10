<section class="content-header">
	<h1>
    <center>Collection Reports</center>
  	<!-- <?php echo ucfirst($foldername); ?><a href="index.php?file=city/create" class="float-right btn-sm btn-primary">Add New</a> -->
  </h1>	  
</section>
<?php 
//echo "ggggggggg".$_REQUEST[start_date];
  // $select_sales_entry = $pdo_conn->prepare("SELECT * FROM sales_entry JOIN  cash_receipts_entry ORDER BY sales_date DESC");
  // $select_sales_entry->execute();
  // $result = $select_sales_entry->fetchAll();
//  $sales_id=1;
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
                <button onclick="print_list('collectionreport/list_print.php')"><i class="fa fa-print" ></i>PRINT</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            </div>
              <!-- Search filter -->
              <div >
   <!-- Date Filter -->
   <table>
     <tr>
       <td>
          <input type='text' readonly id='search_fromdate' class="datepicker" placeholder='From date'>
       </td>
       <td>
          <input type='text' readonly id='search_todate' class="datepicker" placeholder='To date'>
       </td>
       <td>
          <input type='button' id="btn_search" value="Search">
       </td>
     </tr>
   </table>

   <!-- Table -->
   <table id='empTable' class='display dataTable'>
     <thead>
       <tr>
         <th>Employee name</th>
         <th>Email</th>
         <th>Date of Joining</th>
         <th>Salary</th>
         <th>City</th>
       </tr>
     </thead>

   </table>
</div>
             <div id="collectionreport_div_id">
     <?php include("list_new.php"); ?>	
          </div>		  
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
<script type="text/javascript">
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
function collectionreport_list(start_date,end_date)
{
 jQuery.ajax({
type: "POST",
url: "collectionreport/list_new.php",
data: "start_date="+start_date+"&end_date="+end_date,

success: function(data) {
// //alert(data);
jQuery("#collectionreport_div_id").html(data);
}
});
}
 
function order_view_modal(url,order_id){
	window.open(url+'?order_id='+order_id,'onmouseover','height=650,width=950,scrollbars=yes,resizable=no,left=250,top=250,toolbar=no,location=no,directories=no,status=no,menubar=no');  
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