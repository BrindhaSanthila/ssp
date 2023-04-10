/****************************** INSERT & UPDATE ***************************************/
function city_cu(city_id,action)
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
		 format=$("form").serialize()+"&city_id="+city_id+"&action="+action;
		    jQuery.ajax({
			type: "POST",
			url: "city/curd.php",
			data: format,
			success: function(msg){ 
			
			        if(msg=='error')
					{
						
						$("#distinct_error").text("Invalid Data");
						return false;
					}
					else
					{
						alert(msg);
						window.location.href="index.php?file=city/list";
					}
			
			}});
	
}


function del(city_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "city/curd.php",
			data: "city_id="+city_id+"&action="+"Delete",
			success: function(msg){ 
			alert(msg);
			location.reload();
			}});
	}

}
function district_list(state_id){
	jQuery.ajax({
		
			type: "POST",
			url: "customer/curd.php",
			data: "state_id="+state_id+"&action="+"district_list",
			success: function(msg)
			{
				
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




