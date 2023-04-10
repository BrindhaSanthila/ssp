
<?php 
error_reporting(0);
include("../dbConnect.php"); 
include("../common_function.php"); 
 $usercreation_id = $_GET['usercreation_id'];
  $user_type_id = $_GET['user_type_id'];

$customer_id=1;
$enquiry_id=1; 
$quotation_number="3435";

?>



<div class="container-fluid" style="padding:0px;">
  <div class="row">
    <div class="col-xs-12 top_header">
      <div class="col-xs-10 top_left" style="padding-left:6px;">
        <h3>Enquiry Entry</h3> 
      </div>       
      <div class="col-xs-2 top_left ">
        <i class="fa fa-arrow-circle-left arrow_back" onClick="gotoPage('enquiry/list','<?php echo $usercreation_id?>','<?php echo $user_type_id?>')"></i>    
      </div> 
    </div>
  </div>
</div>
 <input type="hidden" id="usercreation_id" name="usercreation_id" value="<?php echo $usercreation_id;?>">
<input type="hidden" id="user_type_id" name="user_type_id" value="<?php echo $user_type_id;?>">
<input type="hidden" name="enquiry_id" id="enquiry_id" value="<?php echo $enquiry_id ?>">
<input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer_id; ?>">

<input type="hidden" name="quotation_number" id="quotation_number" value="<?php echo $quotation_number; ?>">

<div class="container">
            <div class="cover-page-content-dash" align="center" style="background-color:#fff;margin-bottom: 12px;">
 
	<div class="container list-fonts">
	   
	    <div class="form-group form_pad new-control">
	      <label   class="attn-font-clr-chnge size-change select-bx">Date</label>
	      <input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
	    </div>

	    
		

	  <div class="row"><div class="col-xs-12" >		
			<div class="cover-field">
				<h5 class="select-bx">File</h5>
				<div class="row" style="  margin-bottom: 10px;margin-top: 0px;background-color:#f9f9f9;padding: 10px 10px 10px 10px;border-bottom: 1px solid #e6e6e6;" id="pic_div">
					<div class="col-xs-5" style="padding:0px;">   <img src="<?php echo $image_path?>common_images/images.jpg" id='picture' name='picture' style="width: 100px; height: 100px;" >
				</div>
				<div class="col-xs-7" style="padding:0px;margin-top:20px;">
					<div class="col-xs-6"> <img id='but_takes' enctype="multipart/form-data" src="<?php echo $image_path;?>common_images/photo.png" style="width:45px;height:45px;"/> </div>
					<div class="col-xs-6"> <img id='but_selects' enctype="multipart/form-data" src="<?php echo $image_path;?>common_images/gallery.png" style="width:45px;height:45px;"/> </div>
				</div>
				</div>		
			</div>
		</div></div>	
			 
		 
     			<div class="form-group form_pad">
				<label for="email" class="attn-font-clr-chnge size-change">Status</label>
     			<input   class="form-control select2" id="status" name="status" value="Order Closed" readonly>
			        
  </div> 
		 
			<div class="form-group form_pad">
		  <label class="attn-font-clr-chnge size-change">Description</label>
		  <textarea class="form-control" id="description" name="description"> </textarea>
	    </div>
			 
		 

	    <div class="row">
		
		  <div class="col-xs-4">
		    <button type="submit" class="gool-btn" onclick="customer_satisfaction_add(date.value,status.value,description.value,'<?php echo $usercreation_id; ?>','<?php echo $user_type_id; ?>','<?php echo $enquiry_id; ?>','<?php $quotation_number ?>')"> Submit  </button>
	   	  </div>
	    <div class="col-xs-3"> </div>
		   <div class="col-xs-5">
		    <button type="submit" class="gool-btn" onClick="gotoPage('enquiry/list','<?php echo $usercreation_id?>','<?php echo $user_type_id?>')">Cancel</button>
		  </div>
	  	</div>
	</div>
</div>
</div>

<script type="text/javascript">
$(".select2").select2();

function customer_satisfaction_add(date,status,description,usercreation_id,user_type_id,enquiry_id,quotation_number)
{
var image=  window.localStorage.getItem("image_name");   
	var sendInfo = {
		date : date,
		status : status,
		description : description,
		usercreation_id : usercreation_id,
		user_type_id : user_type_id,
		enquiry_id:enquiry_id,
		quotation_number : quotation_number,
		image: image,
	};
	jQuery.ajax({
		type: "POST",
		url: FILE_PATH+'/customer_satisfaction/model.php?action=customer_satisfaction_add',
		data: sendInfo,
		timeout:60000,
		success: function(data) 
		{
			alert(data);
			window.localStorage.setItem("image_name",'');	
			$("#page_replace_div").load(FILE_PATH+'/customer_satisfaction/list.php?user_type_id='+user_type_id+"&usercreation_id="+usercreation_id);
		}
		});			

}


$('#but_takes').click(function(){      
  

  navigator.camera.getPicture(onSuccess, onFail, { quality: 20,
  destinationType: Camera.DestinationType.FILE_URL 
});});

function onSuccess(imageURI) 
{    
  //alert(imageURI);
  var image = document.getElementById('picture');
  image.src = imageURI  + '?' + Math.random();   
  var options = new FileUploadOptions();
  options.fileKey = "file";
  options.fileName = imageURI.substr(imageURI.lastIndexOf('/') + 1);
  options.mimeType = "image/jpeg";                
  var params = {};
  params.value1 = "test";
  params.value2 = "param";
  options.params = params;
  options.chunkedMode = false;
  var ft = new FileTransfer();
  ft.upload(imageURI,"<?php echo $image_path;?>customer_satisfaction/satisfaction_images.php", function(result)
  {
    //alert(result.response);
      var data=result.response;
    window.localStorage.setItem("image_name",data.trim());      
  }, 
  function(error)
  {
    alert('error : ' + JSON.stringify(error));
  }, options);
//  $("#pic_div_galary").html("<img src='<?php echo $image_path?>enquiry_images/'"+data+" id='picture' name='picture' style='width: 100px; height: 100px;' >")
}



function onFail(message) 
{
    alert('Failed because: ' + message);
}
</script>
<style>
.gool-btn {
    padding: 5px 20px !important;
    background-color: #f5e9e4;
    color: #000 !important;
    border: 2px solid #6f4130;
    font-size: 17px !important;
    text-decoration: unset !important;
    margin: 20px;
}
i.fa.fa-arrow-circle-left.arrow_back {
    float: right;
}
.gool-btn {
   
    margin: 10px !important;
}
.add_class
{
	display: block;
}
.remove_class
{
	display: none;
}
</style>
