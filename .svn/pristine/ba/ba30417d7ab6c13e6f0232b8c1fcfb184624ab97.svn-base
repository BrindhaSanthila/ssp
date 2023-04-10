<style>
    .size {
        width: 335px;
        height: 35px;
          }
    .was-validated .form-control:valid, .form-control.is-valid{
        background-image: none;
        text-align: left;
    }
</style>

<?php 
  include('../inc/dbConnect.php');

if( isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
}
else
{
    $order_id= '';
}
  
  
  $enquiry_item=$pdo_conn->prepare("SELECT * FROM  enquiry_item  WHERE order_id='".$order_id."'");
  $enquiry_item->execute();
  $enquiry_item_record=$enquiry_item->fetch();  

  
 
  if($_GET['random_sc']!='')
  {
    $random_sc=$_GET['random_sc'];
  }

  if($_GET['random_no']!='')
  {
    $random_no=$_GET['random_no'];
//  require_once('../inc/dbConnect.php');
  }
  
 ?>

<input type="hidden" name="category_id" id="category_id" value="<?php echo $enquiry_item_record['category_id'] ?>">
<input type="hidden" name="subcategory_id" id="subcategory_id" value="<?php echo $enquiry_item_record['subcategory_id'] ?>">
 
<input type="hidden" name="order_id" id="order_id" value="<?php echo $order_id; ?>">
<input type="hidden" name="enquiry_image" id="enquiry_image" value="<?php echo $enquiry_item_record['enquiry_image']; ?>">
<input type="hidden" name="enquiry_image1" id="enquiry_image1" value="<?php echo $enquiry_item_record['enquiry_image1']; ?>">
<input type="hidden" name="enquiry_image2" id="enquiry_image2" value="<?php echo $enquiry_item_record['enquiry_image2']; ?>">
<input type="hidden" name="enquiry_image3" id="enquiry_image3" value="<?php echo $enquiry_item_record['enquiry_image3']; ?>">
 
<div class="row" >
    <div class="list" id="">
    
        <!-- <form id="form1" class="was-validated" name="sub-form" method="post"> -->
            <!-- <input type="hidden" id="curr_usr_id" name="curr_usr_id" value="<?php echo $_GET['customer_id']; ?>" /> -->
            

            <table class="table table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        <!-- <td align="left">S.No </td> -->
                        <td align="left">Item Name</td>
                        <td align="left">Quantity</td>
                        <td align="left">GST(%)</td>
                       <td align="left">Image1</td>
                       <td align="left">Image2</td>
                       <td align="left">Image3</td>
                       <td align="left">Image4</td>
                        <td>Action</td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <select name="item_id" id="item_id" class="form-control select2 item_name" onchange="itemChange(this.value)" required  style="width: 120px;">
                                <option value="">Select Item Name</option>
                    <?php 
		                $select_item1=$pdo_conn->prepare("SELECT item_id,item_name FROM itemcreation WHERE status='1'");
		                $select_item1->execute();
                        $selectitem1 = $select_item1->fetchAll();
                        
		                foreach($selectitem1 as $record1) { ?>
                            <option value="<?php echo $record1['item_id']; ?>"<?php if($enquiry_item_record['item_id']== $record1['item_id']){ echo "selected"; }  ?>><?php echo $record1['item_name']; ?></option>
                <?php   } ?>
                                
                            </select>
                        </td>
                       
                        <td>
                            <input type="number" class="form-control numeric" name="quantity" id="quantity"
                             placeholder="Quantity" value="<?php echo $enquiry_item_record['quantity']; ?>" style="width: 120px;" onkeyup="calc();">
                        </td>
                            <td>
                            <input type="number" class="form-control numeric" name="gst_per" id="gst_per"
                             placeholder="GST Percentage" value="<?php echo $enquiry_item_record['gst_per']; ?>" style="width: 120px;" >
                        </td>
                 

                       <td> 
							<input type="file" name="file" id="file"   class="form-control" onChange="loadFile(event)" >
							<?php if($enquiry_item_record['enquiry_image']!=''){ ?>
                             <img src="<?php echo $image_path."enquiry_images/".$enquiry_item_record['enquiry_image']; ?>" name="image_name" width="50" height="50" id="image_name"/>
                          <?php }else{?>
                          <img src='images/images.jpg' name="image_name" width="50" height="50" id="image_name" >
                          <?php }?> 
						</td>
							
							<td> 
										 <input type="file" name="file1" id="file1"    class="form-control" onChange="loadFile1(event)">
										 <?php if($enquiry_item_record['enquiry_image1']!=''){ ?>
                                     <img src="<?php echo $image_path."enquiry_images/".$enquiry_item_record['enquiry_image1']; ?>" name="image_name1" width="50" height="50" id="image_name1"/>
                                      <?php }else{?>
										 <img src="images/images.jpg" name="image_name1" width="50" height="50" id="image_name1"/>
										 <?php  } ?>
										 							 </td>
						<td>
										 <input type="file" name="file2" id="file2"   class="form-control" onChange="loadFile2(event)">
										 <?php if($enquiry_item_record['enquiry_image2']!=''){ ?>
                                     <img src="<?php echo $image_path."enquiry_images/".$enquiry_item_record['enquiry_image2']; ?>" name="image_name2" width="50" height="50" id="image_name2"/>
                                      <?php }else{?>
										 <img src="images/images.jpg" name="image_name2" width="50" height="50" id="image_name2"/>
										 <?php  } ?>
										 							 </td>
							<td> 
										 <input type="file" name="file3" id="file3"   class="form-control" onChange="loadFile3(event)">
										 <?php if($enquiry_item_record['enquiry_image3']!=''){ ?>
                                     <img src="<?php echo $image_path."enquiry_images/".$enquiry_item_record['enquiry_image3']; ?>" name="image_name3" width="50" height="50" id="image_name3"/>
                                      <?php }else{?>
										 <img src="images/images.jpg" name="image_name3" width="50" height="50" id="image_name3"/>
										 <?php  } ?>
										 							 </td>

                        <td align="center" colspan="2" style="background-color:#fff;">
                            <button class="btn btn-primary btn-sm green" id="add" onclick="sublist_add(item_id.value,category_id.value,subcategory_id.value,quantity.value,'<?php echo $random_no; ?>', '<?php echo $random_sc ?>',gst_per.value)">
                            <?php if($order_id==''): ?>
                                    Add
                            <?php else: ?>
                                    Update
                            <?php endif; ?>
                            </button>
                        </td>
                        
                        
                    </tr>
                </tbody>
            </table>
   
                                        
            <table class="table table-bordered table-striped" width="100%">
                <thead>
                    <tr>
                        <td>S.No</td>
                        <td>Item Name</td>
                        <td>Quantity</td>
                        <td>GST(%)</td>
                       <td align="left">Image1</td>
                       <td align="left">Image2</td>
                       <td align="left">Image3</td>
                       <td align="left">Image4</td>
                        <th>Action</th>
                    </tr>                </thead>


                    <?php 
                    $i=0;
                    //echo "SELECT * FROM enquiry_item WHERE status='1' AND random_no='".$random_no."' AND random_sc='".$random_sc."'";
                    
                     $itemchange = $pdo_conn->prepare("SELECT * FROM enquiry_item WHERE status='1' AND random_no='".$random_no."' AND random_sc='".$random_sc."' ORDER BY order_id DESC");
                     $itemchange->execute();
                     $item = $itemchange->fetchAll(); 
                    
                    foreach ($item as  $value) { 
                    	$image1=$value['enquiry_image'];
			$image2=$value['enquiry_image1'];
			$image3=$value['enquiry_image2'];
			$image4=$value['enquiry_image3']; ?>
                    <tr>
                        <td><?php echo $i=$i+1; ?></td>
                        <!-- <td><?php echo $value['item_id']; ?></td> -->
                        <td><?php 
                            $itemname = $pdo_conn->prepare("SELECT item_name FROM  itemcreation WHERE status='1' AND item_id='".$value['item_id']."'");
                            $itemname->execute();
                            $item_name = $itemname->fetch();
                            echo $item_name['item_name'];
                        ?></td>
                     
                        <td><?php echo $value['quantity']; ?></td>
                        <td><?php echo $value['gst_per']; ?></td>
                  
                       	<td><?php if($image1!=''){ ?><a href="javascript:pdf_view('<?php echo $image_path."enquiry_images/".$image1; ?>');" title="View Material" ><img  src="<?php echo $image_path."enquiry_images/".$value['enquiry_image']; ?>" style="height:60px; width:60px;"  ></a> <?php } else { ?><img   src="images/images.jpg" style="height:60px; width:60px;" > <?php } ?> </td>

			<td><?php if($image2!=''){ ?><a href="javascript:pdf_view('<?php echo $image_path."enquiry_images/".$image2; ?>');" title="View Material" ><img  src="<?php echo $image_path."enquiry_images/".$value['enquiry_image1']; ?>"  style="height:60px; width:60px;"  ></a> <?php } else { ?><img   src="images/images.jpg" style="height:60px; width:60px;" > <?php } ?> </td>

			<td><?php if($image3!=''){ ?><a href="javascript:pdf_view('<?php echo $image_path."enquiry_images/".$image3; ?>');" title="View Material" ><img  src="<?php echo $image_path."enquiry_images/".$value['enquiry_image2']; ?>" style="height:60px; width:60px;"  ></a><?php } else { ?><img   src="images/images.jpg" style="height:60px; width:60px;" > <?php } ?> </td>

			 
			<td><?php if($image4!=''){ ?><a href="javascript:pdf_view('<?php echo $image_path."enquiry_images/".$image4; ?>');" title="View Material" ><img  src="<?php echo $image_path."enquiry_images/".$value['enquiry_image3']; ?>"  style="height:60px; width:60px;"  ></a><?php } else { ?><img   src="images/images.jpg" style="height:60px; width:60px;" > <?php } ?> </td>
		

                        <td>
                        <a href="#
                        " onclick="edit_subform('<?php echo $value['order_id'] ?>', '<?php echo $random_no; ?>', '<?php echo $random_sc; ?>')" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>  	
                          <a href="#" onclick="delete_subform('<?php echo $value['order_id'] ?>', '<?php echo $random_no; ?>', '<?php echo $random_sc; ?>')"  title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                        </tr>
                    <?php } 
                    ?>
            </table>
        <!-- </form> -->
    </div>
</div>
 
<script>

function itemChange(id) 
{
	$.ajax({
	type: "POST",
	url: "enquiry/curd.php",
	data: { item_id:id, action:'itemChange'},
	success: function(msg) 
	{
        //alert(msg);
        var data_trim=msg.trim();
        var data_split =data_trim.split("@@");
		 
        var rate_id = data_split[1];
        var c_id = data_split[3];
        var sc_id = data_split[4];
	 
		$("#category_id").val(c_id);
		$("#subcategory_id").val(sc_id);
        console.log(rate_id + ' ' + c_id + ' ' + sc_id);
	}
	});    
}

function sublist_add(id,c_id,sc_id,quantity,random_no,random_sc,gst_per)
{
   
    if($('#item_id').val() == "") 
    {
        alert('please select item name');
        $("#item_id").focus();
        return false;
    }

    if($('#quantity').val() == "") 
    {
        alert("Please enter the quantity");
        return false;
    }
    if($('#order_id').val() == '')
    {
       var action="subformadd";
    }
    else
    {
        var action="subformupdate";
    }
   
    var file_data =  jQuery("#file").prop("files")[0]; 
    var file_data1= jQuery("#file1").prop("files")[0];
    var file_data2= jQuery("#file2").prop("files")[0];
    var file_data3 = jQuery("#file3").prop("files")[0];
     var enquiry_image=$("#enquiry_image").val();
    	 
    var enquiry_image1=$("#enquiry_image1").val();
     
    var enquiry_image2=$("#enquiry_image2").val();
    
    var enquiry_image3=$("#enquiry_image3").val();
    	var form_data = new FormData();
    		form_data.append("item_id", id);
			form_data.append("cat_id", c_id);
			form_data.append("sc_id", sc_id);
			form_data.append("random_no", random_no);
			form_data.append("random_sc", random_sc);
				form_data.append("quantity", quantity);
			form_data.append("file_data", file_data);
			form_data.append("file_data1", file_data1);
			form_data.append("file_data2", file_data2);
			form_data.append("file_data3", file_data3);
				form_data.append("enquiry_image", enquiry_image);
			form_data.append("enquiry_image1", enquiry_image1);
			form_data.append("enquiry_image2", enquiry_image2);
			form_data.append("enquiry_image3", enquiry_image3);
			form_data.append("gst_per", gst_per);
		 	form_data.append("action", action);
		 		form_data.append("order_id", $('#order_id').val());
    $("#add").attr("disabled", "disabled");
       jQuery.ajax({
        type: "POST",
         url: "enquiry/curd.php",
    	cache: false,
    	contentType: false,
    	processData: false,
    	data:form_data,
        success: function(msg) 
        {
            alert(msg);
            $('#sublist_div').load('enquiry/subform.php?random_no='+random_no+'&random_sc='+random_sc);
    	}
    });
}
 

function calc(){
    var rate = $('#rate').val();
    var quantity = $('#quantity').val();
    var amount = rate * quantity;
    $('#amount').val(amount);
}


function edit_subform(order_id,random_no,random_sc)
{
	$("#sublist_div").load("enquiry/subform.php?order_id="+order_id+"&random_no="+random_no+"&random_sc="+random_sc);
}

function delete_subform(order_id,random_no,random_sc)
{
    if(confirm("Confirm Deletion?"))
	{
		jQuery.ajax({
	    type: "POST",
	    url: "enquiry/curd.php",
	    data: "order_id="+order_id+"&action="+"subform_delete",
	    success: function(msg)
	    {
        alert(msg);
	    	$("#sublist_div").load("enquiry/subform.php?random_no="+random_no+"&random_sc="+random_sc);
	    }
	  });
	}
}

var loadFile = function(event)
{
	var output = document.getElementById('image_name');
 
	document.getElementById('image_name').style.display = 'block';
	var test = document.getElementById('image_name');
	output.src = URL.createObjectURL(event.target.files[0]);
};
var loadFile1 = function(event)
{
	var output = document.getElementById('image_name1');
	document.getElementById('image_name1').style.display = 'block';
	var test = document.getElementById('image_name1');
	output.src = URL.createObjectURL(event.target.files[0]);
};
var loadFile2 = function(event)
{
	var output = document.getElementById('image_name2');
	document.getElementById('image_name2').style.display = 'block';
	var test = document.getElementById('image_name2');
	output.src = URL.createObjectURL(event.target.files[0]);
};
var loadFile3 = function(event)
{
	var output = document.getElementById('image_name3');
	document.getElementById('image_name3').style.display = 'block';
	var test = document.getElementById('image_name3');
	output.src = URL.createObjectURL(event.target.files[0]);
};
	function pdf_view(url)
  {
  onmouseover55= window.open(url,'onmouseover55','height=450px,width=650px,scrollbars=yes,resizable=no,left=420,top=190,toolbar=no,location=no,directories=no,status=no,menubar=no');
  }
</script>


