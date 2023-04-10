/****************************** INSERT & UPDATE ***************************************/
function category_cu(category_id,action)
{
		
		format=$("form").serialize()+"&category_id="+category_id+"&action="+action;
		
		jQuery.ajax({
			type: "POST",
			url: "category/curd.php",
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
						window.location.href="index.php?file=category/list";
					}
			
			}});
	
}

function del(category_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "category/curd.php",
			data: "category_id="+category_id+"&action="+"Delete",
			success: function(msg){ 
			alert(msg);
			location.reload();
			}});
	}

}