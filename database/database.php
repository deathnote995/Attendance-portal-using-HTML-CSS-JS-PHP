<?php
class Database
{
  private $servername = "localhost",
          $username = "root",
          $password = "",
          $dbname = "attendance_db";
  public $conn = null;
  
  public function __construct()
  {
    try 
    {
      $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      // set the PDO error mode to exception
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "Connected successfully";
    
      // $cmd="create table tab2(id int auto_increment primary key, user_id varchar(30) unique)";
      // $st=$conn->prepare($cmd);
      // $st->execute();
    } 
    
    catch(PDOException $e) 
    {
      echo "Connection failed: " . $e->getMessage();
    }
  }
}


?>