
/****************************** INSERT & UPDATE ***************************************/
function materialcreation_cu(material_id,action)
{
/*	var img_name=document.getElementById("img_name").value;
	var img_name1=document.getElementById("img_name1").value;*/
	
	
	var action_type = "SUBMIT";
	
	if(action=="Add" || action=="Update" )
	{
			
          //  alert(file_data);	
			var form_data = new FormData();
			
			form_data.append("material_name", $("#material_name").val());
			form_data.append("unit", $("#unit").val());
			form_data.append("alt_unit", $("#alt_unit").val());
			form_data.append("production_from", $("#production_from").val());		
			form_data.append("active_status", $("#active_status").val());
			form_data.append("material_id", material_id);
			
		}

		if(action=="Update"){
			action_type = "UPDATE";
		}

	var material_name = $("#material_name").val();
	var unit = $("#unit").val();
		var alt_unit = $("#alt_unit").val();
	var production_from = $("#production_from").val();

	if(material_name=='')
	{
		alert('Please enter Material Name');
		$("#material_name").focus();
	
	}
	else if (unit=='')
	{
		alert('Please select the unit of Measurement');
		$("#unit").focus();

	}
else if(production_from=='')
{
	alert('Please Enter the material production from');
	$("#production_from").focus();

}
else if (alt_unit=='')
	{
		alert('Please select the unit of Measurement');
		$("#alt_unit").focus();

	}
	else if(unit==alt_unit)
{
	alert('Please select alternative units');
	$("#alt_unit").focus();

}
else {
      $("#add").attr("disabled", "disabled");
		jQuery.ajax({
			type: "POST",
			url: "material/curd.php?action="+action_type,
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			success: function(msg)
			{
				
				alert(msg);
				window.location="index.php?file=material/list";
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






