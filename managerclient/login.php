<?php
 // namespace flowcontrol\managerclient;
 use \flowcontrol\library\SQLManager;
 include "../library/SQLManager.php";
 
 if(empty($_POST['username']))
 {
 	print_r("username is empty");
 	die();
 }

 else if(empty($_POST['password']))
 {
 	print_r("password is empty");
 	die();
 }

  $tableName="ACCOUNTS";
  $databaseName="ACCOUNTS";

 $sqlManager=new SQLManager($databaseName,$tableName);
 $querySen="select * from $tableName";
 $result=$sqlManager->query($querySen);
 $result->setFetchMode(PDO::FETCH_ASSOC);
 $row_array=$result->fetchAll();
 for($i=0;$i<count($row_array);$i++)
 {
 	$row=$row_array[$i];
 	if($_POST['username']==$row['USERNAME'] &&$_POST['password']==$row['PASSWORD']&&strcasecmp($row['LEVEL'], "manager")==0)
 	{
 		print_r("success");
 	    die();
 	}
 	
 }
 print_r("failed");
 die(); 
?>
