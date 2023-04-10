<script language="javascript" type="text/javascript" src="usercreation/usercreation.js"></script>
<!-- Main content -->
<section class="content">
<div class="col">
<div class="box">
<!-- /.box-header -->
<div class="box-body">
<?php
$state = $updateresult[0]['state'];
$district = $updateresult[0]['district'];		
$city = $updateresult[0]['city'];
?>       
<form class="was-validated" name="usercreation" action='' autocomplete="off">
    <div class="row">
		<div class="col-md-6 ">
			<div class="form-group">
				<h5>Full Name  </h5>
				<div class="controls">
				<input type="text" name="full_name" id="full_name" class="form-control"   required>
				<div id="full_name_error"></div>
				</div>
			</div>

			<div class="form-group">
				<h5>Address  </h5>
				<div class="controls">
				<textarea name="address" id="address" rows="3" class="form-control"  required></textarea>
				<div id="address_error"></div>
				</div>
			</div>

			<div class="form-group">
				<h5>State </h5>
				<?php
					$select_state=$pdo_conn->prepare("SELECT * FROM state where status='1'");
					$select_state->execute();
					$states = $select_state->fetchAll();
				?>				
				<div class="controls">				
				<select name="state" id="state"  class="form-control select2 item_name" onchange="district_list(state.value)" required>
				<option value="">Select Your State</option>
				<?php 
				foreach($states as $value)
				{
					if ($_GET['usercreation_id']=='')
					{ ?>
						<option value="<?php echo $value['state_id']?>"><?php echo $value['state_name']?></option>
					<?php 
					}
					else
					{
					?>
						<option value="<?php echo $value['state_id']?>" <?php if($updateresult[0]['state'] == $value['state_id']){ echo "selected";} ?>><?php echo $value['state_name'];?></option>
					<?php
					}?>
					<?php 
				}
				?>
				</select>
				</div>
			</div>

			<div class="form-group">
				<h5>District</h5>
				<div class="controls">
				<select class="form-control select2 item_name" name="district" id="district" onchange="city_list()" required>
				<?php 
				if ($_GET['usercreation_id']=='')
				{
				?>
					<option value="">Select Your District</option>
				<?php
				}
				else 
				{
					$district_by_state = $pdo_conn->prepare("SELECT * FROM district WHERE state_id = $state ORDER BY district_id ASC");
					$district_by_state->execute();
					$districtbystate = $district_by_state->fetchAll();
					foreach($districtbystate as $value)
					{?>
						<option value="<?php echo $value['district_id']?>" <?php if($updateresult[0]['district'] == $value['district_id']){ echo "selected";} ?>><?php echo $value['district_name'];?></option>
					<?php 
					} 
				} ?>
				</select>
				</div>
			</div>
			
			<div class="form-group">
				<h5>City</h5>				
				<div class="controls">
				<select class="form-control select2 item_name" name="city" id="city" required>
				<?php 
				if ($_GET['usercreation_id']=='')
				{  ?>
				<option value="">Select Your City</option>
				<?php } 
				else 
				{
					$city_by_district = $pdo_conn->prepare("SELECT * FROM city WHERE state_id = $state AND district_id = $district ORDER BY city_id ASC");
					$city_by_district->execute();
					$citybydistrict = $city_by_district->fetchAll();
					foreach($citybydistrict as $value)
					{?>
						<option value="<?php echo $value['city_id']?>" <?php if($updateresult[0]['city'] == $value['city_id']){ echo "selected";} ?>><?php echo $value['city_name'];?></option>
					<?php 
					} 
				}?>
				</select>
				</div>
			</div>
		</div>
                
		<div class="col-md-6 ">
			<div class="form-group">
				<h5>Mobile No </h5>
				<div class="controls">
					<input type="number" name="mobile_no" id="mobile_no" class="form-control"  required>
					<div id="mobile_no_error"></div>
				</div>
			</div>
		
			<div class="form-group">
				<h5>User Roll</h5>
				<div class="controls">
				<select name="user_roll" id="user_roll" required class="form-control select2 item_name">
				<option value="">Select Your Roll</option>
				<?php foreach($userrole as $value)
				{ 
				?>
					<option value="<?php echo $value['userroll_id']?>"><?php echo $value['roll_name']?></option>
				<?php 
				}
				?>
				</select>
				</div>
			</div> 

			<div class="form-group">
				<h5>User Name</h5>
				<div class="controls">
					<input type="text" name="user_name" id="user_name" class="form-control"   required>
				<div id="user_name_error"></div>
				</div>
			</div>


			<div class="form-group">
				<h5>Password </h5>
				<div class="controls">
					<input type="password"  name="password" id="password" class="form-control"  required>
				<div id="password_error"></div>
				</div>
			</div>

			<div class="form-group">
				<h5>Active Status </h5>
				<div class="controls">
					<select name="active_status" id="active_status" required class="form-control ">
						<option value="1">Active</option>
						<option value="2">Inactive</option>
					</select>
				</div>
			</div>

		</div>
	</div>
             
	<a href="index.php?file=usercreation/list" class="float-left btn btn-primary">Cancel</a>
	<?php if($updateresult==''){?>
	<button type="button" class="float-right btn btn-success" onclick="usercreation_c('','Add')">Save</button>
	<?php }else{?>
	<button type="button" class="float-right btn btn-success" onclick="usercreation_c('<?php echo $updateresult[0]['usercreation_id']?>','Update')">Update</button>
	<?php }?>
	</form>
</div>
<!-- /.box-body -->
<div id="usercreation_list"></div>
<div id="distinct_error" style="color:red"></div>
</div>
</div>	
</section>

<?php 
if($updateresult!='')
{?>
<script>
document.getElementById("full_name").value ="<?php echo $updateresult[0]['full_name'];?>";
document.getElementById("address").value ="<?php echo $updateresult[0]['address'];?>";
document.getElementById("city").value ="<?php echo $updateresult[0]['city'];?>";
document.getElementById("district").value ="<?php echo $updateresult[0]['district'];?>";
document.getElementById("state").value ="<?php echo $updateresult[0]['state'];?>";
document.getElementById("mobile_no").value ="<?php echo $updateresult[0]['mobile_no'];?>";
document.getElementById("user_roll").value ="<?php echo $updateresult[0]['user_roll'];?>";
document.getElementById("user_name").value ="<?php echo $updateresult[0]['user_name'];?>";
document.getElementById("password").value ="<?php echo $updateresult[0]['password'];?>";
document.getElementById("active_status").value ="<?php echo $updateresult[0]['active_status'];?>";
</script>
<?php 
}
?>


