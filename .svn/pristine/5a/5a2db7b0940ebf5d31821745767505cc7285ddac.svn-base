
<?php 
include("../inc/dbConnect.php");
//include '../inc/header.php';
error_reporting(0);
// include('../inc/company_ma
 //echo $
// $to_date=$_POST[end_date];
//echo "ggggggggggggg";
?>
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="box">
       <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">
 <!--<?php
//$current_date=date('Y-m-d');
 //$from_date=$_POST['start_date'];
  //$to_date=$_POST['end_date'];
//if($from_date!=""){ $from_date1 = "sales_date>='$from_date'";}else {$from_date1 = "sales_date='$current_date'";}
//if($to_date!=""){ $to_date1 =  "sales_date<='$to_date'  ";}else{$to_date1='';}

//$all_value10 = $from_date1."@@@".$to_date1;
//$all_array10 = explode('@@@',$all_value10);
//foreach($all_array10 as $value10)
{ 
  //if($value10!='')
  {
    // $get_query101 .= $value10." AND ";
  }
} 
?> -->
        
					
					<tbody>	
          
          <?php
?>		 

<?php 
$select_sales_entry = $pdo_conn->prepare("SELECT * FROM sales_entry  where   
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
					</tbody>
          </html>

       