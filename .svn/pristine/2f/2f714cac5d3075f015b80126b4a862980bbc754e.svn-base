/****************************** INSERT & UPDATE ***************************************/
function district_cu(district_id,action)
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
		 
		
		format=$("form").serialize()+"&district_id="+district_id+"&action="+action;
	
		jQuery.ajax({
			type: "POST",
			url: "district/curd.php",
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
						window.location.href="index.php?file=district/list";
					}
			
			}});
	
}


function del(district_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "district/curd.php",
			data: "district_id="+district_id+"&action="+"Delete",
			success: function(msg){ 
			alert(msg);
			location.reload();
			}});
	}

}