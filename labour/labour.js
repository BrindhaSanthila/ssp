/****************************** INSERT & UPDATE ***************************************/
function labourcreation_cu(labour_id,action)
{
/*	var img_name=document.getElementById("img_name").value;
	var img_name1=document.getElementById("img_name1").value;*/
	
	
	var action_type = "SUBMIT";
	
	
	
	if(action=="Add" || action=="Update" )
	{
			
          //  alert(file_data);	
			var form_data = new FormData();
			
			form_data.append("labour_name", $("#labour_name").val());
			form_data.append("mobile_no", $("#mobile_no").val());
			form_data.append("address", $("#address").val());
			form_data.append("labour_dob", $("#labour_dob").val());
			form_data.append("working_place", $("#working_place").val());
			form_data.append("crusher_place", $("#crusher_place").val());			
			form_data.append("active_status", $("#active_status").val());
			form_data.append("labour_id", labour_id);
			
		}

		if(action=="Update"){
			action_type = "UPDATE";
		}

	var labour_name = $("#labour_name").val();
	var mobile_no = $("#mobile_no").val();
	var address = $("#address").val();
	var working_place = $("#working_place").val();

	if(labour_name=='')
	{
		alert('Please enter Labour Name');
		$("#labour_name").focus();
	
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
else if(working_place=='')
{
	alert('Please select the Working Place');
	$("#working_place").focus();
	
}
else {
      $("#add").attr("disabled", "disabled");
		jQuery.ajax({
			type: "POST",
			url: "labour/curd.php?action="+action_type,
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			success: function(msg)
			{
				
				alert(msg);
				window.location="index.php?file=labour/list";
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






