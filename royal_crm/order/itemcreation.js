// *******************   ON CHANGE CATEGORY **************************
function categoryChange(id) 
{
	$.ajax({
	type: "POST",
	url: "itemcreation/curd.php",
	data: { category_id:id, action:'categoryChange'},
	success: function(msg) 
	{
		alert(msg);
		$("#subcategory_id").html(msg);
	}
	});    
}




/****************************** INSERT & UPDATE ***************************************/
function item_cu(item_id,action)
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
	format=$("form").serialize()+"&item_id="+item_id+"&action="+action;
	
	jQuery.ajax({
		type: "POST",
		url: "enquiry/curd.php",
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
				window.location.href="index.php?file=enquiry/list";
			}
		
		}
	});	
}


function del(item_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "enquiry/curd.php",
			data: "item_id="+item_id+"&action="+"Delete",
			success: function(msg){ 
			alert(msg);
			location.reload();
			}});
	}
}