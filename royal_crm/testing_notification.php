<?php 

	$token = "cply7pTLQaGF5zbMiwjrR1:APA91bGIbNX8Ay1FR5v1TSbkwA8ovClX-lNLijN9Rb-JvOxnoO3l7IkoASPNEHJ36S9GdicXeLUiAHGO8LtTuHq_OBNJY87RpVxxtpP_03yxyKp1cqXYgknkdXX4D_yoe1OXP1HdKBcD";
	$staff_name="jsads";
	$wish="jsads";
    send_notification($token, $date, $staff_name, $wish);


function send_notification($token, $date, $staff_name, $wish)
{           	
	$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
	// $token1 = $token;
	//$token = "ds_WSXwwRouKSFLcphThDL:APA91bH1Y_XWnzNsEVWm1Fkr8v3pSnitn13l51Ww9MOlwfgenqzGOHD79xJf2u3HEfuU3xRU1rZBnz_IdWLQhBSByT4GJnA7uK6_FhmKC4WzYZdXVRsGMqcQUkjKazCnrJJKTdciJNXc";
	
	$image = '';
	$body = "Dear ".$staff_name." \nZigma Team wishes you a very Happy ".$wish;
	$title = "Anniversary Wish ** ".$date;
	
	$notification = [
					'title' =>	$title,
					'body' 	=> 	$body,
					'icon' 	=>	$image		
					];
	
	$extraNotificationData = ["message" => $notification,"moredata" =>'Data'];

	$fcmNotification  = [		
						'to'        	=> $token,
						'notification' 	=> $notification,
						'data' 			=> $extraNotificationData
						];

	$headers =  [
				'Authorization: key=' ."AAAAOZWrDr4:APA91bH14JNTRzOkRRHVLRFmfuWOPPdRwW6dONBPpYlNRxpGXTMwU9hsW7TOzq--0aXe8imrphoLqkN7zycCHlBuqNqQ03wYAhq2jrwjF2yTdTD-LE53EPP-YtIzqGB2Fyv1k-lQLBk3",
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
		
		if (!curl_errno($ch)) {
  $info = curl_getinfo($ch);
  echo 'Took ', $info['total_time'], ' seconds to send a request to ', $info['url'], "\n";
}

		curl_close($ch);
	}
	
	if ($result === FALSE) 
	{
		die('FCM Send Error: ' . curl_error($ch));
		return curl_error($ch);
	}
	else
	{
	    return $token;
	}		   
}
             
?>