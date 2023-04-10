/****************************** INSERT & UPDATE ***************************************/
function userrole_cu(userroll_id,action)
{		
		var checkboxes = $('.checkbox');
		var checkboxesChecked = [];
  
  		for(var i=0; i<checkboxes.length; i++) 
		{
     		if(checkboxes[i].checked) 
			{
				var checkedid = checkboxes[i].id;				
		        checkboxesChecked.push($('#'+checkedid).attr('data-id'));
        	}
  		}
			
		format=$("form").serialize()+"&userroll_id="+userroll_id+"&checkboxesChecked="+checkboxesChecked+"&action="+action;
		
		jQuery.ajax({
			type: "POST",
			url: "userrights/curd.php",
			data: format,
			success: function(msg)
			{			
			        if(msg !='1')
					{
						console.log(msg);
						$("#distinct_error").text("Invalid Data");
						return false;
					}
					else
					{
						console.log(msg);
						window.location.href="index.php?file=userrights/list";						
					}
			
			}});
	
		
}
function dele(userroll_id)
{	
	value=confirm("Are Sure You Want Delete?");
	if(value)
	{
		jQuery.ajax({
		type: "POST",
		url: "userrights/curd.php",
		data: "userroll_id="+userroll_id+"&action="+"Delete",
		success: function(msg)
		{
			console.log(msg);
			location.reload();
		}
		});
	}

}

$(document).ready(function()
{
	$('.checkbox').on('click', function()
	{
		/*************ROOT-CHILD-SUBchild************************/
		/***Childs and parent be selected*******/
		var name = $(this).attr('name');
		if(!this.checked)
		{
			/***Sub Child be removed check child ****/
			$('.'+name).prop('checked', false);
			var checkname = $(this).attr('data-name');
			var checkedcount = $('.'+checkname).filter(':checked').length;
			if(checkedcount == '1'){
			/*****Make child unchecked*******/
			$('.'+checkname).prop('checked', false);
			}
			/****check Child count - parent remove******/
			var data = ($(this).parents('li').children('input[type=checkbox]'));
			var datacount = data.length;
			var data_count = parseInt(datacount)-1;	
			//console.log(data);		
			var checkedval = data[data_count].value;		
			var valcount = $('.'+checkedval).filter(':checked').length;			
			if(valcount == '1'){
			/*****Make root unchecked*******/
			$('.'+checkedval).prop('checked', false);
			}

		}
		else
		{
			$('.'+name).prop('checked', true);
			$(this).parents('li').children('input[type=checkbox]').prop('checked',true);			
		}	
	});

});

