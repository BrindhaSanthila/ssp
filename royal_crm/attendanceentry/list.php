 <script language="javascript" type="text/javascript" src="attendanceentry/attendanceentry.js">
 	
 	
 </script>
 <section class="content-header">
	  <h1>
        <small>Manage</small>
		Attendance Entry<!-- <a href="index.php?file=attendanceentry/create" class="float-right btn-sm btn-primary"></a> -->
      </h1>	  
    </section>

 
    
<script>
function print_google_map(url)
{
	//alert(url);
	 
	onmouseover= window.open(url,'onmouseover','height=600,width=1200,scrollbars=yes,resizable=no,left=50,top=50,toolbar=no,location=no,directories=no,status=no,menubar=no');
}

function atten_report_print(url)
{
    var from_date =document.getElementById("from_date").value;
    var to_date   =document.getElementById("to_date").value;
    var staffcreation_id =document.getElementById("staffcreation_id").value;
    var format ="?from_date="+from_date+"&to_date="+to_date+"&staffcreation_id="+staffcreation_id;

    onmouseover55= window.open(url+format,'','height=450,width=950,scrollbars=yes,left=320,top=120,toolbar=no,location=no,directories=no,status=no,menubar=no');
} 
</script>
<?php
$select_cust=$pdo_conn->prepare("SELECT * FROM staffcreation where delete_status!='1' ");
  $select_cust->execute();
  $cust = $select_cust->fetchAll();
$cr_dt=date("Y-m-d");
?>
    <!-- Main content -->
         <section class="content">
      <div class="row">
        <div class="col-md-6 col-lg-3">
        <div class="form-group">
          <h5>From Date</h5>
          <input type="date" class="form-control" name="from_date" id="from_date"  value="<?php if($_GET['from_date']!=""){ echo $_GET['from_date'];  } else{ echo date("Y-m-d"); } ?>" required>
        
        </div>
      </div> 
      <div class="col-md-6 col-lg-3">
        <div class="form-group">
          <h5>To Date</h5>
          <input type="date" class="form-control" name="to_date" id="to_date"  value="<?php if($_GET['from_date']!=""){  echo $_GET['to_date']; } else{ echo $cr_dt; } ?>" required>
        </div>
      </div>
      

               <div class="col-md-6 col-lg-2">
      <div class="form-group">
        <h5>Staff Name</h5>

        <select name="staffcreation_id" id="staffcreation_id"  class="form-control select2 item_name"  required>
          <option value="">All</option>
          <?php foreach($cust as $value){?>
          <option value="<?php echo $value['staffcreation_id']?>" <?php if($value['staffcreation_id'] == $_GET['staffcreation_id']){ echo "selected"; }?>  ><?php echo $value['staff_name']?>
            
          </option>
          <?php } ?>
        </select>
      </div>
         </div> 
         <div class="col-md-6 col-lg-2">
      <h5><br></h5>
      <div class="form-group">
        <input type="button" name="" id="" onclick="attendancee_report()" class="form-control btn-info" value="GO" >
        
      </div>
         </div>
        <div class="col-12">
         
          <div class="box">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" >
              <tr>
                  <td><a   onclick="javascript:atten_report_print('attendanceentry/atten_print.php')" style="float:right;margin-right:20px;"><img  align="right" src="images/report_print.png" width="35" height="35" border="0" title="PRINT"></a></td>
              </tr>
          </table>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
					
				  <table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">
				  	<!-- <div class="pint_btn">
			        <button onclick="print_list('attendanceentry/list_print.php')"><i class="fa fa-print" ></i>PRINT</button>
					</div> -->
          <?php 
$roll_id=1;
$query="";
if($_GET['from_date']=="" && $_GET['to_date']=="" && $_GET['staffcreation_id']=="" )
{
    $query = "AND entry_date='".$cr_dt."'";

    

}
else if($_GET['from_date']!="" && $_GET['to_date']!="" && $_GET['staffcreation_id']==""  ){

    $query = "AND entry_date between '".$_GET['from_date']."' AND '".$_GET['to_date']."'  ";
           
}
else{
      
        $query = "AND entry_date between '".$_GET['from_date']."' AND '".$_GET['to_date']."' AND staffcreation_id='".$_GET['staffcreation_id']."' ";
    }
// echo "SELECT * FROM attendance_entry  WHERE delete_status ='0' $query ORDER BY attendance_entry_id DESC";
           $select_attendance = $pdo_conn->prepare("SELECT * FROM attendance_entry  WHERE delete_status ='0' $query ORDER BY attendance_entry_id DESC");
            $select_attendance->execute();
            $result = $select_attendance->fetchAll();
            $roll_id=1;
        ?>

					<thead>
						<tr class="bold">
							<th>#</th>
							<th>Staff Name</th>
							<th>Attendance Type</th>
							<th>Entry Date</th>
							<th>Entry Time</th>
              <th>Attendance Image</th>
							<th>Location</th>
								<th>Description</th>
							<!-- <th>Action</th> -->
						</tr>
					</thead>
        
					<tbody>						
                        <?php foreach($result as $value){ 
                        	$staff_longitude=$value['staff_longitude'];
                        	$staff_latitude=$value['staff_latitude'];
							
						?>
                          <tr>
							<td><?php echo $roll_id;?></td>
							<?php
							$select_staff_name=$pdo_conn->prepare("SELECT * FROM staffcreation WHERE staffcreation_id='".$value['staffcreation_id']."' ");
							$select_staff_name->execute();
							$staff_name = $select_staff_name->fetchAll();
							?>
							
							
							<td><?php echo $staff_name[0]['staff_name'];?></td>
							<td><?php echo $value['attendance_type'];?></td>
							<td><?php echo date("d-m-Y",strtotime($value['entry_date']));?></td>
							<td><?php echo $value['entry_time'];?></td>
              <td><?php  if($value['attendance_images']!='') {?><a href="javascript:pdf_view('<?php echo $image_path."attendance_images/".$value[attendance_images]; ?>');" title="View Material" ><img  src="<?php echo $image_path."attendance_images/".$value['attendance_images']; ?>" style="height:60px; width:60px;"  ></a><?php } else {  ?><img  src="images/images.jpg"  style="height:60px; width:60px;"  > <?php } ?>
              </td>
               
              <td><?php if(($staff_longitude!='')&&($staff_latitude!='')) {?>
                  <div align="center">
                  <a onclick="print_google_map('attendanceentry/map.php?staff_latitude=<?php echo $staff_latitude; ?>&staff_longitude=<?php echo $staff_longitude; ?>');" target="new">
                  <img src="images/map.png" height="30" width="30">
                  </a></div><?php }?>
              </td>
              	<td><?php echo $value['attendance_desc'];?></td>
						
              <!-- <td> 						
						  <a href="index.php?file=attendanceentry/update&attendance_entry_id=<?php echo $value['attendance_entry_id']?>&update=1" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  	
              <a href="#" id="<?php echo $value['attendance_entry_id']?>" onclick="del(<?php echo $value['attendance_entry_id']?>)" title="Delete"><i    class="fa fa-trash" aria-hidden="true"></i></a>
						  </td> -->
						</tr>
              <?php $roll_id++;} ?>
					</tbody>				  
				</table>
				</div>              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
	<!-- /.content -->
<script>
function print_list(url) {
  window.open(url+'?','onmouseover','height=650,width=950,scrollbars=yes,resizable=no,left=250,top=400,toolbar=no,location=no,directories=no,status=no,menubar=no');
}

function attendancee_report(){
  var from_date =document.getElementById("from_date").value;
  var to_date   =document.getElementById("to_date").value;
  var staffcreation_id =document.getElementById("staffcreation_id").value;

  var format ="from_date="+from_date+"&to_date="+to_date+"&staffcreation_id="+staffcreation_id;
  //var format ="from_date="+from_date+"&to_date="+to_date+"&staffcreation_id="+staffcreation_id;
window.location.href = "index.php?file=attendanceentry/list&"+format; 

}
  
function pdf_view(url)
  {
  onmouseover55= window.open(url,'onmouseover55','height=450px,width=650px,scrollbars=yes,resizable=no,left=420,top=190,toolbar=no,location=no,directories=no,status=no,menubar=no');
  }
</script>



<style>
tr.bold th {
    font-weight: 600;
}
.pint_btn button {
    background: #447c09;
    color: white;
    padding: 8px;
    width: 80px;
    border: 0px;
    font-weight: 600;
    float: left;
}
.pint_btn i {
    padding-right: 10px;
    font-size: 17px;
} 
</style>