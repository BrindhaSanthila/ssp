<?php
include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		<small>View</small>

		<?php
   error_reporting(0);
     echo ucfirst($foldername); ?>        
      </h1>
	  
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?file=order/list"><i class="fa fa-home"></i> <?php echo ucfirst($foldername); ?> List</a></li>
        <li class="breadcrumb-item active">View</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	 
	 <?php include 'form.php'; ?>
		
	</section>
	<!-- /.content -->
