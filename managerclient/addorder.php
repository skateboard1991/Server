<?php
  use flowcontrol\managerclient\library\SQLManager;
  use flowcontrol\managerclient\library\XMManager;
  include "./library/XMManager.php";
  include "./library/SQLManager.php";
  $tableName="ORDER_LIST";
  $databaseName="ORDERS";
  $sqlManager=new SQLManager($databaseName,$tableName);
  if(empty($_POST['ordernumber']))
  {
  	echo "ordernumber can't empty";
  	die();
  }
   $ordernumber=$_POST['ordernumber'];

  if(empty($_POST['type']))
  {
  	echo "type can't empty";
  	die();
  }

   $type=$_POST['type'];
   
   if(empty($_POST['voltage']))
  {
  	echo "voltage can't empty";
  	die();
  }

  $voltage=$_POST['voltage'];

   if(empty($_POST['size']))
  {
  	echo "size can't empty";
  	die();
  }

  $size= $_POST['size'];

   if(empty($_POST['amount']))
  {
  	echo "amount can't empty";
  	die();
  }

  $amount=$_POST['amount'];

   if(empty($_POST['state']))
  {
  	$_POST['state']="NULL";
  }

  $state=$_POST['state'];
  
   if(empty($_POST['note']))
  {
  	$_POST['note']="NULL";
  }
  $note=$_POST['note'];

  $date=date("Y/m/d/H:i");

  $insertSen="INSERT INTO $tableName (DATE,ORDERNUMBER,TYPE,VOLTAGE,SIZE,AMOUNT,STATE,NOTE) VALUES (\"$date\",$ordernumber,\"$type\",$voltage,\"$size\",$amount,\"$state\",\"$note\")";
  $result=$sqlManager->exec($insertSen);


  //create ordernumber process table
  $creSen="CREATE TABLE ORDER$ordernumber (ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT, DATE TEXT,PROCESS TEXT)";
  $sqlManager->exec($creSen);
    echo "success";
  //send order to next
  // $xmManager=new XMManager();
  // $xmManager->sendPushToNext("");
?>