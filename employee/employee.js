/****************************** INSERT & UPDATE ***************************************/
function employeecreation_cu(emp_id,action)
{
/*	var img_name=document.getElementById("img_name").value;
	var img_name1=document.getElementById("img_name1").value;*/
	
	var action_type = "SUBMIT";

	if(action=="Add" || action=="Update" )
	{
			var file_data = jQuery("#id_proof").prop("files")[0];
			
          //  alert(file_data);	
			var form_data = new FormData();
			
			form_data.append("employee_name", $("#employee_name").val());
			form_data.append("employee_id", $("#employee_id").val());
			form_data.append("mobile_no", $("#mobile_no").val());
			form_data.append("address", $("#address").val());
			form_data.append("designation", $("#designation").val());
			form_data.append("userroll", $("#userroll").val());
			form_data.append("employee_mobile", $("input[type='radio'][name='employee_mobile']:checked").val());
			form_data.append("employee_web", $("input[type='radio'][name='employee_web']:checked").val());			
			form_data.append("active_status", $("#active_status").val());
			form_data.append("file", file_data);
			form_data.append("emp_id", emp_id);
		}

		if(action=="Update"){
			action_type = "UPDATE";
		}

	var employee_name = $("#employee_name").val();
	var mobile_no = $("#mobile_no").val();
	var address = $("#address").val();
	var designation = $("#designation").val();
	var employee_mobile=$("input[type='radio'][name='employee_mobile']:checked").val();
	var employee_web=$("input[type='radio'][name='employee_web']:checked").val();
	var name_regex = /^[A-Za-z\s]+$/.test(employee_name);


	if(employee_name=='' || !name_regex)
	{
		alert('Please enter valid Employee Name');
		$("#employee_name").focus();
	
	}
	else if (mobile_no=='' || mobile_no.length!='10' || isNaN(mobile_no))
	{
		alert('Please Enter the valid Mobile No');
		$("#mobile_no").focus();

	}
else if(address=='')
{
	alert('Please Enter the address');
	$("#address").focus();

}
else if(designation=='')
{
	alert('Please select the designation');
	$("#designation").focus();
	
}
else if(employee_mobile=='' || employee_mobile==undefined)
{
	alert('Please select whether the employee required mobile access');
	
}
else if(employee_web=='' || employee_web==undefined)
{
	alert('Please select whether the employee required web access');
	
}
else {
      $("#add").attr("disabled", "disabled");
		jQuery.ajax({
			type: "POST",
			url: "employee/curd.php?action="+action_type,
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			success: function(msg)
			{
				
				alert(msg);
				window.location="index.php?file=employee/list";
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






