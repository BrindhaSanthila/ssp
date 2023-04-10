
<?php
date_default_timezone_set('Asia/Kolkata');
header('Access-Control-Allow-Origin: *'); 
error_reporting(0);
include("inc/dbConnect.php");
include("notification_insert.php");
$current_date=date('Y-m-d');
 

//echo  "SELECT * FROM enquiry_followups where next_date='".$current_date."'";
$order_confirm = $pdo_conn->prepare("SELECT * FROM  order_confirm where delivered_status='0' group  by enquiry_id order by enquiry_id DESC  ");
$order_confirm->execute();
  $order = $order_confirm->fetchAll();

foreach($order as $delivery)
{
  $delivery_date=$delivery['delivery_date'];
  $confirm_number=$delivery['confirm_number'];
  $date1_ts = strtotime($delivery_date);
  $date2_ts = strtotime($current_date);
  $diff1 = $date1_ts-$date2_ts ;
   $diff=   round($diff1 / 86400);
  
     
  if((($diff<5)||($diff==0)) && ($diff>=0))
  {
      echo  $diff;
      echo "<br>";
    ///////////////////////////////////////////////// Department wise Notification sending///////////
  
    if($diff=='0')
    {
        $body=$confirm_number." Confirm number  deliver  today. ";
    }
    else
    {
        $body=$confirm_number." Confirm number  deliver with in ".$diff." days. ";
    }
    
     $staffcreation= $pdo_conn->prepare("SELECT 	staff_name,token_id,staff_type,staffcreation_id FROM staffcreation WHERE staffcreation_id = '".$delivery['staffcreation_id']."'");
    	$staffcreation->execute();
    	$staff_list = $staffcreation->fetch();
      	$staff_name=$staff_list['staff_name'];
      
		define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
	    	$token=$staff_list['token_id'];  
		
		$image = 'https://royalfurn.in/royal_crm/images/logo.jpg';
		
		$notification = [
		'title' =>'Before Delivery',
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
				notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Before Delivery');
		}
		if ($result === FALSE) 
		{
	        die('FCM Send Error: ' . curl_error($ch));
	    }
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
      'title' =>'Before Delivery',
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
      notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Before Delivery');
      }
    }
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
    		'title' =>'Before Delivery',
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
    				 notification($current_date,$token_id['usercreation_id'],'1',$token,$body,'Before Delivery');
    		}
    		if ($result === FALSE) 
    		{
    	        die('FCM Send Error: ' . curl_error($ch));
    	    }
    		curl_close($ch);
    	 
        }
  }
  ////////////Notification sending  for not delivery
  if($diff<0)
  {
          $body=$confirm_number." Confirm number not  delivered. ";
       $staffcreation= $pdo_conn->prepare("SELECT 	staff_name,token_id,staff_type,staffcreation_id FROM staffcreation WHERE staffcreation_id = '".$delivery['staffcreation_id']."'");
    	$staffcreation->execute();
    	$staff_list = $staffcreation->fetch();
      	$staff_name=$staff_list['staff_name'];
      
		define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
	    	$token=$staff_list['token_id'];  
		
		$image = 'https://santhila.co/royal_crm/images/logo.jpg';
		
		$notification = [
		'title' =>'Not Delivery',
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
				notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Not Delivery');
		}
		if ($result === FALSE) 
		{
	        die('FCM Send Error: ' . curl_error($ch));
	    }
   
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
      'title' =>'Not Delivery',
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
      notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Not Delivery');
      }
    }
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
    		'title' =>'Not Delivery',
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
    				 notification($current_date,$token_id['usercreation_id'],'1',$token,$body,'Before Delivery');
    		}
    		if ($result === FALSE) 
    		{
    	        die('FCM Send Error: ' . curl_error($ch));
    	    }
    		curl_close($ch);
    	 
        }	$admin = $pdo_conn->prepare("SELECT * FROM usercreation where  user_roll='1'");
        $admin->execute();
        $admin_token = $admin->fetchAll(); 
        
        foreach($admin_token as $token_id)
        {
            
    		define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
    		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    	  	$token=$token_id['token_id'];  
    		
    		$image = 'https://santhila.co/royal_crm/images/logo.jpg';
    		
    		$notification = [
    		'title' =>'Not Delivery',
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
    				 notification($current_date,$token_id['usercreation_id'],'1',$token,$body,'Not Delivery');
    		}
    		if ($result === FALSE) 
    		{
    	        die('FCM Send Error: ' . curl_error($ch));
    	    }
    		curl_close($ch);
    }
  }
} 

?>