<?php

require_once('../inc/dbConnect.php');

/************************************* INSERT ********************************************/

if($_POST['action']=="Add")
{ 
    $select_expense=$pdo_conn->prepare("SELECT COUNT(expense_id) FROM expense WHERE expense_name LIKE '".$_POST['expense_name']."' AND status LIKE '".$_POST['status']."' ");
    $select_expense->execute();
    $expense = $select_expense->fetchAll();
	if($expense[0]['COUNT(expense_id)']==0)
	{
		$sql = "INSERT INTO expense (expense_name,amount,status) VALUES (:expense_name,:amount,:status)";
		$pdo_statement = $pdo_conn->prepare($sql);
			
		$result = $pdo_statement->execute(array(':expense_name'=>$_POST['expense_name'],':amount'=>$_POST['amount'],':status'=>$_POST['status']));
	}
	else
	{
		echo "error";
	}
	if (!empty($result) ){
	  echo $msg = "Successfully Created";
	}
	//else { print_r($pdo_statement->errorinfo()); }
}

/************************************* UPDATE ********************************************/
if($_POST['action']=="Update")
{
	//echo "SELECT COUNT(expense_id) FROM expense WHERE expense_name LIKE '".$_POST['expense_name']."' AND status LIKE '".$_POST['status']."' AND expense_id!='".$_POST['expense_id']."' ";
	$select_expense=$pdo_conn->prepare("SELECT COUNT(expense_id) FROM expense WHERE expense_name LIKE '".$_POST['expense_name']."' AND status LIKE '".$_POST['status']."' AND expense_id!='".$_POST['expense_id']."' ");
    $select_expense->execute();
    $expense = $select_expense->fetchAll();
	if($expense[0]['COUNT(expense_id)']==0)
	{
	   $pdo_statement=$pdo_conn->prepare("update expense set expense_name='".$_POST['expense_name']."',amount='".$_POST['amount']."',status='".$_POST['status']."' where expense_id=".$_POST['expense_id']);
	   $result = $pdo_statement->execute();
	}
	else
	{
		echo "error";
	}
	if(!empty($result)) {
		echo $msg = "Successfully Updated";
	}
	//else { print_r($pdo_statement->errorinfo()); }
	
} 

/************************************* DELETE ********************************************/

if($_POST['action']=="Delete")
{
	
	$pdo_statement="DELETE FROM expense where expense_id=".$_POST['expense_id'];
	$result=$pdo_conn->exec($pdo_statement);
	if(!empty($result)) {
		echo $msg = "Successfully Deleted";
	}
	//else { print_r($pdo_statement->errorinfo()); }
	
}

?> 