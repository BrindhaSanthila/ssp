<?php 

include("../inc/dbConnect.php");
include '../inc/header.php';
//include('../inc/company_master.php');
?>

<?php


    if($_GET['district_id']!='' && $_GET['religion_id']!='')
    {
  
 $select_customer_creation = $pdo_conn->prepare("SELECT * FROM customer_creation WHERE delete_status='0' and religion_id='".$_GET['religion_id']."' and district_id='".$_GET['district_id']."' ORDER BY customer_id DESC");
  $select_customer_creation->execute();
  $customer_creation = $select_customer_creation->fetchAll();
           
}
else if($_GET['district_id']!='' && $_GET['religion_id']=='')
{

 $select_customer_creation = $pdo_conn->prepare("SELECT * FROM customer_creation WHERE delete_status='0' and district_id='".$_GET['district_id']."' ORDER BY customer_id DESC");
  $select_customer_creation->execute();
  $customer_creation = $select_customer_creation->fetchAll();
}

else if($_GET['district_id']=="" && $_GET['religion_id']!="" )
{

 $select_customer_creation = $pdo_conn->prepare("SELECT * FROM customer_creation WHERE delete_status='0' and religion_id='".$_GET['religion_id']."' ORDER BY customer_id DESC");
  $select_customer_creation->execute();
  $customer_creation = $select_customer_creation->fetchAll();
}
else if($_GET['district_id']=='' && $_GET['religion_id']=='')
{

$select_customer_creation = $pdo_conn->prepare("SELECT * FROM customer_creation WHERE delete_status='0'  ORDER BY customer_id DESC");
  $select_customer_creation->execute();
  $customer_creation = $select_customer_creation->fetchAll();	
}

         ?>
<div class="padd_div">
    <div class="col-md-12 header">
      <h4 class="staff_head">Customer List</h4>
    </div>
    <div class="table-responsive">
      <table width="100%" id="table7">
        <thead>
          <tr class="bold">
          <th class="th_div">#</th>
          <th class="th_div">Customer Name</th>
           <th class="th_div">Religion</th>
           <th class="th_div">Mobile Number</th>
          <th class="th_div"> Address</th>
        
          </tr>
        </thead>
        <tbody id="rg_ls">
      <?php   
        
        $roll_id=1;

        foreach($customer_creation as $value){ ?>
          <tr>
              <td><?php echo $roll_id;?></td>   
              <td align="left"><?php echo $value['customer_name'];?></td>
             
              <?php 
              $select_religion = $pdo_conn->prepare("SELECT * FROM religion WHERE religion_id='".$value['religion_id']."' ");
              $select_religion->execute();
              $religion = $select_religion->fetchAll();
              ?>
               <td align="left"><?php echo $religion[0]['religion_name'];?></td>
              <td align="left"><?php echo $value['mobile_no'];?></td>
             
              
               <td align="left"><?php echo $value['address'];?></td>
              
          </tr>
  <?php     $roll_id++;
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
    font-size: 21px;
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
    text-align: left;

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

