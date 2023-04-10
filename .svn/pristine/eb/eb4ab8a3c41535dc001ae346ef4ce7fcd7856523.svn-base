<?php 

$company_master = $pdo_conn->prepare("SELECT * FROM company_master WHERE delete_status='0'");
$company_master->execute();
$company_masters = $company_master->fetchAll();
foreach($company_masters as $value) {
?>





<div class="row">


<div class="over_div" style="text-align: center;">
<!--<img src="../images/1.png" >--->
  <div class="company_name">
        <h1> <?php echo $value['company_name'];?></h1> 
  </div>
  <div class="address">
      <h4> <?php echo $value['address'];?>,<span class="print_icon"><i class="fa fa-phone"></i></span> <?php echo $value['mobile_no'];?> <span class="print_icon"><i class="fa fa-envelope"></i></span> <?php echo $value['emai_id'];?></h4>
  </div>
</div>


<?php
}
?>
<style>
.company_name h1 {
    color: #2f3392;
    font-size: 33px;
	margin-top: 7px;
}
.address h4 {
    font-size: 13px;
}
.over_div {
    line-height: 6px;
    border-bottom: 1px solid #ccc;
   padding: 9px;
   width: 100%;
}
.print_icon i
{
font-size:15px;
color:#2f3392;
padding-right:5px;	
}
</style>