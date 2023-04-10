<link rel="stylesheet" href="css/fontawesome.min.css">

<section class="content-header">
  <h1>
    <small>Manage</small>
		<?php echo ucfirst($foldername); ?><a href="index.php?file=customer/create" class="float-right btn-sm btn-primary">Add New</a>
  </h1>	  
</section>
    
<?php 
 

  $select_religion=$pdo_conn->prepare("SELECT * FROM religion where delete_status!='1' ");
  $select_religion->execute();
  $religion = $select_religion->fetchAll();

  $select_district=$pdo_conn->prepare("SELECT * FROM district where delete_status!='1' ");
  $select_district->execute();
  $district= $select_district->fetchAll();
?>
<!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-md-6 col-lg-3">
        <div class="form-group">
          <h5>District Name</h5>
          <select name="district_id" id="district_id"  class="form-control select2 item_name"  required>
          <option value="">All</option>
          <?php foreach($district as $value){?>
          <option value="<?php echo $value['district_id']?>" <?php if($value['district_id'] == $_GET['district_id']){ echo "selected"; }?>  ><?php echo $value['district_name']?>
            
          </option>
          <?php } ?>
        </select>
        </div>
      </div>
      

               <div class="col-md-6 col-lg-2">
      <div class="form-group">
        <h5>Religion Name</h5>

        <select name="religion_id" id="religion_id"  class="form-control select2 item_name"  required>
          <option value="">All</option>
          <?php foreach($religion as $value){?>
          <option value="<?php echo $value['religion_id']?>" <?php if($value['religion_id'] == $_GET['religion_id']){ echo "selected"; }?>  ><?php echo $value['religion_name']?>
            
          </option>
          <?php } ?>
        </select>
      </div>
         </div> 
          <div class="col-md-6 col-lg-2">
      <h5><br></h5>
      <div class="form-group">
        <input type="button" name="" id="" onclick="customer_report()" class="form-control btn-info" value="GO" >
        
      </div>
         </div>
         <?php

if($_GET['district_id']=="" && $_GET['religion_id']=="" )
{
  
 $select_customer_creation = $pdo_conn->prepare("SELECT * FROM customer_creation WHERE delete_status='0'  ORDER BY customer_id DESC");
  $select_customer_creation->execute();
  $customer_creation = $select_customer_creation->fetchAll();
           
}


 else if($_GET['district_id']!="" && $_GET['religion_id']=="" ){

    $query = "AND district_id='".$_GET['district_id']."' ";

 $select_customer_creation = $pdo_conn->prepare("SELECT * FROM customer_creation WHERE delete_status='0' $query ORDER BY customer_id DESC");
$select_customer_creation->execute();
$customer_creation = $select_customer_creation->fetchAll();
           
}
else if($_GET['district_id']=="" && $_GET['religion_id']!="" ){

    $query = "AND religion_id='".$_GET['religion_id']."' ";

 $select_customer_creation = $pdo_conn->prepare("SELECT * FROM customer_creation WHERE delete_status='0' $query ORDER BY customer_id DESC");
$select_customer_creation->execute();
$customer_creation = $select_customer_creation->fetchAll();
           
}
else 
{
  $query = "AND district_id='".$_GET['district_id']."' AND religion_id='".$_GET['religion_id']."' ";
  
 $select_customer_creation = $pdo_conn->prepare("SELECT * FROM customer_creation WHERE delete_status='0' $query ORDER BY customer_id DESC");
  $select_customer_creation->execute();
  $customer_creation = $select_customer_creation->fetchAll();
}


  $roll_id=1;

         ?>
      <div class="col-12">
   
        <div class="box">          
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
				
				  <table id="example" class="table table-bordered table-hover table-striped display nowrap margin-top-10 w-p100">
					<div class="pint_btn">
              <button onclick="print_list('customer/list_print.php')"><i class="fa fa-print" ></i>PRINT</button>
          </div>
          <thead>
						<tr class="bold">
							<th>#</th>
              <th>Coustomer Name</th>
              <th>Religion</th>
              <th>Mobile Number</th>
             <th>Status</th>
              <th>Action</th>
						</tr>
					</thead>
					<tbody>						
                       <?php foreach($customer_creation as $value){?>
					   
                          <tr>
							<td><?php echo $roll_id;?></td>
							
							<td><?php echo $value['customer_name'];?></td>
							<?php 
              $select_religion = $pdo_conn->prepare("SELECT * FROM religion WHERE religion_id='".$value['religion_id']."' ");
              $select_religion->execute();
              $religion = $select_religion->fetchAll();
              ?>
              <td><?php echo $religion[0]['religion_name'];?></td>
							<td><?php echo $value['mobile_no'];?></td>
							<td><?php if ($value['status']=='1'){ echo "Active";} else { echo "Inactive"; }?></td>
						<td>             
				
						  <a href="index.php?file=customer/update&customer_id=<?php echo $value['customer_id']?>" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  	
                          <a href="#" id="<?php echo $value['customer_id']?>" onclick="del(<?php echo $value['customer_id']?>)" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
						  

 <a href="#" title="View" id="customer_view_modal" onclick="customer_view_modal('customer/customer_view.php','<?php echo $value['customer_id'];?>')" data-toggle="modal" data-target="#customer_view"><i class="fa fa-eye" aria-hidden="true"></i></a>
              </td>
						</tr>
                        <?php $roll_id++;} ?>
						</tbody>				  
					</table>
				</div>  
                          
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
<div class="modal-body">
                      <div id="customer_view_modal_body">
                          
                        </div>
                    </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
	<!-- /.content -->
<script>
function del(customer_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "customer/curd.php",
			data: "customer_id="+customer_id+"&action="+"Delete",
			success: function(msg){ 
			alert(msg);
			window.location.href="index.php?file=customer/list";
			}});
	}

}
/*function customer_view_modal(customer_id){
	 jQuery.ajax({
			type: "POST",
			url: "customer/customer_view.php?action=CUSTOMER_VIEW",
			data: "customer_id="+customer_id,
			success: function(msg){ 
			//alert(msg);
			$("#customer_view_modal_body").html(msg);
			}
		});
}*/
/*function customer_view_modal(customer_id){
   jQuery.ajax({
      type: "POST",
      url: "customer/view.php?action=VIEW",
      data: "customer_id="+customer_id,
      success: function(msg){ 
      //alert(msg);
      $("#customer_view_modal_body").html(msg);
      }
    });
}*/

function customer_view_modal(url, customer_id)
{
	window.open(url+'?customer_id='+customer_id,'onmouseover','height=650,width=950,scrollbars=yes,resizable=no,left=250,top=250,toolbar=no,location=no,directories=no,status=no,menubar=no');	
}

function customer_print(url, customer_id)
{
	window.open(url+'?salesentry_id='+customer_id,'onmouseover','height=450,width=900,scrollbars=yes,resizable=no,left=200,top=150,toolbar=no,location=no,directories=no,status=no,menubar=no');
}


/////////////////////////////////PRINT///////////////////////////////////////////
function print_list(url) {

  var religion_id =document.getElementById("religion_id").value;
  var district_id =document.getElementById("district_id").value;
 
  window.open(url+'?district_id='+district_id+'&religion_id='+religion_id,'onmouseover','height=650,width=950,scrollbars=yes,resizable=no,left=250,top=400,toolbar=no,location=no,directories=no,status=no,menubar=no');
  
}

function customer_report(){
  var religion_id =document.getElementById("religion_id").value;
  var district_id =document.getElementById("district_id").value;
  //var staffcreation_id =document.getElementById("staffcreation_id").value;

  var format ="district_id="+district_id+"&religion_id="+religion_id;
  //var format ="from_date="+from_date+"&to_date="+to_date+"&staffcreation_id="+staffcreation_id;
window.location.href = "index.php?file=customer/list&"+format; 

}

</script>
<style>
.modal-content {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 106%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 0.3rem;
    outline: 0;
}
.tr-bg {
    color: #447c09;
    font-weight: 700;
}
tr.padng {
    color: #ef5350;
}
td.style3 {
    color: black;
	font-weight:600;
}
tr {
    color: black;
}
tr.bold th {
    font-weight: 600;
}
.modal-header {
    padding: 10px;
}
.pint_btn button {
    background: #dfcd50;
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
