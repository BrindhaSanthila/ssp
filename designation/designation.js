/****************************** INSERT & UPDATE ***************************************/
function designationcreation_cu(designation_id,action)
{
/*	var img_name=document.getElementById("img_name").value;
	var img_name1=document.getElementById("img_name1").value;*/
	
	
	var action_type = "SUBMIT";
	
	if(action=="Add" || action=="Update" )
	{
          //  alert(file_data);	
			var form_data = new FormData();
			
			form_data.append("designation_name", $("#designation_name").val());
			form_data.append("reporting_to", $("#reporting_to").val());
			
		}

		if(action=="Update"){
			action_type = "UPDATE";
		}

	var designation_name = $("#designation_name").val();
	var reporting_to = $("#reporting_to").val();

	if(designation_name=='')
	{
		alert('Please enter Designation Name');
		$("#designation_name").focus();
	
	}
	else if (reporting_to=='')
	{
		alert('Please Enter the Reporting No');
		$("#reporting_to").focus();

	}

else {
      $("#add").attr("disabled", "disabled");
		jQuery.ajax({
			type: "POST",
			url: "designation/curd.php?action="+action_type+"&designation_id="+designation_id,
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			success: function(msg)
			{
				
				alert(msg);
				window.location="index.php?file=designation/list";
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






