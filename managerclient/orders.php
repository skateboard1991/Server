<?php
  use \flowcontrol\managerclient\library\SQLManager;
  include "./library/SQLManager.php";
  $tableName="ORDER_LIST";
  $databaseName="ORDERS";
  $sqlManager=new SQLManager($databaseName,$tableName);
  $querSen="SELECT * FROM $tableName";
  $result=$sqlManager->query($querSen);
  $result->setFetchMode(PDO::FETCH_ASSOC);
  $row_array=$result->fetchAll();
  $jsonResult=json_encode($row_array);
  echo "{ \"ORDER_LIST\":$jsonResult } ";
  // foreach ($row_array as $row) {
    
  // }
   // var_dump($result);
?>
