    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		<small>Update</small>
		<?php echo 'Equipment Nature'; // ucfirst($foldername); ?>        
      </h1>
	  
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?file=equipmentnature/list"><i class="fa fa-home"></i> <?php echo 'Equipment Nature'; //ucfirst($foldername); ?> List</a></li>
        <li class="breadcrumb-item active">Update</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	 
     <?php
      $pdo_statement = $pdo_conn->prepare("SELECT * FROM equipmentnature_creation where equipmentnature_id=".$_GET['equipmentnature_id']);
      $pdo_statement->execute();
      $updateresult = $pdo_statement->fetchAll();
	?>
     
	 <?php include 'form.php'; ?>
		
	</section>
	<!-- /.content -->
