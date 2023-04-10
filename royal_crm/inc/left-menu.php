
<?php
$pdo_userroll = $pdo_conn->prepare("SELECT * FROM userformrights WHERE delete_status !='1' and  roll_id ='".$_SESSION['user_roll']."' and status ='1' and delete_status !='1'");
$pdo_userroll->execute();
$userroll = $pdo_userroll->fetchAll();
$customers = 'customers';
$staff ='staff';
 
$customer_creation = 'customerscreation';
$staffcreation ='staffcreation';
$attendancereport ='attendancereport';
$expensereport ='expensereport';
$assigncustomer ='assigncustomer';
 
$assigntocustomer ='assigntocustomer';
  
$paymentcreation ='paymentcreation';
$paymentfollowups ='paymentfollowups';
$quotation='quotation';
$quotationlist='quotationlist';
$quotationconfirm='quotationconfirm';
$quotationfollowups='quotationfollowups';
$invoice='invoice';
$enquiry='enquiry';
$enquirylist='enquirylist';
 $invoicelist='invoicelist';
 $master='master';
 $statecreation='statecreation';
 $districtcreation='districtcreation';
$citycreation='citycreation';
//$userroll='userroll';
$usercreation='usercreation';
$religion='religion';
$expense='expense';
$specialdays='specialdays';
$category='category';
$subcategory='subcategory';
$itemcreation='itemcreation';
$order='order';
$orderlist='orderlist';
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
						<img src="images/logo.jpg" class="rounded-circle" alt="User Image" width="100px" height="100px">
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
	if($customers == $value1['short_name']) { ?>
		<li class="treeview">
			<a href="#">
			<i class="fa fa-user left1" aria-hidden="true "></i>
			<span style="color: black;font-weight: 600;">Customers</span>
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
		<?php if($customer_creation ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=customer/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Customer Creation </h4>
			</div>
			</a> 
			</li>
			   <?php $customer_creation =''; }  ?>
         <?php }} ?>
			</ul> 
		</li> 
		     
		<?php $customer ='';} ?>
		 <?php if($staff == $value1['short_name']) {
	?>
		<li class="treeview">
			<a href="#">
			<i class="fa fa-users left2" aria-hidden="true "></i>
			<span style="color: black;font-weight: 600;">Staff</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-right pull-right"></i>
			</span>
			</a>
			<ul class="treeview-menu">	
			  <?php   foreach($userroll as $record1) {
			  $pdo_userroll = $pdo_conn->prepare("SELECT * FROM userform WHERE delete_status !='1' and  userform_id ='".$record1['userform_id']."'");
	$pdo_userroll->execute();
	$userform = $pdo_userroll->fetchAll();
	foreach($userform as $record) { ?>
		<?php if($staffcreation ==$record['short_name']) {?>
			<li>
			<a href="index.php?file=staff/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Staff Creation </h4>
			</div>
			</a> 
			</li>
	<?php $staffcreation ='';} ?>
        <?php if($attendancereport == $record['short_name']) { ?>
			<li>
			<a href="index.php?file=attendanceentry/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Attendance Report </h4>
			</div>
			</a> 
			</li>
   <?php $attendancereport ='';} ?>
        <?php if($expensereport == $record['short_name']) { ?>
			<li>
			<a href="index.php?file=expense_entry/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Expense Report </h4>
			</div>
			</a> 
			</li>
			<?php $expensereport ='';} ?>
			
			
        <?php if($assigncustomer == $record['short_name']) { ?>	
			<li>
			<a href="index.php?file=assign_customer/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Assign Customer </h4>
			</div>
			</a> 
			</li>
		 <?php $assigncustomer ='';} ?>
            <?php } } ?>
			</ul> 
		</li>
	<?php $staff =''; } ?>
	<?php if($enquiry == $value1['short_name']) {
	?>
		<li class="treeview">
			<a href="#">
			<i class="fa fa-question-circle left3"></i>
			<span style="color: black;font-weight: 600;">Enquiry</span>
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
	   if($enquirylist == $record['short_name']) { ?>
			<li>
			  
    			<a href="index.php?file=enquiry/list">
    			<div class="menu-info">
    			<h4 class="control-sidebar-subheading"> - Enquiry List</h4>
    			</div>
    			</a> 
		
			</li>
				<?php  } ?>
			 <?php }} ?>
			</ul> 
		</li> 
<?php $enquiry='';}  ?>

	<?php if($quotation == $value1['short_name']) {
	?>
		<li class="treeview">
			<a href="#">
			<i class="fa fa-file-o left3"></i>
			<span style="color: black;font-weight: 600;">Quotation</span>
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
	   if($quotationlist == $record['short_name']) { ?>
			<li>
			<a href="index.php?file=quotation/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Quotation List</h4>
			</div>
			</a> 
			</li>
			<?php } 
			 if($quotationconfirm == $record['short_name']) { ?>
				<li>
			<a href="index.php?file=quotation_conformed/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Quotation Approval List</h4>
			</div>
			</a> 
			</li>
			<?php }  
			
			 if($quotationfollowups == $record['short_name']) { ?>
				<li>
			<a href="index.php?file=quotation_followps/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Quotation Followup List</h4>
			</div>
			</a> 
			</li>
			<?php } ?>
		 
			 <?php }} ?>
		</ul>
	</li>
	<?php $quotation='';} ?>
		<!-- <li class="treeview">
			<a href="#">
			<i class="fa fa-check left3"></i>
			<span style="color: black;font-weight: 600;">Quotation Conform </span>
			<span class="pull-right-container">
			<i class="fa fa-angle-right pull-right"></i>
			</span>
			</a>
			<ul class="treeview-menu">			
			<li>
			<a href="index.php?file=quotation_conformed/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Quotation  Conform List</h4>
			</div>
			</a> 
			</li>
		
		</ul>
		</li>
 -->
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
	   if($enquirylist == $record['short_name']) { ?>
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
	
	<?php if($invoice == $value1['short_name']) {
	?>		
		<li class="treeview">
			<a href="#">
			<i class=" fa fa-file-text left3"></i>
			<span style="color: black;font-weight: 600;">Invoice</span>
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
	   if($invoicelist == $record['short_name']) { ?>
			<li>
			<a href="index.php?file=invoice/invoice_list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading"> - Invoice List</h4>
			</div>
			</a> 
			</li>
		<?php }  ?>
		
		<?php } } ?>
		</ul>
	</li>
<?php } ?>

	
	<?php if($invoice == $value1['short_name']) {
	?>	
	<li class="treeview">
			<a href="#">
			<i class="fa fa-rupee left3"></i>
			<span style="color: black;font-weight: 600;">Payment Followups</span>
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
	   if($invoicelist == $record['short_name']) { ?>
			<li>
			<a href="index.php?file=paymentfollowups/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading">Payment Followups List</h4>
			</div>
			</a> 
			</li>
		<?php } ?>
		<?php } } ?>
		</ul>
	</li>
	<?php  }  ?>
	
		
	<?php if($invoice == $value1['short_name']) {
	?>	
	<li class="treeview">
			<a href="#">
			<i class="fa fa-rupee left3"></i>
			<span style="color: black;font-weight: 600;">Payment Collection</span>
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
	   if($invoicelist == $record['short_name']) { ?>
			<li>
			<a href="index.php?file=paymentcollection/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading">Payment Collection List</h4>
			</div>
			</a> 
			</li>
		<?php  } ?>
		<?php } } ?>
		</ul>
	</li>
	
	<?php } ?>
	
		
	<?php if($invoice == $value1['short_name']) {
	?>	

	<li class="treeview">
			<a href="#">
			<i class="fa fa-rupee left3"></i>
			<span style="color: black;font-weight: 600;">Customer Satisfaction</span>
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
	   if($invoicelist == $record['short_name']) { ?>
			<li>
			<a href="index.php?file=customer_satisfaction/list">
			<div class="menu-info">
			<h4 class="control-sidebar-subheading">Customer Satisfaction List</h4>
			</div>
			</a> 
			</li>
		<?php } ?>
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