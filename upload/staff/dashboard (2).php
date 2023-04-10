  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <?php 
  
  	if($_SESSION['executive_login'] == '') 
	{
		
 	$select_customer=$pdo_conn->prepare("SELECT COUNT(customer_id) FROM customer_profile WHERE delete_status = '0' ");
    $select_customer->execute();
	
    $customer = $select_customer->fetch();
	$cus_count = (int)$customer['COUNT(customer_id)'];

	$select_project=$pdo_conn->prepare("SELECT COUNT(project_creation_id) FROM project_creation WHERE delete_status = '0' ");
    $select_project->execute();
    $projects = $select_project->fetchAll();
	
	}
	else
	{
	$select_customer=$pdo_conn->prepare("SELECT COUNT(company_id) FROM assign_customer WHERE staff_id ='".$_SESSION['executive_login']."' and delete_status = '0'");
    $select_customer->execute();
    $customer = $select_customer->fetch();
	$cus_count = (int)$customer['COUNT(company_id)'];
//echo "SELECT COUNT(project_name) FROM assign_company WHERE executive ='".$_SESSION['executive_login']."' and delete_status = '0' and project_name!=''";
	$select_project=$pdo_conn->prepare("SELECT COUNT(project_name) FROM assign_company WHERE executive ='".$_SESSION['executive_login']."' and delete_status = '0' and project_name!='' ");
    $select_project->execute();
    $projects = $select_project->fetchAll();
	}
	$select_staff=$pdo_conn->prepare("SELECT COUNT(staffcreation_id) FROM staffcreation WHERE delete_status = '0' ");
    $select_staff->execute();
    $staff = $select_staff->fetchAll();
	$select_userroll1=$pdo_conn->prepare("SELECT * FROM userroll WHERE roll_name like '%executive%' and active_status ='Active'");
    $select_userroll1->execute();
    $userroll1 = $select_userroll1->fetchAll();
	foreach($userroll1 as $value) {	
	$select_executive=$pdo_conn->prepare("SELECT * FROM staffcreation WHERE delete_status = '0' and staff_type=$value[userroll_id] and delete_status = '0'");
    $select_executive->execute();
    $executive = $select_executive->fetchAll();
	foreach($executive as $value)
	{
		$executive_count=$executive_count+1;
	}
	}

	$cr_dt=date("Y-m-d");
	$cr_month=date("Y-m-01");
	$month =date("Y-m");
	$select_payment=$pdo_conn->prepare("SELECT * FROM payment_creation WHERE delete_status = '0' ");
    $select_payment->execute();
    $executive_name = $select_payment->fetchAll(); 
	$select_userroll=$pdo_conn->prepare("SELECT * FROM userroll WHERE roll_name like '%executive%' and active_status ='Active'");
    $select_userroll->execute();
    $userroll = $select_userroll->fetchAll();
	
	if($mobileapp_login)
	{
		$file = '';
	}
	else
	{
		$file = 'index.php';
	}
	?>
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small></small>
		<?php echo ucfirst($foldername); ?>        
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $file;?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active"><?php echo ucfirst($foldername); ?></li>
      </ol>
    </section>
<!----------------------------------------------------------------Visit Notification Scrolll --------------------------------------------->    
 <?php     if($_SESSION['executive_login'] == '') { ?>
     <h5 class="box-title"><marquee width="100%" direction="left" height="20%" loop="infinite">
   <table>
   <tr>
      <?php
	 
		
	$aftertwo_date = date('Y-m-d', strtotime('+2 days', strtotime(date("Y-m-d")))); 
	//echo "SELECT * FROM regular_visits WHERE  next_date  between '".$cr_dt."' and '".$aftertwo_date."' and delete_status !='1'";
	$select_regularvisit=$pdo_conn->prepare("SELECT * FROM regular_visits WHERE  next_date  between '".$cr_dt."' and '".$aftertwo_date."' and delete_status !='1'");
    $select_regularvisit->execute();
    $regularvisit = $select_regularvisit->fetchAll();
	$count = $select_regularvisit->rowCount();
	if ($select_regularvisit->rowCount() ==0){
	?> <?php } else{
	?><h4> Visit Notification</h4> <?php }
	foreach($regularvisit as $value) 
{	
$select_customer=$pdo_conn->prepare("SELECT company_name FROM customer_profile WHERE customer_id ='$value[company_id]' and delete_status !='1'");
    $select_customer->execute();
    $customer1 = $select_customer->fetch();
	$assign_customer=$pdo_conn->prepare("SELECT executive FROM assign_company WHERE company_name ='$value[company_id]' and project_name ='$value[project_name]' and delete_status !='1'");
    $assign_customer->execute();
    $assign_customer1 = $assign_customer->fetch();
	$staff1 = $pdo_conn->prepare("SELECT `staff_name` FROM `staffcreation` WHERE `staffcreation_id`='".$assign_customer1['executive']."' and delete_status !='1'");
	$staff1->execute();
	$staff_name1 = $staff1->fetch();
	$project = $pdo_conn->prepare("SELECT `project_name` FROM `project_creation` WHERE `project_creation_id`='".$value[project_name]."' and delete_status !='1'");
	$project->execute();
	$project_name = $project->fetch();

	?>
   
  
	<td align="left">
	<table border="1">
    <tr>
    <td>Customer : <?php echo $customer1['company_name']?></td></tr><tr>
    <td>Executive : <?php echo $staff_name1['staff_name']?></td></tr><tr>
    <td>Project : <?php echo $project_name['project_name']  ?> </td></tr><tr>
    <td>Visit Date : <?php echo date('d-m-Y',strtotime($value['next_date'])) ?></td>
    </tr>
	</table>
 </td>
  <?php  } ?> 
 </tr>
 </table>
  </marquee></h5>
 <?php } else { ?>
    <h5 class="box-title"><marquee width="100%" direction="left" height="20%" loop="infinite">
   <table>
   <tr>
 <?php
	$project1 = $pdo_conn->prepare("SELECT * FROM `assign_company` WHERE executive ='".$_SESSION['executive_login']."' and delete_status !='1'");
	$project1->execute();
	$project_name1 = $project1->fetchAll();
	$count1 =1;
	$aftertwo_date = date('Y-m-d', strtotime('+2 days', strtotime(date("Y-m-d")))); 
foreach($project_name1 as $record)	{
	$select_regularvisit=$pdo_conn->prepare("SELECT * FROM regular_visits WHERE  next_date  between '".$cr_dt."' and '".$aftertwo_date."' and project_name='$record[project_name]' and company_id = '$record[company_name]' and delete_status !='1'");
    $select_regularvisit->execute();
    $regularvisit = $select_regularvisit->fetchAll();
	$count = $select_regularvisit->rowCount();
	if ($count !==0 && $count1 !=0){
	?><h4> Visit Notification</h4> <?php $count1 =0; } else{
	 } 
	foreach($regularvisit as $value) 
{	
$select_customer=$pdo_conn->prepare("SELECT company_name FROM customer_profile WHERE customer_id ='$value[company_id]' and delete_status !='1'");
    $select_customer->execute();
    $customer1 = $select_customer->fetch();
	$assign_customer=$pdo_conn->prepare("SELECT executive FROM assign_company WHERE company_name ='$value[company_id]' and project_name ='$value[project_name]' and delete_status !='1'");
    $assign_customer->execute();
    $assign_customer1 = $assign_customer->fetch();
	$staff1 = $pdo_conn->prepare("SELECT `staff_name` FROM `staffcreation` WHERE `staffcreation_id`='".$assign_customer1['executive']."' and delete_status !='1'");
	$staff1->execute();
	$staff_name1 = $staff1->fetch();
	$project = $pdo_conn->prepare("SELECT `project_name` FROM `project_creation` WHERE `project_creation_id`='".$value[project_name]."' and delete_status !='1'");
	$project->execute();
	$project_name = $project->fetch();

	?>
   
  
	<td align="left">
	<table border="1">
    <tr>
    <td>Customer : <?php echo $customer1['company_name']?></td></tr><tr>
    <td>Executive : <?php echo $staff_name1['staff_name']?></td></tr><tr>
    <td>Project : <?php echo $project_name['project_name']  ?> </td></tr><tr>
    <td>Visit Date : <?php echo date('d-m-Y',strtotime($value['next_date'])) ?></td>
    </tr>
	</table>
 </td>
  <?php } } ?> 
 </tr>
 </table>
 </marquee></h5>
 <?php }
   ?>
 <!----------------------------------------------------------------/Visit Notification Scrolll --------------------------------------------->
  <!----------------------------------------------------------------Customer Count --------------------------------------------->
 
	<section class="content">
	
	<div class="row">
        <div class="col-xl-3 col-md-6 col-12">
         <a class="media media-single" href="#" title="View" id="customer_view_model" onclick="customer_list();" data-toggle="modal" data-target="#customer_list">
          <div class="info-box">
            <!----<span class="info-box-icon bg-blue"><i class="ion ion-stats-bars"> --->
             <span class="info-box-icon bg-red"><img src="images/imag1.png" style="width: 46px;height: 46px;"  ></span>
    
            <div class="info-box-content">
              <span class="info-box-number"><?php if($cus_count!= '') {echo (int)$cus_count;} else { echo "0";}?></span>
              <span class="info-box-text">Customers</span>
            </div>
            <!-- /.info-box-content -->
          </div></a>
          <!-- /.info-box -->
        </div>
 <!----------------------------------------------------------------Staff Count --------------------------------------------->
        <!-- /.col -->
       
       <?php if($_SESSION['executive_login'] == '') { ?>
        
          <div class="col-xl-3 col-md-6 col-12">
           <a class="media media-single" href="#" title="View" id="staff_view_model"onclick="staff_list();" data-toggle="modal" data-target="#staff_list">
          <div class="info-box">
         
           <span class="info-box-icon bg-red"><img src="images/imag2.png" style="width: 65px;height: 65px;"  ></span>
			 
            <div class="info-box-content">
              <span class="info-box-number"><?php if($staff[0]['COUNT(staffcreation_id)'] !=0) {echo $staff[0]['COUNT(staffcreation_id)'];} else { echo "0";}?></span>
              <span class="info-box-text">Staffs</span>
            </div>
            <!-- /.info-box-content --> 
          </div></a>
          <!-- /.info-box -->
       </div> 
        <div class="clearfix visible-sm-block"></div>

        <div class="col-xl-3 col-md-6 col-12">
         <a class="media media-single" href="#" title="View" id="executive_model"onclick="executive_list();" data-toggle="modal" data-target="#executive_list">
          <div class="info-box">
            <span class="info-box-icon bg-red"><img src="images/imag3.png" style="width: 46px;height: 46px;"  ></span>

            <div class="info-box-content">
              <span class="info-box-number"><?php if($executive_count !=0) {echo $executive_count;} else { echo "0";}?></span>
              <span class="info-box-text">Executives</span>
            </div>
            <!-- /.info-box-content -->
          </div></a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
          <?php } ?>
        <div class="col-xl-3 col-md-6 col-12">
         <a class="media media-single" href="#" title="View" id="project_view_model"onclick="project_list();" data-toggle="modal" data-target="#project_list">
          <div class="info-box">
            <span class="info-box-icon bg-red"><img src="images/imag4.png" style="width: 66px;height: 66px;"  ></span>

            <div class="info-box-content">
              <span class="info-box-number"><?php 
              if($_SESSION['executive_login'] == '') 
              {
              if($projects[0]['COUNT(project_creation_id)']!=0) 
              {
                  echo $projects[0]['COUNT(project_creation_id)'];
                  
              } 
              else 
              {
              echo "0";
              }
              
              }
              
              else
              {
               if($projects[0]['COUNT(project_name)']!="") 
              {
                  echo $projects[0]['COUNT(project_name)'];
                  
              } 
              else 
              {
              echo "0";
              }   
              }
              ?></span>
              <span class="info-box-text">Projects</span>
            </div>
            <!-- /.info-box-content -->
          </div></a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
        
        <div class="col-xl-12 col-md-12 col-sm-12">
          <div class="info-box">
           	<div class="box-header" align="center">
           		<h5 class="box-title" style="color: #ef5350;">Payment Follow-ups</h5>
           	</div>
            
 			<form class="was-validated" name="state" autocomplete="off">
				<div class="row">
					<div class="col-md-3 ">
					<div class="form-group">
						<h5>From Date</h5>
						<input type="month" class="form-control" name="from_date" id="from_date"  value="<?php if($_GET['from_date'] !="") { echo $_GET['from_date']; } else { echo $month; } ?>" required>
					</div>
					</div>
			
					<!-- <div class="col-md-3 ">
					<div class="form-group">
						<h5>To Date</h5>
						<input type="date" class = "form-control" name="to_date" id="to_date"  value="<?php if($_GET['to_date'] !="") {	echo $_GET['to_date']; } else { echo $cr_dt; } ?>"required>
					</div>
					</div> -->
					<div class="col-md-1 ">
					<div class="form-group">
						<h5><br></h5>
						<input type="button" class="form-control btn btn-info response-div" name="go" id="go" onClick="filter();" value="GO" required>
					</div>
					</div>
		        </div>
            </form>
                         <?php 
						// if($_GET['from_date']!="" && $_GET['to_date']!=""){
						 if($_GET['from_date']!=""){
							$from_date = $_GET['from_date'];
							//$to_date = $_GET['to_date'];
						 	//$query = "and date between'".$_GET['from_date']."' and '".$_GET['to_date']."'";
						 $query = "and DATE_FORMAT(date,'%Y-%m')='".$_GET['from_date']."'";
						 }
						 else{
						 	//$query ="and date between'".$cr_month."' and '".$cr_dt."'";
						 	$query = "and DATE_FORMAT(date,'%Y-%m')= '$month'";
							$from_date = $month;
						 	//$to_date =$cr_dt;
						 }
						 ?>
                         <input type="hidden" class="form-control" name="from_date1" id="from_date1"  value="<?php echo $from_date; ?>" required>
                        <!--  <input type="hidden" class="form-control" name="to_date1" id="to_date1"  value="<?php echo $to_date; ?>" required> -->
         
	<table style="width:100%" class="pointer">
	<tr>
	<th class="box-title" style="width:17%;" >Executive</th>
	<th class="box-title"  style="width:15%;">Target</th>
	<th class="box-title" style="width:15%;" >Collection </th>
	<th class="box-title" style="width:15%;" >Balance</th>
	<th class="box-title"  style="width:15%;">Percentage</th>
	</tr>
	<div class="box-body p-0">
		<div class="media-list media-list-hover media-list-divided">
		<?php
		$collection_tar=$balance_amt=$bal='';
		if($_SESSION['executive_login'] == '') 
		{
			foreach( $userroll as $userrolls)
			{
				$select_executivename=$pdo_conn->prepare("SELECT * FROM staffcreation WHERE delete_status = '0' and staff_type ='".$userrolls['userroll_id']."'");
				$select_executivename->execute();
				$executive_name = $select_executivename->fetchAll(); ?>
				<?php foreach($executive_name as $value ) 
				{ 
					$select_payment=$pdo_conn->prepare("SELECT SUM(bal_amt) ,SUM(collection_target) FROM payment_creation WHERE delete_status != '1'  $query and executive ='".$value['staffcreation_id']."' ");
					$select_payment->execute();
					$executive_target = $select_payment->fetchAll(); 
					$pay_sum = $pdo_conn->prepare("SELECT SUM(today_collection) FROM paymentfollowups WHERE executive ='".$value['staffcreation_id']."' AND  delete_status != '1'$query");
					$pay_sum->execute();
					$paymentsum = $pay_sum->fetchAll();
					$total_clc =$paymentsum[0]['SUM(today_collection)'];?>
					<tr  href="#" title="View" id="executive_view_modal" onclick="executive_view_modal(<?php echo $value['staffcreation_id']?>)" data-toggle="modal" data-target="#executive_view">
						
						<td>
						<span class = "title"><?php echo $value['staff_name']; ?></span>
						</td>
						<td>
						<!-- <div class="box-tools "> -->
						<span ><?php 
						if( $executive_target[0]['SUM(collection_target)'] =="") {
						$collection_tar = number_format('0',2);
						echo number_format('0',2);
						}
						else {
						$collection_tar = $executive_target[0]['SUM(collection_target)'];
						echo number_format($executive_target[0]['SUM(collection_target)'],2); } ?></span>
						</td>
						<td>
						<span ><?php 
						if($total_clc == "") {
						$balance_amt = number_format('0',2);
						echo number_format('0',2); }
						else {
						$balance_amt = $total_clc;
						echo number_format($total_clc,2); } ?> </span>
						</td>
						<td>
						<span >
						<?php
						$bal = $collection_tar - $balance_amt;
						echo number_format($bal,2);
						?> 
						</span>
						<!-- </div> -->
						</td>
						<td>
						<span >
						<?php
						$percentage = ($total_clc/$collection_tar)*100;
						if(is_numeric($percentage)){
						echo number_format($percentage,2).'%';
						}
						else{
						echo number_format(0,2).'%';
						}
						?> 
						</span>
						<!-- </div> -->
						</td>
						
					</tr>
					<?php 
					$total_target = $total_target + $executive_target[0]['SUM(collection_target)'];
					$total_colc =  $total_colc + $total_clc;
					$total_bal += $bal;
				}
			}
		}
		else 
		{ 
			?>
			<?php 
			$select_payment=$pdo_conn->prepare("SELECT SUM(bal_amt) ,SUM(collection_target) FROM payment_creation WHERE delete_status != '1'  $query and executive ='".$_SESSION['executive_login']."'");
			$select_payment->execute();
			$executive_target = $select_payment->fetchAll();
			$pay_sum = $pdo_conn->prepare("SELECT SUM(today_collection) FROM paymentfollowups WHERE executive ='".$_SESSION['executive_login']."' AND  delete_status != '1'$query");
			$pay_sum->execute();
			$paymentsum = $pay_sum->fetchAll();
			$total_clc =$paymentsum[0]['SUM(today_collection)'];?>
			<tr  href="#" title="View" id="executive_view_modal" onclick="executive_view_modal(<?php echo $_SESSION['executive_login']?>)" data-toggle="modal" data-target="#executive_view">
				
					<td>
						<span class = "title"><?php echo $_SESSION['full_name'] ?></span>
					</td>
					<td>
						<!-- <div class="box-tools "> -->
						<span ><?php 
						if( $executive_target[0]['SUM(collection_target)'] =="") {
						$collection_tar = number_format('0',2);
						echo number_format('0',2);
						}
						else {
						$collection_tar = $executive_target[0]['SUM(collection_target)'];
						echo number_format($executive_target[0]['SUM(collection_target)'],2); } ?></span>
					</td>
					<td>
						<span ><?php 
						if($total_clc == "") {
						$balance_amt = number_format('0',2);
						echo number_format('0',2); }
						else {
						$balance_amt = $total_clc;
						echo number_format($total_clc,2); } ?> </span>
					</td>
					<td>
						<span >
						<?php
						$bal = $collection_tar - $balance_amt;
						echo number_format($bal,2);
						?> 
						</span>
						<!-- </div> -->
					</td>
					<td>
						<span >
						<?php
						$percentage = ($total_clc/$collection_tar)*100;
						echo number_format($percentage,2).'%';
						?> 
						</span>
						<!-- </div> -->
					</td>
				
			</tr>
			<?php 
			$total_target = $total_target + $executive_target[0]['SUM(collection_target)'];
			$total_colc =  $total_colc + $total_clc;
			$total_bal += $bal;
		} 
		?>
		<tr href="#" title="View" id="executive_view_modal" data-toggle="modal">
			
			<td>
			<h5 class="box-title">Total</h5>
			<!-- <div class="box-tools"> -->
			</td>
			<td>
			<h5 class="box-title " ><?php echo number_format($total_target,2); ?></h5>
			</td>
			<td>
			<h5 class="box-title " ><?php echo number_format($total_colc,2); ?></h5>
			</td>
			<td>
			<h5 class="box-title " ><?php echo number_format($total_bal,2); ?></h5>
			</td>
			<?php  $per_t= ($total_colc/$total_target)*100; ?>
			<td>
			<h5 class="box-title " ><?php echo number_format($per_t,2).'%'; ?></h5>
			</td>
			
		</tr>
		</div>
	</div>
				
            </div>
            </div>
			</table>
           
       


<div class="row">

        <div class="col-md-6 col-sm-12 col-lg-6">
          <div class="box"> 
			<div class="box-header with-border">
			<h5 class="box-title" style="color: #ef5350;">Customer &  Project Details</h5>  
			</div>

			<div class="row">
			<div class="col-md-12 col-lg-6" >
			<div class="form-group select_customer" >
			<?php  if($_SESSION['executive_login'] == '') 
			{ ?>
				<span class="title">
				<select class="form-control select2 item_name" name="search_customer" id="search_customer" required>
					<option value="">Select Customer Name</option>
					<?php 
					$select_company=$pdo_conn->prepare("SELECT * FROM customer_profile WHERE delete_status !='1' ");
					$select_company->execute();
					$selectcompany = $select_company->fetchAll();
					foreach($selectcompany as $value)
					{
					?>
						<option value="<?php echo $value['customer_id'];?>"  <?php if($value['customer_id']==$_GET['customer_id']){ echo "selected"; } ?> ><?php echo $value['company_name'] ?></option>
					<?php 
					}
					?>
				</select>
				</span>					
				<!--<input type="search" name="search_customer" id="search_customer" value="<?php if($_GET['cutomer_name'] != '') echo $_GET['search_customer'];  ?> "> ---></div> </div>
				<div class="col-md-2">
				<div class="form-group">
				<input type="button" class="btn-info" name="go" id="go" onClick="search_customer();" value="Search" required style="height:35px;"></div>
				</div>
				</div>			
					
				<table style="width:100%" class="pointer">       
				<div class="box-body p-0">
				<div class="media-list media-list-hover media-list-divided">

				<?php
				if($_GET['customer_id'] != '') 
				{
					$select_project=$pdo_conn->prepare("SELECT * FROM customer_profile WHERE delete_status !='1' and customer_id=$_GET[customer_id]");
					$select_project->execute();
					$project = $select_project->fetchAll();
				}
				else
				{
					$select_project=$pdo_conn->prepare("SELECT * FROM customer_profile WHERE delete_status !='1'  ORDER BY customer_id DESC LIMIT 5");
					$select_project->execute();
					$project = $select_project->fetchAll();
				} 
				foreach($project as $value1) 
				{ ?>
					<tr  href="#" title="View" id="project_view_modal"onclick="customer_view_modal(<?php echo $value1['customer_id']?>)" data-toggle="modal" data-target="#customer_view">
						<td><span class="title"><?php echo $value1['company_name'] ?></span></td>
					</tr>
				<?php 
				} 
			} 
			else
			{
				
				?>
				<span class="title">
					<select class="form-control select2 item_name" name="search_customer" id="search_customer" required>
						<option value="">Select Customer Name</option>
						<?php 
						$asgn_cmpny =$pdo_conn->prepare("SELECT * FROM assign_company WHERE delete_status !='1' and executive ='".$_SESSION['executive_login']."'");
						$asgn_cmpny->execute();
						$asgncmpny = $asgn_cmpny->fetchAll();
						foreach($asgncmpny as $value2)	 
						{					
							$select_company=$pdo_conn->prepare("SELECT * FROM customer_profile WHERE delete_status !='1' and customer_id ='$value2[company_name]' ");
							$select_company->execute();
							$selectcompany = $select_company->fetchAll();
							foreach($selectcompany as $value)
							{ ?>
								<option value="<?php echo $value['customer_id'];?>"  <?php if($value['customer_id']==$_GET['customer_id']){ echo "selected"; } ?> ><?php echo $value['company_name'] ?></option>
							<?php   
							}	
						}?>
					</select>
				</span>					
				</div> 
				</div>
				
				<div class="col-md-2">
				<div class="form-group">
				<input type="button" class="btn-info" name="go" id="go" onClick="filter_regularvisit();" value="GO" required>
				</div>
				</div>
				</div>
				<table style="width:100%" class="pointer"> 
				<div class="box-body p-0">
				<div class="media-list media-list-hover media-list-divided">
				<?php
				if($_GET['customer_id'] != '') 
				{
					$select_project=$pdo_conn->prepare("SELECT * FROM customer_profile WHERE delete_status !='1' and customer_id=$_GET[customer_id]");
					$select_project->execute();
					$project = $select_project->fetchAll();
					foreach($project as $value1) 
					{ ?>
						<tr href="#" title="View" id="project_view_modal" onclick="customer_view_modal(<?php echo $value1['customer_id']?>)" data-toggle="modal" data-target="#customer_view">
							<td><span class="title"><?php echo $value1['company_name'] ?></span></td>
						</tr> 
					<?php 
					} 
				}
				else
				{
					$asgn_cmpny1 =$pdo_conn->prepare("SELECT * FROM assign_company WHERE delete_status !='1' and executive ='".$_SESSION['executive_login']."' ORDER BY assign_company_id DESC LIMIT 5");
					$asgn_cmpny1->execute();
					$asgncmpny1 = $asgn_cmpny1->fetchAll();
					foreach($asgncmpny1 as $value2)	 
					{	
						$select_project=$pdo_conn->prepare("SELECT * FROM customer_profile WHERE delete_status !='1' and customer_id ='$value2[company_name]' ");
						$select_project->execute();
						$project = $select_project->fetchAll();
						foreach($project as $value1) 
						{ ?>
							<tr href="#" title="View" id="project_view_modal" onclick="customer_view_modal(<?php echo $value1['customer_id']?>)" data-toggle="modal" data-target="#customer_view">
							<td><span class="title"><?php echo $value1['company_name'] ?></span></td>
						</tr> 
						<?php 
						} 
					} 
				} 
			} ?>
			</div>
		</div>
		</table>
		</div>		
		</div>
		
		
		
        <div class="col-md-6 col-sm-12 col-lg-6"  id="rg_ls">              
             <div class="box">
                <div class="box-header with-border">
                   <h5 class="box-title" style="color: #ef5350;">Regular Visit</h5>
                   
                </div>
                <div class="row">
                   
                	<div class="col-md-12 col-lg-6" >
                   	<div class="form-group">
						<input type="date"   class="form-control  item_name" name="visit_date" id="visit_date" value="<?php if($_GET['visit_date']!=""){echo $_GET['visit_date']; } else {echo $cr_dt;} ?>" onChange="visit_list();" required></div>
					</div>
					</div>
					<table width="100%">
						<tr class="" href="#" title="View" id="" data-toggle="modal" style="border: 1px solid #ccc;">
                    	    <th class="box-title" >Executive</th>
                        	<!-- <div class="box-tools"> -->
                        	<th class="box-title " >Excel</th>
                            <th class="box-title " >PDF</th>
		                </tr>
                <div class="box-body p-0">
                   <div class="media-list media-list-hover media-list-divided">
        <?php
            $collection_tar=$balance_amt=$bal='';
			if($_SESSION['executive_login'] == '') {
            foreach( $userroll as $userrolls)
            {
                $select_executivename=$pdo_conn->prepare("SELECT * FROM staffcreation WHERE delete_status = '0' and staff_type ='".$userrolls['userroll_id']."'");
                $select_executivename->execute();
                $executive_name = $select_executivename->fetchAll();
                foreach($executive_name as $value) 
                { ?>
					<tr class="" href="#" id="" data-toggle="modal">
                        <td><span class = "title"><?php echo $value['staff_name']; ?></span></td>
                        <td> <span>
<!--					 <span onclick="executive_excel(<?php echo $value['staffcreation_id']?>)"> Click To Download</span>
-->                      <img src="upload/regularvisits_file/xl.png"  width="20px" onclick="executive_excel(<?php echo $value['staffcreation_id']?>)" title="Click To Download"/>
                           </span><!-- </div> --></td>
                         <td> <span><img src="upload/regularvisits_file/pdf.jpg"  width="20px" onclick="executive_pdf(<?php echo $value['staffcreation_id']?>)" title="Click To Download"/>
<!--    <span onclick="executive_pdf(<?php echo $value['staffcreation_id']?>)"> Click To Download</span>   -->                            </span>
                        </td>
                    </tr>
        <?php 
                }}}else { ?>
					<tr class="" href="#" title="View" id="" data-toggle="modal">
                        <td><span class = "title"><?php echo $_SESSION['full_name'] ?></span></td>
                        <td><span><img src="upload/regularvisits_file/xl.png" width="20px"  onclick="executive_excel(<?php echo $_SESSION['executive_login'] ?>)"/></span><!-- </div> --></td>
                        <td> <span><img src="upload/regularvisits_file/pdf.jpg"  width="20px" onclick="executive_pdf(<?php echo $_SESSION['executive_login']; ?>)" title="Click To Download"/>
<!--    <span onclick="executive_pdf(<?php echo $value['staffcreation_id']?>)"> Click To Download</span>  -->                            </span></td>
                    </tr>
                      <?php 
                         } ?>
                 
					</div>
                </div>
				</table>
             </div>
            </div>
			</div>
			<div class="row">
         <div class="col-md-6 ">
          <div class="box"> 
				<div class="box-header with-border">
					<h5 class="box-title" style="color: #ef5350;">Visit Pending List</h5>  
                </div> 
<table width="100%">	
<tr class="" href="#" title="View" id="" data-toggle="modal" style="border: 1px solid #ccc;">			   
                   
                        <td>
                         <h5 class="box-title">Customer</h5>
                         <!-- <div class="box-tools"> -->
                          </td>
                        <td>
                            <h5 class="box-title" >Executive</h5>
                            </td>
                        <td>
                            <h5 class="box-title " >Visit Date</h5>
                            </td>
                        
                     </tr>                      
				<div class="box-body p-0">
				  <div class="media-list media-list-hover media-list-divided">
                 	<?php
					if($_SESSION['executive_login'] == '') {
					$select_customer=$pdo_conn->prepare("SELECT * FROM customer_profile WHERE delete_status !='1'");
					$select_customer->execute();
					$customer2 = $select_customer->fetchAll();
					foreach($customer2 as $value) {
						$customer_name ='';
						$customer_id ='';
					$select_regularvisit1=$pdo_conn->prepare("SELECT * FROM regular_visits WHERE company_id ='$value[customer_id]' and delete_status !='1' ORDER BY regular_visit_id DESC");
					$select_regularvisit1->execute();
					$regularvisit1 = $select_regularvisit1->fetchAll();	
					if($regularvisit1[0]['next_date'] != '')
					if($regularvisit1[0]['next_date'] < date('Y-m-d', strtotime('+1 days', strtotime(date("Y-m-d")))))
					{
				
						$customer_name = $value['company_name'];
						$customer_id = $value['customer_id'];
						
					}
					$project_id = $regularvisit1[0]['project_name'];
	$assign_customer=$pdo_conn->prepare("SELECT executive FROM assign_company WHERE company_name ='$customer_id' and project_name ='$project_id' and delete_status !='1'");
    $assign_customer->execute();
    $assign_customer2 = $assign_customer->fetch();
	$staff1 = $pdo_conn->prepare("SELECT `staff_name` FROM `staffcreation` WHERE `staffcreation_id`='".$assign_customer2['executive']."'");
	$staff1->execute();
	$staff_name2 = $staff1->fetch();
  ?>				<?php if($customer_name !='') { ?>
  <tr class="" href="#" title="" id="" data-toggle="modal" data-target="">
					
                     <td>
					  <span class="box-title"><?php  echo $customer_name ?> </span>
                      </td>
					   <td>
                   
                            <span class="box-title" >
                            <?php echo $staff_name2['staff_name'] ?>
                            </span>
                        </td>
                         <td>
                   
                            <span class="box-title text-right" >
                            <?php echo date('d-m-Y',strtotime($regularvisit1[0]['next_date'])); ?>
                            </span>
                        </td>
					</tr>
                <?php   }}  }
                else {
					$select_customer=$pdo_conn->prepare("SELECT * FROM assign_company WHERE executive ='".$_SESSION['executive_login']."' and delete_status !='1'");
					$select_customer->execute();
					$customer2 = $select_customer->fetchAll();
					foreach($customer2 as $value) {
						$customer_name ='';
						$customer_id ='';
					$select_regularvisit1=$pdo_conn->prepare("SELECT * FROM regular_visits WHERE company_id ='$value[company_name]' and delete_status !='1' ORDER BY regular_visit_id DESC");
					$select_regularvisit1->execute();
					$regularvisit1 = $select_regularvisit1->fetchAll();	
					if($regularvisit1[0]['next_date'] != '')
					if($regularvisit1[0]['next_date'] < date('Y-m-d', strtotime('+1 days', strtotime(date("Y-m-d")))))
					{
						$select_customer=$pdo_conn->prepare("SELECT company_name FROM customer_profile WHERE customer_id ='$value[company_name]' and delete_status = '0' ");
				$select_customer->execute();
				$customer = $select_customer->fetch();
						$customer_name = $customer['company_name'];
						$customer_id = $value['company_name'];
						
					}
					$project_id = $regularvisit1[0]['project_name'];
  ?>				<?php if($customer_name !='') { ?>
					<tr class="" href="#" title="" id="" data-toggle="modal" data-target="">
					
                     <td>
					  <span class="box-title"><?php  echo $customer_name ?> </span>
                      </td>
					   <td>
                   
                            <span class="box-title" >
                            <?php echo $_SESSION['full_name']; ?>
                            </span>
                        </td>
                         <td>
                   
                            <span class="box-title text-right" >
                            <?php echo date('d-m-Y',strtotime($regularvisit1[0]['next_date'])); ?>
                            </span>
                        </td>
					</tr>
                <?php   }}  }?>

					
				  </div>
			   </div>
			   </table>
            </div>
          <!-- /.info-box -->
        </div>
       <div class="col-md-6 ">
          <div class="box"> 
				<div class="box-header with-border">
					<h5 class="box-title" style="color: #ef5350;">Attendance List</h5>  
				
               
                   </div> 
                   <div class="row">
                    
                                    <div class="col-md-12 col-lg-6" style="">
		                           <div class="form-group">
									<input type="month"  class="form-control  item_name" name="month" id="month" value="<?php if($_GET['month']!=""){echo $_GET['month']; } else {echo $month;} ?>" onChange="attendance_list();" required></div>
									</div>
								</div> 
								<table width="100%" class="pointer">
								<tr class="" href="#" title="View" id="" data-toggle="modal" style="border: 1px solid #ccc;">
                    
                        <th>
                         <h5 class="box-title">Staff Name</h5>
                         <!-- <div class="box-tools"> -->
                      </th>
                       
                        <th style="width:47%;">
                            <h5 class="box-title " >Present Days Count</h5>
                            </th>
                        
                      </tr>                         
				<div class="box-body p-0">
				  <div class="media-list media-list-hover media-list-divided">
                 	<?php
					if($_SESSION['executive_login'] == '') {
						$query_att ="";
						
					}
					else{
						$query_att = "staff_name ='".$_SESSION['executive_login']."' and ";
					}
					if($_GET['month']!=""){
							 $from_month = $_GET['month']."-01";
							 $to_month = date("Y-m-t", strtotime($_GET['month']));

						 $query_att2 = "and entry_date between'".$from_month."' and '".$to_month."'";
						 }
						 else{
						 $query_att2 ="and entry_date between'".$cr_month."' and '".$cr_dt."'";
						 $from_month = $cr_month;
						 $to_month =$cr_dt;
						 }

					$attendance_entry=$pdo_conn->prepare("SELECT DISTINCT staff_name FROM attendance_entry WHERE $query_att delete_status !='1' $query_att2 ORDER BY attendance_entry_id DESC");
					$attendance_entry->execute();
					$attendanceentry = $attendance_entry->fetchAll();
					foreach($attendanceentry as $value){	
					$staff1 = $pdo_conn->prepare("SELECT `staff_name` FROM `staffcreation` WHERE `staffcreation_id`='".$value['staff_name']."'");
					$staff1->execute();
					$staff_name2 = $staff1->fetch();
					$attendance_entry_in=$pdo_conn->prepare("SELECT COUNT(attendance_entry_id) FROM attendance_entry WHERE attendance_type ='Office in' $query_att2 and delete_status !='1' and staff_name ='".$value['staff_name']."'");
					$attendance_entry_in->execute();
					$attendanceentry_in = $attendance_entry_in->fetch();
					//echo "SELECT COUNT(attendance_entry_id) FROM attendance_entry WHERE attendance_type ='Office in' $query_att2 and delete_status !='1' and staff_name ='".$value['staff_name']."'";
					?>
                    <tr class="" href="#" title="View" id="attandance_view_modal" onclick="attendance_view_modal(<?php echo $value['staff_name']?>)" data-toggle="modal" data-target="#attadance_view">					
					
                     <td>
					  <span class="box-title"><?php  echo $staff_name2['staff_name'] ?> </span>
                      </td>
					  
                         <td>
                   
                            <span class="box-title text-right" >
                            <?php echo (int)$attendanceentry_in['COUNT(attendance_entry_id)']; ?>
                            </span>
                             <input type="hidden" class="form-control" name="from_month1" id="from_month1"  value="<?php echo $from_month; ?>" required>
                         <input type="hidden" class="form-control" name="to_month1" id="to_month1"  value="<?php echo $to_month; ?>" required>
                        </td>
					</tr>
                <?php   } ?>
                	
				  </div>
			   </div>
			   </table>
            </div>
          <!-- /.info-box -->
    </div>
	</div>
           <div class="col-xl-12 col-md-12 col-12 reponsive-air3">
          	<div class="info-box">
            	<div class="box-header with-border" style="text-align: center;">
					<h5 class="box-title" align="center" style="color: #ef5350; ">Regular Followups List</h5>  
            	</div>  
				<form class="was-validated" name="state" autocomplete="off">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-3 responsive-air1">
						<div class="form-group">
							<h5>From Date</h5>
							<input type="date" class="form-control" name="from_dt" id="from_dt" value="<?php if($_GET['from_dt'] !="") { echo $_GET['from_dt']; } else { echo $cr_dt; } ?>" required>
						</div>
						</div>

						<div class="col-md-6 col-sm-6 col-lg-3 responsive-air2">
						<div class="form-group">
							<h5>To Date</h5>
							<input type="date" class="form-control" name="to_dt" id="to_dt" value="<?php if($_GET['to_dt']!="") {	echo $_GET['to_dt']; } else { echo $cr_dt; } ?>"required>
						</div>
						</div>
                        <div class="col-md-6 col-sm-6 col-lg-3 responsive-air1">
						<div class="form-group">
							<h5 style="padding-left: 1px;">Customer Name</h5>	
                 <?php      if($_SESSION['executive_login'] == '') { ?>
							<select class="form-control select2" name="company_name" id="company_name" required>
                    			<option value="">Select Customer Name</option>
					<?php 
						$select_company=$pdo_conn->prepare("SELECT * FROM customer_profile WHERE delete_status != '1'");
						$select_company->execute();
						$selectcompany = $select_company->fetchAll();
						foreach($selectcompany as $value2){ ?>
								<option value="<?php echo $value2['customer_id'];?>" <?php if($value2['customer_id']==$_GET['customer_id']){ echo "selected"; } ?> ><?php echo $value2['company_name'] ?></option>
				<?php   } ?> </select>
<?php                      } else { ?>
							<select class="form-control select2" name="company_name" id="company_name">
                            	<option value="">Select Customer Name</option>
			<?php 						
				$asgn_cmpny =$pdo_conn->prepare("SELECT * FROM assign_company WHERE delete_status !='1' and executive ='".$_SESSION['executive_login']."'");
				$asgn_cmpny->execute();
				$asgncmpny = $asgn_cmpny->fetchAll();
				foreach($asgncmpny as $value2)	 
				{
					$select_company=$pdo_conn->prepare("SELECT * FROM customer_profile WHERE delete_status != '1' and customer_id ='$value2[company_name]'");
					$select_company->execute();
					$selectcompany = $select_company->fetchAll(); 
					foreach($selectcompany as $value2) { ?>
								<option value="<?php echo $value2['customer_id'];?>"  <?php if($value2['customer_id']==$_GET['customer_id']){ echo "selected"; } ?> ><?php echo $value2['company_name'] ?></option>
		<?php   	}
				} ?> 		</select> 
		<?php				}?>
						</div>
						</div>		
                        <div class="col-md-2 col-sm-6 col-lg-3" >
							<div class="form-group">
							<h5><br></h5>
							<input type="button" class="form-control btn btn-info" name="go" id="go" onClick="filter_regularvisit();" value="GO" required>
							</div>
						</div>
                    </div>
                </form>
            <?php 
			if($_GET['from_dt']!="" && $_GET['to_dt']!="" && $_GET['customer_id'] ==""){
				$from_dt = $_GET['from_dt'];
				$to_dt = $_GET['to_dt'];
			 	$query1 = "and date between'".$_GET['from_dt']."' and '".$_GET['to_dt']."'";
			} elseif($_GET['from_dt']!="" && $_GET['to_dt']!="" && $_GET['customer_id'] !=""){
				$from_dt = $_GET['from_dt'];
				$to_dt = $_GET['to_dt'];
			 	$query1 = "and date between'".$_GET['from_dt']."' and '".$_GET['to_dt']."' and company_id ='".$_GET['customer_id']."'";
			} else{
				$query1 ="and date between'".$cr_dt."' and '".$cr_dt."'";
				$from_dt = $cr_dt;
				$to_dt =$cr_dt;
			} ?>
                         <input type="hidden" class="form-control" name="from_dt1" id="from_date1"  value="<?php echo $from_dt; ?>" required>
                         <input type="hidden" class="form-control" name="to_dt1" id="to_date1"  value="<?php echo $to_dt; ?>" required>
            
				<table width="100%" style="text-align:center;" class="pointer">
				<tr class="" href="#" title="View" id="" data-toggle="modal" style="border: 1px solid #ccc;">
                    
                        <th style="width: 18%;">
                         <h5 class="box-title" style="">Visit Date</h5>
                         <!-- <div class="box-tools"> -->
                          </th>
                        <th style="width: 18%;">
                            <h5 class="box-title" style="">Customer Name</h5>
                            </th>
                        <th style="width: 18%;">
                            <h5 class="box-title" style="">Project</h5>
                            </th>
                             <th style="width: 18%;">
                            <h5 class="box-title" style="">Followups Status</h5>
                            </th>
                        
                      </tr>                         
				<div class="box-body p-0">
				  <div class="media-list media-list-hover media-list-divided">
<!-----------------------------------------regularvisit list -Admin--------------------------------------------------------------------------->                  
                 		<?php if($_SESSION['executive_login'] == '') { 
						
					$select_rgrl_lst=$pdo_conn->prepare("SELECT * FROM regular_visits WHERE delete_status !='1' $query1 ORDER BY regular_visit_id DESC");
					$select_rgrl_lst->execute();
					$rgr_lt =$select_rgrl_lst->fetchAll();
							foreach($rgr_lt as $rglur_lst) { ?>
							
							
<tr class="" href="#" title="View" id="regularvisit_view_model"onclick="regularvisit_view_modal(<?php echo $rglur_lst['regular_visit_id'] ?>)" data-toggle="modal" data-target="#regularvisit_view">					

                             
                              <td>
						<span class="box-title"><?php echo date("d-m-Y",strtotime($rglur_lst['date'])); ?></span>
                        </td>
							<?php $select_cmpny_nm=$pdo_conn->prepare("SELECT * FROM customer_profile WHERE delete_status = '0' and customer_id='".$rglur_lst['company_id']."'");
							$select_cmpny_nm->execute();
							$cmpny_nm =$select_cmpny_nm->fetchAll(); ?>
                             <td>
							<span class="box-title"><?php echo $cmpny_nm[0]['company_name']; ?></span>
                            </td>
                            <td>

                          <?php  
						  if($rglur_lst['project_name']){

						  $pr_cstmr = $pdo_conn->prepare("SELECT * FROM project_creation WHERE project_creation_id='".$rglur_lst['project_name']."' ");
								 $pr_cstmr->execute();
								 $pr1 = $pr_cstmr->fetchAll(); ?>
							<span class="box-title"><?php echo $pr1[0]['project_name']; ?></span>
                            <?php } else{ ?>
                            <span class="box-title"><?php echo "-";?></span>
                           <?php  } ?>
                            </td>
                             <td>

                            <?php
							  if($rglur_lst['project_position_id'] !=0){
                            $project_pos=$pdo_conn->prepare("SELECT * FROM project_position WHERE project_position_id ='".$rglur_lst['project_position_id']."'");
							$project_pos->execute();
							$followups =$project_pos->fetchAll();
						
							?>
							<span class="box-title"><?php echo $followups[0]['project_position']; ?></span>
                             <?php } else{ ?>
                            <span class="box-title"><?php echo "-";?></span>
                           <?php  } ?>
                            </td>
						</tr>
  <!-----------------------------------------regularvisit list -executive--------------------------------------------------------------------------->                                        
						<?php $i++; }}
						else 
						{ 
						
						//echo $_SESSION['executive_login'];
						//echo "SELECT * FROM assign_company WHERE delete_status !='1' and executive ='".$_SESSION['executive_login']."'";
						
						if($_GET['customer_id'] !=""){
							$asgn_cmpny =$pdo_conn->prepare("SELECT * FROM assign_company WHERE delete_status !='1' and executive ='".$_SESSION['executive_login']."' and company_name='".$_GET['customer_id']."'");
						    //echo "SELECT * FROM assign_company WHERE delete_status !='1' and executive ='".$_SESSION['executive_login']."' and company_name='".$_GET['customer_id']."'";
						}else{
							$asgn_cmpny =$pdo_conn->prepare("SELECT * FROM assign_company WHERE delete_status !='1' and executive ='".$_SESSION['executive_login']."'");
						    //echo "SELECT * FROM assign_company WHERE delete_status !='1' and executive ='".$_SESSION['executive_login']."'";
						}
						
						$asgn_cmpny->execute();
						$asgncmpny1 = $asgn_cmpny->fetchAll();
						foreach($asgncmpny1 as $value2) 
						{
							//echo "SELECT * FROM regular_visits WHERE project_name ='$value2[project_name]' $query1 and  company_id ='$value2[company_name]' and delete_status !='1' ORDER BY regular_visit_id DESC";
							$select_rgrl_lst=$pdo_conn->prepare("SELECT * FROM regular_visits WHERE project_name ='$value2[project_name]' $query1 and  company_id ='$value2[company_name]' and delete_status !='1' ORDER BY regular_visit_id DESC");
							$select_rgrl_lst->execute();
							$rgr_lt =$select_rgrl_lst->fetchAll();
						foreach($rgr_lt as $rglur_lst) { 
						
						
						
						?>
						<tr  href="#" title="View" id="regularvisit_view_model" onclick="regularvisit_view_modal(<?php echo $rglur_lst['regular_visit_id'] ?>)" data-toggle="modal" data-target="#regularvisit_view">
                        
						<td>
							<span class="box-title"><?php echo date("d-m-Y",strtotime($rglur_lst['date'])); ?></span></td>
							<?php $select_cmpny_nm=$pdo_conn->prepare("SELECT * FROM customer_profile WHERE delete_status = '0' and customer_id='".$rglur_lst['company_id']."'");
							$select_cmpny_nm->execute();
							$cmpny_nm =$select_cmpny_nm->fetchAll(); ?>
							<td>
							<span class="box-title"><?php echo $cmpny_nm[0]['company_name']; ?></span></td>
                            <td>

                          <?php   if($rglur_lst['project_name']){ 
						   $pr_cstmr = $pdo_conn->prepare("SELECT * FROM project_creation WHERE project_creation_id='".$rglur_lst['project_name']."' ");
								 $pr_cstmr->execute();
								 $pr1 = $pr_cstmr->fetchAll(); ?>
							<span class="box-title"><?php echo $pr1[0]['project_name']; ?></span>
                             <?php } else{ ?>
                            <span class="box-title"><?php echo "-";?></span>
                           <?php  } ?></td>
                            <td>

                            <?php
							 if($rglur_lst['project_position_id'] !=0){
                            $project_pos=$pdo_conn->prepare("SELECT * FROM project_position WHERE project_position_id ='".$rglur_lst['project_position_id']."'");
							$project_pos->execute();
							$followups =$project_pos->fetchAll();
						
							?>
							<span class="box-title"><?php echo $followups[0]['project_position']; ?></span>
                             <?php } else{ ?>
                            <span class="box-title"><?php echo "-";?></span>
                           <?php  } ?></td>                        
						</tr>
						<?php $i++; }} }?>

					
				  </div>
			   </div>
			   </table>
            </div>
          <!-- /.info-box -->
        </div>
        
                 <!------staff list -------------------->
              <div class="modal fade" id="staff_list">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                   <div class="modal-header">
                      <h3 class="modal-title">Staff List</h3>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                  <div class="modal-body">
                    	<div id="staff_list_view">
                        	
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                              <a href="" class="float-right btn btn-primary" data-dismiss="modal">Close</a>
                    </div>                    
                  </div>
                </div>
              </div> 
               <!------/staff list-------------------->
               <!------Attandance list -------------------->
              <div class="modal fade" id="attadance_view">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                   <div class="modal-header">
                      <h3 class="modal-title">Attadance List</h3>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                  <div class="modal-body">
                    	<div id="attadance_list_view">
                        	
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                              <a href="" class="float-right btn btn-primary" data-dismiss="modal">Close</a>
                    </div>                    
                  </div>
                </div>
              </div> 
               <div class="modal fade" id="regularvisit_view">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h3 class="modal-title">DailyVisits View</h3>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                    	<div id="regularvisit_view_modal_body">
                        	
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                              <a href="#" class="float-right btn btn-primary" data-dismiss="modal">Close</a>
                    </div>                    
                  </div>
                </div>
              </div>
                      
               <!------project list -------------------->
              <div class="modal fade" id="project_list">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                   <div class="modal-header">
                      <h3 class="modal-title">Project List</h3>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                  <div class="modal-body">
                    	<div id="project_list_view">
                        	
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                              <a href="" class="float-right btn btn-primary" data-dismiss="modal">Close</a>
                    </div>                    
                  </div>
                </div>
              </div> 
               <!------/project list-------------------->
               <input type="hidden" id="executive_login"  value="<?php echo $_SESSION['executive_login']; ?>">
            <!------view for executive -------------------->
              <div class="modal fade" id="executive_view">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                   <div class="modal-header">
                      <h3 class="modal-title">Payment Details</h3>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                  <div class="modal-body">
                    	<div id="executive_view_modal_body">
                        	
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                              <a href="" class="float-right btn btn-primary" data-dismiss="modal">Close</a>
                    </div>                    
                  </div>
                </div>
              </div> 
               <!------/view for executive -------------------->
               <!------view for executive  and Project-------------------->
              <div class="modal fade" id="executive_list">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                   <div class="modal-header">
                      <h3 class="modal-title">Executive List</h3>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                  <div class="modal-body">
                    	<div id="executive_list_modal_body">
                        	
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                              <a href="" class="float-right btn btn-primary" data-dismiss="modal">Close</a>
                    </div>                    
                  </div>
                </div>
              </div> 
               <!------/view for executive  and Project-------------------->
                 <!------/Customer-------------------->
                <div class="modal fade" id="customer_list">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                   <div class="modal-header">
                      <h3 class="modal-title">Customer List</h3>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                  <div class="modal-body">
                    	<div id="customer_list_view">
                        	
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                              <a href="" class="float-right btn btn-primary" data-dismiss="modal">Close</a>
                    </div>                    
                  </div>
                </div>
              </div> 
                <!------/Customer-------------------->
          <!-- /.info-box -->
         <div class="modal fade" id="customer_view">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                   <div class="modal-header">
                      <h3 class="modal-title">Customer & Project Details</h3>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                  <div class="modal-body">
                    	<div id="customer_view_modal_body">
                        	
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                              <a href="" class="float-right btn btn-primary" data-dismiss="modal">Close</a>
                    </div>                    
                  </div>
                </div>
              </div> 
       
      </div>
	</section>
<script>
function executive_view_modal(staffcreation_id) {
	var from_date = document.getElementById("from_date1").value;
	var to_date	  = document.getElementById("to_date1").value;
	var format ="from_date="+from_date+"&to_date="+to_date;
	
	 jQuery.ajax({
			type: "POST",
			url: "customerview.php?action=VIEW&"+format,
			data: "staffcreation_id="+staffcreation_id,
			success: function(msg){ 
			//alert(msg);
			$("#executive_view_modal_body").html(msg);
			}
		}); 
}
function customer_view_modal(customer_id)
{
	var executive_login =document.getElementById("executive_login").value;
	 jQuery.ajax({
			type: "POST",
			url: "customerview.php?action=CUSTOMER_VIEW",
			data: "customer_id="+customer_id+"&executive_login="+executive_login,
			success: function(msg){ 
			//alert(msg);
			$("#customer_view_modal_body").html(msg);
			}
		}); 
}
function filter() 
{
	var from_date =document.getElementById("from_date").value;
	//var to_date	  =document.getElementById("to_date").value;
<?php 
		if($mobileapp_login=="app")
		{ ?>
			var format ="from_date="+from_date+"&type="+'<?php echo $mobileapp_login; ?>'+"&usercreation_id="+'<?php echo $usercreationid; ?>'+"&usertype="+'<?php echo $user_type_id; ?>';
<?php 	} else { ?>
			var format ="from_date="+from_date;
<?php 	} ?>
		
	window.location.href = "index.php?&"+format;
}

function staff_list(){
	 jQuery.ajax({
			type: "POST",
			url: "customerview.php?action=STAFF_VIEW",
			success: function(msg){ 
			//alert(msg);
			$("#staff_list_view").html(msg);
			}
		}); 
}
function project_list(){
	var executive_login =document.getElementById("executive_login").value;
	//alert(executive_login);
	 jQuery.ajax({
			type: "POST",
			data:"executive_login="+executive_login,
			url: "customerview.php?action=PROJECT_VIEW",
			success: function(msg){ 
			//alert(msg);
			$("#project_list_view").html(msg);
			}
		}); 
}
function executive_list(){
	
	 jQuery.ajax({
			type: "POST",
			url: "customerview.php?action=EXECUTIVE_VIEW",
			success: function(msg){ 
			//alert(msg);
			$("#executive_list_modal_body").html(msg);
			}
		}); 
}
function search_customer()
{
	var customer1_name =document.getElementById("search_customer").value;
	var customer_id = customer1_name.trim();
<?php 
		if($mobileapp_login=="app")
		{ ?>
			var format ="customer_id="+customer_id+"&type="+'<?php echo $mobileapp_login; ?>'+"&usercreation_id="+'<?php echo $usercreationid; ?>'+"&usertype="+'<?php echo $user_type_id; ?>';
<?php 	} else { ?>
			var format ="customer_id="+customer_id;
<?php 	} ?>

	// window.location.href ="index.php?customer_id="+customer_id;
	window.location.href ="index.php?&"+format;
}
function customer_list()
{
	//alert();
	var executive_login =document.getElementById("executive_login").value;
	 jQuery.ajax({
			type: "POST",
			url: "customerview.php?action=CUSTOMER_LIST",
			data:"executive_login="+executive_login,
			success: function(msg){ 
			//alert(msg);
			$("#customer_list_view").html(msg);
			}
		}); 
	
}
function filter_regularvisit()
{
	var from_date =document.getElementById("from_dt").value;
	var to_date	  =document.getElementById("to_dt").value;
	//var customer1_name =document.getElementById("search_customer").value;
	//var customer_id = customer1_name.trim();
	var customer_id	  =document.getElementById("company_name").value;
<?php	
		if($mobileapp_login=="app")
		{ ?>
			var format ="from_date="+from_date+"&to_date="+to_date+"&customer_id="+customer_id+"&type="+'<?php echo $mobileapp_login; ?>'+"&usercreation_id="+'<?php echo $usercreationid; ?>'+"&usertype="+'<?php echo $user_type_id; ?>';
<?php 	} else { ?>
			var format ="from_date="+from_date+"&to_date="+to_date+"&customer_id="+customer_id;
<?php 	} ?>

	//window.location.href ="index.php?from_dt="+from_date+"&to_dt="+to_date+"&customer_id="+customer_id;
	window.location.href = "index.php?&"+format;
	//var format ="from_dt="+from_date+"&to_dt="+to_date+"&customr_id="+customer_id;
}
function regularvisit_view_modal(regularvisit_id){
	//alert(regularvisit_id)
	 jQuery.ajax({
			type: "POST",
			url: "regularvisits/regularvisits_view.php?action=REGULARVISIT_VIEW",
			data: "regularvisit_id="+regularvisit_id,
			success: function(msg){ 
			//alert(msg);
			$("#regularvisit_view_modal_body").html(msg);
			}
		});
}
function attendance_list()
{
	var month =document.getElementById("month").value;
<?php 
		if($mobileapp_login=="app")
		{ ?>
			var format ="month="+month+"&type="+'<?php echo $mobileapp_login; ?>'+"&usercreation_id="+'<?php echo $usercreationid; ?>'+"&usertype="+'<?php echo $user_type_id; ?>';
<?php 	} else { ?>
			var format ="month="+month;
<?php 	} ?>
	window.location.href = "index.php?&"+format;
}
function attendance_view_modal(staff_id)
{
	var from_month =document.getElementById("from_month1").value;
	var to_month	  =document.getElementById("to_month1").value;
jQuery.ajax({
			type: "POST",
			url: "customerview.php?action=ATTANDANCE_VIEW",
			data: "staff_id="+staff_id+"&from_month="+from_month+"&to_month="+to_month,
			success: function(msg){ 
			$("#attadance_list_view").html(msg);
			}
		}); 
}
function executive_excel(staff_id)
{
		var visit_date =document.getElementById("visit_date").value;

	window.location.href="regularvisits/regularvisits_excel_file.php?staff_id="+staff_id+"&visit_date="+visit_date;
	/*<!--jQuery.ajax({
			type: "POST",
			url: "regularvisits/regularvisits_view.php?action=REGULARVISIT_VIEW",
			data: "regularvisit_id="+regularvisit_id,
			success: function(msg){ 
			//alert(msg);
			$("#regularvisit_view_modal_body").html(msg);
			}
		});
	 window.open('data:application/vnd.ms-excel,' + $('#dvData').html());
    e.preventDefault();-->*/

}
function visit_list()
{
	var visit_date =document.getElementById("visit_date").value;
<?php 
		if($mobileapp_login=="app")
		{ ?>
			var format ="visit_date="+visit_date+"&type="+'<?php echo $mobileapp_login; ?>'+"&usercreation_id="+'<?php echo $usercreationid; ?>'+"&usertype="+'<?php echo $user_type_id; ?>';
<?php 	} else { ?>
			var format ="visit_date="+visit_date;
<?php 	} ?>
	window.location.href = "index.php?&"+format;
}

function executive_pdf(staff_id)
{
	var visit_date =document.getElementById("visit_date").value;
	window.open("regularvisits/regularvisits_pdf_file.php?staff_id="+staff_id+"&visit_date="+visit_date, '_blank');
	

}
</script>
<style>
h5 {
    line-height: 18px;
    font-size: 16px;
    color: #447c09;
    font-weight: 600;
}
input#go {
    font-weight: 500;
}
.info-box-text, .progress-description {
    display: block;
    font-size: 16px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-weight: 500;
}
.info-box-number {
    font-weight: 500;
    font-size: 21px;
}
.modal-header {
    border-bottom-color: #ef5350;
    color: #ef5350;
}
h3.modal-title {
    font-weight: 400;
}
table tr td {
    border: 1px solid #ccc;
	color: black;
	padding: 5px;
}
table tr {
    font-weight: 500;
}
td.style10.style4 {
    color: #447c09;
}
a#executive_view_modal {
    font-weight: 600;
}
.box-body.p-0 {
    font-weight: 600;
}
span.selection {
    font-weight: 600;
}
h4 {
    line-height: 22px;
    font-size: 18px;
    font-weight: 600;
}
.top_table {
    border: 1px solid #ccc;
}

.box-header.with-border.b1 {
    color: #455a64;
    display: block;
    padding: 0.8rem 1.25rem;
    position: relative;
    border-bottom: 1px solid #ccc;
}
table th {
    border: 1px solid #cccc;
}
th {
    font-weight: 600;
    color: #447c09;
	font-size: 15px;
}
tr.padding td {
    padding: 0px;
}
@media(min-width: 600px) and (max-width: 768px){
.col-md-1 {
    -ms-flex: 0 0 8.333333%;
    flex: 0 0 8.333333%;
    max-width: 36.333333%;
}
.col-md-3 {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 42%;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 28px;
    right: 10px;
}
span.select2-selection.select2-selection--single {
    width: 100%;
}
.responsive-air1 {
    padding-left: 0px;
} 
.responsive-air2 {
    padding-right: 0px;
}

.reponsive-air3{
	 padding-right: 0px;
	 padding-left: 0px;
}
h5.box-title {
    font-size: 14px;
}
.box-header.with-border {
    padding-left: 0px;
}
.info-box-text, .progress-description {
    font-size: 12px; 
}
}
span.select2.select2-container.select2-container--default.select2-container--focus {
    width: 100% !important;
}
{
width:100% !important;	
}
table {
    text-align: center;
}
table.pointer td {
    cursor: pointer;
}

</style>
