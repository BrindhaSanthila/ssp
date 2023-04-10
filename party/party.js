/****************************** INSERT & UPDATE ***************************************/
function party_cu(party_id,action)
{
/*	var img_name=document.getElementById("img_name").value;
	var img_name1=document.getElementById("img_name1").value;*/
	
	// var staff_creation_id =staff_id;
	
	var action_type = "SUBMIT";
	
	if(action=="Add" || action=="Update" )
	{
	
			
          //  alert(file_data);	
			var form_data = new FormData();
			
			form_data.append("party_name", $("#party_name").val());
			form_data.append("mobile_no", $("#mobile_no").val());
			form_data.append("address", $("#address").val());
			form_data.append("accounts_no", $("#accounts_no").val());
			form_data.append("partytype", $("#partytype").val());
			form_data.append("comp_name", $("#comp_name").val());
			form_data.append("person_name", $("#person_name").val());
			form_data.append("contact_mob_no", $("#contact_mob_no").val());
			form_data.append("gst_no", $("#gst_no").val());
			form_data.append("paymenttype", $("#paymenttype").val());
			form_data.append("credit_days", $("#credit_days").val());
			form_data.append("auto_sms", $("input[type='radio'][name='auto_sms']:checked").val());		
			form_data.append("active_status", $("#active_status").val());
			form_data.append("area_name", $("#area_name").val());
			form_data.append("city_name", $("#city_name").val());
			
		}

		if(action=="Update"){
			action_type = "UPDATE";
		}
var area_name = [];  
   	jQuery.each(jQuery('.area_name option:selected'), function() {
		area_name.push(jQuery(this).val()); 
    });
   
   var area_name=area_name.toString();
   var city_name = [];  
   	jQuery.each(jQuery('.city_name option:selected'), function() {
		city_name.push(jQuery(this).val()); 
    });
   
   var city_name=city_name.toString();
	var party_name = $("#party_name").val();
	var mobile_no = $("#mobile_no").val();
	var address = $("#address").val();
	var partytype = $("#partytype").val();
	var employee_mobile=$("input[type='radio'][name='employee_mobile']:checked").val();
	var employee_web=$("input[type='radio'][name='employee_web']:checked").val();

	if(party_name=='')
	{
		alert('Please enter Party Name');
		$("#party_name").focus();
	
	}
	else if (mobile_no=='')
	{
		alert('Please Enter the Mobile No');
		$("#mobile_no").focus();

	}
else if(address=='')
{
	alert('Please Enter the address');
	$("#address").focus();

}
else if(partytype=='')
{
	alert('Please select the Party Type');
	$("#designation").focus();
	
}
else {
      $("#add").attr("disabled", "disabled");
		jQuery.ajax({
			type: "POST",
			url: "party/curd.php?action="+action_type+"&party_id="+party_id,
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			success: function(msg)
			{
				
				alert(msg);
				window.location="index.php?file=party/list";
			}
		});
	}
}


function district_list(state_id){
	jQuery.ajax({
			type: "POST",
			url: "customer/curd.php",
			data: "state_id="+state_id+"&action="+"district_list",
			success: function(msg){ 
				$("#district_id").html(msg);
			}
	});
}

function city_list(){
	
	var st_id = document.getElementById("state_id").value;
	var dis_id = document.getElementById("district_id").value;
	
	jQuery.ajax({
			type: "POST",
			url: "customer/curd.php",
			data: "stat_id="+st_id+"&dis_id="+dis_id+"&action="+"city_list",
			success: function(msg){ 
				$("#city_id").html(msg);
			}
	});
}

function get_partytype_details(partytype_id){
	jQuery.ajax({
	type: "POST",
	url: "party/curd.phpaction="+get_partytype_details,
	data: "partytype_id="+partytype_id+"&action="+"get_partytype_details",
	success: function(msg){ 
		$("#get_partytype").html(msg);
	}
});
}




