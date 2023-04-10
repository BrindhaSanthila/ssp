/****************************** INSERT & UPDATE ***************************************/
function equipmenttypecreation_cu(equipmenttype_id,action)
{
/*	var img_name=document.getElementById("img_name").value;
	var img_name1=document.getElementById("img_name1").value;*/
	
	
	var action_type = "SUBMIT";
	
	if(action=="Add" || action=="Update" )
	{
			
          //  alert(file_data);	
			var form_data = new FormData();
			
			form_data.append("equipmenttype_name", $("#equipmenttype_name").val());
			form_data.append("equipment_load", $("input[type='radio'][name='equipment_load']:checked").val());
			form_data.append("mileage_km", $("#mileage_km").val());
			form_data.append("mileage_hr", $("#mileage_hr").val());
			form_data.append("reading_km", $("#reading_km").val());
			form_data.append("reading_hr", $("#reading_hr").val());
			form_data.append("equipmentnature", $("#equipmentnature").val());
			form_data.append("designation", $("#designation").val());
			form_data.append("employee_web", $("input[type='radio'][name='employee_web']:checked").val());			
			form_data.append("active_status", $("#active_status").val());
			form_data.append("equipmenttype_id", equipmenttype_id);
		}

		if(action=="Update"){
			action_type = "UPDATE";
		}

	var equipmenttype_name = $("#equipmenttype_name").val();
	var equipment_load=$("input[type='radio'][name='equipment_load']:checked").val();

	if(equipmenttype_name=='')
	{
		alert('Please enter Equipment Type Name');
		$("#equipmenttype_name").focus();
	
	}
	else if (equipment_load=='' || equipment_load==undefined)
	{
		alert('Please select whether the Equipment can carry load');
		$("#equipment_load").focus();

	}
else {
      $("#add").attr("disabled", "disabled");
		jQuery.ajax({
			type: "POST",
			url: "equipmenttype/curd.php?action="+action_type,
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			success: function(msg)
			{
				
				alert(msg);
				window.location="index.php?file=equipmenttype/list";
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






