<section class="content-header">
  <?php 
include("../inc/dbConnect.php");
//include '../inc/header.php';
error_reporting(0); ?>
	<h1>
    <center>Collection Reportssss</center>
  	<!-- <?php // echo ucfirst($foldername); ?><a href="index.php?file=city/create" class="float-right btn-sm btn-primary">Add New</a> -->
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
            <!--<div class="pint_btn">
                <button onclick="print_list('collectionreport/list.php')"><i class="fa fa-print" ></i>PRINT</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            </div> -->
            <form>
    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo date('Y-m-d');?>">

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="<?php echo date('Y-m-d');?>">

    <!-- <label class="pint_btn">-->
               
            </label>
             
                <button onClick="collectionreport_list(start_date.value,end_date.value);">Search</button>
            </div>
</form>
             <!-- Search filter -->
             <div id="collectionreport_div_id">
     <?php 
     //include("list_new.php");
     $current_date=date('Y-m-d');
 $from_date=$_POST['start_date'];
  $to_date=$_POST['end_date'];
if($from_date!=""){ $from_date1 = "sales_date>='$from_date'";}else {$from_date1 = "sales_date='$current_date'";}
if($to_date!=""){ $to_date1 =  "sales_date<='$to_date'  ";}else{$to_date1='';}

$all_value10 = $from_date1."@@@".$to_date1;
$all_array10 = explode('@@@',$all_value10);
foreach($all_array10 as $value10)
{ 
  if($value10!='')
  {
     $get_query101 .= $value10." AND ";
  }
}  ?>	
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
?>     <?php 
$select_sales_entry = $pdo_conn->prepare("SELECT * FROM sales_entry where   
  $get_query101 sales_date!='' ORDER BY sales_date DESC");
  $select_sales_entry->execute();
  $result = $select_sales_entry->fetchAll();

    $i='0';
    foreach($result as $value) {        
            ?>
             <tr>
         
              <td><?php echo $i+=1;?></td>
              <td><?php echo date('d-m-Y',strtotime($value['sales_date']));?></td>
              <td><?php echo $value['seller_name'];?></td> 
              <td><?php echo $value['seller_name'];?></td>
              <td><?php echo $value['seller_name'];?></td>
              <td><?php echo $value['seller_name'];?></td>
              <td><?php echo number_format($value['total_amount_received'],2);?></td>

     
            </tr>                       
            
            <?php } ?> 
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
url: "collectionreport/list.php",
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