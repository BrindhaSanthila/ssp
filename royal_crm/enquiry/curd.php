<?php
error_reporting(0);
include('../inc/dbConnect.php');
include('../inc/commonfunction.php');
 include('../notification_insert.php'); 
    $current_date=date('Y-m-d');
/************************************* ENQUIRY ADD ********************************************/

if($_POST['action']=="Add")
{   

    $enquiry_item=$pdo_conn->prepare("SELECT * FROM enquiry_item WHERE   random_no='".$_POST['random_no']."' and random_sc='".$_POST['random_sc']."'  ");
    $result_item = $enquiry_item->execute();
   $count_check = $enquiry_item->rowCount();
    if($count_check!='0')
    {
        
        $enquiry_no=get_enquiry_creation();
        $sql = "INSERT INTO enquiry (random_no, random_sc, customer_id, date,description,usercreation_id,user_type_id,enquiry_no,status) VALUES (:random_no, :random_sc, :customer_id, :date,:description,:usercreation_id,:user_type_id,:enquiry_no,:status)";
        $pdo_item = $pdo_conn->prepare($sql);
        $result = $pdo_item->execute(array(
        ':random_no'=>$_POST['random_no'],
        ':random_sc'=>$_POST['random_sc'],
        ':customer_id'=>$_POST['customer_id'], 
        ':date'=>$_POST['date'],
        ':description'=>$_POST['description'],
        ':usercreation_id'=>$_POST['usercreation_id'],
        ':user_type_id'=>$_POST['user_type_id'],
            ':enquiry_no'=>$enquiry_no,
            ':status'=>$_POST['enquiry_followups_sid']
        ));
    
         $enquiry_id = $pdo_conn->lastInsertId();
        
        $pdo_statement=$pdo_conn->prepare("UPDATE enquiry_item SET enquiry_id='".$enquiry_id."' WHERE random_no='".$_POST['random_no']."' AND random_sc='".$_POST['random_sc']."' ");
        $result2 = $pdo_statement->execute();
    
        $sql_followup = "INSERT INTO enquiry_followups (random_no,random_sc,usercreation_id,user_type_id,customer_id,enquiry_id,date,followups_status,days,next_date,remarks) VALUES(:random_no,:random_sc,:usercreation_id,:user_type_id,:customer_id,:enquiry_id,:date,:followups_status,:days,:next_date,:remarks)";
        $pdo_statement = $pdo_conn->prepare($sql_followup);
        $enquiry_followup_result = $pdo_statement->execute(array(':random_no'=>$_POST['random_no'],':random_sc'=>$_POST['random_sc'],':usercreation_id'=>$_POST['usercreation_id'],':user_type_id'=>$_POST['user_type_id'],':customer_id'=>$_POST['customer_id'],':enquiry_id'=>$enquiry_id,':date'=>$_POST['date'],':followups_status'=>$_POST['enquiry_followups_sid'],':days'=>$_POST['days'],':next_date'=>$_POST['next_date'],':remarks'=>$_POST['remarks'])); 
     
         
        if ($enquiry_followup_result == TRUE)   
        {
            echo $msg = "Successfully Created";
        }
        else 
        { 
            $array = array('error'=> $pdo_statement->errorinfo());
            echo json_encode($array);
            
        }
        $customer_name=get_customer_name($_POST['customer_id']);
        
        //////////Sms Sendinng for  customer/////////////
        
        $customr_list=$pdo_conn->prepare("SELECT customer_name,customer_id,mobile_no FROM customer_creation where delete_status!='1' and customer_id='".$_POST['customer_id']."' ");
        $customr_list->execute();
        $customers=$customr_list->fetch();
       $customer_mobile_no=$customers['mobile_no'];
       
        $message_content="Enquiry Created";


        $url1="http://sms.santhila.com/api/mt/SendSMS?APIKey=mr5pXVZ6fEK0tjZ5eG6jYA&senderid=eroyal&channel=2&DCS=0&flashsms=0&number=".$customer_mobile_no."&text=".$message_content."-Royal Furnitures&route=31";
   
       // $url1="http://login.smsgatewayhub.com/api/mt/SendSMS?APIKey=mr5pXVZ6fEK0tjZ5eG6jYA&senderid=EROYAL&channel=2&DCS=0&flashsms=0&number=".$ 

        $ch2= curl_init();
        curl_setopt($ch2, CURLOPT_URL, str_replace(' ','%20',$url1));
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
        $data = curl_exec($ch2);
        curl_close($ch2);
        
           ////////// For Admin////////
    //  echo "SELECT * FROM usercreation where  user_roll='1'";
     $body= "Enquiry created for ".$customer_name." Customer";
        $admin = $pdo_conn->prepare("SELECT * FROM usercreation where  user_roll='1'");
        $admin->execute();
        $admin_token = $admin->fetchAll(); 
        
        foreach($admin_token as $token_id)
        {
          
            define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
            $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            $token="cEk8-naLOLY:APA91bFZXKg9E622Ld2XjnbLgv_mr9e-I9XMULeZh0tBQrhI02iDDViN6yz69LNllw3yxvhBbIWtbD3jB_OO4IT49-b5F4vZkTk0eNF8xROBrJAPLZyQPCYLXxhY5JSog_HmROGEl0LL";  
            
            $image = 'https://santhila.co/royal_crm/images/logo.jpg';
            
            $notification = [
            'title' =>'Enquiry Created',
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
                notification($current_date,$token_id['usercreation_id'],'1',$token,$body,'Enquiry Created');
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
            'title' =>'Enquiry Created',
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
                notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Enquiry Created');
            }
        }
        ///////////////////////////////////////////////// Staff Notification sending///////////
        $staffcreation = $pdo_conn->prepare("SELECT staff_name,staffcreation_id,staff_type,token_id FROM staffcreation  WHERE staffcreation_id='".$_POST['usercreation_id']."' and delete_status='0' ");
        $staffcreation->execute();
        $staff_list = $staffcreation->fetch();
        $token= $staff_list['token_id'];
        
        $image = 'https://santhila.co/royal_crm/images/logo.jpg';
        define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        
        $notification = [
        'title' =>'Enquiry Created',
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
            notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Enquiry Created');
        }
            
    }
    else
    {
        echo "0";
    }
}




/************************************* QUOTATION Update ********************************************/
 
if($_POST['action']=="quotation_update")
{
  /*if()*/

   $name = $_FILES['file']['name'];
   $name1 = $_FILES['file1']['name'];
  $random_no=rand(0000,9999);
  $random_sc= date('dmyhis');
 $target_dir = '../upload/enquiry/';
  $random_no=rand(0000,9999);
  $random_sc= date('dmyhis');
  $file_name="pdf1".$random_no.$random_sc."."."pdf"; 
 // $file_name1="pdf2".$random_no.$random_sc."."."pdf"; 
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
   $target_file1 = $target_dir . basename($_FILES["file1"]["name"]);
  if($_FILES["file1"]["name"]=="")
  {
     $file_name1="";
  }
  else{
    //$target_file1 = $target_dir . basename($_FILES["file1"]["name"]);
   $file_name1="pdf2".$random_no.$random_sc."."."pdf"; 
  }
  if($name!="" || $name1!='')
  {
  
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $imageFileType1 = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
    $extensions_arr = array('pdf');
    
    if( (in_array($imageFileType,$extensions_arr))||(in_array($imageFileType1,$extensions_arr)))
    {
  
        move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$file_name);
        
        move_uploaded_file($_FILES['file1']['tmp_name'],$target_dir.$file_name1);


  if($_POST['check_img']!='0')
  {

            $pdo_itemm = $pdo_conn->prepare("UPDATE enquiry_pdf SET pdf='$file_name',pdf1='$file_name1' WHERE enquiry_id='".$_POST['enquiry_id']."'");
    $pdo_itemm->execute();
  }
  else if($_POST['check_img']=='0')
  {
      $pdo_item1 = $pdo_conn->prepare("INSERT INTO enquiry_pdf (pdf,pdf1,enquiry_id)VALUES(:pdf,:pdf1,:enquiry_id)");
        $pdo_array=array(':pdf'=>$file_name,':pdf1'=>$file_name1,':enquiry_id'=>$_POST['enquiry_id']);  
        $result1 = $pdo_item1->execute($pdo_array);
 
  }
  
      

   
     }
   else{echo "check File formatt";}
 }
 

 $count = $_POST['count'];
 $enquiry_id = $_POST['enquiry_id'];
 $enquiry_no=$_POST['enquiry_no'];
 for($i = 1; $i<=$count; $i++)
 {
    $category_id='category_id'.$i;
    $cat = $_POST[$category_id];
    $subcategory_id='subcategory_id'.$i;
    $subcat = $_POST[$subcategory_id];
    $item_id='item_id'.$i;
    $item = $_POST[$item_id];
    $rate_id_value='rate_id'.$i;
    $rate_id = $_POST[$rate_id_value];
    $rate_value='rate'.$i;
    $rate = $_POST[$rate_value];
     $quantity='qty'.$i;
    $qty = $_POST[$quantity];
     $amount='amount'.$i;
    $amount = $_POST[$amount];
     $gst='gst_per'.$i;
    $gst_per=$_POST[$gst];

    $sms_send_time=date("Y-m-d H:i:s");
    $sms_send_time = date('Y-m-d H:i:s', strtotime($sms_send_time . ' +3 day'));


    $pdo_items = $pdo_conn->prepare("UPDATE quotation SET rate_id='$rate_id',rate='$rate' ,quantity='$qty' ,gst_per='$gst_per' , amount='$amount' ,user_type_id='".$_POST['user_type_id']."' ,usercreation_id='".$_POST['usercreation_id']."' ,date='".$current_date."' ,quotation_number='".$_POST['quotation_number']."' ,customer_id='".$_POST['customer_id']."' WHERE enquiry_id='".$enquiry_id."' and category_id='".$cat."' and subcategory_id='".$subcat."' and item_id='".$item."'");
    $pdo_items->execute();
 


 }
 
      


}


/************************************* ENQUIRY UPDATE ********************************************/

if($_POST['action']=="Update")
{
     //ECHO "UPDATE enquiry SET customer_id='".$_POST['customer_id']."',date='".$_POST['date']."',usercreation_id='".$_POST['usercreation_id']."',user_type_id='".$_POST['user_type_id']."' WHERE enquiry_id='".$_POST['enquiry_id']."' ";
    $pdo_statement=$pdo_conn->prepare("UPDATE enquiry SET customer_id='".$_POST['customer_id']."',date='".$_POST['date']."',usercreation_id='".$_POST['usercreation_id']."',user_type_id='".$_POST['user_type_id']."',status='".$_POST['enquiry_followups_sid']."',description='".$_POST['description']."' WHERE enquiry_id='".$_POST['enquiry_id']."' ");

    $result = $pdo_statement->execute();
    
//echo "UPDATE enquiry_item SET enquiry_id='".$_POST['enquiry_id']."' WHERE random_no='".$_POST['random_no']."' AND random_sc='".$_POST['random_sc']."' "; 
    $pdo_statement=$pdo_conn->prepare("UPDATE enquiry_item SET enquiry_id='".$_POST['enquiry_id']."' WHERE random_no='".$_POST['random_no']."' AND random_sc='".$_POST['random_sc']."' ");
    $result = $pdo_statement->execute();

 //echo "update enquiry_followups set followups_status='".$_POST['enquiry_followups_sid']."',days='".$_POST['days']."',next_date='".$_POST['next_date']."',remarks='".$_POST['remarks']."' where enquiry_id='".$_POST['enquiry_id']."' and random_no='".$_POST['random_no']."' and random_sc='".$_POST['random_sc']."' ";
    $pdo_statement=$pdo_conn->prepare("update enquiry_followups set followups_status='".$_POST['enquiry_followups_sid']."',days='".$_POST['days']."',next_date='".$_POST['next_date']."',remarks='".$_POST['remarks']."' where enquiry_id='".$_POST['enquiry_id']."' and random_no='".$_POST['random_no']."' and random_sc='".$_POST['random_sc']."'");
$result = $pdo_statement->execute();
   ///echo " UPDATE enquiry_followups SET  followups_status= '".$_GET['followups_sname']."' where enquiry_id='".$_GET['enquiry_id']."'";
  // echo "update enquiry set status='".$_POST['enquiry_followups_sid']."' where enquiry_id='".$_POST['enquiry_id']."' and random_no='".$_POST['random_no']."' and random_sc='".$_POST['random_sc']."'";
     
   // $result = $pdo_statement->execute();   

// if ($_POST['enquiry_followups_sid']=="Quotation Cancelled" || $_POST['enquiry_followups_sid']=="Enquiry Cancelled"){
//     $confirmStatus="Canceled";
//     $pdo_statement=$pdo_conn->prepare("update quotation set confirm_status='".$confirmStatus."',status_updated_from='enquiry' where enquiry_id='".$_POST['enquiry_id']."'");
//     $result = $pdo_statement->execute();   
// }
  
  if ($result == TRUE)  
    {
        echo $msg = "Successfully Updated";
    }
    else 
    { 
        $array = array('error'=> $pdo_item->errorinfo());
        echo json_encode($array);
    }
}
/************************************* ENQUIRY DELETE ********************************************/

if($_POST['action']=="Delete")
{
    
    $enquiry_delete="DELETE FROM enquiry WHERE enquiry_id=".$_POST['enquiry_id'];
    $result=$pdo_conn->exec($enquiry_delete);
   
    $enquiry_delete="DELETE FROM enquiry_pdf WHERE enquiry_id=".$_POST['enquiry_id'];
    $result=$pdo_conn->exec($enquiry_delete);
     
    $enquiry_delete="DELETE FROM quotation WHERE enquiry_id=".$_POST['enquiry_id'];
    $result=$pdo_conn->exec($enquiry_delete);
    
    $enquiry_delete="DELETE FROM enquiry_item WHERE enquiry_id="
    .$_POST['enquiry_id'];
    $result=$pdo_conn->exec($enquiry_delete);
    
    if(!empty($result)) {
        echo $msg = "Successfully Deleted";
    }
}

/************************************* QUOTATION ADD ********************************************/
 
if($_POST['action']=="quotation_add")
{
  /*if()*/
  $name = $_FILES['file']['name'];
  $name1 = $_FILES['file1']['name'];
  $target_dir = '../upload/enquiry/';
  
  $random_no=rand(0000,9999);
  $random_sc= date('dmyhis');
  $file_name="pdf1".$random_no.$random_sc."."."pdf"; 
 // $file_name1="pdf2".$random_no.$random_sc."."."pdf"; 
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $target_file1 = $target_dir . basename($_FILES["file1"]["name"]);
  if($_FILES["file1"]["name"]=="")
  {
     $file_name1="";
  }
  else{
    //$target_file1 = $target_dir . basename($_FILES["file1"]["name"]);
   $file_name1="pdf2".$random_no.$random_sc."."."pdf"; 
  }
  if($name!="")
  {
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $imageFileType1 = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
    $extensions_arr = array('pdf');
    
    if( (in_array($imageFileType,$extensions_arr))||(in_array($imageFileType1,$extensions_arr)))
    {
        
        move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$file_name);
        move_uploaded_file($_FILES['file1']['tmp_name'],$target_dir.$file_name1);
      
        $pdo_item1 = $pdo_conn->prepare("INSERT INTO enquiry_pdf (pdf,pdf1,enquiry_id)VALUES(:pdf,:pdf1,:enquiry_id)");
        $pdo_array=array(':pdf'=>$file_name,':pdf1'=>$file_name1,':enquiry_id'=>$_POST['enquiry_id']);  
        $result1 = $pdo_item1->execute($pdo_array);
      

   
     }
   else{echo "check File formatt";}
 }

 $count = $_POST['count'];
 $enquiry_id = $_POST['enquiry_id'];
 $enquiry_no=$_POST['enquiry_no'];
 for($i = 1; $i<=$count; $i++)
 {
    $category_id='category_id'.$i;
    $cat = $_POST[$category_id];
    $subcategory_id='subcategory_id'.$i;
    $subcat = $_POST[$subcategory_id];
    $item_id='item_id'.$i;
    $item = $_POST[$item_id];
    $rate_id_value='rate_id'.$i;
    $rate_id = $_POST[$rate_id_value];
    $rate_value='rate'.$i;
    $rate = $_POST[$rate_value];
    $quantity='qty'.$i;
    $qty = $_POST[$quantity];
    $amount='amount'.$i;
    $amount = $_POST[$amount];
    $gst='gst_per'.$i;
    $gst_per=$_POST[$gst];

    $sms_send_time=date("Y-m-d H:i:s");
    $sms_send_time = date('Y-m-d H:i:s', strtotime($sms_send_time . ' +3 day'));
    $pdo_item = $pdo_conn->prepare("INSERT INTO quotation (category_id, enquiry_id,subcategory_id, item_id, rate_id, rate, quantity, gst_per, amount ,user_type_id ,usercreation_id,sms_send_time,date,quotation_number,customer_id) VALUES (:category_id, :enquiry_id,:subcategory_id, :item_id, :rate_id, :rate, :quantity, :gst_per, :amount ,:user_type_id,:usercreation_id,:sms_send_time,:date,:quotation_number,:customer_id)");
    $pdo_array=array(':category_id'=>$cat, ':enquiry_id'=>$enquiry_id,':subcategory_id'=>$subcat,':item_id'=>$item, ':rate_id'=>$rate_id, ':rate'=>$rate,':quantity'=>$qty,':gst_per'=>$gst_per, ':amount'=>$amount ,':user_type_id'=>$_POST['user_type_id'],':usercreation_id'=>$_POST['usercreation_id'],':sms_send_time'=>$sms_send_time,':date'=>$current_date,':quotation_number'=>$_POST['quotation_number'],':customer_id'=>$_POST['customer_id']);  
    $result = $pdo_item->execute($pdo_array);
    if ($result == TRUE)    
    {
        echo $msg = "Successfully Updated";
    }
    else 
    { 
        $array = array('error'=> $pdo_item->errorinfo());
        echo json_encode($array);
    }
 }
 
    //////////Sms Sendinng for  customer/////////////

$enquiry_no=get_enquiry_number($enquiry_id);
    $customr_list=$pdo_conn->prepare("SELECT customer_name,customer_id,mobile_no FROM customer_creation where delete_status!='1' and customer_id='".$_POST['customer_id']."' ");
        $customr_list->execute();
        $customers=$customr_list->fetch();
       $customer_mobile_no=$customers['mobile_no'];
       $message_content="Quotation Prepared";
          $url1="http://sms.santhila.com/api/mt/SendSMS?APIKey=mr5pXVZ6fEK0tjZ5eG6jYA&senderid=eroyal&channel=2&DCS=0&flashsms=0&number=".$customer_mobile_no."&text=".$message_content."-Royal Furnitures&route=31";
      ///  $url1="http://login.smsgatewayhub.com/api/mt/SendSMS?APIKey=mr5pXVZ6fEK0tjZ5eG6jYA&senderid=EROYAL&channel=2&DCS=0&flashsms=0&number=".$customer_mobile_no."&text=".$message_content."&route=31";
    
        $ch2= curl_init();
        curl_setopt($ch2, CURLOPT_URL, str_replace(' ','%20',$url1));
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
        $data = curl_exec($ch2);
        curl_close($ch2);
    $body="Quotation Prepared for this ".$enquiry_no." Enquiry";
 ///////Admin nottoificaation  Senndinng//////
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
        'title' =>'Quotation Prepared',
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
            notification($current_date,$token_id['usercreation_id'],'1',$token,$body,'Quotation Prepared');
        }
        if ($result === FALSE) 
        {
            die('FCM Send Error: ' . curl_error($ch));
        }
      
    }   ///////////////////////////////////////////////// Department wise Notification sending///////////
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
        'title' =>'Quotation Prepared',
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
            notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Quotation Prepared');
        }
    }
    ///////////////////////////////////////////////// Staff Notification sending///////////
    $staffcreation = $pdo_conn->prepare("SELECT staff_name,staffcreation_id,staff_type,token_id FROM staffcreation  WHERE staffcreation_id='".$_POST['usercreation_id']."' and delete_status='0' ");
    $staffcreation->execute();
    $staff_list = $staffcreation->fetch();
    $token= $staff_list['token_id'];
    
    $image = 'https://santhila.co/royal_crm/images/logo.jpg';
    define('API_ACCESS_KEY','AIzaSyCoWuWL0ENI5DUfSDElcNSDPqiGFWaOP44');
    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    
    $notification = [
    'title' =>'Quotation Prepared',
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
        notification($current_date,$staff_list['staffcreation_id'],$staff_list['staff_type'],$token,$body,'Quotation Prepared');
    }
    $pdo_item = $pdo_conn->prepare("UPDATE enquiry SET quotation_status='1',status='Quoted' WHERE enquiry_id='".$_POST['enquiry_id']."'");
    $pdo_item->execute();
 
     


}


/************************************* SUBFORM LIST ADD ********************************************/

if($_POST['action']=="subformadd")
{ 
    $item_id = $_POST['item_id'];
    $category_id = $_POST['cat_id'];
    $subcategory_id = $_POST['sc_id'];
 
     
    $quantity = $_POST['quantity'];
     
    $random_no = $_POST['random_no'];
    $random_sc = $_POST['random_sc'];
    $gst_per=$_POST['gst_per'];
    
 
    $new_name1 = "image1".$random_no.$random_sc."."."jpg";
        $new_name2 = "image2".$random_no.$random_sc."."."jpg";
         $new_name3 = "image3".$random_no.$random_sc."."."jpg";
    $new_name4 = "image4".$random_no.$random_sc."."."jpg";
    if(move_uploaded_file($_FILES["file_data"]["tmp_name"],"../../royal_furniture_mobapp/img/enquiry_images/".$new_name1))
    {
            $new_name1 = "image1".$random_no.$random_sc."."."jpg";
    }
    else
    {
            $new_name1 = "";
    }
    if( move_uploaded_file($_FILES["file_data1"]["tmp_name"],"../../royal_furniture_mobapp/img/enquiry_images/".$new_name2))
    {
            $new_name2 = "image2".$random_no.$random_sc."."."jpg";
    }
    else
    {
        $new_name2 = "";
    }
    if( move_uploaded_file($_FILES["file_data2"]["tmp_name"],"../../royal_furniture_mobapp/img/enquiry_images/".$new_name3))
    {
    $new_name3 = "image3".$random_no.$random_sc."."."jpg";
    }
    else
    {
    $new_name3=""   ;
    }
     if(move_uploaded_file($_FILES["file_data3"]["tmp_name"],"../../royal_furniture_mobapp/img/enquiry_images/".$new_name4))
    {
            $new_name4 = "image4".$random_no.$random_sc."."."jpg";
    }
    else
    {
        $new_name4="";
    }
    $sql = "INSERT INTO enquiry_item (item_id,category_id,subcategory_id,quantity,gst_per,random_no,random_sc,enquiry_image,enquiry_image1,enquiry_image2,enquiry_image3) 
    VALUES(:item_id,:category_id,:subcategory_id,:quantity,:gst_per,:random_no,:random_sc,:enquiry_image,:enquiry_image1,:enquiry_image2,:enquiry_image3)";
    $pdo_statement = $pdo_conn->prepare($sql);
    $pdo_array=array(
        ':item_id'=>$item_id,
        ':category_id'=>$category_id,
        ':subcategory_id'=>$subcategory_id,
        ':quantity'=>$quantity,
        ':gst_per'=>$gst_per,
        ':random_no'=>$random_no,
        ':random_sc'=>$random_sc, 
        ':enquiry_image'=>$new_name1,
        ':enquiry_image1'=>$new_name2,
        ':enquiry_image2'=>$new_name3,
        ':enquiry_image3'=>$new_name4);
    $result = $pdo_statement->execute($pdo_array);

 
 
if ($result == TRUE)    
    {
        
        
        echo $msg = "Successfully Created";
    }
    else 
    { 
        $array = array('error'=> $pdo_statement->errorinfo());
        echo json_encode($array);
        
    }
 
}

/************************************* SUBFORM LIST UPDATE ********************************************/

if($_POST['action']=="subformupdate") 
{ 
         
     $random_no1=rand(00000,99999);
 
 $random_sc1 = date('dmyhis');
        $new_name1 = "image1".$random_no1.$random_sc1."."."jpg";
        $new_name2 = "image2".$random_no1.$random_sc1."."."jpg";
         $new_name3 = "image3".$random_no1.$random_sc1."."."jpg";
    $new_name4 = "image4".$random_no1.$random_sc1."."."jpg";
  if(move_uploaded_file($_FILES["file_data"]["tmp_name"],"../../royal_furniture_mobapp/img/enquiry_images/".$new_name1))
    {
            $new_name1 = "image1".$random_no1.$random_sc1."."."jpg";
    }
    else
    {
            $new_name1 =  $_POST['enquiry_image'];
    }
    if( move_uploaded_file($_FILES["file_data1"]["tmp_name"],"../../royal_furniture_mobapp/img/enquiry_images/".$new_name2))
    {
            $new_name2 = "image2".$random_no1.$random_sc1."."."jpg";
    }
    else
    {
        $new_name2 = $_POST['enquiry_image1'];
    }
    if( move_uploaded_file($_FILES["file_data2"]["tmp_name"],"../../royal_furniture_mobapp/img/enquiry_images/".$new_name3))
    {
    $new_name3 = "image3".$random_no1.$random_sc1."."."jpg";
    }
    else
    {
    $new_name3=$_POST['enquiry_image2'];
    }
     if(move_uploaded_file($_FILES["file_data3"]["tmp_name"],"../../royal_furniture_mobapp/img/enquiry_images/".$new_name4))
    {
            $new_name4 = "image4".$random_no1.$random_sc1."."."jpg";
    }
    else
    {
        $new_name4=$_POST['enquiry_image3'];
    }
        $pdo_statement=$pdo_conn->prepare("UPDATE enquiry_item SET category_id='".$_POST['cat_id']."',subcategory_id='".$_POST['sc_id']."',item_id='".$_POST['item_id']."',quantity='".$_POST['quantity']."',gst_per='".$_POST['gst_per']."',enquiry_image='".$new_name1."',enquiry_image1='".$new_name2."',enquiry_image2='".$new_name3."',enquiry_image3='".$new_name4."' WHERE order_id='".$_POST['order_id']."' ");
    
    $result = $pdo_statement->execute();



    if (!empty($result) )
    {
        echo $msg = "Successfully Updated";
    }   
}

/************************************* SUBFORM LIST DELETE ********************************************/

if($_POST['action']=="subform_delete")
{    
    $pdo_statement=$pdo_conn->prepare("UPDATE enquiry_item SET status='0' WHERE order_id='".$_POST['order_id']."'");
    $result=$pdo_statement->execute();
    if(!empty($result)) {
        echo $msg = "Successfully Deleted";
    }
}

/************************************* ITEM CHANGE ****************************************************/

if($_POST['action']=="itemChange")
  {   
    //get item rate
    $item_id = $_POST['item_id'];   
    $itemchange = $pdo_conn->prepare("SELECT * FROM ratefixing WHERE item_id = $item_id ORDER BY item_id ASC");
    $itemchange->execute();
    $item = $itemchange->fetch();   
    

    //get item name
    $item_name = $pdo_conn->prepare("SELECT * FROM itemcreation WHERE item_id = $item_id ORDER BY item_id ASC");
    $item_name->execute();
    $itemname = $item_name->fetch();
    
    $rate = $item['rate'];
    $rate_id = $item['rate_id'];
    $name = $itemname['item_name'];
    $category_id = $itemname['category_id'];
    $subcategory_id = $itemname['subcategory_id'];
     echo $rate."@@".$rate_id."@@".$name."@@".$category_id."@@".$subcategory_id;
  }
?>

