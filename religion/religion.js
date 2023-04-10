/****************************** INSERT & UPDATE ***************************************/
function religion_cu(religion_id,action)
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
	    //jQuery("#state_list").html('<img src="img/ajax-loaders/ajax-loader-5.gif"> Loading...');
		
		format=$("form").serialize()+"&religion_id="+religion_id+"&action="+action;
		
		jQuery.ajax({
			type: "POST",
			url: "religion/curd.php",
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
						window.location.href="index.php?file=religion/list";
					}
			
			}});
	
}

function del(religion_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "religion/curd.php",
			data: "religion_id="+religion_id+"&action="+"Delete",
			success: function(msg){ 
			alert(msg);
			location.reload();
			}});
	}

}