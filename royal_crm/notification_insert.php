<?php

function notification($date,$user_id,$user_roll,$token_id,$content,$type)
{
	global $pdo_conn;
	$sql = "INSERT INTO notification (date,user_id,user_roll,token_id,content,type) VALUES (:date,:user_id,:user_roll,:token_id,:content,:type)";
	$pdo_statement = $pdo_conn->prepare($sql);
	$result = $pdo_statement->execute(array(':date'=>$date,':user_id'=>$user_id,':user_roll'=>$user_roll,':token_id'=>$token_id,':content'=>$content,':type'=>$type));
   /* if (!empty($result) )
	{
	  echo $msg = "Successfully Created";
	}*/
}
?>