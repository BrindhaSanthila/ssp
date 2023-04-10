    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		<small>Update</small>
		<?php echo ucfirst($foldername); ?>        
      </h1>
	  
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?file=itemcreation/list"><i class="fa fa-home"></i> <?php echo ucfirst($foldername); ?> List</a></li>
        <li class="breadcrumb-item active">Update</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	 
     <?php
    $pdo_statement = $pdo_conn->prepare("SELECT * FROM itemcreation where item_id=".$_GET['item_id']);
    $pdo_statement->execute();
    $updateresult = $pdo_statement->fetchAll();
     
    $pdo_statement1 = $pdo_conn->prepare("SELECT * FROM subcategory where subcategory_id=".$updateresult[0]['subcategory_id']);
      $pdo_statement1->execute();
      $updateresult1 = $pdo_statement1->fetchAll();
	?>
     
	 <?php include 'form.php'; ?>
		
	</section>
	<!-- /.content -->
