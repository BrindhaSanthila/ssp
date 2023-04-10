<script language="javascript" type="text/javascript" src="userrights/userrights.js"></script>
<?php 
$roll_name=''; 
$active_status ='';
if($_GET['userroll_id'] !='')
{
$sql = "SELECT * FROM userroll where userroll_id=".$_GET['userroll_id'];
$pdo_statement = $pdo_conn->prepare($sql);
$pdo_statement->execute();
$updateresult = $pdo_statement->fetchAll();
$roll_name=$updateresult[0]['roll_name'];
}  
$sql = "SELECT * FROM userroll where active_status = '1' ";
$pdo_statement = $pdo_conn->prepare($sql);
$pdo_statement->execute();
$updateresult1 = $pdo_statement->fetchAll();
?> 

<section class="content">
	<div class="col">
		<div class="box">
			<!-- /.box-header -->
			<div class="box-body">
				<form class="was-validated"  name="userroll" autocomplete="off">
				<div class="row">
				<div class="col-md-6 ">
				<div class="form-group">
				<h5>Roll Name  </h5>
				<div class="controls">
				<select name="roll_name" id="roll_name" class="select2 form-control"  required>
				<option value="">Select Roll</option>
				<?php foreach($updateresult1 as $value3) 
				{ 
					if($value3['userroll_id'] == $_GET['userroll_id']) 
					{
					?>
						<option value="<?php echo $value3['userroll_id']?>" selected><?php echo $value3['roll_name'];?></option>
					<?php 
					}
					else
					{ ?> 
						<option value="<?php echo $value3['userroll_id'] ; ?>"><?php echo $value3['roll_name']; ?></option>										 						
					<?php 
					} 
				} ?>
				</select>
				<div id="roll_name_error"></div>
				</div>
				</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-12">
				<?php 
				include('formlist.php'); 
				?>
				</div>
				</div>
				<a href="index.php?file=userrights/list" class="float-left btn btn-primary">Cancel</a>
				<?php 
				if($updateresult=='')
				{?>
					<button type="button" class="float-right btn btn-success" onClick="userrole_cu('','Add')">Save</button>
				<?php 
				}
				else
				{?>
					<button type="button" class="float-right btn btn-success" onclick="userrole_cu('<?php echo $updateresult[0]['userroll_id'];?>','Update')">Update</button>
				<?php 
				}?>

				</form>
			</div>
			<div id="userrole_list"></div>
			<div id="distinct_error" style="color:red"></div>
		</div>
	</div>
</section>
<?php
function checkstatus($rollid, $formid)
{
	global $pdo_conn;
	$status = '0';	$data = '';
	$sql = "SELECT * FROM userformrights  WHERE delete_status != 1 AND roll_id = '".$rollid."' AND userform_id = '".$formid."' ";
	$prepare = $pdo_conn->prepare($sql);
	$exc = $prepare->execute();
	if($exc == TRUE)
	{
		$list = $prepare->fetchAll();
		$status = $list[0]['status'];
		if($status == '1')
		{
			$data = 'checked';
		}
	}
	return $data;
}

?>
