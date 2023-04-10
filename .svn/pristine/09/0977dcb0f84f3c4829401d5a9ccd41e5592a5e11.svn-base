
<?php
$pdo_userroll = $pdo_conn->prepare("SELECT * FROM userformrights WHERE delete_status !='1' and  roll_id ='".$_SESSION['user_roll']."' and status ='1' and delete_status !='1'");
$pdo_userroll->execute();
$userroll = $pdo_userroll->fetchAll();

$master='master';
$employeecreation ='staffcreation';
$designation ='designation';
$area ='area';
$partytype ='partytype';
$party ='party';
$shift ='shift';
$unit = 'unit';
$material = 'material';
$vehicle = 'vehicle';
$quary = 'quary';
$labour = 'labour';
$runningstatus = 'runningstatus';
$city='citycreation';
$equipmentnature  = 'equipmentnature';
$equipmenttype = 'equipmenttype';

$order='order';
$salesorder='salesorder';
$reports='reports';
$orderstatus='orderstatus';

?>
<aside class="main-sidebar">
	<!-- sidebar -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="ulogo">
				<a href="index.php">
				<!-- logo for regular state and mobile devices -->
					<span></span>
				</a>
			</div>
			<div class="image">
				<center>
					<a href="index.php">
						<img src="images/rpplogo.png" class="rounded-circle4" alt="User Image" width="90px" height="120px">
					</a>
				</center>
			</div>
			
		</div>	
		
		<ul class="sidebar-menu" data-widget="tree">
		<li class="nav-devider"></li>
        <li class="header nav-small-cap">PERSONAL</li>
       <?php foreach($userroll as $value) {
       	$pdo_userroll = $pdo_conn->prepare("SELECT * FROM userform WHERE delete_status !='1' and  userform_id ='".$value['userform_id']."'");
	$pdo_userroll->execute();
	$userform = $pdo_userroll->fetchAll();
	foreach($userform as $value1) {
		if($master == $value1['short_name']) { ?>
			<li class="treeview">
			<a href="#">
			<i class="fa fa-user left1" aria-hidden="true "></i>
			<span style="color: black;font-weight: 600;">Masters</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-right pull-right"></i>
			</span>
			</a>
			<ul class="treeview-menu">		
			   <?php 
		  foreach($userroll as $record1) {
			  $pdo_userroll = $pdo_conn->prepare("SELECT * FROM userform WHERE delete_status !='1' and  userform_id ='".$record1['userform_id']."'");
	$pdo_userroll->execute();
	$userform = $pdo_userroll->fetchAll();
	foreach($userform as $record) { ?>
		<?php if($employeecreation ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=employee/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Employee Creation </h4>
			</div>
			</a> 
			</li>
	<?php $employeecreation ='';} ?>
	<?php if($designation ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=designation/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Designation Creation </h4>
			</div>
			</a> 
			</li>
	<?php $designation ='';} ?>
	<?php if($city ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=city/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - City Creation </h4>
			</div>
			</a> 
			</li>
	<?php $city ='';} ?>
	<?php if($area ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=area/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Area Creation </h4>
			</div>
			</a> 
			</li>
	<?php $area ='';} ?>
	<?php if($partytype ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=partytype/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Party Type Creation </h4>
			</div>
			</a> 
			</li>
	<?php $partytype ='';} ?>
	<?php if($party ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=party/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Party Creation </h4>
			</div>
			</a> 
			</li>
	<?php $party ='';} ?>
	<?php if($shift ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=shift/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Shift Creation </h4>
			</div>
			</a> 
			</li>
	<?php $shift ='';} ?>
	<?php if($unit ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=unit/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Unit Creation </h4>
			</div>
			</a> 
			</li>
	<?php $unit ='';} ?>
	<?php if($material ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=material/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Material Name Creation </h4>
			</div>
			</a> 
			</li>
	<?php $material ='';} ?>
	<?php if($equipmentnature ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=equipmentnature/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Equipment Nature Creation </h4>
			</div>
			</a> 
			</li>
	<?php $equipmentnature ='';} ?>
	<?php if($equipmenttype ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=equipmenttype/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Equipment Type Creation </h4>
			</div>
			</a> 
			</li>
	<?php $equipmenttype ='';} ?>
	<?php if($vehicle ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=vehicle/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Vehicle Creation </h4>
			</div>
			</a> 
			</li>
	<?php $vehicle ='';} ?>
	<?php if($quary ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=quary/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Quary Creation </h4>
			</div>
			</a> 
			</li>
	<?php $quary ='';} ?>
	<?php if($labour ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=labour/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Labour Creation </h4>
			</div>
			</a> 
			</li>
	<?php $labour ='';} ?>
	<?php if($runningstatus ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=runningstatus/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Running Status Creation </h4>
			</div>
			</a> 
			</li>
	<?php $runningstatus ='';} ?>
         <?php }} ?>
			</ul> 
			</li>
			<?php } 
	 ?>
	<?php if($order == $value1['short_name']) {
	?>
		<li class="treeview">
			<a href="#">
			<i class="fa fa-first-order left3"></i>
			<span style="color: black;font-weight: 600;">Order</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-right pull-right"></i>
			</span>
			</a>
			<ul class="treeview-menu">		
			 <?php   foreach($userroll as $record1) {
			  $pdo_userroll = $pdo_conn->prepare("SELECT * FROM userform WHERE delete_status !='1' and  userform_id ='".$record1['userform_id']."'");
	$pdo_userroll->execute();
	$userform = $pdo_userroll->fetchAll();
	foreach($userform as $record) { 
	   if($order == $record['short_name']) { ?>
			<li>
			<a href="index.php?file=order/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Order List</h4>
			</div>
			</a> 
			</li>
	<?php  }  ?>
	<?php }} ?>
		</ul>
		</li>
	<?php } ?>

	<?php if($salesorder == $value1['short_name']) {
	?>
		<li class="treeview">
			<a href="#">
			<i class="fa fa-first-order left3"></i>
			<span style="color: black;font-weight: 600;">Sales</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-right pull-right"></i>
			</span>
			</a>
			<ul class="treeview-menu">		
			 <?php   foreach($userroll as $record1) {
			  $pdo_userroll = $pdo_conn->prepare("SELECT * FROM userform WHERE delete_status !='1' and  userform_id ='".$record1['userform_id']."'");
	$pdo_userroll->execute();
	$userform = $pdo_userroll->fetchAll();
	foreach($userform as $record) { 
	   if($salesorder == $record['short_name']) { ?>
			<li>
			<a href="index.php?file=sales/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Sales List</h4>
			</div>
			</a> 
			</li>
	<?php  }  ?>
	<?php }} ?>
		</ul>
		</li>

	<?php } ?>
	<?php if($salesorder == $value1['short_name']) {
	?>
		<li class="treeview">
			<a href="#">
			<i class="fa fa-first-order left3"></i>
			<span style="color: black;font-weight: 600;">Reports</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-right pull-right"></i>
			</span>
			</a>
			<ul class="treeview-menu">		
			 <?php   foreach($userroll as $record1) {
			  $pdo_userroll = $pdo_conn->prepare("SELECT * FROM userform WHERE delete_status !='1' and  userform_id ='".$record1['userform_id']."'");
	$pdo_userroll->execute();
	$userform = $pdo_userroll->fetchAll();
	foreach($userform as $record) { 
	   if($salesorder == $record['short_name']) { ?>
			<li>
			<a href="index.php?file=orderstatus/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Order Status</h4>
			</div>
			</a> 
			</li>
	<?php  }  ?>
	<?php }} ?>
		</ul>
		</li>
	
	<?php } ?>

	<?php }} ?>
	</ul>
	</section>
</aside>
	  
<script>
function logout()
{
	if(confirm("As You Sure You Want To Logout?"))
	{
		jQuery.ajax({
		type: "POST",
		url: "inc/logout.php",
		data: { value01 : '',value02 : '',value03 : 'logout'},
		success: function(msg){ //alert(msg);
		window.location.href="index.php";
		}});
	}
} 
</script>
  
  
<style>
.sidebar-menu>li>a>.fa, .sidebar-menu>li>a>.glyphicon, .sidebar-menu>li>a>.ion {
width: 35px;
height: 35px;
font-size: 19px;
display: inline-block;
vertical-align: middle;
padding-left: 0;
margin-right: 10px;
line-height: 36px;
text-align: center;
background-color: rgba(0, 0, 0, 0.1);
border-radius: 100px;
}
.skin-blue-light .sidebar-menu > li.header {
color: #ef5350;
font-size: 14px;
font-weight: 700;
}
.skin-blue-light .sidebar a {
color: #2ba3f6;
}
</style>