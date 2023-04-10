    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		<small>Update</small>
		<?php echo ucfirst($foldername); ?>        
      </h1>
	  
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?file=category/list"><i class="fa fa-home"></i> <?php echo ucfirst($foldername); ?> List</a></li>
        <li class="breadcrumb-item active">Update</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	 
     <?php
      $pdo_statement = $pdo_conn->prepare("SELECT * FROM category where category_id=".$_GET['category_id']);
      $pdo_statement->execute();
      $updateresult = $pdo_statement->fetchAll();
	?>
     
	 <?php include 'form.php'; ?>
		
	</section>
	<!-- /.content -->
