<?php 

include("../inc/dbConnect.php");
include '../inc/header.php';
// include('../inc/company_master.php');

?>

<div class="padd_div">
    <div class="col-md-12 header">
      <h4 class="staff_head">Party's List</h4>
    </div>
    <div class="table-responsive">
      <table width="100%" id="table7">
        <thead>
          <tr class="bold">
          <th class="th_div">#</th>
          <th class="th_div">Party Name</th>
          <th class="th_div">Mobile Number</th>
          <th class="th_div">Address</th>
          <th class="th_div">Accounts No</th>
          <th class="th_div">Party Type</th>
          <th class="th_div">Company Name</th>
          <th class="th_div">Contact Person Name</th>
          <th class="th_div">Contact Person Mobile Number</th>
          <th class="th_div">GST No</th>
          <th class="th_div">Payment Type</th>
          <th class="th_div">Credit Days</th>
          <th class="th_div">Auto SMS</th>
          </tr>
        </thead>
        <tbody id="rg_ls">
      <?php   
        $select_purchaseentry = $pdo_conn->prepare("SELECT * FROM party_creation ORDER BY party_id DESC");
        $select_purchaseentry->execute();
        $result = $select_purchaseentry->fetchAll();
        $roll_id=1;
        foreach($result as $value) {        
        ?>
          <tr>
          
            <td><?php echo $roll_id;?></td>
            <td><?php echo $value['party_name'];?></td>
            <td><?php echo $value['mobile_no'];?></td>
            <td><?php echo $value['address'];?></td>
            <td><?php echo $value['accounts_no'];?></td>
            <td><?php echo get_partytype($value['partytype']);?></td>
            <td><?php echo $value['comp_name'];?></td>
            <td><?php echo $value['person_name'];?></td>
            <td><?php echo $value['contact_mob_no'];?></td>
            <td><?php echo $value['gst_no'];?></td>
            <td><?php echo $value['paymenttype'];?></td>
            <td><?php echo $value['credit_days'];?></td>
            <td><?php echo $value['auto_sms'];?></td>
          </tr>
  <?php   $roll_id++;
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

