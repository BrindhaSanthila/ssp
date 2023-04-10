<?php

include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
 require_once('../notification_insert.php'); 
error_reporting(0);
$current_date=date('Y-m-d');

if($_POST['action']=="conform_order")
{ 
    $count=$_POST['count'];
    for($i=1;$i<=$count;$i++)
    {
        $quotation	="quotation_id".$i;
        $quotation_id	=$_POST[$quotation];
        $rate="rate".$i;
        $final_amount=$_POST[$rate];
        $amt="amount".$i;
        $amount=$_POST[$amt];
        $total=0;
        $qnty="quantity".$i;
        $final_quantity=$_POST[$qnty]; 
        $gst="gst_per".$i;
        $gst_per=$_POST[$gst];
        $sql = "INSERT INTO  order_confirm (customer_id,staffcreation_id,enquiry_id,quotation_id,order_date,confirm_number,quotation_number,delivery_date) VALUES(:customer_id,:staffcreation_id,:enquiry_id,:quotation_id,:order_date,:confirm_number,:quotation_number,:delivery_date)";
        $pdo_statement = $pdo_conn->prepare($sql);
        $pdo_array=array(':customer_id'=>$_POST['customer_id'],':staffcreation_id'=>$_POST['staffcreation_id'],':enquiry_id'=>$_POST['enquiry_id'],':quotation_id'=>$quotation_id,':order_date'=>$current_date,':confirm_number'=>$_POST['confirm_number'],':quotation_number'=>$_POST['quotation_number'],':delivery_date'=>$_POST['delivery_date']);
        $enquiry_result = $pdo_statement->execute($pdo_array);
        //////////////////////Update in quotation  ////////
      
        $pdo_update=$pdo_conn->prepare("update quotation set gst_per='".$gst_per."',final_rate='".$final_amount."',final_quantity='".$final_quantity."',final_amount='".$amount."',status='1' where quotation_id='".$quotation_id."' ");
        $result = $pdo_update->execute();
        
        $enquiry_update=$pdo_conn->prepare("update enquiry set advance_amount='".$_POST['advance_amount']."',discount_per='".$_POST['discount']."',status='Confirmed'  where enquiry_id='".$_POST['enquiry_id']."' ");
        $enquiry_result = $enquiry_update->execute();


		if ($enquiry_result == TRUE)	
		{ 
			 
		}
		else 
		{ 
			$array = array('error'=> $pdo_statement->errorinfo());
			echo json_encode($array);			
		}		
    }
 
	$name = $_FILES['file']['name'];
	$target_dir = '../upload/quotation/';
	$random_no=rand(0000,9999);
	$random_sc= date('dmyhis');
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$file_name=$random_no.$random_sc.".pdf";
  //echo $target_file;

	 
    if($name!="")
    {
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions_arr = array('pdf');
        if( in_array($imageFileType,$extensions_arr) )
        {
         	if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$file_name))
         	{
                $pdo_update=$pdo_conn->prepare("update enquiry_pdf set quotation_number='$_POST[quotation_number]',quotation_pdf='$file_name' where enquiry_id='$_POST[enquiry_id]' ");
                $result1 = $pdo_update->execute();
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
    
    $customer_mobile = $pdo_conn->prepare("SELECT mobile_no FROM customer_creation WHERE customer_id='".$_POST['customer_id']."'");
	$customer_mobile->execute();
	$customer = $customer_mobile->fetch(); 
    $customer_mobile_no=$customer['mobile_no'];

		$message_content="Order Placed";
    /*SMS Sending for Customer */ 
    $url="http://sms.santhila.com/api/mt/SendSMS?APIKey=mr5pXVZ6fEK0tjZ5eG6jYA&senderid=eroyal&channel=2&DCS=0&flashsms=0&number=".$customer_mobile_no."&text=".$message_content."-Royal Furnitures&route=31";
    
    //	$url="http://login.smsgatewayhub.com/api/mt/SendSMS?APIKey=mr5pXVZ6fEK0tjZ5eG6jYA&senderid=EROYAL&channel=2&DCS=0&flashsms=0&number=".$customer_mobile_no."&text=".$message_content."&route=31";
      $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL, str_replace(' ','%20',$url));
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, true);
    $data = curl_exec($ch1);
    curl_close($ch1);
    $body=  get_enquiry_number($_POST['enquiry_id'])." enquiry is converted to order";
    /////////For Admin/////////
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
		'title' =>'Order Confirmed',
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
			notification($current_date,$token_id['usercreation_id'],'1',$token,$body,'Order Confirmed');
		}
		if ($result === FALSE) 
		{
	        die('FCM Send Error: ' . curl_error($ch));
	    }
	 
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
    		'title' =>'Order Confirmed',
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
    			notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Order Confirmed');
            }
    	}
    	///////////////////////////////////////////////// Staff Notification sending///////////
    	$staffcreation = $pdo_conn->prepare("SELECT staff_name,staffcreation_id,staff_type,token_id FROM staffcreation  WHERE staffcreation_id='".$_POST['staffcreation_id']."' and delete_status='0' ");
    	$staffcreation->execute();
    	$staff_list = $staffcreation->fetch();
	 	$token= $staff_list['token_id'];
		
		$image = 'https://santhila.co/royal_crm/images/logo.jpg';
		define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
		
		$notification = [
		'title' =>'Order Confirmed',
		'body' =>$body,
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
			notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Order Confirmed');
        }
  
	 
}

/*if($_POST['action']=="conform_order")
{ 
$quotation_ids=explode(',',$_POST['quotation_ids']);

 $invoice_status = $pdo_conn->prepare("SELECT * FROM invoice where status='1'  order by invoice_no desc limit 1");
     $invoice_status->execute();
      $invoice_status = $invoice_status->fetch();
 	$invoice_no=$invoice_status['invoice_no'];
 
	 $invoice_no++;
$count=$_POST['count'];
 
for($i=1;$i<=$count;$i++)
 {
 
 	
 
 	   $quotation	="quotation_id".$i;
		 $quotation_id	=$_POST[$quotation];
  
      
     
		if (in_array($quotation_id, $quotation_ids))
  		{  		 

    //echo "SELECT * FROM quotation  WHERE  quotation_id='".$quotation_id."'";
        $order_view = $pdo_conn->prepare("SELECT * FROM quotation  WHERE  quotation_id='".$quotation_id."'");
         $order_view->execute();
          $orderview = $order_view->fetchAll();
           $enquiry_id=$orderview[0]['enquiry_id'];
          $category_id=$orderview[0]['category_id'];
          $subcategory_id=$orderview[0]['subcategory_id'];
            $item_id=$orderview[0]['item_id'];
            $final_amount=$orderview[0]['rate'];
           // $final_quantity=$orderview[0]['final_quantity'];
        $rate="rate".$i;
        $final_amount=$_POST[$rate];
          $amt="amount".$i;
          $amount=$_POST[$amt];
	     $total=0;
	    
         $qnty="quantity".$i;
          $final_quantity=$_POST[$qnty];

			$sql = "INSERT INTO  invoice (invoice_no,enquiry_id,staffcreation_id,customer_id,category_id,subcategory_id,item_id,quotation_id,final_quantity,final_amount,amount,discount,advance_amount,balance_amount) VALUES(:invoice_no,:enquiry_id,:staffcreation_id,:customer_id,:category_id,:subcategory_id,:item_id,:quotation_id,:final_quantity,:final_amount,:amount,:discount,:advance_amount,:balance_amount)";
			$pdo_statement = $pdo_conn->prepare($sql);

			$pdo_array=array(':invoice_no'=>$invoice_no,':enquiry_id'=>$enquiry_id,':staffcreation_id'=>$_POST['staffcreation_id'],':customer_id'=>$_POST['customer_id'],':category_id'=>$category_id,':subcategory_id'=>$subcategory_id,':item_id'=>$item_id,':quotation_id'=>$quotation_id,':final_quantity'=>$final_quantity,':final_amount'=>$final_amount,':amount'=>$amount,':discount'=>$_POST['discount'],':advance_amount'=>$_POST['advance_amount'],':balance_amount'=>$_POST['balance_amount']);
			$enquiry_result = $pdo_statement->execute($pdo_array);

         
		   $pdo_update=$pdo_conn->prepare("update quotation set rate='".$final_amount."',quantity='".$final_quantity."',amount='".$amount."' where quotation_id='".$quotation_id."' ");
			$result = $pdo_update->execute();	
}

}}*/
?>