<?php
use flowcontrol\library\SQLManager;
use flowcontrol\library\XMManager;
include "../library/SQLManager.php";
include "../library/XMManager.php";

$orderListName="ORDER_LIST";
$dbName="ORDERS";
$sqlManager=new SQLManager($dbName,null);
if(empty($_POST['steplist']))
{
	die();
}
$stepList=$_POST['steplist'];
if(empty($_POST['ordernumber']))
{
	die();
}
$orderNumber=$_POST['ordernumber'];

//create table for ordernumber
$createSen="CREATE TABLE ORDER$orderNumber (ORDERNUMBER INT UNIQUE KEY,DATE TEXT,FLOWLIST TEXT,STATE TEXT)";

// $insertSen="UPDATE $tableName SET FLOWSTEP=\"$stepList\"";
$result=$sqlManager->exec($createSen);


$tableName="ORDER$orderNumber";
$regex="/\//";
$steps=array();
$steps=preg_split($regex, $stepList);

//update orderlist state;
$updateSen="UPDATE $orderListName SET STATE=\"$steps[0]\" WHERE ORDERNUMBER=$orderNumber";
$sqlManager->exec($updateSen);

$date=date("Y/m/d/H:i");
$insertSen="INSERT INTO $tableName (ORDERNUMBER,DATE,FLOWLIST,STATE) VALUES ($orderNumber,\"$date\",\"$stepList\",\"订单建立\")";
try
{
    $sqlManager->exec($insertSen);
	print_r("success");
}
catch(PDOException $e)
{
	print_r($e->getMessage());
}

try
{
$messageTitle="订单$orderNumber";
$messageDesc="需要$steps[0]";
// $payLoad=$steps[1];
$xmManager=new XMManager();
$xmManager->sendPushToNext($messageTitle,$messageDesc,"");
}

catch(Exception $e)
{
	print_r($e->getMessage());
}
?>
