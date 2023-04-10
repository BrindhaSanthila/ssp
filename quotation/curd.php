<?php
require_once('../inc/dbConnect.php');
require_once('../inc/commonfunction.php');
 require_once('../notification_insert.php'); 
/*if($_POST['action']=="Add")
{	
	$count = $_POST['count'];
	
	$cat='';$subcat='';$item='';$rate_id='';$rate=''; $qty=''; $amount='';
	
	
	$select_orders=$pdo_conn->prepare("SELECT * FROM orders WHERE enquiry_id = '".$_POST['enquiry_id']."'");
    $select_orders->execute();
	$orders = $select_orders->fetchAll();

	for($i = 1; $i<=$count; $i++)
	{
		$enquiry_id = $_POST['enquiry_id'];
		$cat = $_POST['cat'.$i];
		$subcat = $_POST['subcat'.$i];
		$item = $_POST['item'.$i];
		$rate_id = $_POST['rate_id'.$i];
		$rate = $_POST['rate'.$i];
		$qty = $_POST['qty'.$i];
		$amount = $_POST['amount'.$i];
		
		$sql = "INSERT INTO quotation (category_id, enquiry_id, subcategory_id, item_id, rate_id, rate, quantity, amount) VALUES (:category_id, :enquiry_id, :subcategory_id, :item_id, :rate_id, :rate, :quantity, :amount)";
		$pdo_item = $pdo_conn->prepare($sql);
		$result = $pdo_item->execute(array(':category_id'=>$cat, ':enquiry_id'=>$enquiry_id, ':subcategory_id'=>$subcat,':item_id'=>$item, ':rate_id'=>$rate_id, ':rate'=>$rate,':quantity'=>$qty, ':amount'=>$amount));	
	}
	
}*/

// if($_POST['action']=="Update")
// {
// 	$update_orders=$pdo_conn->prepare("SELECT * FROM quotation WHERE category_id LIKE '".$_POST['category_id']."' AND subcategory_id LIKE '".$_POST['subcategory_id']."' AND item_id LIKE '".$_POST['item_id']."' AND quotation_id!='".$_POST['quotation_id']."' ");
//     $update_orders->execute();
// 	$updateorders = $update_orders->fetchAll();

// 	for($i = 1; $i<=$count; $i++)
// 	{
// 		$cat = $_POST['cat'.$i];
// 		$subcat = $_POST['subcat'.$i];
// 		$item = $_POST['item'.$i];
// 		$qty = $_POST['qty'.$i];
// 		$rate = $_POST['rate'.$i];

		
// 			$pdo_update_orders=$pdo_conn->prepare("update quotation set 
// 			category_id='".$cat."',
// 			subcategory_id='".$subcat."',
// 			item_id='".$item."',
// 			quantity='".$qty."',
// 			rate='".$rate."',
// 			status='".$_POST['status']."' WHERE  quotation_id=".$_POST['quotation_id']);
// 			$result = $pdo_update_orders->execute();
		

// 	}

// }


/*else
{
	echo "error";
}
*/
 
	

if($_GET['action']=="cancel_quotation")
{ 
	$pdo_statement=$pdo_conn->prepare("UPDATE  quotation set  status='0',confirm_status='Canceled' where enquiry_id='".$_POST['enquiry_id']."' ");
	$result = $pdo_statement->execute();
	$pdo_statement=$pdo_conn->prepare("UPDATE  enquiry set  status='Cancelled' where enquiry_id='".$_POST['enquiry_id']."' ");
	$result = $pdo_statement->execute();
	$pdo_statement=$pdo_conn->prepare("UPDATE  enquiry_item set  status='0' where enquiry_id='".$_POST['enquiry_id']."' ");
	$result = $pdo_statement->execute();
	
	 $body=  $_POST['quotation_number']." Quotation   is Cancelled";
	////////// For Admin////////


	$admin = $pdo_conn->prepare("SELECT * FROM usercreation where  user_roll='1'");
    $admin->execute();
    $admin_token = $admin->fetchAll(); 
    
    foreach($admin_token as $token_id)
    {
      
		define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
	  	$token=$token_id['token_id'];  
		
		$image = 'https://santhila.co/royal_crm/images/logo.jpg';
		
		$notification = [
		'title' =>'Quotation Cancelled',
		'body' => $body,
		'icon' =>$image		
		];
		$extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

		$fcmNotification = [		
		'to'        => $token,
		'notification' => $notification,
		'data' => $extraNotificationData
		];

		$headers = [
		'Authorization: key=' . API_ACCESS_KEY,
		'Content-Type: application/json'
		];
		if($token!='')
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$fcmUrl);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
		 	$result = curl_exec($ch);
			curl_close($ch);
			notification($current_date,$token_id['usercreation_id'],'1',$token,$body,'Quotation Cancelled');
		}
		if ($result === FALSE) 
		{
	        die('FCM Send Error: ' . curl_error($ch));
	    }
	 
    }
	///////////////////////////////////////////////// Department wise Notification sending///////////
    	$sms_creation = $pdo_conn->prepare("SELECT  sms_type,mobile_no,message  FROM  sms WHERE sms_type='Sales Coordinator' ");
    	$sms_creation->execute();
    	$sms = $sms_creation->fetch(); 
    	$mobile_numbers = $sms['mobile_no'];
    	 
    	$mobile_numbers=explode(',',$mobile_numbers);
    	
    	foreach($mobile_numbers as $department_mobile)
    	{
        	$staffcreation = $pdo_conn->prepare("SELECT staff_name,staffcreation_id,staff_type,token_id FROM staffcreation  WHERE mobile_no='".$department_mobile."' and delete_status='0' ");
        	$staffcreation->execute();
        	$staff_list = $staffcreation->fetch();
    	 	$token= $staff_list['token_id'];
    		
    		$image = 'https://santhila.co/royal_crm/images/logo.jpg';
    		define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
    		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    		
    		$notification = [
    		'title' =>'Quotation Cancelled',
    		'body' => $body,
    		'icon' =>$image		
    		];
    		$extraNotificationData = ["message" => $notification,"moredata" =>'dd'];
    
    		$fcmNotification = [		
    		'to'        => $token,
    		'notification' => $notification,
    		'data' => $extraNotificationData
    		];
    
    		$headers = [
    		'Authorization: key=' . API_ACCESS_KEY,
    		'Content-Type: application/json'
    		];
    		if($token!='')
    		{
    			$ch = curl_init();
    			curl_setopt($ch, CURLOPT_URL,$fcmUrl);
    			curl_setopt($ch, CURLOPT_POST, true);
    			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
    		  	$result = curl_exec($ch);
    			curl_close($ch);
    			notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Quotation Cancelled');
            }
    	}
    	///////////////////////////////////////////////// Staff Notification sending///////////
    	echo "SELECT staff_name,staffcreation_id,staff_type,token_id FROM staffcreation  WHERE staffcreation_id='".$_POST['usercreation_id']."' and delete_status='0' ";
    	$staffcreation = $pdo_conn->prepare("SELECT staff_name,staffcreation_id,staff_type,token_id FROM staffcreation  WHERE staffcreation_id='".$_POST['usercreation_id']."' and delete_status='0' ");
    	$staffcreation->execute();
    	$staff_list = $staffcreation->fetch();
	 	$token= $staff_list['token_id'];
		
		$image = 'https://santhila.co/royal_crm/images/logo.jpg';
		define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
		
		$notification = [
		'title' =>'Quotation Cancelled',
		'body' => $body,
		'icon' =>$image		
		];
		$extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

		$fcmNotification = [		
		'to'        => $token,
		'notification' => $notification,
		'data' => $extraNotificationData
		];

		$headers = [
		'Authorization: key=' . API_ACCESS_KEY,
		'Content-Type: application/json'
		];
		if($token!='')
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$fcmUrl);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
		  	$result = curl_exec($ch);
			curl_close($ch);
			notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Quotation Cancelled');
        }
} 

if($_GET['action']=="approve_quotation")
{ 
    $count = $_POST['count'];
    $enquiry_id = $_POST['enquiry_id'];
    for($i = 1; $i<=$count; $i++)
	{ 
		$rate = $_POST['rate'.$i];
		$qty = $_POST['quantity'.$i];
		$amount = $_POST['amount'.$i];
		$quotation_id = $_POST['quotation_id'.$i];
		$gst_per = $_POST['gst_per'.$i];
		$pdo_statement=$pdo_conn->prepare("UPDATE  quotation set rate='".$rate."',quantity='".$qty."',gst_per='".$gst_per."',amount='".$amount."',status='1',confirm_status='Approved' where enquiry_id='".$_POST['enquiry_id']."' and quotation_id='".$quotation_id."'");
	    $result = $pdo_statement->execute();	
	}
	
	
	 
	 $body=  $_POST['quotation_number']." Quotation   is Approved";
	////////// For Admin////////


	$admin = $pdo_conn->prepare("SELECT * FROM usercreation where  user_roll='1'");
    $admin->execute();
    $admin_token = $admin->fetchAll(); 
    
    foreach($admin_token as $token_id)
    {
      
		define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
	  	$token=$token_id['token_id'];  
		
		$image = 'https://santhila.co/royal_crm/images/logo.jpg';
		
		$notification = [
		'title' =>'Quotation Approved',
		'body' => $body,
		'icon' =>$image		
		];
		$extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

		$fcmNotification = [		
		'to'        => $token,
		'notification' => $notification,
		'data' => $extraNotificationData
		];

		$headers = [
		'Authorization: key=' . API_ACCESS_KEY,
		'Content-Type: application/json'
		];
		if($token!='')
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$fcmUrl);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
		 	$result = curl_exec($ch);
			curl_close($ch);
			notification($current_date,$token_id['usercreation_id'],'1',$token,$body,'Quotation Approved');
		}
		if ($result === FALSE) 
		{
	        die('FCM Send Error: ' . curl_error($ch));
	    } 
    }
	///////////////////////////////////////////////// Department wise Notification sending///////////
    	$sms_creation = $pdo_conn->prepare("SELECT  sms_type,mobile_no,message  FROM  sms WHERE sms_type='Sales Coordinator' ");
    	$sms_creation->execute();
    	$sms = $sms_creation->fetch(); 
    	$mobile_numbers = $sms['mobile_no'];
    	 
    	$mobile_numbers=explode(',',$mobile_numbers);
    	
    	foreach($mobile_numbers as $department_mobile)
    	{
        	$staffcreation = $pdo_conn->prepare("SELECT staff_name,staffcreation_id,staff_type,token_id FROM staffcreation  WHERE mobile_no='".$department_mobile."' and delete_status='0' ");
        	$staffcreation->execute();
        	$staff_list = $staffcreation->fetch();
    	 	$token= $staff_list['token_id'];
    		
    		$image = 'https://santhila.co/royal_crm/images/logo.jpg';
    		define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
    		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    		
    		$notification = [
    		'title' =>'Quotation Approved',
    		'body' => $body,
    		'icon' =>$image		
    		];
    		$extraNotificationData = ["message" => $notification,"moredata" =>'dd'];
    
    		$fcmNotification = [		
    		'to'        => $token,
    		'notification' => $notification,
    		'data' => $extraNotificationData
    		];
    
    		$headers = [
    		'Authorization: key=' . API_ACCESS_KEY,
    		'Content-Type: application/json'
    		];
    		if($token!='')
    		{
    			$ch = curl_init();
    			curl_setopt($ch, CURLOPT_URL,$fcmUrl);
    			curl_setopt($ch, CURLOPT_POST, true);
    			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
    		  	$result = curl_exec($ch);
    			curl_close($ch);
    			notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Quotation Approved');
            }
    	}
    	///////////////////////////////////////////////// Staff Notification sending///////////
    //	echo "SELECT staff_name,staffcreation_id,staff_type,token_id FROM staffcreation  WHERE staffcreation_id='".$_POST['usercreation_id']."' and delete_status='0' ";
    	$staffcreation = $pdo_conn->prepare("SELECT staff_name,staffcreation_id,staff_type,token_id FROM staffcreation  WHERE staffcreation_id='".$_POST['usercreation_id']."' and delete_status='0' ");
    	$staffcreation->execute();
    	$staff_list = $staffcreation->fetch();
	 	$token= $staff_list['token_id'];
		
		$image = 'https://santhila.co/royal_crm/images/logo.jpg';
		define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
		
		$notification = [
		'title' =>'Quotation Approved',
		'body' => $body,
		'icon' =>$image		
		];
		$extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

		$fcmNotification = [		
		'to'        => $token,
		'notification' => $notification,
		'data' => $extraNotificationData
		];

		$headers = [
		'Authorization: key=' . API_ACCESS_KEY,
		'Content-Type: application/json'
		];
		if($token!='')
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$fcmUrl);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
		  	$result = curl_exec($ch);
			curl_close($ch);
			notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Quotation Approved');
        }
	$pdo_statement=$pdo_conn->prepare("UPDATE  quotation set  status='1',confirm_status='Approved' where enquiry_id='".$_POST['enquiry_id']."' ");
	$result = $pdo_statement->execute();
 	$pdo_statement=$pdo_conn->prepare("UPDATE enquiry SET status='Approved' WHERE enquiry_id='".$_POST['enquiry_id']."' ");
	$result = $pdo_statement->execute();
} 

