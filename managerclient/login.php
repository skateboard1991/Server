<?php
 namespace flowcontrol\managerclient;
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

 if($_POST['username']=="haoxuanwu" && $_POST['password']=="123321")
 {
 	print_r("success");
 	die();
 }
 else
 {
 	print_r("failed");
    die(); 
 }

?>