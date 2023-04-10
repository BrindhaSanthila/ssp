<script language="javascript" type="text/javascript" src="userroll/userrole.js"></script>
<section class="content">
<div class="col">
	<div class="box">
		<!-- /.box-header -->
		<div class="box-body">
			<form class=""  name="userroll" autocomplete="off">
				<div class="row">
					<div class="col-md-6 ">
					<div class="form-group">
					<h5>Roll Name  </h5>
					<div class="controls">
					<input type="text" name="roll_name" id="roll_name" onkeyup="validation(this.id)" class="form-control" required>
					<div id="roll_name_error"></div>
					</div>
					</div>
					<div class="form-group">
					<h5>Active Status  </h5>
					<div class="controls">
					<select name="active_status" id="active_status" class="form-control" required>
					<option value="1">Active</option>
					<option value="0">Inactive</option>
					</select>
					</div>
					</div>
					</div>
				</div>
				<a href="index.php?file=userroll/list" class="float-left btn btn-primary">Cancel</a>
				<?php if($updateresult==''){?>
				<button type="buton" class="float-right btn btn-success" onclick="userrole_cu('','Add')">Save</button>
				<?php }else{?>
				<button type="button" class="float-right btn btn-success" onclick="userrole_cu('<?php echo $updateresult[0]['userroll_id'];?>','Update')">Update</button>
				<?php }?>
			</form>
		</div>
		<!-- /.box-body -->
		<div id="userrole_list"></div>
		<div id="distinct_error" style="color:red"></div>
	</div>
</div>
</section>
<?php if($updateresult!=''){?>
<script>
document.getElementById("roll_name").value ="<?php echo $updateresult[0]['roll_name'];?>";
document.getElementById("active_status").value ="<?php echo $updateresult[0]['active_status'];?>";
</script>
<?php } ?>


