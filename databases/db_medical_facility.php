<?php

  class db_medical_facility {

    public $conn;

    private $host = "localhost";
    private $username = "medical_facility";
    private $password = "medical_facility";
    private $dbName = "medical_facility";

    public function getConnection() {
      try{
        $this->conn = new PDO("mysql:host=". $this->host .";dbname=". $this->dbName, $this->username, $this->password);
      }
      catch(PDOException $exception) {
        echo "Database Connection Failed: ". $exception->getMessage();
      }
      return $this->conn;
    }

  }
?>