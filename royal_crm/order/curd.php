<?php
require_once('../inc/dbConnect.php');
include('../inc/commonfunction.php');
 require_once('../notification_insert.php'); 
error_reporting(0);

$current_date=date('Y-m-d');
$name = $_FILES['file']['name'];
$target_dir = '../upload/order/';
$random_no=rand(0000,9999);
$random_sc= date('dmyhis');
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$file_name=$random_no.$random_sc.".pdf";
 
if($_POST['action']=="conform_order")
{ 
   
  $quotation_ids=explode(',',$_POST['quotation_ids']);
  $count=$_POST['count'];
  for($i=1;$i<=$count;$i++)
  {
 	  $quotation	="quotation_id".$i;
		$quotation_id	=$_POST[$quotation];
		$reg_no=$_POST['reg_no'];
  
		if (in_array($quotation_id, $quotation_ids))
  	{  		 
      $order_view = $pdo_conn->prepare("SELECT * FROM quotation  WHERE  quotation_id='".$quotation_id."'");
      $order_view->execute();
      $orderview = $order_view->fetchAll();
      $enquiry_id=$orderview[0]['enquiry_id'];
      $category_id=$orderview[0]['category_id'];
      $subcategory_id=$orderview[0]['subcategory_id'];
      $item_id=$orderview[0]['item_id'];
      $final_amount=$orderview[0]['rate'];
      $rate="rate".$i;
      $final_amount=$_POST[$rate];
      $amt="amount".$i;
      $amount=$_POST[$amt];
      $gst="gst_per".$i;
      $gst_per=$_POST[$gst];
      $total=0;
      $qnty="quantity".$i;
      $final_quantity=$_POST[$qnty]; 
	$sql = "INSERT INTO  invoice (invoice_no,reg_no,enquiry_id,staffcreation_id,customer_id,category_id,subcategory_id,item_id,quotation_id,final_quantity,final_amount,amount,gst_per,date,quotation_number) VALUES(:invoice_no,:reg_no,:enquiry_id,:staffcreation_id,:customer_id,:category_id,:subcategory_id,:item_id,:quotation_id,:final_quantity,:final_amount,:amount,:gst_per,:date,:quotation_number)";
	$pdo_statement = $pdo_conn->prepare($sql);

	$pdo_array=array(':invoice_no'=>$_POST['invoice_no'],':reg_no'=>$reg_no,':enquiry_id'=>$enquiry_id,':staffcreation_id'=>$_POST['staffcreation_id'],':customer_id'=>$_POST['customer_id'],':category_id'=>$category_id,':subcategory_id'=>$subcategory_id,':item_id'=>$item_id,':quotation_id'=>$quotation_id,':final_quantity'=>$final_quantity,':final_amount'=>$final_amount,':amount'=>$amount,'gst_per'=>$gst_per,'date'=>$current_date,':quotation_number'=>$_POST['quotation_number']);
	$enquiry_result = $pdo_statement->execute($pdo_array);
	 
      if ($enquiry_result == TRUE) 
      { 
           
      }
      else 
      { 
        $array = array('error'=> $pdo_array->errorinfo());
        echo json_encode($array);     
      }
    }
  } 
  if($name!="")
  {
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $extensions_arr = array('pdf');
    if( in_array($imageFileType,$extensions_arr) )
    {
      if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$file_name))
      {
        $pdo_item1 = $pdo_conn->prepare("INSERT INTO order_pdf (enquiry_id,invoice_no,pdf,quotation_number)VALUES(:enquiry_id,:invoice_no,:pdf,:quotation_number)");
		$pdo_array=array(':enquiry_id'=>$_POST['enquiry_id'],':invoice_no'=>$_POST['invoice_no'],':pdf'=>$file_name,':quotation_number'=>$_POST['quotation_number']);	
		$result1 = $pdo_item1->execute($pdo_array);
         
        if ($result1 == TRUE) 
        { 
           
        }
        else 
        { 
          $array = array('error'=> $pdo_update->errorinfo());
          echo json_encode($array);     
        } 
      }
      else
      { 
          echo "File not uploaded"; 
      }
    }
    else
    { 
      echo "check File formatt"; 
    }
  }
   $body="Invoice Generated for  this ".  $_POST['quotation_number']." Quotation";
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
		'title' =>'Invoice Generated',
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
				notification($current_date,$token_id['usercreation_id'],'1',$token,$body,'Invoice Generated');
		}
		if ($result === FALSE) 
		{
	        die('FCM Send Error: ' . curl_error($ch));
	    }
		curl_close($ch);
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
    		'title' =>'Invoice Generated',
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
    			notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Invoice Generated');
            }
    	}
    	///////////////////////////////////////////////// Staff Notification sending///////////
    	//echo "SELECT staff_name,staffcreation_id,staff_type,token_id FROM staffcreation  WHERE staffcreation_id='".$_POST['staffcreation_id']."' and delete_status='0' ";
    	$staffcreation = $pdo_conn->prepare("SELECT staff_name,staffcreation_id,staff_type,token_id FROM staffcreation  WHERE staffcreation_id='".$_POST['staffcreation_id']."' and delete_status='0' ");
    	$staffcreation->execute();
    	$staff_list = $staffcreation->fetch();
	 	$token= $staff_list['token_id'];
		
		$image = 'https://santhila.co/royal_crm/images/logo.jpg';
		define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
		
		$notification = [
		'title' =>'Invoice Generated',
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
			notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Invoice Generated');
        }
}
?>