/****************************** INSERT & UPDATE ***************************************/
function vehiclecreation_cu(vehicle_id,action)
{
/*	var img_name=document.getElementById("img_name").value;
	var img_name1=document.getElementById("img_name1").value;*/
	
	
	var action_type = "SUBMIT";
	
	if(action=="Add" || action=="Update" )
	{
			
          //  alert(file_data);	
			var form_data = new FormData();
			
			form_data.append("vehicle_code", $("#vehicle_code").val());
			form_data.append("registration_no", $("#registration_no").val());
			form_data.append("equipmenttype", $("#equipmenttype").val());
			form_data.append("max_units", $("#max_units").val());
			form_data.append("max_tonnes", $("#max_tonnes").val());
			form_data.append("mileage_tolerance", $("#mileage_tolerance").val());	
			form_data.append("active_status", $("#active_status").val());
			form_data.append("vehicle_id", vehicle_id);
			
		}

		if(action=="Update"){
			action_type = "UPDATE";
		}

	var vehicle_code = $("#vehicle_code").val();
	var registration_no = $("#registration_no").val();
	var equipmenttype = $("#equipmenttype").val();

	if(vehicle_code=='')
	{
		alert('Please enter Vehicle Code');
		$("#vehicle_code").focus();
	
	}
	else if (registration_no=='')
	{
		alert('Please Enter the Registration No');
		$("#registration_no").focus();

	}
else if(equipmenttype=='')
{
	alert('Please select the Equipment Type');
	$("#equipmenttype").focus();

}
else {
      $("#add").attr("disabled", "disabled");
		jQuery.ajax({
			type: "POST",
			url: "vehicle/curd.php?action="+action_type,
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			success: function(msg)
			{
				
				alert(msg);
				window.location="index.php?file=vehicle/list";
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






