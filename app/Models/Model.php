<?php

namespace App\Models;

use mysqli;

class Model {

    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_name = DB_NAME;

    protected $conn;
    protected $query;

    protected $table;

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

    public function all(){
        return $this->query("SELECT * FROM {$this->table}")->get();
    }

    public function find($id){
        return $this->query("SELECT * FROM {$this->table} WHERE id = {$id}")->first();
    }

    public function where($column, $operator, $value = null){

        if($value == null){
            $value = $operator;
            $operator = "=";
        }

        $this->query("SELECT * FROM {$this->table} WHERE {$column} {$operator} {$value}");

        return $this;
    }

    public function create(array $data) {
        $columns = array_keys($data);
        $columns = implode(",", $columns);

        $values = array_values($data);
        $values = "'" . implode("', '", $values) . "'";

        $this->query("INSERT INTO {$this->table} ({$columns}) VALUES ({$values})");

        $id = $this->conn->insert_id;

        return $this->find($id);
    }

    public function update(int $id, array $data){

        $fields = array();
        foreach($data as $column => $value)
            $fields[] = $column . " = '" . $value ."'"; 

        $fields = implode(", ", $fields);

        $this->query("UPDATE {$this->table} SET {$fields} WHERE id = {$id}");

        return $this->find($id);
    }

    public function delete($id){
        $this->query("DELETE FROM {$this->table} WHERE id = {$id}");
    }
}