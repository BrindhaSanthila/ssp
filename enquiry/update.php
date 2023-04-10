    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		<small>Update</small>
		<?php echo ucfirst($foldername); ?>        
      </h1>
	  
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?file=enquiry/list"><i class="fa fa-home"></i> <?php echo ucfirst($foldername); ?> List</a></li>
        <li class="breadcrumb-item active">Update</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	 
     <?php
    //  echo "SELECT * FROM enquiry where enquiry_id='".$_GET['enquiry_id']."'";
      $pdo_statement1 = $pdo_conn->prepare("SELECT * FROM enquiry where enquiry_id='".$_GET['enquiry_id']."'");
      $pdo_statement1->execute();
      $updateresult1 = $pdo_statement1->fetch();
   
      $pdo_statement = $pdo_conn->prepare("SELECT * FROM enquiry_item where enquiry_id='".$_GET['enquiry_id']."'");
      $pdo_statement->execute();
      $updateresult = $pdo_statement->fetchAll();
 
$pdo_followups = $pdo_conn->prepare("SELECT * FROM  enquiry_followups where enquiry_id='".$_GET['enquiry_id']."' ");
      $pdo_followups->execute();
      $update_followup = $pdo_followups->fetch();

	  include 'form.php'; ?>
		
	</section>
	<!-- /.content -->
