    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		<small>Update</small>
		<?php echo ucfirst($foldername); ?>        
      </h1>
	  
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?file=employee/list"><i class="fa fa-home"></i> <?php echo ucfirst($foldername); ?> List</a></li>
        <li class="breadcrumb-item active">Update</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	 
     <?php
      $pdo_statement = $pdo_conn->prepare("SELECT * FROM employee_creation LEFT JOIN user_creation ON employee_creation.employee_id = user_creation.password where employee_creation.emp_id=".$_GET['emp_id']);
      $pdo_statement->execute();
      $updateresult = $pdo_statement->fetchAll();
	?>
     
	 <?php include 'form.php'; ?>
		
	</section>
	<!-- /.content -->
