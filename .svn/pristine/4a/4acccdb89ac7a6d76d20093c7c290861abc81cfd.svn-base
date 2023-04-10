/****************************** INSERT & UPDATE ***************************************/
function staffcreation_cu(staff_id,action)
{
/*	var img_name=document.getElementById("img_name").value;
	var img_name1=document.getElementById("img_name1").value;*/
	
	var staff_creation_id =staff_id;
	
	var action_type = "SUBMIT";
	
	if(action=="Add" || action=="Update" )
	{
			var file_data = jQuery("#staff_image").prop("files")[0];
			var file_data1 = jQuery("#staff_image1").prop("files")[0];
          //  alert(file_data);	
			var form_data = new FormData();
			
			form_data.append("staff_type", $("#staff_type").val());
			form_data.append("staff_name", $("#staff_name").val());
			form_data.append("staff_gender", $("#staff_gender").val());
			form_data.append("staff_comnict_adrs", $("#staff_comnict_adrs").val());
			form_data.append("staff_parmnt_adrs", $("#staff_parmnt_adrs").val());
			
			form_data.append("staff_id", $("#staff_id").val());
			form_data.append("staff_mbl_num", $("#staff_mbl_num").val());
			form_data.append("staff_licence_num", $("#staff_licence_num").val());
			form_data.append("staff_dob", $("#staff_dob").val());
			form_data.append("staff_doj", $("#staff_doj").val());
			
			form_data.append("staff_bld_grp", $("#staff_bld_grp").val());
			form_data.append("staff_old_esi", $("#staff_old_esi").val());
			form_data.append("staff_old_pf", $("#staff_old_pf").val());
			form_data.append("staff_nature_work", $("#staff_nature_work").val());
	
			
			form_data.append("staff_bank_ac", $("#staff_bank_ac").val());
			form_data.append("staff_id_proof", $("#staff_id_proof").val());
			form_data.append("staff_email", $("#staff_email").val());
			form_data.append("staff_adharnumber", $("#staff_adharnumber").val());
			form_data.append("state_id", $("#state_id").val());
			form_data.append("district_id", $("#district_id").val());
			form_data.append("city_id", $("#city_id").val());
			form_data.append("user_name", $("#user_name").val());
			form_data.append("password", $("#password").val());
			
			form_data.append("file", file_data);
			form_data.append("file1", file_data1);
			form_data.append("staff_creation_id", staff_creation_id);
			
			form_data.append("staff_designation", $("#staff_designation").val());
			/*form_data.append("img_name",$("#img_name").val());	
			form_data.append("img_name1",$("#img_name1").val());*/
		}

		if(action=="Update"){
			action_type = "UPDATE";
		}

	var staff_type = $("#staff_type").val();
	var staff_name = $("#staff_name").val();
	var staff_mbl_num = $("#staff_mbl_num").val();
	var user_name = $("#user_name").val();
	var password = $("#password").val();
	
	if(staff_type=='')
	{
		alert('Please Select the Staff Type');
		$("#staff_type").focus();
	
	}
	else if (staff_name=='')
	{
		alert('Please Enter the Staff Name');
		$("#staff_name").focus();

	}

else if(staff_mbl_num=='')
{
	alert('Please Enter the Mobile no');
		$("#staff_mbl_num").focus();

}
else if(user_name=='')
{
	alert('Please Enter the User Name');
		$("#user_name").focus();
	
}
else if(password=='')
{
	alert('Please Enter the Password');
		$("#password").focus();
	
}
else {
      $("#add").attr("disabled", "disabled");
		jQuery.ajax({
			type: "POST",
			url: "staff/curd.php?action="+action_type,
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			success: function(msg)
			{
				
				alert(msg);
				window.location="index.php?file=staff/list";
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






