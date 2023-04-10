/****************************** INSERT & UPDATE ***************************************/
function runningstatuscreation_cu(runningstatus_id,action)
{
/*	var img_name=document.getElementById("img_name").value;
	var img_name1=document.getElementById("img_name1").value;*/
	
	var action_type = "SUBMIT";
	
	if(action=="Add" || action=="Update" )
	{
			
          //  alert(file_data);	
			var form_data = new FormData();
			
			form_data.append("runningstatus_name", $("#runningstatus_name").val());
			form_data.append("openclose_req", $("input[type='radio'][name='openclose_req']:checked").val());
			form_data.append("workremarks_req", $("input[type='radio'][name='workremarks_req']:checked").val());			
			form_data.append("active_status", $("#active_status").val());
			form_data.append("runningstatus_id", runningstatus_id);
			
		}

		if(action=="Update"){
			action_type = "UPDATE";
		}

	var runningstatus_name = $("#runningstatus_name").val();
	var openclose_req=$("input[type='radio'][name='openclose_req']:checked").val();
	var workremarks_req=$("input[type='radio'][name='workremarks_req']:checked").val();

	if(runningstatus_name=='')
	{
		alert('Please enter Status Name');
		$("#runningstatus_name").focus();
	
	}
	else if (openclose_req=='')
	{
		alert('Please select whether Opening & Closing is required ');
		$("#openclose_req").focus();

	}
else if(workremarks_req=='')
{
	alert('Please select whether work remarks is required');
	$("#workremarks_req").focus();

}
else {
      $("#add").attr("disabled", "disabled");
		jQuery.ajax({
			type: "POST",
			url: "runningstatus/curd.php?action="+action_type,
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			success: function(msg)
			{
				
				alert(msg);
				window.location="index.php?file=runningstatus/list";
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






