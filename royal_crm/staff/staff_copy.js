/****************************** INSERT & UPDATE ***************************************/
function purchaseentry_cu(purchaseentry_id,action)
{
	
	jQuery("#purchaseentry_list").html('<img src="img/ajax-loaders/ajax-loader-5.gif"> Loading...');
		if(action=="Add")
		{
		   format=$("form[name='purchaseentry']").serialize()+"&purchaseentry_id="+purchaseentry_id+"&action="+action;
		}		
		var item_name=$("#item_name").val();
		var ledger_name=$("#ledger_name").val();
		jQuery.ajax({
			type: "POST",
			url: "purchaseentry/curd.php",
			data: format,
			success: function(msg){
				var obj = JSON.parse(msg);
				if(obj.error == 0){
					alert(obj.msg);
				}
				if(obj.error == ''){
				$(".purchaseentrylist tbody").html(obj.purchaselistdata);
				$("form[name='purchaseentry_payment'] #total").val(obj.total);
				$("form[name='purchaseentry_payment'] #subtotal").val(obj.subtotal);
				$("form[name='purchaseentry_payment'] #net").val(obj.net);
				//alert(obj.msg);
				}else{
					alert(obj.error);
				}
				if(purchaseentry_id != ''){
					$("form[name='purchaseentry'] button").attr('onclick','purchaseentry_cu("","Add")');
					$("form[name='purchaseentry'] button").text('Add');
				}
			//window.history.back(); 
			//window.location.href="index.php?file=purchaseentry/create&repeat=yes&ledger_name="+ledger_name;
			}});
	
}
/*******************************************Save & Update total entry***********************************************************/
function purchaseentry_su(purchaseentry_id,action)
{
		if(action=="Save")
		{
		   format=$("form[name='purchaseentry_payment']").serialize()+"&"+$("form[name='purchaseentry']").serialize()+"&purchaseentry_id="+purchaseentry_id+"&action="+action;
		}		
		jQuery.ajax({
			type: "POST",
			url: "purchaseentry/curd.php",
			data: format,
			success: function(msg){
				//var obj = JSON.parse(msg);
				//alert(obj.msg);
				window.location.href="index.php?file=state_creation/list";
			}});
				
}
/*******************************************document ready function***********************************************************/
$(document).ready(function(){	
/*$("#purchase_no").val("P1");

/*******************************************calculation for subtotal***********************************************************/
$("#discount").keyup(function() {
  var sub_total = $("#total").val() - $(this).val();
	$('#sub_total').val(sub_total);  
});

/*******************************************calculation for Net***************************************************************/
$("#tax").keyup(function() {
  var net_total = parseInt($("#sub_total").val()) + parseInt($(this).val());
	$('#net').val(net_total);  
});
/*******************************************Fix rate based on item name*******************************************/
$("#unit_id, #item_name").change(function(){
	var itembase_id = $("#item_name").val();
	var unit_id = $("#unit_id option:selected").html();
	if(itembase_id != '' && unit_id != '' ){
		jQuery.ajax({
				type: "POST",
				url: "purchaseentry/curd.php",
				data: "unit_id="+unit_id+"&itembase_id="+itembase_id+"&action=item_rate",
				success: function(msg){
					$('#rate').val(msg);				
				}
		});
	}
});
/*******************************************Display payment mode based on bill type*******************************************/
$(".paymentmode_view").hide();
	
$("#bill_type").change(function() {
	var value = $(this).val();
	bill_type_sh(value);
});
/*******************************************************On Edit check bill type*******************************************/
var bill_type = $("#bill_type").val();
bill_type_sh(bill_type);
/**************************************Function to show hide as common***********************************************/ 
function bill_type_sh(value){
	if(value == 1 || value != ''){
		$(".paymentmode_view").show();
	}else{
		$(".paymentmode_view").hide();
	}
}
/*********************************Display payment mode feilds based on payment mode option***********************************/
$(".paymentmode_type").hide();
	
$("#payment_mode").change(function() {
	var value = $(this).val();
	payment_mode_sh(value);
});
/*****************************************On Edit check payment mode*******************************************/
var payment_mode = $("#payment_mode").val();
payment_mode_sh(payment_mode);
/**************************************Function to show hide as common***********************************************/ 
function payment_mode_sh(value){
	if(value == 1 || value == ''){
		$(".paymentmode_type").hide();
	}else{
		$(".paymentmode_type").show();
	}
}

});

/*********************************************Purchase entry datatable list delete***************************************************************/
function purchaseentry_data_del(purchaseentry_id){
	var value = confirm('Are you sure want to delete?');
	if(value){
		jQuery.ajax({
			type: "POST",
			url: "purchaseentry/curd.php",
			data: $("form[name='purchaseentry']").serialize()+"&purchaseentry_id="+purchaseentry_id+"&action="+"SublistDelete",
			success: function(msg){
				var obj = JSON.parse(msg);
				if(obj.error == ''){
				$(".purchaseentrylist tbody").html(obj.purchaselistdata);
				$("form[name='purchaseentry_payment'] #total").val(obj.total);
				$("form[name='purchaseentry_payment'] #subtotal").val(obj.subtotal);
				$("form[name='purchaseentry_payment'] #net").val(obj.net);
				//alert(obj.msg);
				}else{
					alert(obj.error);
				}
				//$("#"+purchaseentry_id).closest('tr').remove();
			}});
	}
}

function purchaseentry_data_edit(purchaseentry_id){
	jQuery.ajax({
			type: "POST",
			url: "purchaseentry/curd.php",
			data: "purchaseentry_id="+purchaseentry_id+"&action="+"Sublistedit",
			success: function(msg){
				var obj = JSON.parse(msg);

				if(obj.error != 1){					
					$('#item_name').select2("val", [obj.itemname]);
					$('#quantity').val(obj.quantity);
					$('#unit_id').val(obj.units);
					$('#rate').val(obj.rate);
					$("form[name='purchaseentry'] button").attr('onclick','purchaseentry_cu("'+purchaseentry_id+'","Add")');
					$("form[name='purchaseentry'] button").text('Update');			
				}else{
					alert('Editing Failed');	
				}
			}});
}