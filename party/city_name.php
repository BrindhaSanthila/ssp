								
<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
error_reporting(0);?>
<div class="form-group">
									   <h5>City Name</h5>
									   <div class="controls">
										 <select class="form-control select2 city_name"  name="city_name" id="city_name" multiple><?php 
										 $select_city=$pdo_conn->prepare("SELECT * FROM city_creation where active_status='Active' and area_id in($_REQUEST[area_name])");
											$select_city->execute();
											$city_type = $select_city->fetchAll();?>
											<option>Select</option> 
											<?php foreach ($city_type as $value) {?>
												<option value="<?php echo $value['city_id'];?>"><?php echo $value['city_name'];?></option>
												
											<?php } ?></select>
										</div>
								</div>


