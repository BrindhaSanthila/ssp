 
<?php
date_default_timezone_set('Asia/Kolkata');
header('Access-Control-Allow-Origin: *'); 
error_reporting(0);
include("inc/dbConnect.php");
 include("notification_insert.php");
$current_date=date('Y-m-d');
//echo "SELECT * FROM paymentcollection order by enquiry_id DESC";
 
$enquiry_followups = $pdo_conn->prepare("SELECT * FROM paymentcollection   group  by enquiry_id order by paymentcreation_id DESC");
$enquiry_followups->execute();
$followups = $enquiry_followups->fetchAll();

foreach($followups as $follow_date)
{
   
    $followup_date=$follow_date['followup_date'];
    $date1_ts = strtotime($followup_date);
    $date2_ts = strtotime($current_date);
    $diff1 = $date1_ts - $date2_ts;
       $diff=   round($diff1 / 86400);
     
    $paayments_followups = $pdo_conn->prepare("SELECT * FROM paymentcollection where   customer_id='".$follow_date['customer_id']."' and enquiry_id='".$follow_date['enquiry_id']."'  group  by enquiry_id order by enquiry_id DESC");
    $paayments_followups->execute();
     $count = $paayments_followups->rowCount();
   if($followup_date!='0000-00-00')
   {
    if($diff<2)
    {
      /*  if($count==0)
        {*/
            if($diff=='1')
            {
                $body ="Tomorrow need to Follow  this    ".$follow_date['enquiry_id']." Enquiry for payment collection";
            }
            else if($diff=='0')
            {
             $body ="Today need to Follow  this    ".$follow_date['enquiry_id']." Enquiry for payment collection";
            }
            else if($diff<'0')
            {
               echo   $body ="You are not  follow  the  ".$follow_date['enquiry_id']."   for payment collection";
            }
        
        $staffcreation= $pdo_conn->prepare("SELECT 	staff_name,token_id,staff_type,staffcreation_id FROM staffcreation WHERE staffcreation_id = '".$follow_date['staffcreation_id']."'");
    	$staffcreation->execute();
    	$staff_list = $staffcreation->fetch();
      	$staff_name=$staff_list['staff_name'];
      
		define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
	    	$token=$staff_list['token_id'];  
		
		$image = 'https://royalfurn.in/royal_crm/images/logo.jpg';
		
		$notification = [
		'title' =>'Payment followups',
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
				notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Payment Collection');
		}
		if ($result === FALSE) 
		{
	        die('FCM Send Error: ' . curl_error($ch));
	    }
		curl_close($ch);
		 if($diff=='1')
            {
                 $body =$staff_name." Tomorrow need to Follow  this    ".$follow_date['enquiry_id']." Enquiry for payment collection";
		////////// For Admin////////
            }
            else if($diff=='0')
            {
             $body =$staff_name." Today need to Follow  this    ".$follow_date['enquiry_id']." Enquiry for payment collection";
            }
            else if($diff<'0')
            {
                $body=$staff_name." is not  follow  the  ".$follow_date['enquiry_id']." Enquiry for payment collection";
            }
		
	//	echo "SELECT * FROM usercreation where  user_roll='1'";
	
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
    		'title' =>'Payment followups',
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
    				 notification($current_date,$token_id['usercreation_id'],'1',$token,$body,'Payment Collection');
    		}
    		if ($result === FALSE) 
    		{
    	        die('FCM Send Error: ' . curl_error($ch));
    	    }
    	 
    	 
        }
        //////Sales Coordinator/////////////
        $sms_creation = $pdo_conn->prepare("SELECT * FROM `sms` WHERE `sms_type` IN ('Sales Coordinator','Accounts')");
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
          'title' =>'Payment Followups',
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
          notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Payment Collection');
          }
        }  
    }
    }
}
?>