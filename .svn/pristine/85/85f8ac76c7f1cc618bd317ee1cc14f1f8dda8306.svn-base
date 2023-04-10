/****************************** INSERT & UPDATE ***************************************/
function quarycreation_cu(quary_id,action)
{
/*	var img_name=document.getElementById("img_name").value;
	var img_name1=document.getElementById("img_name1").value;*/
	
	
	var action_type = "SUBMIT";
	
	if(action=="Add" || action=="Update" )
	{
			
          //  alert(file_data);	
			var form_data = new FormData();
			
			form_data.append("quary_name", $("#quary_name").val());
			form_data.append("remarks", $("#remarks").val());
			form_data.append("working_place", $("input[type='radio'][name='working_place']:checked").val());			
			form_data.append("active_status", $("#active_status").val());
			form_data.append("quary_id", quary_id);
			
		}

		if(action=="Update"){
			action_type = "UPDATE";
		}

	var quary_name = $("#quary_name").val();

	if(quary_name=='')
	{
		alert('Please enter Quary Name');
		$("#quary_name").focus();
	
	}	
else {
      $("#add").attr("disabled", "disabled");
		jQuery.ajax({
			type: "POST",
			url: "quary/curd.php?action="+action_type,
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			success: function(msg)
			{
				
				alert(msg);
				window.location="index.php?file=quary/list";
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






