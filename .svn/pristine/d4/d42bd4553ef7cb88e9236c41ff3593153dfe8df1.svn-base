<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <?php 
$select_customer=$pdo_conn->prepare("SELECT COUNT(customer_id) FROM customer_creation WHERE delete_status = '0' ");
$select_customer->execute();
$customer = $select_customer->fetch();
$cus_count = (int)$customer['COUNT(customer_id)'];

$select_staff=$pdo_conn->prepare("SELECT COUNT(staffcreation_id) FROM staffcreation WHERE delete_status = '0' ")
;
$select_staff->execute();
$staff = $select_staff->fetch();
$staff_count = (int)$staff['COUNT(staffcreation_id)'];	
?>

	<section class="content">
		<div class="row">
        <div class="col-xl-3 col-md-6 col-12">
         <a class="media media-single" href="#" title="View" id="customer_view_model" onclick="customer_list();" data-toggle="modal" data-target="#customer_list">
          <div class="info-box">
            <div class="info-box-content">
              <span class="info-box-number"><?php if($cus_count!= '') {echo (int)$cus_count;} else { echo "0";}?></span>
              <span class="info-box-text">Customers</span>
            </div>
            <!-- /.info-box-content -->
          </div></a>
          <!-- /.info-box -->
        </div>
        <div class="col-xl-3 col-md-6 col-12">
         <a class="media media-single" href="#" title="View" id="customer_view_model" onclick="staff_list();" data-toggle="modal" data-target="#customer_list">
          <div class="info-box">
            <div class="info-box-content">
              <span class="info-box-number"><?php if($staff_count!= '') {echo (int)$staff_count;} else { echo "0";}?></span>
              <span class="info-box-text">Staffs</span>
            </div>
            <!-- /.info-box-content -->
          </div></a>
          <!-- /.info-box -->
        </div>
    </div>
</section>


<style>

.info-box-content {
    padding: 10px 10px 10px 0;
    margin-left: 0px;
    text-align: center;
}
.info-box{
    box-shadow: 0px 1px 20px #eaeaea;
}

</style>
