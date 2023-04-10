/****************************** INSERT & UPDATE ***************************************/
function usercreation_c(usercreation_id,action)
{
	overall_variable=$("form").serialize();
	array_variable01=overall_variable.split("&");
	for(i=0;i<array_variable01.length;i++)
	{
		array_variable02=array_variable01[i];
		array_variable02=array_variable02.split("=");			
		if(!array_variable02[1])
		{
			$("button").prop("type", "submit");
			return false;
		}
	}
	$("button").prop("type", "button");
	
	format=$("form").serialize()+"&usercreation_id="+usercreation_id+"&action="+action;
	jQuery.ajax({
	type: "POST",
	url: "usercreation/curd.php",
	data: format,
	success: function(msg)
	{
		if(msg=='error')
		{
			$("#distinct_error").text("Invalid Data");
			return false;
		}
		else
		{
			alert(msg);
			window.location.href="index.php?file=usercreation/list";
		}
	}});
	
}


function state_validate(action)
{
		alert("hiii");
		var state_name=$("#state").val();
		
		//jQuery("#item_name").html('<img src="img/ajax-loaders/ajax-loader-5.gif"> Loading...');
		jQuery.ajax({
			type: "POST",
			url: "usercreation/curd.php",
			data: "state_name="+state_name+"&action="+action,
			success: function(msg){
				//alert(msg); 
			  jQuery("#city").html(msg);
			}});
}

function del(usercreation_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value)
	{
		jQuery.ajax(
		{
			type: "POST",
			url: "usercreation/curd.php",
			data: "usercreation_id="+usercreation_id+"&action="+"Delete",
			success: function(msg)
			{ 
				alert(msg);
				location.reload();
			}
		});
	}

}


function district_list(state_id)
{	
	jQuery.ajax(
	{		
		type: "POST",
		url: "usercreation/curd.php",
		data: "state_id="+state_id+"&action="+"district_list",
		success: function(msg)
		{			
			$("#district").html(msg);
		}
	});
}



function city_list()
{	
	var st_id = document.getElementById("state").value;	
	var dis_id = document.getElementById("district").value;
	
	jQuery.ajax(
	{
		type: "POST",
		url: "customer/curd.php",
		data: "stat_id="+st_id+"&dis_id="+dis_id+"&action="+"city_list",
		success: function(msg)
		{ 
			$("#city").html(msg);
		}
	});
}