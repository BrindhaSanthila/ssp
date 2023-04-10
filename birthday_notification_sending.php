
<?php 
date_default_timezone_set('Asia/Kolkata');
header('Access-Control-Allow-Origin: *'); 
error_reporting(0);
include("inc/dbConnect.php");
include("notification_insert.php");
$current_date=date('Y-m-d');
 $current_date1=date('m-d');
$day = date("D",strtotime($cur_date));
//echo "SELECT * FROM customer_creation where dob like '%".$current_date1."%' ";
 
$customr_list=$pdo_conn->prepare("SELECT * FROM customer_creation where dob like '%".$current_date."%' ");
$customr_list->execute();
$customers=$customr_list->fetchAll();
 foreach($customers as $record)
	 {
	    $body="Today is ".$record['customer_name']." birthday ";
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
    
          $image = 'https://royalfurn.in/royal_crm/images/logo.jpg';
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
          notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Birthday wishes');
          }
        }
				 
		
	}

 
?>
