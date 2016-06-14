<?php
   use flowcontrol\library\SQLManager;
   include "../library/SQLManager.php";
 if(empty($_GET['ordernumber']))
  {
  	print_r("don't have ordernumber in request");
    die();
  } 
  $orderNumber=$_GET['ordernumber'];  
  $tableName="ORDER$orderNumber";
  $databaseName="ORDERS";
  $sqlManager=new SQLManager($databaseName,$tableName);
  $queSen="SELECT * FROM $tableName";
  $result=$sqlManager->query($queSen);
  $result->setFetchMode(PDO::FETCH_ASSOC);
  $row_array=$result->fetchAll();
  $jsonResult=json_encode($row_array);
  print_r("{\"states\":$jsonResult}");
?>
