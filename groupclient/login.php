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
 	if(strcasecmp($_POST['username'],$row['USERNAME'])==0 && strcasecmp($_POST['password'], $row['PASSWORD'])==0 && strcmp($row['LEVEL'],"group")==0 )
 	{
 		$logInResult=array("result"=>"success","step"=>"$row[STEP]");
 		print_r(json_encode($logInResult));
 	    die();
 	}
 	
 }
 print_r("failed");
 die(); 
?>
