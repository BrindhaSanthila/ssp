/****************************** INSERT & UPDATE ***************************************/

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
            alert(random_no);
                        alert(random_sc);

           // alert(msg);
            $('#main_sublist_div').load('enquiry/subform.php?random_no='+random_no+'&random_sc='+random_sc);
    	}
    });
}
 
function enquiry_cu(enquiry_id,usercreation_id,user_type_id,random_no, random_sc, action)
{ 
	
var staffcreation_id=$("#staffcreation_id").val();
	  
	    var staffcreation_id_split=staffcreation_id.split("@@");
	    var usercreation_id=staffcreation_id_split[0];
	    var user_type_id=staffcreation_id_split[1];
var days=$("#days").val()
	if($('#customer_id').val() == ''){
		alert("Please select a Customer Name");
		$('#customer_id').focus();
		return false;
	}
   if(usercreation_id=='')
{
    alert("Please Select Staff Name")
    	$('#staffcreation_id').focus();
		return false;
} 
if(days=='')
{
    alert("Please Enter the Date")
    	$('#days').focus();
		return false;
} 
	overall_variable=$("#form :input").serialize();

	
	
	$("button").prop("type", "button");		
	format=$("#form :input").serialize()+"&enquiry_id="+enquiry_id+"&usercreation_id="+usercreation_id+"&user_type_id="+user_type_id+"&random_no="+random_no+"&random_sc="+random_sc+"&action="+action;
	$("#main_add").attr("disabled", "disabled");
	jQuery.ajax({
		type: "POST",
		url: "enquiry/curd.php",
		data: format,
		success: function(msg)
		{
		   // console.log(msg);
		
			var trim_data=msg.trim();
			if(trim_data!='0')
	        {
	           	alert(msg);	 
	     //      	console.log(msg);
	        	//alert("successfully Created");
				window.location.href="index.php?file=enquiry/list";
		   	}
		   	else
		   	{
		   		alert("Please select atleast one item")
		   	}
			 
		}
	});	


}
function del(enquiry_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "enquiry/curd.php",
			data: "enquiry_id="+enquiry_id+"&action="+"Delete",
			success: function(msg){ 
			alert(msg);
			location.reload();
			}});
	}
}


function get_follow_up_date(days,id_name)
{
	var days_num = id_name.substr(4, 5);	
	var date1= new Date();
	var date2=date1.getDate();
	date1.setDate(parseInt(date2) + parseInt(days));
	var date3=date1.toLocaleDateString();
	var date4=date3.split("/");
	var year=date4[2];
	var month=date4[0];
	var date=date4[1];	
	// if(date<10)	{
	// 	date = "0"+date;
	// }
	//var months = month+"";
    //while (months.length < 2) { months="0"+months; }
	if(month.length<2)
	{
		month="0"+month;
	}
	if(date.length<2)
	{
		date="0"+date;
	}
if(days!='')
{
//  var next_date=date+'-'+month+'-'+year;

   var next_date=year+'-'+month+'-'+date;
  $("#next_date").val(next_date);


}	//document.getElementById("next_date").value=year+'-'+month+'-'+date;
}