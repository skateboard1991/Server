<?php
  use flowcontrol\library\SQLManager;
  include "../library/SQLManager.php";

  $tableName="ORDER_LIST";
  $databaseName="ORDERS";

  if(empty($_GET['ordernumber']))
  {
  	print_r("don't have ordernumber in request");
    die();
  } 
   
   $orderNumber=$_GET['ordernumber'];
   $sqlManager=new SQLManager($databaseName,$tableName);
   $selectSen="SELECT * FROM $tableName WHERE ORDERNUMBER=$orderNumber";
   $result=$sqlManager->query($selectSen);
   $result->setFetchMode(PDO::FETCH_ASSOC);
   $row_array=$result->fetch();
   $jsonResult=json_encode($row_array);
   print_r("$jsonResult");
?>
