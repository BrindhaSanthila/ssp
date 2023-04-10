<style>
ul.menuaccess li{
	list-style: none;
}
.sub_head {
	list-style-type: none;
}
.sub_head2 {
	list-style-type: none;
	padding-top: 5px;
}
.sub_head3 {
	font-weight: 400 !important;
}
.sub_heading {
	font-size: 17px;
	font-weight: bold;
	padding-top: 5px;
}
</style>
<?php
$rollid = ''; $check_status =''; $check_status1 =''; $check_status2 ='';
if(isset($_GET['userroll_id']))
{
	$rollid = $_GET['userroll_id'];
}
	
$sql = "SELECT * FROM userform WHERE delete_status != 1 AND sub_id = '0' ORDER BY userform_id ASC";
$prepare = $pdo_conn->prepare($sql);
$exc = $prepare->execute();
if($exc == TRUE)
{
	$list = $prepare->fetchAll();
	if(count($list) >0)
	{
		foreach($list as $value)
		{ 
			$val_id = $value['userform_id'];
			$val_short_name = $value['short_name'];
			$val_form_name	= $value['form_name'];
			if(!empty($rollid))
			{			
				$status = checkstatus($rollid, $val_id);	
			}
			?>
			<!---------Root---------------->
			<div class="container">
				<ul class="menuaccess">
					<li>
						<input type="checkbox" data-id="<?php echo $val_id; ?>" class="checkbox <?php echo $val_short_name;?>" name="<?php echo $val_short_name;?>" value="<?php echo $val_short_name;?>" id="<?php echo $val_short_name;?>" <?php echo $status;?> style="display: none;">
						<label for="<?php echo $val_short_name;?>" class="h5"><strong><?php echo $val_form_name;?></strong></label>
						<!--Root ends--> 
						<!--Child-->
						<ul class="row">
							<?php
							$sql = "SELECT * FROM userform WHERE delete_status != 1 AND sub_id ='".$value['userform_id']."' ORDER BY userform_id ASC";
							$prepare = $pdo_conn->prepare($sql);
							$exc = $prepare->execute();
							if($exc == TRUE)
							{
								$list = $prepare->fetchAll();
								if(count($list) >0)
								{
									foreach($list as $value1)
									{ 
										$val_1_id = $value1['userform_id'];
										$val_1_short_name = $value1['short_name'].'-'.$val_short_name;
										$val_1_form_name  = $value1['form_name'];
										if(!empty($rollid))
										{
											$check_status1 = checkstatus($rollid, $val_1_id);
										}
										?>
										<li class="col-sm-4">
											<input type="checkbox" data-id="<?php echo $val_1_id; ?>" data-name="<?php echo $val_1_short_name; ?>" class="checkbox <?php echo $val_short_name;?> <?php echo $val_1_short_name;?>" name="<?php echo $val_1_short_name;?>" value="<?php echo $val_1_short_name;?>" id="<?php echo $val_1_short_name;?>" <?php echo $check_status1;?> style="display: none;">
											<label class="sub_heading" for="<?php echo $val_1_short_name;?>"><strong><?php echo $val_1_form_name;?></strong></label>
											<!--Child Ends----------------------> 
											<!--Sub Child---------->
											<ul class="sub_head2">
												<?php
												$sql = "SELECT * FROM userform WHERE delete_status != 1 AND sub_id ='".$value1['userform_id']."' ORDER BY userform_id ASC";
												$prepare = $pdo_conn->prepare($sql);
												$exc = $prepare->execute();
												if($exc == TRUE)
												{
													$list = $prepare->fetchAll();
													if(count($list) >0)
													{
														foreach($list as $value2)
														{ 
															$val_2_id = $value2['userform_id'];
															$val_2_short_name = $value2['short_name'];
															$val_2_form_name  = $value2['form_name'];
															$val_1_shortname = $value1['short_name'];
															$val_1_shortname_class = $value1['short_name'].'-'.$val_short_name;
															if(!empty($rollid))
															{
																$check_status2 = checkstatus($rollid, $val_2_id);
															}
															?>
															<li>
															<input type="checkbox" data-id="<?php echo $val_2_id; ?>" data-name="<?php echo $val_1_shortname_class; ?>" class="checkbox <?php echo $val_short_name;?> <?php echo $val_1_shortname_class;?>" name="<?php echo $val_1_shortname.'-'.$val_2_short_name;?>" value="<?php echo $val_1_shortname.'-'.$value2['short_name'];?>" id="<?php echo $val_1_shortname.'-'.$val_2_short_name;?>" <?php echo $check_status2;?> style="display: none;">
															<label for="<?php echo $val_1_shortname.'-'.$val_2_short_name;?>" class="sub_head3"><?php echo $val_2_form_name;?></label>
															</li>
															<?php
														}
													}
												}
												?>
											</ul>
											<!--Sub Child Ends---------->
										</li>
										<?php
									}
								}
							}
							?>							
						</ul>
					</li>
				</ul>
			</div>
			<?php
		}
	}
}
?>

