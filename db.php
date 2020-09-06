<?php 
  class Database {
    // DB Params
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'todo';
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
      } catch(Exception $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }
      return $this->conn;
    }
  }