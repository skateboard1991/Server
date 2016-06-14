<?php
 use flowcontrol\library\SQLManager;
 use flowcontrol\library\XMManager;
 include "../library/SQLManager.php";
 include "../library/XMManager.php";
$tableName="ORDER_LIST";
$dbName="ORDERS";
if(empty($_POST['ordernumber']))
{
   die();
}
$orderNumber=$_POST['ordernumber'];
if(empty($_POST['step']))
{
	die();
}
$step=$_POST['step'];
$sqlManager=new SQLManager($dbName,$tableName);
$querySen="SELECT FLOWSTEPS FROM $tableName WHERE ORDERNUMBER=$orderNumber";
$result=$sqlManager->query($querySen);
$result->setFetchMode(PDO::FETCH_ASSOC);
$flowSteps=$result["FLOWSTEP"];
$regex="/\//";
$totalSteps=array();
$totalSteps=preg_split($regex, $flowSteps);
$stepNum=-1;
for($num;$num<count($totalSteps);$num++)
{
    if($totalSteps[$num]==$step)
    {
          $stepNum=++$num;
    }

}

$nextStep="完成";

if($stepNum<count($totalSteps))
{
   $nextStep=$totalSteps[$stepNum];
}

$updateSen="UPDATE $tableName SET STATE=$nextStep WHERE ORDERNUMBER=$orderNumber";
$sqlManager->exec($updateSen);

$messageTitle="订单$orderNumber";
$messageDesc="需要$nextStep";
$xmManager=new XMManager();
$xmManager->sendPushToNext($messageTitle,$messageDesc,"");

?>