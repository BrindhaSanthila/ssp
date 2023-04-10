
 <?php
date_default_timezone_set('Asia/Kolkata');
header('Access-Control-Allow-Origin: *'); 
error_reporting(0);
include("inc/dbConnect.php");
include("notification_insert.php");
$current_date=date('Y-m-d');
 //echo "SELECT * FROM quotation  WHERE   confirm_status='Pending' group by enquiry_id order by enquiry_id DESC";
$quotation = $pdo_conn->prepare("SELECT * FROM quotation  WHERE   confirm_status='Pending' group by enquiry_id order by enquiry_id DESC");
$quotation->execute();
$quotation_list = $quotation->fetchAll();
foreach($quotation_list as $record)
{
    $quotation_date=$record['date'];
    $date1_ts = strtotime($quotation_date);
    $date2_ts = strtotime($current_date);
    $diff1 = $date2_ts - $date1_ts;
    $diff=   round($diff1 / 86400);
    
      
    if($diff>1)
    {
        $body=$record['quotation_number']." is not Approved";
    	$staffcreation= $pdo_conn->prepare("SELECT 	staff_name,token_id,staff_type,staffcreation_id FROM staffcreation WHERE staffcreation_id = '".$record['usercreation_id']."'");
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
    			notification($current_date,$staff_list['usercreation_id'],$staff_list['staff_type'],$token,$body,'Quotation Not Approval');
    	}
    	if ($result === FALSE) 
    	{
            die('FCM Send Error: ' . curl_error($ch));
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
    			curl_setopt($ch, CURLOPT_URL,$fcmUrl);
    			curl_setopt($ch, CURLOPT_POST, true);
    			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
    		 	$result = curl_exec($ch);
    			curl_close($ch);
    				 notification($current_date,$token_id['usercreation_id'],'1',$token,$body,'Quotation Not Approval');
    		}
    		if ($result === FALSE) 
    		{
    	        die('FCM Send Error: ' . curl_error($ch));
    	    }
    		curl_close($ch);
    	 
        }
        //////Sales Coordinator/////////////
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
          'title' =>'Enquiry Followups',
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
          notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Quotation Not Approval');
          }
        }
    }
}
?>