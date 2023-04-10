/*******	*********************** INSERT & UPDATE ***************************************/
function customer_cu(customer_id,action)
{


	
 var dd = document.getElementById("district_id").value;

format=$("form").serialize()+"&customer_id="+customer_id+"&action="+action;

 var customer_name=document.getElementById("customer_name").value;
 var mobile_no=document.getElementById("mobile_no").value;

		//alert(format);
if(customer_name=='')
 {
 	alert("Please Enter the Customer Name");
 	 document.getElementById("customer_name").focus();
	
 }
 else if(mobile_no=='')
 {
 
    	alert("Please Enter the  Mobile no");
 	 	 document.getElementById("mobile_no").focus();
	
 }
				
		else
{
    $("#add").attr("disabled", "disabled");

		jQuery.ajax({
			type: "POST",
			url: "customer/curd.php",
			data: format,
			success: function(msg)
			{ 

					alert(msg);
								
						window.location.href="index.php?file=customer/list";
							
			}
		});
	}
	
}

function del(customer_id)
{
	value=confirm("Are Sure You Want Delete?");
	if(value){
	  jQuery.ajax({
			type: "POST",
			url: "customer/curd.php",
			data: "customer_id="+customer_id+"&action="+"Delete",
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

function assign_religion(religion_id)
{
	
	  jQuery.ajax({
			type: "POST",
			url: "customer/curd.php",
			data: "religion_id="+religion_id+"&action="+"Assigned_Executive",
			success: function(msg){ 
			
			$("#executive").html(msg);
			
			}});
	
	
}



