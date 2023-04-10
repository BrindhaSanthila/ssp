/****************************** INSERT & UPDATE ***************************************/
function areacreation_cu(area_id,action)
{
/*	var img_name=document.getElementById("img_name").value;
	var img_name1=document.getElementById("img_name1").value;*/
	
	
	var action_type = "SUBMIT";
	
	if(action=="Add" || action=="Update" )
	{
			
          //  alert(file_data);	
			var form_data = new FormData();
			
			form_data.append("area_name", $("#area_name").val());
			form_data.append("under_area", $("input[type='radio'][name='under_area']:checked").val());
			form_data.append("under_area_id", $("#under_area_id").val());
			form_data.append("crusher_km", $("#crusher_km").val());
			form_data.append("limit_radius", $("#limit_radius").val());	
			form_data.append("active_status", $("#active_status").val());
			form_data.append("area_id", area_id);
			
		}

		if(action=="Update"){
			action_type = "UPDATE";
		}

	var area_name = $("#area_name").val();

	if(area_name=='')
	{
		alert('Please enter Area Name');
		$("#area_name").focus();
	
	}
else {
      $("#add").attr("disabled", "disabled");
		jQuery.ajax({
			type: "POST",
			url: "area/curd.php?action="+action_type,
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			success: function(msg)
			{
				
				alert(msg);
				window.location="index.php?file=area/list";
			}
		});
	}
}

function get_area_details(){
	var under_area=$("input[type='radio'][name='under_area']:checked").val();

	if(under_area=='Yes'){
		$("#get_area_details").css("display", "block")
	}else{
		$("#get_area_details").css("display", "none")
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






