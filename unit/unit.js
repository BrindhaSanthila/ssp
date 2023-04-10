/****************************** INSERT & UPDATE ***************************************/
function unitcreation_cu(unit_id,action)
{
/*	var img_name=document.getElementById("img_name").value;
	var img_name1=document.getElementById("img_name1").value;*/
	
	
	var action_type = "SUBMIT";
	
	if(action=="Add" || action=="Update" )
	{
          //  alert(file_data);	
			var form_data = new FormData();
			
			form_data.append("unit_name", $("#unit_name").val());
			form_data.append("remarks", $("#remarks").val());		
			form_data.append("active_status", $("#active_status").val());
			
		}

		if(action=="Update"){
			action_type = "UPDATE";
		}

	var unit_name = $("#unit_name").val();

	if(unit_name=='')
	{
		alert('Please enter Unit Name');
		$("#unit_name").focus();
	
	}
else {
      $("#add").attr("disabled", "disabled");
		jQuery.ajax({
			type: "POST",
			url: "unit/curd.php?action="+action_type+"&unit_id="+unit_id,
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			success: function(msg)
			{
				
				alert(msg);
				window.location="index.php?file=unit/list";
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





