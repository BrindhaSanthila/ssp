<?php
error_reporting(0);
include("dbConnect.php");
include("commonfunction.php");
session_start();
session_id();

 $usercreationid = $_SESSION['user_id'];
$fullname = $_SESSION['employee_name'];
$userroll = $_SESSION['user_roll'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title>SSP Infra</title>
    
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="assets/vendor_components/bootstrap/dist/css/bootstrap.css">
	
	<!-- Bootstrap-extend -->
	<link rel="stylesheet" href="css/bootstrap-extend.css">
	
	<!-- Morris charts -->
	<link rel="stylesheet" href="assets/vendor_components/morris.js/morris.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    	
	<!-- weather weather -->
	<link rel="stylesheet" href="assets/vendor_components/weather-icons/weather-icons.css">
	
	<!-- date picker -->
	<link rel="stylesheet" href="assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">
	
	<!-- daterange picker -->
	<link rel="stylesheet" href="assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css">
    
    <!-- Select2 -->
	<link rel="stylesheet" href="assets/vendor_components/select2/dist/css/select2.min.css">
    
    <!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="assets/vendor_plugins/iCheck/all.css">
	
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">
	
	<!-- theme style -->
	<link rel="stylesheet" href="css/master_style.css">
	
	<!-- Lion_admin skins -->
	<link rel="stylesheet" href="css/skins/_all-skins.css">
	
	<!-- xeditable css -->
    <link href="assets/vendor_components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
	
	<!-- font-awesome css -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	
	<!--<link href="//code.ionicframework.com/nightly/css/ionic.css" rel="stylesheet"/> -->
	<link href="css/ionic.css" rel="stylesheet"/>
	<link href="css/bootstrap.min2.css" rel="stylesheet"/ >

	<!-- jQuery 3 -->
	<script src="assets/vendor_components/jquery/dist/jquery.js"></script>
	<script src="../js/chosen.jquery.js"></script>
	<script src="../js/chosen.jquery.min.js"></script>
	<script src="../js/canvasjs.min.js"></script>
	<script src="../js/loader.js"></script>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	 
	<script src="js/jquery-3.4.1.min.js"></script>
	
	<link href="../js/chosen.min.css" rel="stylesheet"/>
	
	<link rel="stylesheet" href="css/style2.css">
  </head>
  
  <body class="hold-transition skin-blue-light sidebar-mini">