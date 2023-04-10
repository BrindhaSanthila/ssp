/****************************** INSERT & UPDATE ***************************************/
function sms(sms_id,action)
{

	   

  var format=$("form").serialize()+"&sms_id="+sms_id+"&action="+action;
 var sms_type = $("#sms_type").val();


if(sms_type==='')
 {
 	alert("Select the SMS Type");
 	 	$("#sms_type").focus();
		exit();
 }
 			
else
{
    $("#add").attr("disabled", "disabled");
				
		jQuery.ajax({
			type: "POST",
			url: "sms/curd.php",
			data: format,
			success: function(msg){ 
			
			          alert(msg);
						window.location.href="index.php?file=sms/list";
	
	}				
			
			});
	


}
}

function del(sms_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "sms/curd.php",
			data: "sms_id="+sms_id+"&action="+"Delete",
			success: function(msg){ 
			alert(msg);
			location.reload();
			}});
	}

}

