<style>
h5.view_mode{
	font-weight:bold;
}
</style>
<?php
include('inc/dbConnect.php');
include('inc/commonfunction.php');
$action = $_GET['action'];

/************************************* VIEW ********************************************/
if($action == 'CUSTOMER_VIEW'){ 
if($_POST['executive_login'] =='')
{
	$query = "";
}
else
{
	$query = " AND executive = '".$_POST['executive_login']."'";
}
	$main_list = $pdo_conn->prepare("SELECT * FROM assign_company WHERE company_name ='".$_POST['customer_id']."' $query AND  delete_status != '1'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	
	$cmy_list = $pdo_conn->prepare("SELECT * FROM customer_profile WHERE customer_id ='".$_POST['customer_id']."' AND  delete_status != '1' ");
	$cmy_list->execute();
	$companylist = $cmy_list->fetchAll();	
	/*$pay_list1 = $pdo_conn->prepare("SELECT * FROM payment_creation WHERE executive ='".$_POST['staffcreation_id']."' AND  delete_status != '1'");
	$pay_list1->execute();
	$paymentlist1 = $pay_list1->fetchAll();	*/
?>

       
           <strong><h5> Customer Name : <?php echo $companylist[0]['company_name']; ?></h5></strong>
        
 <div class="table-responsive">     	
<table width="100%" cellspacing="0" cellpadding="0">
       <tr>
            <td width="48" height="27" align="left" class="style10 style4"><strong class="third_data">S.No</strong></td>
            <td width="183" align="left" class="style10 style4"><strong class="third_data">&nbsp;Project Name</strong></td>
            <td width="168" align="left" class="style10 style4"><strong class="third_data">&nbsp;Executive Name</strong></td>
            <td width="334" align="left" class="style10 style4"><strong class="third_data">&nbsp;Project Status</strong></td>      
            
        </tr>
        <?php  $i=0;
	 foreach($mainlist as $val)  { ?>
    <tr>
                <td align="left" height="25" class="style2">&nbsp;<?php echo $i = $i+1; ?>.</td>
                 <?php
			 $select_project = $pdo_conn->prepare("SELECT * FROM project_creation WHERE project_creation_id ='".$val['project_name']."' ");
             $select_project->execute();
             $project = $select_project->fetchAll(); ?>
                 <td align="left" class="style2">&nbsp;<?php echo $project[0]['project_name'] ?></td>
                  <?php
			 $executive_name = $pdo_conn->prepare("SELECT * FROM staffcreation WHERE staffcreation_id ='".$val['executive']."' ");
             $executive_name->execute();
             $executive = $executive_name->fetchAll(); ?>
                <td align="left" class="style2">&nbsp;<?php echo $executive[0]['staff_name']; ?></td>   
                  <?php
			 $regular_visit= $pdo_conn->prepare("SELECT * FROM regular_visits WHERE company_id ='".$_POST['customer_id']."' and project_name = '".$val['project_name']."'ORDER BY regular_visit_id DESC limit 1 ");
             $regular_visit->execute();
             $regularvisit = $regular_visit->fetchAll();
			 $position = "";
			 foreach($regularvisit as $value)
				 $position = $value['project_position_id'];
			 $project_status = $pdo_conn->prepare("SELECT * FROM `project_position` WHERE project_position_id ='".$position."'");
             $project_status->execute();
             $projectstatus = $project_status->fetchAll();
			 $status = "";
			 foreach($projectstatus as $projectsstatus)
			 $status = $projectsstatus['project_position']; ?>            
                 <td align="left" class="style2">&nbsp;<?php echo $status; ?></td>
                          
                </tr>
                <?php  } ?>
   

	
               
     </table>
	 </div>
     
<?php  } ?>    
 <?php     
     if($action == 'STAFF_VIEW'){ 

	$main_list = $pdo_conn->prepare("SELECT * FROM `staffcreation` WHERE delete_status != '1'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	
?>
 <div class="table-responsive">     
<table width="100%" cellspacing="0" cellpadding="0">
       <tr>
            <td width="48" height="27" align="left" class="style10 style4"><strong>S.No</strong></td>
            <td width="183" align="left" class="style10 style4"><strong>&nbsp;Staff Designation</strong></td>
            <td width="183" align="left" class="style10 style4"><strong>&nbsp;Staff Name</strong></td>
             <td width="183" align="left" class="style10 style4"><strong>&nbsp;Mobile No</strong></td>
              <td width="183" align="left" class="style10 style4"><strong>&nbsp;Email Id</strong></td>
                           
        </tr>
        <?php  $i=0;
	 foreach($mainlist as $value)  { ?>
    <tr>
                <td align="left" height="25" class="style2">&nbsp;<?php echo $i = $i+1; ?>.</td>
				<td align="left" class="style2">&nbsp;<?php echo $value['staff_designation'] ?></td>
                 <td align="left" class="style2">&nbsp;<?php echo $value['staff_name'] ?></td>
                  <td align="left" class="style2">&nbsp;<?php echo $value['mobile_no'] ?></td>
                   <td align="left" class="style2">&nbsp;<?php echo $value['email_id'] ?></td>
            
                </tr>
                <?php   } ?>
   

	
               
     </table>
	 </div>
<?php } ?>
 <?php     
     if($action == 'ATTANDANCE_VIEW'){ 

	$attendance_entry=$pdo_conn->prepare("SELECT * FROM attendance_entry WHERE staff_name ='".$_POST['staff_id']."' and  delete_status !='1' and entry_date between'".$_POST['from_month']."' and '".$_POST['to_month']."' ORDER BY attendance_entry_id DESC");
	$attendance_entry->execute();
	$attendanceentry = $attendance_entry->fetchAll();
	$staff1 = $pdo_conn->prepare("SELECT `staff_name` FROM `staffcreation` WHERE `staffcreation_id`='".$_POST['staff_id']."'");
	$staff1->execute();
	$staff_name2 = $staff1->fetch();
	$date = $_POST['from_month'];
	$end_date = $_POST['to_month'];
	$cr_date =date('Y-m-d');
		
		if($end_date > $cr_date) 
		{
			$end_date = $cr_date;
		}
?>
<table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td height="37" align="center" class="style5"><strong><h5><?php echo $staff_name2['staff_name']; ?> ATTADANCE REPORT</h5></strong></td>
        </tr>
	</table>
<table width="100%" cellspacing="0" cellpadding="0" border="1">
       <tr>
            <td width="48" height="27" align="center" class="style10 style4"><strong class="third_data">S.No</strong></td>
            <td width="183" align="center" class="style10 style4"><strong class="third_data">&nbsp;Entry Date</strong></td>
            <td width="183" align="center" class="style10 style4"><strong class="third_data">&nbsp;Office In</strong></td>
            <td width="183" align="center" class="style10 style4"><strong class="third_data">&nbsp;Lunch In</strong></td>
            <td width="183" align="center" class="style10 style4"><strong class="third_data">&nbsp;Lunch Out</strong></td>
            <td width="183" align="center" class="style10 style4"><strong class="third_data">&nbsp;Break In</strong></td>
            <td width="183" align="center" class="style10 style4"><strong class="third_data">&nbsp;Break Out</strong></td>
            <td width="183" align="center" class="style10 style4"><strong class="third_data">&nbsp;Office Out</strong></td>                           
        </tr>
        <?php  $i=0;
	while (strtotime($date) <= strtotime($end_date)) {
		$attendance_entry=$pdo_conn->prepare("SELECT entry_time FROM attendance_entry WHERE staff_name ='".$_POST['staff_id']."' and  delete_status !='1' and entry_date ='".$date."' and attendance_type ='Office in' ");
		$attendance_entry->execute();
		$attendanceentry = $attendance_entry->fetch();
		$attendance_entry1=$pdo_conn->prepare("SELECT entry_time FROM attendance_entry WHERE staff_name ='".$_POST['staff_id']."' and  delete_status !='1' and entry_date ='".$date."' and attendance_type ='Office out' ");
		$attendance_entry1->execute();
		$attendanceentry1 = $attendance_entry1->fetch();
		$forlunch_in=$pdo_conn->prepare("SELECT entry_time FROM attendance_entry WHERE staff_name ='".$_POST['staff_id']."' and  delete_status !='1' and entry_date ='".$date."' and attendance_type ='Lunch in' ");
		$forlunch_in->execute();
		$for_lunch_in = $forlunch_in->fetch();
		$forlunch_out=$pdo_conn->prepare("SELECT entry_time FROM attendance_entry WHERE staff_name ='".$_POST['staff_id']."' and  delete_status !='1' and entry_date ='".$date."' and attendance_type ='Lunch out' ");
		$forlunch_out->execute();
		$for_lunch_out = $forlunch_out->fetch();
		$forbreak_out=$pdo_conn->prepare("SELECT entry_time FROM attendance_entry WHERE staff_name ='".$_POST['staff_id']."' and  delete_status !='1' and entry_date ='".$date."' and attendance_type ='Break out' ");
		$forbreak_out->execute();
		$for_break_out = $forbreak_out->fetch();
		$forbreak_in=$pdo_conn->prepare("SELECT entry_time FROM attendance_entry WHERE staff_name ='".$_POST['staff_id']."' and  delete_status !='1' and entry_date ='".$date."' and attendance_type ='Break in' ");
		$forbreak_in->execute();
		$for_break_in = $forbreak_in->fetch();
		
		
 ?>
    <tr>
                <td align="center" height="25" class="style2">&nbsp;<?php echo $i = $i+1; ?>.</td>
				<td align="center" class="style2">&nbsp;<?php echo date ("d-m-Y", strtotime($date))?></td>
                
                 <td align="center" class="style2">&nbsp;<?php if($attendanceentry['entry_time']) {echo $attendanceentry['entry_time']; } else {echo "-"; }?></td>
                  <td align="center" class="style2">&nbsp;<?php if($for_lunch_in['entry_time']) {echo $for_lunch_in['entry_time']; } else {echo "-"; } ?></td>
                 <td align="center" class="style2">&nbsp;<?php if($for_lunch_out['entry_time']) {echo $for_lunch_out['entry_time']; } else {echo "-"; } ?></td>
                 <td align="center" class="style2">&nbsp;<?php if($for_break_in['entry_time']) {echo $for_break_in['entry_time']; } else {echo "-"; } ?></td>
                 <td align="center" class="style2">&nbsp;<?php if($for_break_out['entry_time']) {echo $for_break_out['entry_time']; } else {echo "-"; } ?></td>
                  <td align="center" class="style2">&nbsp;<?php if($attendanceentry1['entry_time']) {echo $attendanceentry1['entry_time']; } else {echo "-"; } ?></td>   
                </tr>
                <?php 
				$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));  } ?>
   

	
               
     </table>
<?php } ?>

<?php     
		if($action == 'EXECUTIVE_VIEW'){ 
		
		 ?>
	

<table width="100%" cellspacing="0" cellpadding="0">
            
 		  
        <?php  $i=0;
		$select_userroll=$pdo_conn->prepare("SELECT * FROM userroll WHERE roll_name like '%executive%' and active_status ='Active'");
		$select_userroll->execute();
		$userroll = $select_userroll->fetchAll();
		foreach( $userroll as $userrolls){
		$select_executivename=$pdo_conn->prepare("SELECT * FROM staffcreation WHERE delete_status = '0' and staff_type ='".$userrolls['userroll_id']."'");
		$select_executivename->execute();
		$executive_name = $select_executivename->fetchAll(); 
		 foreach($executive_name as $value ) { 
		$main_list = $pdo_conn->prepare("SELECT * FROM assign_company WHERE executive ='".$value['staffcreation_id']."' AND  delete_status != '1'");
		$main_list->execute();
		$mainlist = $main_list->fetchAll();	
		  
	?>
    <tr>
                <td width="183" align="left" class="style10 style4"><h5><strong>&nbsp;Executive Name: 
                
                &nbsp;<?php echo  $value['staff_name']; ?></strong></h5></td></tr>
                  <tr>  <td width="183" align="left" class="style10 style4"><strong>&nbsp;Project Name</strong></td>   
        </tr>   
             <?php $i='0';
			 if($mainlist !='') { 
			 foreach($mainlist as $record)   {    	
			  $select_project = $pdo_conn->prepare("SELECT * FROM project_creation WHERE project_creation_id ='".$record['project_name']."' ");
             $select_project->execute();
             $project = $select_project->fetchAll(); ?>
             
           <tr> <td align="left" height="25" class="style2">&nbsp;<?php echo $i = $i+1; ?>.
           &nbsp;<?php echo $project[0]['project_name'] ?></td> 
                 
                  <?php  } 
				   ?>
                </tr>
                <?php } 
				else  { ?>
				<tr><td>
           &nbsp;<?php echo "-"; ?></td> 
				<?php 
				}}
		}?>
   

	
               
     </table>
<?php 
		}?>
<?php     
		if($action == 'PROJECT_VIEW'){ 
		
		 ?>
	

<table width="100%" cellspacing="0" cellpadding="0">
        
        <?php  $i=0;
		if($_POST['executive_login'] =='') {
		$pdo_project_pos = $pdo_conn->prepare("SELECT * FROM  project_creation WHERE delete_status !='1'");
		$pdo_project_pos->execute();
		$pdoproject_name = $pdo_project_pos->fetchAll();  
		foreach($pdoproject_name as $value ){ 
		$main_list = $pdo_conn->prepare("SELECT * FROM assign_company WHERE project_name ='".$value['project_creation_id']."' AND  delete_status != '1'");
		$main_list->execute();
		$mainlist = $main_list->fetchAll();	
		
	?>
    <tr>
               <td width="183" align="left" class="style10 style4"><h5><strong>&nbsp;Project Name :&nbsp;<?php echo  $value['project_name']; ?></strong></h5></td><tr>
                <tr>
        <td width="183" align="left" class="style10 style4"><strong>&nbsp;Executive Name</strong></td>         
        </tr> 
              <?php $i=0;
			  foreach($mainlist as $record) {	
			 $select_project = $pdo_conn->prepare("SELECT * FROM staffcreation WHERE staffcreation_id ='".$record['executive']."'");
             $select_project->execute();
             $project = $select_project->fetchAll(); ?>
               <tr> 
               <td align="left" height="25" class="style2">&nbsp;<?php echo $i = $i+1; ?>.
               &nbsp;<?php echo $project[0]['staff_name']; ?></td> 
          <?php  } ?>
                </tr>
                <?php   
		}}
		else{
		$select_customer=$pdo_conn->prepare("SELECT * FROM assign_company WHERE executive ='".$_POST['executive_login']."' and delete_status !='1'");
		$select_customer->execute();
		$customer2 = $select_customer->fetchAll();
		foreach($customer2 as $value1){
		$pdo_project_pos = $pdo_conn->prepare("SELECT * FROM  project_creation WHERE delete_status !='1' and project_creation_id ='$value1[project_name]'");
		$pdo_project_pos->execute();
		$pdoproject_name = $pdo_project_pos->fetchAll();  
		foreach($pdoproject_name as $value ){ 
		$main_list = $pdo_conn->prepare("SELECT * FROM assign_company WHERE project_name ='".$value['project_creation_id']."' AND  delete_status != '1'");
		$main_list->execute();
		$mainlist = $main_list->fetchAll();	
		
	?>
    <tr>
               <td width="183" align="left" class="style10 style4"><h5><strong>&nbsp;<?php echo  $value['project_name']; ?></strong></h5></td><tr>
         <!----       <tr>
        <td width="183" align="left" class="style10 style4"><strong>&nbsp;Executive Name</strong></td>         
        </tr> 
              <?php $i=0;
			  foreach($mainlist as $record) {	
			 $select_project = $pdo_conn->prepare("SELECT * FROM staffcreation WHERE staffcreation_id ='".$record['executive']."'");
             $select_project->execute();
             $project = $select_project->fetchAll(); ?>
               <tr> 
               <td align="left" height="25" class="style2">&nbsp;<?php echo $i = $i+1; ?>.
               &nbsp;<?php echo $project[0]['staff_name']; ?></td> 
          <?php  } ?>
                </tr> ---->
                <?php   
		}} }?>
   

	
               
     </table>
<?php 
		}?>
<?php 		if($action == 'VIEW'){ 
$cr_month = date('M');
$cr_year = date('y');

    $query = "and date between'".$_GET['from_date']."' and '".$_GET['to_date']."'";
	$main_list = $pdo_conn->prepare("SELECT * FROM staffcreation WHERE staffcreation_id ='".$_POST['staffcreation_id']."' AND  delete_status != '1'");
	$main_list->execute();
	$mainlist = $main_list->fetchAll();	

    
	//$pay_list = $pdo_conn->prepare("SELECT * FROM `paymentfollowups` WHERE executive ='".$_POST['staffcreation_id']."' $query AND `delete_status` = 0  ");
	$pay_list = $pdo_conn->prepare("SELECT *,SUM(today_collection) as tc FROM `paymentfollowups` WHERE executive ='".$_POST['staffcreation_id']."' $query AND `delete_status` = 0 GROUP by `company_name`,`customer_name`");
	$pay_list->execute();
	$paymentlist = $pay_list->fetchAll();	
	
	$select_payment=$pdo_conn->prepare("SELECT SUM(bal_amt) ,SUM(collection_target) FROM payment_creation WHERE delete_status != '1'  $query and executive ='".$_POST['staffcreation_id']."' ");
   	$select_payment->execute();
   	$executive_target = $select_payment->fetchAll();
?>
<table width="100%" cellspacing="0" cellpadding="0" >
        <tr> 
            <td height="37" align="center" class="style10"><strong><b><h4>&nbsp;<?php echo ucfirst($mainlist[0]['staff_name']); ?> - Collection Target <?php echo $cr_month ?> ' <?php echo $cr_year; ?></h4></b></strong></td>
       
        </tr>
        
	</table>
	
      <table align="right">  
            <td height="37" align="right" class="style10"><strong><h4>&nbsp;Target Amount : <?php if( $executive_target[0]['SUM(collection_target)'] =="")
					  															echo "0";
																				else
																				echo number_format($executive_target[0]['SUM(collection_target)'],2); ?></h4> </strong></td>
        </tr>
	</table>
    
      
               
     </table>
	<table width="100%" cellspacing="0" cellpadding="0" border="1" style="float:right;">
        <tr>
            <td width="48" height="27" align="" class="style10 style4"><strong><h4 style="font-size: 11px;">S.No</h4></strong></td>
            <!--<td width="183" align="" class="style10 style4"><strong><h4 style="font-size: 11px;">&nbsp;Date</h4></strong></td>-->
            <td width="168" align="" class="style10 style4"><strong><h4 style="font-size: 11px;">&nbsp;Customer</h4></strong></td>
            <td width="168" align="" class="style10 style4"><strong><h4 style="font-size: 11px;">&nbsp;Concern</h4></strong></td>
            <td width="168" align="" class="style10 style4"><strong><h4 style="font-size: 11px;">&nbsp;Target</h4></strong></td>
            <td width="334" align="" class="style10 style4"><strong><h4 style="font-size: 11px;">&nbsp;Collection</h4></strong></td>
            <td width="168" align="" class="style10 style4"><strong><h4 style="font-size: 11px;">&nbsp;Pending</h4></strong></td>      
            
        </tr>
        <?php  $i=0;
		$total ="";
		$total1 ="";
   		 $date ='';
	      $concern ='';
	 foreach($paymentlist as $value)  
	 { 
        if(($date != $value['date']) || ($concern !=$value['company_name'] || $customer !=$value['customer_name'] )) 
        {
            /*$pay_sum = $pdo_conn->prepare("SELECT SUM(today_collection) as todaycoll,bal_amt FROM paymentfollowups WHERE executive ='".$_POST['staffcreation_id']."' AND  delete_status != '1' and date='".$value['date']."' and customer_name='".$value['customer_name']."' and company_name='".$value['company_name']."'");
            $pay_sum->execute();
            $paymentsum = $pay_sum->fetch();	
            $pending_amount = $paymentsum['bal_amt'] - $paymentsum['todaycoll'];*/
            $pending_amount = $value['bal_amt'] - $value['tc'];
            ?>
            <tr>
                <td align="left" height="25" class="style2">&nbsp;<?php echo $i = $i+1; ?>.</td>
                <!--<td align="left" class="style2">&nbsp;<?php echo date("d-m-Y",strtotime($value['date'])); ?></td>-->
                <?php
                $select_customer_profile = $pdo_conn->prepare("SELECT * FROM customer_profile WHERE customer_id ='".$value['customer_name']."' ");
                $select_customer_profile->execute();
                $customer_profile = $select_customer_profile->fetchAll(); ?>
                <td align="left" class="style2">&nbsp;<?php echo $customer_profile[0]['company_name']; ?></td>  
                <?php  $cncn_nam = $pdo_conn->prepare("SELECT * FROM ourconcerns WHERE concern_id='".$value['company_name']."'");
                $cncn_nam->execute();
                $concern_name = $cncn_nam->fetchAll();?>
                <td align="left" class="style2">&nbsp;<?php echo $concern_name[0]['concern_name']; ?></td>
                <td align="right" class="style2">&nbsp;<?php echo number_format($value['collection_amt'],2);  ?></td>          
                <!--<td align="right" class="style2">&nbsp;<?php echo number_format($paymentsum['todaycoll'],2);  ?></td>-->
                <td align="right" class="style2">&nbsp;<?php echo number_format($value['tc'],2);  ?></td>
                <td align="right" class="style2">&nbsp;<?php echo number_format($pending_amount,2);  ?></td>         
            </tr>
        <?php
        }
    $date =$value['date'];
    $concern = $value['company_name']; 
    $customer =$value['customer_name'];
    }
    $total_target = $total + $total1; 
				 ?>
               
               
     </table><br>
     <table align="right" border="1" width="100%">
    <td align="right" width="55%"><strong class="third_data">Concern</strong></td>
     <td align="right" width="15%"><strong class="third_data">Target</strong></td>
     <td align="center" width="15%"><strong class="third_data">Collection</strong></td>
      <td align="center" width="15%"><strong class="third_data">Pending</strong></td>
    <?php
	$percentage =""; 
	$cncn_name ='';
	$total_tar ='';
	$total_pen ='';
	$total_collection =0;
	 //foreach($paymentlist as $value)  {
		//if($cncn_name != $value['company_name']){
	$cncn_name = $pdo_conn->prepare("SELECT * FROM ourconcerns WHERE delete_status!='1'");
	$cncn_name->execute();
	$concern_names = $cncn_name->fetchAll();
	foreach($concern_names as $value1) {
	$paymnt = $pdo_conn->prepare("SELECT SUM(collection_target) FROM payment_creation WHERE executive ='".$_POST['staffcreation_id']."' AND  delete_status != '1'and company_name='".$value1['concern_id']."'$query");
	$paymnt->execute();
	$payment = $paymnt->fetchAll();	
	$pay_sum = $pdo_conn->prepare("SELECT SUM(today_collection) FROM paymentfollowups WHERE executive ='".$_POST['staffcreation_id']."' AND  delete_status != '1' and company_name='".$value1['concern_id']."' $query");
	$pay_sum->execute();
	$paymentsum = $pay_sum->fetchAll();
	$total_clc =$paymentsum[0]['SUM(today_collection)'];
	$pending =  $payment[0]['SUM(collection_target)']-$total_clc;?>
     <tr>
     <td align="right" style="font-weight:800;"><?php echo $value1['concern_name']; ?></td>
     <td align="right"><?php echo number_format($payment[0]['SUM(collection_target)'],2); ?></td>
     <td align="right"><?php echo number_format($total_clc,2); ?></td>
     <td align="right"><?php echo number_format($pending,2); ?></td>
     </tr>
     <?php 
	 $total_collection = $total_collection+$total_clc;
	 $total_tar = $total_tar +  $payment[0]['SUM(collection_target)'];
	 $total_pen = $total_pen + $pending;
	 
	  }?>
     <tr >
     <td><strong class="third_data">TOTAL</strong></td>
     <td align="right"><strong class="third_data"><?php echo number_format($total_tar,2); ?></strong></td>
     <td align="right" ><strong class="third_data"> <?php echo number_format($total_collection,2); ?></strong></td>
     <td align="right" ><strong class="third_data"><?php echo number_format($total_pen,2); ?></strong></td>
     </tr>
     </table>
  <!---   <table width="40%" border="1" align="left">
     <tr>
     <td>Collection %</td>
     <td><?php echo $percentage; ?>%</td>
     </tr>
     </table> --->
<?php } ?>
<?php 
	if($action == 'CUSTOMER_LIST'){ 
		
		 ?>
        
        <?php  $i=0;
		
	?>
	 <div class="table-responsive">     
  <table width="100%" cellspacing="0" cellpadding="0">
       <tr>
            <td width="48" height="27" align="left" class="style10 style4"><strong>S.No</strong></td>
            <td width="183" align="left" class="style10 style4"><strong>&nbsp;Customer Name</strong></td>
            <td width="183" align="left" class="style10 style4"><strong>&nbsp;Billing Address</strong></td>
             <td width="183" align="left" class="style10 style4"><strong>&nbsp;Landline Number</strong></td>
             <td width="183" align="left" class="style10 style4"><strong>&nbsp;Email Id</strong></td>
              <td width="183" align="left" class="style10 style4"><strong>&nbsp;Contact Person</strong></td>
             <td width="183" align="left" class="style10 style4"><strong>&nbsp;Mobile No</strong></td>
             
                           
        </tr>
      <?php    if($_POST['executive_login'] =='') {
		$pdo_cus = $pdo_conn->prepare("SELECT * FROM  customer_profile WHERE delete_status !='1'");
		$pdo_cus->execute();
		$pdo_customer = $pdo_cus->fetchAll();  
		 		
        $i=0;
	 foreach($pdo_customer as $value ){ ?>
    <tr>
                <td align="left" height="25" class="style2">&nbsp;<?php echo $i = $i+1; ?>.</td>
				<td align="left" class="style2">&nbsp;<?php echo $value['company_name'] ?></td>
                 <td align="left" class="style2">&nbsp;<?php echo $value['billing_address'] ?></td>
                  <td align="left" class="style2">&nbsp;<?php echo $value['landline_num'] ?></td>
                   <td align="left" class="style2">&nbsp;<?php echo $value['email'] ?></td>
                   <?php
				   		$pdo_conct = $pdo_conn->prepare("SELECT * FROM  contact WHERE customer_id ='".$value['customer_id']."'and delete_status !='1'ORDER BY contact_id DESC");
		$pdo_conct->execute();
		$pdo_contact = $pdo_conct->fetchAll();
		$len = count($pdo_contact);  
				   ?>
            <td> <?php foreach($pdo_contact as $record) { echo $record['contact_name'];if(($len-1) != 0) echo " & "; $len--;}?></td>
            <td> <?php $len = count($pdo_contact); foreach($pdo_contact as $record) { echo $record['mobile_number'];if(($len-1) != 0) echo " & ";$len--;}?></td>
                </tr>
                <?php   } }
                   else{
					   $i='0';
		$select_customer=$pdo_conn->prepare("SELECT * FROM assign_customer WHERE staff_id ='".$_POST['executive_login']."' and delete_status = '0'");
		$select_customer->execute();
		$cust = $select_customer->fetchAll();
foreach($cust as $rcd)	{	
		$pdo_cus = $pdo_conn->prepare("SELECT * FROM  customer_profile WHERE delete_status !='1' and customer_id ='".$rcd['company_id']."'");
		$pdo_cus->execute();
		$pdo_customer = $pdo_cus->fetchAll();  
		 		
	 foreach($pdo_customer as $value ){ ?>
    <tr>
                <td align="left" height="25" class="style2">&nbsp;<?php echo $i = $i+1; ?>.</td>
				<td align="left" class="style2">&nbsp;<?php echo $value['company_name'];?></td>
                 <td align="left" class="style2">&nbsp;<?php echo $value['billing_address'] ?></td>
                  <td align="left" class="style2">&nbsp;<?php echo $value['landline_num'] ?></td>
                   <td align="left" class="style2">&nbsp;<?php echo $value['email'] ?></td>
                   <?php
				   		$pdo_conct = $pdo_conn->prepare("SELECT * FROM  contact WHERE customer_id ='".$value['customer_id']."'and delete_status !='1'ORDER BY contact_id DESC");
		$pdo_conct->execute();
		$pdo_contact = $pdo_conct->fetchAll();
		$len = count($pdo_contact);  
				   ?>
            <td> <?php foreach($pdo_contact as $record) { echo $record['contact_name'];if(($len-1) != 0) echo " & "; $len--;}?></td>
            <td> <?php $len = count($pdo_contact); foreach($pdo_contact as $record) { echo $record['mobile_number'];if(($len-1) != 0) echo " & ";$len--;}?></td>
                </tr>
                <?php  } } }?>
      
      
     </table>
	 </div>
<?php 
		}?>
<style>
h4 {
    line-height: 22px;
    font-size: 13px !important;
    font-weight: 800 !important;
    color: black;
}
strong.third_data {
    font-weight: 800;
	color: black;
}
</style>