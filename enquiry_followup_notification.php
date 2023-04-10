
<?php
date_default_timezone_set('Asia/Kolkata');
header('Access-Control-Allow-Origin: *'); 
//error_reporting(0);
//include("inc/dbConnect.php");
//include("notification_insert.php");
$current_date=date('Y-m-d');
 
              $body="hai";
        
     
    		define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
    		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    		$token="cEk8-naLOLY:APA91bFZXKg9E622Ld2XjnbLgv_mr9e-I9XMULeZh0tBQrhI02iDDViN6yz69LNllw3yxvhBbIWtbD3jB_OO4IT49-b5F4vZkTk0eNF8xROBrJAPLZyQPCYLXxhY5JSog_HmROGEl0LL"; 
    		$image = 'https://santhila.co/royal_crm/images/logo.jpg';
    		
    		$notification = [
    		'title' =>'Enquiry followups',
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
    			$timeout = 0;
    			curl_setopt($ch, CURLOPT_URL,$fcmUrl);
    			curl_setopt($ch, CURLOPT_POST, true);
    			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
    			curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
    		 	$result = curl_exec($ch);
    		/*	curl_close($ch);*/
    				 //notification($current_date,1,'1',$token,$body,'Enquiry followups');
    		}
    		if ($result === FALSE) 
    		{
    	        die('FCM Send Error: ' . curl_error($ch));
    	    }
    		curl_close($ch);
    ?>