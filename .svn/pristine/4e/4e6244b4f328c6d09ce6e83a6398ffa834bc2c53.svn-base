<?php 

include("../inc/dbConnect.php");
include '../inc/header.php';
// include('../inc/company_master.php');

?>

<div class="padd_div">
    <div class="col-md-12 header">
      <h4 class="staff_head">Order Details</h4>
    </div>
    <div class="table-responsive">
      <table width="100%" id="table7">
        <thead>
          <tr class="bold">
          <th class="th_div">#</th>
          <th class="th_div">Order Date</th>
          <th class="th_div">Order No</th>
          <th class="th_div">Party Name</th>
          <th class="th_div">Material Name</th>
          <th class="th_div">Delivery Area</th>
          <th class="th_div">Delivery Date</th>
          <th class="th_div">Payment Mode</th>
          <th class="th_div">Status</th>
          <th class="th_div">Quantity</th>
          <th class="th_div">Rate</th>
          <th class="th_div">Amount</th>
          </tr>
        </thead>
        <tbody id="rg_ls">
      <?php   
        $select_order_entry = $pdo_conn->prepare("SELECT * FROM order_entry ORDER BY order_date DESC");
        $select_order_entry->execute();
        $result = $select_order_entry->fetchAll();
        $i='0';
        foreach($result as $value) {        
        ?>
          <tr>
            <td><?php echo $i+=1;?></td>
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
          </tr>
  <?php $roll_id++;
        } ?> 
        </tbody>
      </table>
    </div>
</div>



<style>
.border_div {
    border: 1px solid#cccc;
    padding: 7px;
}
.col-md-12.header {
    text-align: center;
    background-color: #fff;
    color: black;
    font-weight: 900;
    padding: 2px;
    margin-bottom: 0px;
    font-size: 25px;
    font-family: century gothic ! important;
}
table#table7 tr td {
    border: 1px solid #ccc;
  color:black;
  height: 22px;
}



tr.address_td td {
    height: 104px;
}
.padd_div {
    padding: 4px;
}
span.comp_name {
    font-size: 21px;
    font-weight: 800;
  color: black;
}
table tr td {
    text-align: center;
}

td.th_div {
    font-weight: 600;
    color: black;
}
h3 {
    font-weight: 600;
}
h4 {
    font-weight: 600;
}
table#table3 tr td {
    padding: 6px;
}
hr {
    margin: 0px;
    border: 1px solid #ccc;
    width: 101%;
    margin-left: -5px;
}
ul {text-align: justify}
ol {text-align: justify}



table#table7 tr td {
    border: 1px solid #ccc;
    color: black;
    height: 22px;
    padding: 2px;
    padding-top: 10px;
    padding-bottom: 10px;  

}
tr.bold th {
    padding-bottom: 10px;
   
}
th.th_div.add-wid {
    width: 10%;
}

tr.bold th {
    padding-bottom: 10px;
    border: 1px solid #cccccc;
    padding: 6px;
    background-color: #f3f2f2;
}

.add-align {
  text-align: left;
}


table {
    text-align: center;
    font-family:century gothic ! important;
}
.staff_head
{
margin-top: 10px !important;
margin-bottom: 16px !important; 
  
}
</style>

