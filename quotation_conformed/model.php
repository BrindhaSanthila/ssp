<?php
require_once('../inc/dbConnect.php');



	$pdo_order=$pdo_conn->prepare("update invoice set delivered_status=1 where invoice_no=".$_GET['invoice_no']);
	$result = $pdo_order->execute();

	if(!empty($result)) 
	{
		echo $msg = "Successfully Delivered";
	}

	$sms_creation = $pdo_conn->prepare("SELECT  sms_type,mobile_no,message  FROM  sms WHERE sms_type='Invoice Generation' ");
	$sms_creation->execute();
	$sms = $sms_creation->fetch(); 
	$admin_mobile = $sms['mobile_no'];
	$message_content= $sms['message'];

	
                     $url= "login.smsgatewayhub.com/api/mt/SendSMS?APIKey=2znyaFxQG0qIxNp8V4TiXw&senderid=KSCBSE&channel=2&DCS=0&flashsms=0&number=".$admin_mobile."&text=".$message_content."&route=1";
    
						$ch=curl_init($url);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch,CURLOPT_POST,1);
						curl_setopt($ch,CURLOPT_POSTFIELDS,"");
						curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
						$data = curl_exec($ch);

?>