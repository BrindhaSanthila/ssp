function special_days_cu(special_id,action)
{
	
	 overall_variable=$("form").serialize();
		  array_variable01=overall_variable.split("&");
		  for(i=0;i<array_variable01.length;i++)
	      {
		
		    array_variable02=array_variable01[i];
		    array_variable02=array_variable02.split("=");
			//alert(array_variable02);
		    if(!array_variable02[1])
			{
				
				  $("button").prop("type", "submit");
				  return false;
			 }
			   
			   
		  }
		 $("button").prop("type", "button");
	   
		
		format=$("form").serialize()+"&special_id="+special_id+"&action="+action;
	$("#add").attr("disabled", "disabled");
		jQuery.ajax({
			type: "POST",
			url: "special_days/curd.php",
			data: format,
			success: function(msg){ 
				alert(msg);
			
			     if(msg=='error')
					{
						
						$("#distinct_error").text("Invalid Data");
						return false;
					}
					else
					{
						
						window.location.href="index.php?file=special_days/list";
					}
	
			}});
			}


function del(special_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "special_days/curd.php",
			data: "special_id="+special_id+"&action="+"Delete",
			success: function(msg){ 
			alert(msg);
			location.reload();
			}});
	}

}
function assign_religion(religion_id)
{
	
	  jQuery.ajax({
			type: "POST",
			url: "special_days/curd.php",
			data: "religion_id="+religion_id+"&action="+"Assigned_Executive",
			success: function(msg){ 
			
			$("#executive").html(msg);
			
			}});
	
	
}
