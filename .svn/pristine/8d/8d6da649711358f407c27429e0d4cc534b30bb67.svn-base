<?php
//despatch_sub_id>0 and despatch_sub_id<10 
session_start();
require_once('inc/dbConnect.php');
$i=0;

 $db_sql="SELECT random_sc FROM `enquiry_item` order by order_id desc limit 0,100 ";
        $getprepare = $pdo_conn->prepare($db_sql);
        $exc = $getprepare->execute();	
        $list = $getprepare->fetchAll();
        
        foreach($list as $value)
        {
          
 $sql = "SELECT COUNT(*)  FROM enquiry WHERE random_sc='$value[random_sc]' ";
$res = $pdo_conn->query($sql);
echo "count".$count = $res->fetchColumn(); 
if($count==0)
{
    
     
 $db_sql="delete  FROM `enquiry_item` where random_sc='$value[random_sc]'";
        $getprepare = $pdo_conn->prepare($db_sql);
        $exc = $getprepare->execute();	 
}

        }
    ?>