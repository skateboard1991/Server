<?php
   namespace flowcontrol\library;
   class SQLManager
   {
      private $serverName="localhost";
      private $userName="root";
      private $passWord="132231";
      private $dbName;
      private $tableName;
      private $conn;
      private static $sqlManager;
      
      public function __construct($dbName,$tableName)
      {
          try
  	    {
          $this->dbName=$dbName;
          $this->tableName=$tableName;
          $this->conn = new \PDO("mysql:host=$this->serverName;dbname=$this->dbName", $this->userName,$this->passWord);
        }
          catch(PDOException $e)
        {
    	   echo $e->getMessage();
        }

      } 


      public function exec($sen)
      {

      	return $this->conn->exec($sen);
      }

      public function query($sen)
      {
      	return $this->conn->query($sen);
      }
   }


?>
