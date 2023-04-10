<?php 


include("../inc/dbConnect.php");
include '../inc/header.php';
// include('../inc/company_master.php');

?>

<div class="padd_div">
    <div class="col-md-12 header">
      <h4 class="staff_head">City's List</h4>
    </div>
    <div class="table-responsive">
      <table width="100%" id="table7">
        <thead>
          <tr class="bold">
          <th class="th_div">#</th>
           <th class="th_div">Area Name</th>
          <th class="th_div">City Name</th>
           <th class="th_div">Approximate Km</th>
          <th class="th_div">Status</th>
          </tr>
        </thead>
        <tbody id="rg_ls">
      <?php   
        $select_purchaseentry = $pdo_conn->prepare("SELECT * FROM city_creation ORDER BY city_name Desc");
        $select_purchaseentry->execute();
        $result = $select_purchaseentry->fetchAll();
        $roll_id=1;
        foreach($result as $value) {        
        ?>
          <tr>
          
            <td><?php echo $roll_id;?></td>
              <td><?php echo get_area_name($value['area_id']);?></td>
            <td><?php echo $value['city_name'];?></td>
              <td><?php echo $value['apprx_km'];?></td>
            <td><?php echo $value['active_status'];?></td>
          
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

