<?php

namespace App\Models;

use mysqli;

class Contact {

    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_name = DB_NAME;

    protected $conn;
    protected $query;

    public function __construct()
    {
        $this->connection();
    }

    public function connection(){
        $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if($this->conn->connect_errno)
            die('Connection error: ' . $this->conn->connect_errno);
    }

    public function query($sql){
        $this->query = $this->conn->query($sql);
        return $this;
    }

    public function first(){
        return $this->query->fetch_assoc();
    }

    public function get(){
        return $this->query->fetch_all(MYSQLI_ASSOC);
    }
}