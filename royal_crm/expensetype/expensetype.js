/****************************** INSERT & UPDATE ***************************************/
function add_expense(expense_id,action)
{
	//alert(expense_id);
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
		
		format=$("form").serialize()+"&expense_id="+expense_id+"&action="+action;
		
		jQuery.ajax({
			type: "POST",
			url: "expensetype/curd.php",
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
						window.location.href="index.php?file=expensetype/list";
					}
			
			}});
	
}

function del(expense_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "expensetype/curd.php",
			data: "expense_id="+expense_id+"&action="+"Delete",
			success: function(msg){ 
			alert(msg);
			location.reload();
			}});
	}

}