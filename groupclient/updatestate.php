<?php
  use flowcontrol\library\SQLManager;
  use flowcontrol\library\XMManager;
  include "../library/SQLManager.php";
  include "../library/XMManager.php";
  if(empty($_POST['state']))
  {
  	die();
  }
  $state=$_POST['state'];
  if(empty($_POST['ordernumber']))
  {
  	die();
  }
  $orderNumber=$_POST['ordernumber'];
  $tableName="ORDER$orderNumber";
  $databaseName="ORDERS";
  $date=date("Y/m/d/H:i");
  $sqlManager=new SQLManager($databaseName,$tableName);
  $updateSen="INSERT INTO $tableName (DATE,STATE) VALUES (\"$date\",\"$state\")";
  $result=$sqlManager->exec($updateSen);

  if(strstr("$state","完成"))
  {
  $queryStepSen="SELECT FLOWLIST FROM $tableName WHERE STATE=\"订单建立\"";
  $queryResult=$sqlManager->query($queryStepSen);
  $queryResult->setFetchMOde(PDO::FETCH_ASSOC);  
  $resultArray=$queryResult->fetchAll();
  $stepArray=array();
  $stepArray=preg_split("/\//", $resultArray[0]['FLOWLIST']);
  $nextStepPos=-1;
  for($num=0;$num<count($stepArray)-1;$num++)
  {
      
        if("$state"=="$stepArray[$num]"."完成")
        {
          $num++;
        	$nextStepPos=$num;
          break;
        }
  }
   
  if($nextStepPos>=count($stepArray)-1)
  {
  	$updateOrderListSen="UPDATE ORDER_LIST SET STATE=\"完成\" WHERE ORDERNUMBER=$orderNumber";
  	$sqlManager->exec($updateOrderListSen);

    $insertFlowListSen="INSERT INTO $tableName (DATE,STATE) VALUES (\"$date\",\"完成\")";
    $sqlManager->exec($insertFlowListSen); 

      try
       {
         $messageTitle="订单$orderNumber";
         $messageDesc="完成";
         $xmManager=new XMManager();
         $xmManager->sendFinishMessageToServer($messageTitle,$messageDesc,"");
       }

      catch(Exception $e)
      { 
        print_r($e->getMessage());
      }
      print_r("success");
  	  die();
  }
  else
  {
  	$updateOrderListSen="UPDATE ORDER_LIST SET STATE=\"$stepArray[$nextStepPos]\" WHERE ORDERNUMBER=$orderNumber";
  	$sqlManager->exec($updateOrderListSen);
    
     try
      {
        $messageTitle="订单$orderNumber";
        $messageDesc="需要$stepArray[$nextStepPos]";
        $xmManager=new XMManager();
        $xmManager->sendPushToNext($messageTitle,$messageDesc,"");
      } 

    catch(Exception $e)
     {
        print_r($e->getMessage());
     }
  }

}

  print_r("success");

?>