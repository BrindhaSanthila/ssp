/****************************** INSERT & UPDATE ***************************************/
function partytype_cu(partytype_id,action)
{
/*	var img_name=document.getElementById("img_name").value;
	var img_name1=document.getElementById("img_name1").value;*/
	
	var action_type = "SUBMIT";
	
	if(action=="Add" || action=="Update" )
	{
			var form_data = new FormData();
			
			form_data.append("partytype_name", $("#partytype_name").val());
			form_data.append("req_comp_name", $("input[type='radio'][name='req_comp_name']:checked").val());
			form_data.append("req_person_name", $("input[type='radio'][name='req_person_name']:checked").val());
			form_data.append("req_mobile_no", $("input[type='radio'][name='req_mobile_no']:checked").val());
			form_data.append("req_gst", $("input[type='radio'][name='req_gst']:checked").val());
			
		}

		if(action=="Update"){
			action_type = "UPDATE";
		}

	var partytype_name = $("#partytype_name").val();
	var req_comp_name=$("input[type='radio'][name='req_comp_name']:checked").val();
	var req_person_name=$("input[type='radio'][name='req_person_name']:checked").val();
	var req_mobile_no=$("input[type='radio'][name='req_mobile_no']:checked").val();
	var req_gst=$("input[type='radio'][name='req_gst']:checked").val();

	if(partytype_name=='')
	{
		alert('Please enter Party Type Name');
		$("#partytype_name").focus();
	
	}
	else if (req_comp_name=='' || req_comp_name==undefined)
	{
		alert('Please select whether the party type required company name');

	}
else if(req_person_name=='' || req_person_name==undefined)
{
	alert('Please select whether the party type required contact person name');

}
else if(req_mobile_no=='' || req_mobile_no==undefined)
{
	alert('Please select whether the party type required contact person mobile number');
	
}
else if(req_gst=='' || req_gst==undefined)
{
	alert('Please select whether the party type required GST No');
	
}
else {
      $("#add").attr("disabled", "disabled");
		jQuery.ajax({
			type: "POST",
			url: "partytype/curd.php?action="+action_type+"&partytype_id="+partytype_id,
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			success: function(msg)
			{
				
				alert(msg);
				window.location="index.php?file=partytype/list";
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






