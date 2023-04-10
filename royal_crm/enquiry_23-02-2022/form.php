<style>
	.dt-buttons {
		display: none;
	}

	.dataTables_paginate {
		display: none;
	}

	.dataTables_info {
		display: none;
	}
</style>

<script language="javascript" type="text/javascript" src="enquiry/enquiry.js"></script>

 
<?php 

$update_user_id=$updateresult1['usercreation_id']."@@".$updateresult1['user_type_id'];
 //echo $updateresult1['usercreation_id']; 
     //echo $_GET["usercreation_id"];
    //echo $usercreation_id; 
 
if($_GET['enquiry_id']!='')

{   $status=$_GET["status"];
	$usercreation_id=$updateresult1['usercreation_id'];
	$user_type_id=$updateresult1['user_type_id'];
	  $random_no=$updateresult1['random_no'];
	  $random_sc=$updateresult1['random_sc'];

}
else
{	
 $random_no=rand(00000,99999);
 
 $random_sc = date('dmyhis');
 $date = date("Y-m-d");
}
?> 


<!-- Main content -->
<section class="content">

	<div class="col" style="padding: 0px;">
		<div class="box">
			<div class="box-body">
			<div id="form">
					<div class="row">
						<div class="col-md-12">
							<div class="col-lg-6">
								<div class="form-group">
									<div class="controls">
										<input type="hidden" id="enquiry_id"
											value="<?php echo $updateresult1['enquiry_id'];?>" class="form-control">
									</div>
								</div>
							</div>

						</div>





					<div class="col-md-12">
						<h3>Sub Form</h3><br>
					</div>

					<div class="col-md-12">
						<div id="ressublist_div">
							<?php include ("enquiry_subform.php"); ?>
						</div>
					</div>

								 
						 



					<!-- row ends -->

					<div class="col-md-12"><br><br>
						<a href="index.php?file=enquiry/list" class="float-left btn btn-primary">Cancel</a>
						<?php if($_GET['enquiry_id']==''){?>
						<button type="button" id="main_add" class="float-right btn btn-success"
							onclick="enquiry_cu('<?php echo $_GET['enquiry_id']?>','<?php echo $usercreation_id; ?>','<?php echo $user_type_id; ?>', '<?php echo $random_no; ?>', '<?php echo $random_sc ?>', 'Add')">Save</button>
						<?php }else{?>
						<button type="button" id="main_add" class="float-right btn btn-success"
							onclick="enquiry_cu('<?php echo $_GET['enquiry_id']?>','<?php echo  $usercreation_id ?>','<?php echo $user_type_id; ?>','<?php echo $random_no; ?>','<?php echo $random_sc ?>' ,'Update')">Update</button>

						<?php }?>
					</div>
			</div>
			</div>
		</div>
	</div>

	</div>

</section>
 