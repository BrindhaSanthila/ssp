<?php
date_default_timezone_set('Asia/Kolkata');
header('Access-Control-Allow-Origin: *'); 
error_reporting(0);
include("inc/dbConnect.php");
include("notification_insert.php");
$current_date=date('Y-m-d');
 
$enquiry_followups = $pdo_conn->prepare("SELECT enquiry.enquiry_id, enquiry.enquiry_no, enquiry_followups.next_date, enquiry_followups.usercreation_id FROM enquiry INNER JOIN enquiry_followups ON enquiry.random_no = enquiry_followups.random_no AND enquiry.random_sc = enquiry_followups.random_sc WHERE enquiry.status='Pending'");
$enquiry_followups->execute();
$followups = $enquiry_followups->fetchAll();

foreach($followups as $follow_date)
{
    ini_set('max_execution_time', '0');
    
    $enquiry_no=$follow_date['enquiry_no'];
    $enquiry_date=$follow_date['next_date'];
   
     $date1_ts = strtotime($enquiry_date);
     $date2_ts = strtotime($current_date);

    $diff1 = $date1_ts - $date2_ts;
     $diff=   round($diff1 / 86400);
     
    if($diff<2)
    {
            if($diff=='1') {
                $body ="Tomorrow need to Follow  this    ".$enquiry_no." Enquiry";
            } else if($diff=='0') {
             $body ="Today need to Follow  this    ".$enquiry_no." Enquiry";
            } else if($diff <'0') {
              $body ="You are not  follow  the  ".$enquiry_no." Enquiry";
            }
        
        $staffcreation= $pdo_conn->prepare("SELECT 	staff_name,token_id,staff_type,staffcreation_id FROM staffcreation WHERE staffcreation_id='".$follow_date['usercreation_id']."'");
    	$staffcreation->execute();
    	$staff_list = $staffcreation->fetch();
      	$staff_name=$staff_list['staff_name'];
      
		define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
	    $token=$staff_list['token_id'];  

		$image = 'https://royalfurn.in/royal_crm/images/logo.jpg';
		
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
		if($token!='') {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$fcmUrl);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
	 	  	$result = curl_exec($ch);
			curl_close($ch);
				notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Enquiry followups');
		}
		if($result === FALSE) {
	        die('FCM Send Error: ' . curl_error($ch));
	  }
	   
    }
}
