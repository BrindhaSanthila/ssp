/****************************** INSERT & UPDATE ***************************************/
function userrole_cu(userroll_id,action)
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
		 
	    //jQuery("#userrole_list").html('<img src="img/ajax-loaders/ajax-loader-5.gif"> Loading...');
		
		
		format=$("form").serialize()+"&userroll_id="+userroll_id+"&action="+action;
		
		jQuery.ajax({
			type: "POST",
			url: "userroll/curd.php",
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
						window.location.href="index.php?file=userroll/list";
					}
			
			}});
	
}

function del(userroll_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "userroll/curd.php",
			data: "userroll_id="+userroll_id+"&action="+"Delete",
			success: function(msg){ 
			alert(msg);
			location.reload();
			}});
	}

}

