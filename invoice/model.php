<?php
require_once('../inc/dbConnect.php');
require_once('../notification_insert.php'); 
include('../inc/commonfunction.php');
 $current_date=date('Y-m-d'); 
	$pdo_order=$pdo_conn->prepare("update invoice set delivered_status='1' where invoice_no='".$_GET['invoice_no']."'");
	$result = $pdo_order->execute();

	if(!empty($result)) 
	{
		echo $msg = "Successfully Delivered";
	}


	$quantity = $pdo_conn->prepare("SELECT  sum(final_quantity) as quantity FROM  quotation WHERE enquiry_id='".$_GET['enquiry_id']."' ");
	$quantity->execute();
	$quantity_list = $quantity->fetch(); 
    $quantity_count=$quantity_list['quantity'];
	////////Geetting invoice
	
	//echo "SELECT  sum(final_quantity) as quantity FROM  invoice WHERE enquiry_id='".$_GET['enquiry_id']."'  and  delivered_status='1'";
	$invoice = $pdo_conn->prepare("SELECT  sum(final_quantity) as quantity FROM  invoice WHERE enquiry_id='".$_GET['enquiry_id']."'  and  delivered_status='1'");
	$invoice->execute();
	$invoice_list = $invoice->fetch(); 
    $invoice_count=$invoice_list['quantity'];
	
	if($quantity_count==$invoice_count)
	{
        $pdo_enquiry=$pdo_conn->prepare("update enquiry set status='Delivered' where enquiry_id='".$_GET['enquiry_id']."'");
        $result = $pdo_enquiry->execute();
        
        $pdo_order=$pdo_conn->prepare("update order_confirm set delivered_status='1' where enquiry_id='".$_GET['enquiry_id']."'");
        $result = $pdo_order->execute();
	}
	$sms_creation = $pdo_conn->prepare("SELECT  sms_type,mobile_no,message  FROM  sms WHERE sms_type='Sales Coordinator' ");
	$sms_creation->execute();
	$sms = $sms_creation->fetch(); 
	$admin_mobile = $sms['mobile_no'];
	  
	
                    
	/*	$url1="http://login.smsgatewayhub.com/api/mt/SendSMS?APIKey=ZQJHEb7q4EuPv16s5IOKWg&senderid=CARGEK&channel=2&DCS=0&flashsms=0&number=".$admin_mobile."&text=".$message_content."&route=1";
	 $ch2= curl_init();
	curl_setopt($ch2, CURLOPT_URL, str_replace(' ','%20',$url1));
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
	$data = curl_exec($ch2);
	curl_close($ch2);    */
 $body="Invoice ".$_GET['invoice_no']." is delivered";
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
		'title' =>'Invoice delivered',
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
			notification($current_date,$token_id['usercreation_id'],'1',$token,$body,'Invoice delivered');
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
    		'title' =>'Invoice delivered',
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
    			notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Invoice delivered');
            }
    	}
    	///////////////////////////////////////////////// Staff Notification sending///////////
    //	echo "SELECT staff_name,staffcreation_id,staff_type,token_id FROM staffcreation  WHERE staffcreation_id='".$_POST['staffcreation_id']."' and delete_status='0' ";
    	$staffcreation = $pdo_conn->prepare("SELECT staff_name,staffcreation_id,staff_type,token_id FROM staffcreation  WHERE staffcreation_id='".$_GET['staffcreation_id']."' and delete_status='0' ");
    	$staffcreation->execute();
    	$staff_list = $staffcreation->fetch();
	 	$token= $staff_list['token_id'];
		
		$image = 'https://santhila.co/royal_crm/images/logo.jpg';
		define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
		
		$notification = [
		'title' =>'Invoice delivered',
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
			notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Invoice delivered');
        }
 $customer_mobile = $pdo_conn->prepare("SELECT mobile_no FROM customer_creation WHERE customer_id='".$_GET['customer_id']."'");
	$customer_mobile->execute();
	$customer = $customer_mobile->fetch(); 
	$customer_mobile_no=$customer['mobile_no'];
		$message_content="Invoice ".$_GET['invoice_no']." is delivered";
    /*SMS Sending for Customer */ 
    	$url="http://login.smsgatewayhub.com/api/mt/SendSMS?APIKey=mr5pXVZ6fEK0tjZ5eG6jYA&senderid=EROYAL&channel=2&DCS=0&flashsms=0&number=".$customer_mobile_no."&text=".$message_content."&route=31";
      $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL, str_replace(' ','%20',$url));
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, true);
    $data = curl_exec($ch1);
    curl_close($ch1);
?>