    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		<small>Update</small>
		<?php echo ucfirst($foldername); ?>        
      </h1>
	  
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?file=customer/list"><i class="fa fa-home"></i> <?php echo ucfirst($foldername); ?> List</a></li>
        <li class="breadcrumb-item active">Update</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	  <?php
      $pdo_customer_profile = $pdo_conn->prepare("SELECT * FROM customer_creation where customer_id=".$_GET['customer_id']);
      $pdo_customer_profile->execute();
      $updateresult = $pdo_customer_profile->fetchAll();
	  
	?>
     
	 <?php include 'form.php'; ?>
		
	</section>
	<!-- /.content -->
